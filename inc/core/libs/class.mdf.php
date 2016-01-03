<?
class Core_Mdf {

    public $errors; // Store error codes
    public $wallet_history_types;
    public $packages;

    function __construct() {

        $this->wallet_history_types = array('order', 'order_adjustment', 'order_delete', 'fund_adjustment');
        $this->packages = [];

    }

    function create_partner($options = []) {

        Core::ensure_defaults(array(
                'name' => '',
                'level' => ''
            )
        , $options);

        if($options['name'] == '') {

            return Core::error("Please enter a name for the partner");

        }

        $partner_entity_id = Core::fetch_column(
            "SELECT entity_id FROM " . GAMO_DB . ".entities WHERE name = :name AND type = :type",
            array(
                ':name' => $options['name'],
                ':type' => 'partner'
            )
        );

        if(!is_numeric($partner_entity_id)) {

            $partner_entity_id = Core::db_insert(array(
                    'table' => GAMO_DB . '.entities',
                    'values' => array(
                        'name' => $options['name'],
                        'type' => 'partner'
                    )
                )
            );

        }

        
        if(!is_numeric($partner_entity_id)) {

            return Core::error("There was a database level error while creating your partner. Please refresh the page and try again."); 

        }

        if($options['level'] != '') {

            $unique = array(
                'entity_id' => $partner_entity_id,
                'info_type' => 'partner_level'
            );

            $level = array(
                'entity_id' => $partner_entity_id,
                'info_type' => 'partner_level',
                'info_a' => $options['level']
            );

            Core::db_delete(array(
                    'table' => GAMO_DB . ".entities_info",
                    'where' => array(
                        'entity_id' => $partner_entity_id,
                        'info_type' => 'partner_level',
                        '!info_a' => $options['level']
                    )
                )
            );

            self::create_info(array(
                    'table' => GAMO_DB . ".entities_info",
                    'values' => $level,
                    'unique' => $unique
                )
            );

        }

        return array(
            'partner_entity_id' => $partner_entity_id
        );

    }

    function create_vendor($options = []) {

        Core::ensure_defaults(array(
                'name' => ''
            )
        , $options);

        if($options['name'] == '') {

            return Core::error("Please enter a name for the vendor");

        }

        $vendor_entity_id = Core::fetch_column(
            "SELECT entity_id FROM " . GAMO_DB . ".entities WHERE name = :name AND type = :type",
            array(
                ':name' => $options['name'],
                ':type' => 'vendor'
            )
        );

        if(!is_numeric($vendor_entity_id)) {

            $vendor_entity_id = Core::db_insert(array(
                    'table' => GAMO_DB . '.entities',
                    'values' => array(
                        'name' => $options['name'],
                        'type' => 'vendor'
                    )
                )
            );

        }

        
        if(!is_numeric($vendor_entity_id)) {

            return Core::error("There was a database level error while creating your vendor. Please refresh the page and try again."); 

        }

        return array(
            'vendor_entity_id' => $vendor_entity_id
        );

    }
    
    function create_info($options = []) {

        Core::ensure_defaults(array(
                'table' => GAMO_DB . '.entities_info',
                'values' => [],
                'unique' => []
            )
        , $options);

        if(count($options['unique']) > 0) {

            $c = Core::db_count(array(
                    'table' => $options['table'],
                    'values' => $options['unique']
                )
            );

            if($c > 0) {

                return Core::error("An info entry like this already exists");

            }

        }

        if(count($options['values']) == 0) {

            return Core::error("No values were specified for creating the info entry");

        }

        $id = Core::db_insert(array(
                'table' => $options['table'],
                'values' => $options['values']
            )
        );

        if(!is_numeric($id)) {

            return Core::error("There was a database level error while creating your info entry. Please refresh the page and try again."); 

        }

        return array(
            'id' => $id
        );

    }

    function assign_user_to_partner($options = []) {

        Core::ensure_defaults(array(
                'user_id' => '',
                'partner_entity_id' => ''
            )
        , $options);

        if(!is_numeric($options['user_id'])) {

            $options['user_id'] = Core::fetch_column(
                "SELECT user_id FROM " . GAMO_DB . ".users WHERE email = :email",
                array(
                    ':email' => $options['user_id']
                )
            );

            if(!is_numeric($options['user_id'])) {

                return Core::error("User could not be found based on email address for user to partner assignment");

            }

        }

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".users",
                'values' => array(
                    'user_id' => $options['user_id']
                )
            )
        );

        if($c == 0) {

            return Core::error("User could not be found based on user id for user to partner assignment");

        }

       $options['partner_entity_id'] = self::ensure_entity_id($options['partner_entity_id']);

       if(Core::has_error($options['partner_entity_id'])) {

            return $options['partner_entity_id'];

       }

        Core::db_delete(array(
                'table' => GAMO_DB . ".users_info",
                'where' => array(
                    'user_id' => $options['user_id'],
                    'info_type' => 'partner',
                    '!int_info' => $options['partner_entity_id']
                )
            )
        );

        $users_info_id = Core::r('users')->create_user_info(array(
                'user_id' => $options['user_id'],
                'info_type' => 'partner',
                'int_info' => $options['partner_entity_id']
            )
        );

        if(Core::has_error($users_info_id)) {

            if($users_info_id['error_code'] != 13) { // error code 13 means that this assignment already exists. It's not actually an error.

                return $users_info_id;

            }   

        }

        return array(
            'assigned' => 1
        );

    }

    function get_user_partner($options = []) {

        Core::ensure_defaults([
            'user_id' => ''
        ], $options);

        $partner_entity_id = Core::fetch_column(
            "SELECT int_info FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND info_type = 'partner' LIMIT 0, 1",
            array(
                ':user_id' => $options['user_id']
            )
        );

        if(!is_numeric($partner_entity_id)) {

            return Core::error("Could not find this user's partner ID");

        }

        $partner = self::get_entity([
            'entity_id' => $partner_entity_id
        ]);

        return $partner;

    }

    function save_activity($options = []) {

        Core::ensure_defaults([
            'user_id' => -1,
            'package_id' => -1,
            'quarter_id' => -1,
            'mdf_activity_id' => -1,
            'packages_option_id' => -1,
            'form' => []
        ], $options);

        if($options['mdf_activity_id'] != -1) {

            $activity = Core::r('mdf')->get_activities([
                'mdf_activity_ids' => [$options['mdf_activity_id']]
            ]);

            if(count($activity['activities']) != 1) {

                return Core::error("Invalid activity ID specified. Please refresh the page and try again.");

            }

            $activity = $activity['activities'][0];
            $options['package_id'] = $activity['package_id'];

        }

        $package = self::get_package([
            'package_id' => $options['package_id']
        ]);

        if(Core::has_error($package)) {

            return $package;

        }

        $partner = self::get_user_partner([
            'user_id' => $options['user_id']
        ]);

        if(Core::has_error($partner)) {

            return $partner;

        }

        // Ensure that package option ID is valid
        $k = Core::multi_find($package['packages_options'], 'packages_option_id', $options['packages_option_id']);

        $price = 0;

        if($k == -1) {

            return Core::error("The specified package option is not valid for this package");

        }

        $price = $package['packages_options'][$k]['price'];

        // Ensure that the quarter id is valid
        $k = Core::multi_find($package['packages_info'], [
            'info_type' => 'quarter',
            'numeric_info' => $options['quarter_id']
        ]);

        if($k == -1) {

            return Core::error("Invalid quarter specified for this package");

        }

        $has_funds_price = $price;

        if($options['mdf_activity_id'] != -1) {

            $has_funds_price = $price - $activity['price'];

        }

        $has_funds = self::entity_has_funds(array(
                'entity_id' => $partner['entity_id'],
                'quarter_id' => $options['quarter_id'],
                'bucket_category_id' => $package['bucket_category_id'],
                'amount' => $has_funds_price
            )
        );

        if(Core::has_error($has_funds)) {

            return $has_funds;

        }

        $validate = self::validate_form([
            'form_config' => $package['order_form']['form'],
            'form' => $options['form']
        ]);

        if(Core::has_error($validate)) {

            return $validate;

        }

        $action_type = Core::r('actions')->action_types_id('create_mdf_activity');

        if($action_type == false) {

            return Core::error("Could not find create mdf activity action type");

        }

        if($options['mdf_activity_id'] == -1) {

            $mdf_activity_id = Core::unique_string(16);

            $wallet_history = self::create_wallet_history([
                'entity_id' => $partner['entity_id'],
                'quarter_id' => $options['quarter_id'],
                'bucket_category_id' => $package['bucket_category_id'],
                'user_id' => $options['user_id'],
                'reference_id' => $mdf_activity_id,
                'type' => 'order',
                'amount' => $price*-1
            ]);

            if(Core::has_error($wallet_history)) {

                return $wallet_history;

            }

            $action_id = Core::r('actions')->create_action([
                'action_types_id' => $action_type,
                'user_id' => $options['user_id'],
                'int_other' => $partner['entity_id'],
                'other' => $options['package_id'],
                'other_b' => $mdf_activity_id,
                'other_c' => $options['quarter_id']
            ]);

        } else {

            $mdf_activity_id = $options['mdf_activity_id'];

            Core::db_delete([
                'table' => GAMO_DB . ".actions_info",
                'where' => [
                    'action_id' => $activity['action_id'],
                    'info_type' => 'mdf_field'
                ]
            ]);

            $action_id['action_id'] = $activity['action_id'];

        }

        foreach($options['form'] as $field_id => $val) {

            Core::db_delete([
                'table' => GAMO_DB . ".actions_info",
                'where' => [
                    'action_id' => $action_id['action_id'],
                    'info_type' => 'mdf_field',
                    'info' => $field_id,
                    '!info_b' => $val
                ]
            ]);
            
            $insert = Core::db_insert([
                'table' => GAMO_DB . ".actions_info",
                'values' => array(
                    'action_id' => $action_id['action_id'],
                    'info_type' => 'mdf_field',
                    'info' => $field_id,
                    'info_b' => $val,
                    'time' => Core::datetime()
                ),
                'unique' => array(
                    'action_id' => $action_id['action_id'],
                    'info_type' => 'mdf_field',
                    'info' => $field_id
                )
            ]);

        }

        return array(
            'mdf_activity_id' => $mdf_activity_id
        );

    }

    function entity_has_funds($options = []) {

        Core::ensure_defaults([
            'entity_id' => -1,
            'bucket_category_id' => -1,
            'amount' => 0,
            'quarter_id' => 0
        ], $options);

        $wallet = self::get_wallet([
            'entity_id' => $options['entity_id'],
            'quarter_id' => $options['quarter_id']
        ]);

        if(Core::has_error($wallet)) {

            return $wallet;

        }

        $k = Core::multi_find($wallet['buckets'], 'bucket_category_id', $options['bucket_category_id']);

        if($k == -1) {

            return Core::error("You do not have enough funds to order this package option");

        }

        $bucket = $wallet['buckets'][$k];

        if($bucket['balance'] < $options['amount']) {

            return Core::error("You do not have enough funds to order this package option");

        }

        return true;

    }

    function validate_form($options = []) {

        Core::ensure_defaults([
            'form_config' => [],
            'form' => []
        ], $options);
        
        unset($options['form']['undefined']);

        $save_fields = [];

        foreach($options['form_config'] as $k => $section) {

            foreach($section['fields'] as $k2 => $field) {

                if(isset($field['required']) && $field['required'] == 1) {

                    if(!isset($options['form'][$field['id']]) || trim($options['form'][$field['id']]) == '') {

                        return Core::error("The field '" . $field['label'] . "' is required");

                    }

                }

                if(isset($field['validate'])) {

                    if(isset($field['validate']['is_email']) && $field['validate']['is_email'] == 1) {

                        $check = Core::r('users')->validate_email([
                            'email' => $options['form'][ $field['id'] ],
                            'unique_check' => 0
                        ]);

                        if(Core::has_error($check)) {

                            return Core::error("The field '" . $field['label'] . "' must be a valid email address");

                        }

                    }

                }

                if($field['type'] == 'select'
                    && Core::multi_find($field['options'], 'value', $options['form'][ $field['id'] ]) == -1) {

                    return Core::error("The option selected for '" . $field['label'] . "' does not appear valid. Please refresh the page and try again.");

                }

                if(isset( $options['form'][ $field['id'] ] )) {

                    $save_fields[ $field['id'] ] = $options['form'][ $field['id'] ];

                }

            }

        }

        return $save_fields;

    }

    function assign_order_form_to_package($options = []) {

        Core::ensure_defaults([
            'package_id' => '',
            'mdf_form_id' => ''
        ], $options);

        Core::db_delete(array(
                'table' => GAMO_DB . ".packages_info",
                'where' => array(
                    'package_id' => $options['package_id'],
                    'info_type' => 'order_form',
                    '!numeric_info' => $options['mdf_form_id']
                )
            )
        );

        $values = [
            'package_id' => $options['package_id'],
            'info_type' => 'order_form',
            'numeric_info' => $options['mdf_form_id']
        ];

        $save = self::create_info(array(
                'table' => GAMO_DB . ".packages_info",
                'values' => $values,
                'unique' => $values
            )
        );

        return $save;

    }

    function ensure_entity_id($entity_id, $type = 'partner') {

        if(!is_numeric($entity_id)) {

            $entity_id = Core::fetch_column(
                "SELECT entity_id FROM " . GAMO_DB . ".entities WHERE name = :name AND type = :type",
                array(
                    ':type' => $type,
                    ':name' => $entity_id
                )
            );

            if(!is_numeric($entity_id)) {

                return Core::error("Entity could not be found based on entity name");

            }

        }

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".entities",
                'values' => array(
                    'entity_id' => $entity_id
                )
            )
        );

        if($c == 0) {

            return Core::error("Entity could not be found based on id");

        }

        return $entity_id;

    }

    function ensure_quarter_id($quarter_id) {

        if(!is_numeric($quarter_id)) {

            $quarter_id = Core::fetch_column(
                "SELECT quarter_id FROM " . GAMO_DB . ".quarters WHERE name = :name",
                array(
                    ':name' => $quarter_id
                )
            );

            if(!is_numeric($quarter_id)) {

                return Core::error("quarter could not be found based on quarter name for user to quarter assignment");

            }

        }

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".quarters",
                'values' => array(
                    'quarter_id' => $quarter_id
                )
            )
        );

        if($c == 0) {

            return Core::error("quarter could not be found based on quarter id for user to quarter assignment");

        }

        return $quarter_id;

    }

    function create_wallet($options = []) {

        Core::ensure_defaults(array(
                'entity_id' => '',
                'quarter_id' => ''
            )
        , $options);

        $options['entity_id'] = self::ensure_entity_id($options['entity_id']);

        if(Core::has_error($options['entity_id'])) {

            return $options['entity_id'];

        }

        $options['quarter_id'] = self::ensure_quarter_id($options['quarter_id']);

        if(Core::has_error($options['quarter_id'])) {

            return $options['quarter_id'];

        }

        $wallet_id = Core::fetch_column(
            "SELECT wallet_id FROM " . GAMO_DB . ".wallets WHERE entity_id = :entity_id AND quarter_id = :quarter_id",
            array(
                ':entity_id' => $options['entity_id'],
                ':quarter_id' => $options['quarter_id']
            )
        );

        if(!is_numeric($wallet_id)) {

            $wallet_id = Core::db_insert(array(
                    'table' => GAMO_DB . ".wallets",
                    'values' => array(
                        'entity_id' => $options['entity_id'],
                        'quarter_id' => $options['quarter_id'],
                        'active' => 1
                    )
                )
            );

        }

        if(!is_numeric($wallet_id)) {

            return Core::error("There was a database level error while creating your wallet");

        }

        return array(
            'wallet_id' => $wallet_id
        );

    }

    function get_entities($options = []) {

        Core::ensure_defaults(array(
                'type' => ''
            )
        , $options);

        global $dbh;

        $sql = "SELECT entity_id, name, type FROM " . GAMO_DB . ".entities WHERE type = :type";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':type' => $options['type']
            )
        );

        $entities = [];

        while($row = $sth->fetch()) {

            $entities[] = Core::remove_numeric_keys($row);

        }

        return $entities;

    }

    function get_entity($options = []) {

        Core::ensure_defaults([
            'entity_id' => -1
        ], $options);

        global $dbh;

        $sql = "SELECT entity_id, name, type FROM " . GAMO_DB . ".entities WHERE entity_id = :entity_id";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':entity_id' => $options['entity_id']
            )
        );

        $entity = $sth->fetch();

        if(!is_array($entity)) {

            return Core::error("Could not find entity based on specified ID");

        }

        return Core::remove_numeric_keys($entity);

    }

    function create_package($options = []) {

        Core::ensure_defaults(array(
                'vendor_entity_id' => '',
                'bucket_category_id' => '',
                'name' => '',
                'description' => ''
            )
        );
        
        if($options['name'] == '') {

            return Core::error("Please enter a name for your package");

        }

        if($options['description'] == '') {

            return Core::error("Please enter a description for your package");

        }

        $options['vendor_entity_id'] = self::ensure_entity_id($options['vendor_entity_id'], 'vendor');

        if(Core::has_error($options['vendor_entity_id'])) {

            return $options['vendor_entity_id'];

        }

        $options['bucket_category_id'] = Core::r('categories')->ensure_category_id($options['bucket_category_id'], 'mdf_bucket_type');

        if(Core::has_error($options['bucket_category_id'])) {

            return $options['bucket_category_id'];

        }

        $package_id = Core::fetch_column(
            "SELECT package_id FROM " . GAMO_DB . ".packages WHERE vendor_entity_id = :vendor_entity_id AND bucket_category_id = :bucket_category_id AND name = :name",
            array(
                ':vendor_entity_id' => $options['vendor_entity_id'],
                ':bucket_category_id' => $options['bucket_category_id'],
                ':name' => $options['name']
            )
        );

        if(is_numeric($package_id)) {

            Core::db_update(array(
                    'table' => GAMO_DB . '.packages',
                    'values' => array(
                        'description' => $options['description']
                    ),
                    'where' => array(
                        'package_id' => $package_id
                    )
                )
            );

            return array(
                'package_id' => $package_id
            );

        }

        $package_id = Core::db_insert(array(
                'table' => GAMO_DB . '.packages',
                'values' => array(
                    'vendor_entity_id' => $options['vendor_entity_id'],
                    'bucket_category_id' => $options['bucket_category_id'],
                    'name' => $options['name'],
                    'description' => $options['description'],
                    'active' => 1
                )
            )
        );

        if(!is_numeric($package_id)) {

            return Core::error("There was a database level error while creating your package");

        }

        return array(
            'package_id' => $package_id
        );

    }

    function create_packages_option($options = []) {

        Core::ensure_defaults(array(
                'package_id' => '',
                'description' => '',
                'price' => ''
            )
        , $options);

        if($options['description'] == '') {

            return Core::error("Please enter a description for your package option");

        }

        $packages_option_id = Core::fetch_column(
            "SELECT packages_option_id FROM " . GAMO_DB . ".packages_options WHERE package_id = :package_id AND description = :description AND price = :price",
            array(
                ':package_id' => $options['package_id'],
                ':description' => $options['description'],
                ':price' => $options['price']
            )
        );

        if(is_numeric($packages_option_id)) {

            return array(
                'packages_option_id' => $packages_option_id
            );

        }

        $packages_option_id = Core::db_insert(array(
                'table' => GAMO_DB . ".packages_options",
                'values' => array(
                    'package_id' => $options['package_id'],
                    'description' => $options['description'],
                    'price' => $options['price']
                )
            )
        );

        if(!is_numeric($packages_option_id)) {

            return Core::error("There was a database level error while creating your package option");

        }   

        return array(
            'packages_option_id' => $packages_option_id
        );

    }

    function assign_package_to_quarter($options = []) {

        Core::ensure_defaults(array(
                'package_id' => '',
                'quarter_id' => ''
            )
        , $options);

        $options['quarter_id'] = self::ensure_quarter_id($options['quarter_id']);

        if(Core::has_error($options['quarter_id'])) {

            return $options['quarter_id'];

        }

        $save = array(
            'package_id' => $options['package_id'],
            'info_type' => 'quarter',
            'numeric_info' => $options['quarter_id']
        );

        self::create_info(array(
                'table' => GAMO_DB . ".packages_info",
                'values' => $save,
                'unique' => $save
            )
        );

        return array(
            'created' => 1
        );

    }

    function assign_package_to_category($options = []) {

        Core::ensure_defaults(array(
                'package_id' => '',
                'category_id' => ''
            )
        , $options);

        $options['category_id'] = Core::r('categories')->ensure_category_id($options['category_id']);

        if(Core::has_error($options['category_id'])) {

            return $options['category_id'];

        }

        $save = array(
            'package_id' => $options['package_id'],
            'info_type' => 'category',
            'numeric_info' => $options['category_id']
        );

        self::create_info(array(
                'table' => GAMO_DB . ".packages_info",
                'values' => $save,
                'unique' => $save
            )
        );

        return array(
            'created' => 1
        );

    }

    function unassign_package_from_category($options = []) {

        Core::ensure_defaults(array(
                'package_id' => '',
                'category_id' => ''
            )
        , $options);

        $options['category_id'] = Core::r('categories')->ensure_category_id($options['category_id'], 'mdf_package_type');

        if(Core::has_error($options['category_id'])) {

            return $options['category_id'];

        }

        $save = array(
            'package_id' => $options['package_id'],
            'info_type' => 'category',
            'numeric_info' => $options['category_id']
        );

        Core::db_delete(array(
                'table' => GAMO_DB . ".packages_info",
                'where' => $save
            )
        );

        return array(
            'removed' => 1
        );

    }

    function create_wallet_history($options = []) {

        Core::ensure_defaults(array(
                'wallet_id' => '',
                'entity_id' => '',
                'quarter_id' => '',
                'bucket_category_id' => '',
                'user_id' => '',
                'reference_id' => '',
                'type' => '',
                'amount' => '',
                'notes' => '',
                'info_a' => '',
                'info_b' => '',
                'is_target_amount' => 0,
                'datetime' => Core::datetime()
            )
        , $options);
        
        if(!is_numeric($options['amount'])) {

            return Core::error("The wallet history amount must be a valid number");

        }

        $wallet = self::get_wallet($options);

        if(Core::has_error($wallet)) {

            return $wallet;

        }

        $options['wallet_id'] = $wallet['wallet_id'];

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".wallets",
                'values' => array(
                    'wallet_id' => $options['wallet_id']
                )
            )
        );

        if($c == 0) {

            return Core::error("The specified wallet could not be found when creating this wallet history entry");

        }

        if(!in_array($options['type'], $this->wallet_history_types)) {

            return Core::error("Invalid type specified for wallet history entry");

        }

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".users",
                'values' => array(
                    'user_id' => $options['user_id']
                )
            )
        );

        if($c == 0) {

            return Core::error("Invalid creator user id specified for wallet history entry");

        }

        $options['bucket_category_id'] = Core::r('categories')->ensure_category_id($options['bucket_category_id'], 'mdf_bucket_type');

        if(!is_numeric($options['bucket_category_id'])) {

            return Core::error("Invalid bucket type specified when creating wallet history entry");

        }

        if($options['is_target_amount'] == 1) {

            $k = Core::multi_find($wallet['buckets'], 'bucket_category_id', $options['bucket_category_id']);

            if($k != -1) {

                $current_balance = $wallet['buckets'][$k]['balance'];
                
                $options['amount'] = $options['amount'] - $current_balance;

            }

        }

        $save = array(
            'wallet_id' => $wallet['wallet_id'],
            'bucket_category_id' => $options['bucket_category_id'],
            'entity_id' => $wallet['entity_id'],
            'user_id' => $options['user_id'],
            'reference_id' => $options['reference_id'],
            'type' => $options['type'],
            'amount' => $options['amount'],
            'notes' => $options['notes'],
            'info_a' => $options['info_a'],
            'info_b' => $options['info_b'],
            'datetime' => $options['datetime'],
            'active' => 1
        );

        $wallets_history_id = Core::db_insert(array(
                'table' => GAMO_DB . ".wallets_history",
                'values' => $save
            )
        );

        if(!is_numeric($wallets_history_id)) {

            return Core::error("There was a database level error when saving your wallet history entry");

        }

        return array(
            'wallet_history_id' => $wallets_history_id
        );

    }

    function get_bucket_types() {

        global $dbh;

        $sql = "SELECT category_id AS bucket_category_id, category_name AS bucket_name FROM " . GAMO_DB . ".categories WHERE category_type = 'mdf_bucket_type'";
        $sth = $dbh->prepare($sql);
        $sth->execute();

        $bucket_types = [];

        while($row = $sth->fetch()) {

            $bucket_types[] = Core::remove_numeric_keys($row);

        }

        return $bucket_types;

    }

    function get_wallet($options = []) {

        Core::ensure_defaults(array(
                'wallet_id' => '',
                'entity_id' => '',
                'quarter_id' => '',
                'user_id' => '',
                'all_buckets' => 0
            )
        , $options);

        if($options['user_id'] != '') {

            $partner = self::get_user_partner([
                'user_id' => $options['user_id']
            ]);

            if(Core::has_error($partner)) {

                return $partner;

            }

            $options['entity_id'] = $partner['entity_id'];

        }

        if($options['entity_id'] != '' && $options['quarter_id'] != '' && !is_numeric($options['wallet_id'])) {

            $options['entity_id'] = self::ensure_entity_id($options['entity_id'], 'partner');

            if(!is_numeric($options['entity_id'])) {

                return Core::error("Invalid entity id specified for retrieving wallet");

            }

            $options['quarter_id'] = self::ensure_quarter_id($options['quarter_id']);

            if(!is_numeric($options['quarter_id'])) {

                return Core::error("Invalid quarter id specified for retrieving wallet");

            }

            $options['wallet_id'] = Core::fetch_column(
                "SELECT wallet_id FROM " . GAMO_DB . ".wallets WHERE entity_id = :entity_id AND quarter_id = :quarter_id",
                array(
                    ':entity_id' => $options['entity_id'],
                    ':quarter_id' => $options['quarter_id']
                )
            );

        }

        if(!is_numeric($options['wallet_id'])) {

            return Core::error("No wallet could be found matching the specified filters");

        }

        global $dbh;

        $sql = "SELECT wallet_id, entity_id, quarter_id, active FROM " . GAMO_DB . ".wallets WHERE wallet_id = :wallet_id LIMIT 0, 1";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':wallet_id' => $options['wallet_id']
            )
        );

        $wallet = $sth->fetch();

        if(!is_array($wallet)) {

            return Core::error("No wallet could be found matching the specified filters when trying to retrieve wallet details");

        }

        $wallet = Core::remove_numeric_keys($wallet);

        $sql = "SELECT
        bucket_category_id,
        (SELECT category_name FROM " . GAMO_DB . ".categories AS categories WHERE categories.category_id = wallets_history.bucket_category_id) AS bucket_name,
        SUM(amount) AS balance
        FROM
        " . GAMO_DB . ".wallets_history AS wallets_history
        WHERE
        wallet_id = :wallet_id
        AND active = 1
        GROUP BY bucket_category_id";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':wallet_id' => $options['wallet_id']
            )
        );

        $wallet['buckets'] = [];

        while($row = $sth->fetch()) {

            $wallet['buckets'][] = Core::remove_numeric_keys($row);

        }

        if($options['all_buckets'] == 1) {

            $bucket_types = self::get_bucket_types();

            foreach($bucket_types as $k => $bucket_type) {

                if(Core::multi_find($wallet['buckets'], 'bucket_category_id', $bucket_type['bucket_category_id']) == -1) {

                    $wallet['buckets'][] = [
                        'bucket_category_id' => $bucket_type['bucket_category_id'],
                        'bucket_name' => $bucket_type['bucket_name'],
                        'balance' => 0
                    ];

                }

            }

        }

        return $wallet;

    }

    function get_package($options = []) {

        Core::ensure_defaults(array(
                'package_id' => ''
            )
        , $options);

        if(isset($this->packages[$options['package_id']])) {

            return $this->packages[$options['package_id']];

        }

        global $dbh;

        $sql = "SELECT
        package_id,
        vendor_entity_id,
        (
            SELECT
            name
            FROM " . GAMO_DB . ".entities AS entities
            WHERE entities.entity_id = packages.vendor_entity_id
        ) AS vendor_name,
        bucket_category_id,
        (
            SELECT
            category_name
            FROM " . GAMO_DB . ".categories AS categories
            WHERE categories.category_id = packages.bucket_category_id AND categories.category_type = 'mdf_bucket_type'
        ) AS bucket_name,
        name,
        description,
        active
        FROM " . GAMO_DB . ".packages AS packages
        WHERE
        package_id = :package_id";
        
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':package_id' => $options['package_id']
            )
        );

        $package = $sth->fetch();

        if(!is_array($package)) {

            return Core::error("Could not find package based on specified package id");

        }

        $package['packages_options'] = [];
        $package['min_price'] = 9999999999;
        $package['max_price'] = -999999999;

        $sql = "SELECT
        packages_option_id,
        description,
        price
        FROM " . GAMO_DB . ".packages_options
        WHERE
        package_id = :package_id";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':package_id' => $options['package_id']
            )
        );

        while($row = $sth->fetch()) {

            $package['packages_options'][] = Core::remove_numeric_keys($row);

            $package['min_price'] = min($row['price'], $package['min_price']);
            $package['max_price'] = max($row['price'], $package['max_price']);

        }

        $package['display_price'] = ($package['min_price'] == $package['max_price']) ? '$' . round($package['min_price']) : '$' . round($package['min_price']) . ' to $' . round($package['max_price']); 
        $package['category_names'] = [];

        $package['packages_info'] = [];

        $sql = "SELECT
        packages_info_id,
        info_type,
        info_a,
        info_b,
        numeric_info,
        datetime
        FROM " . GAMO_DB . ".packages_info
        WHERE
        package_id = :package_id";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':package_id' => $options['package_id']
            )
        );

        $order_form = -1;

        while($row = $sth->fetch()) {    

            if($row['info_type'] == 'category') {

                $row['category_name'] = Core::fetch_column(
                    "SELECT category_name FROM " . GAMO_DB . ".categories WHERE category_id = :category_id",
                    array(
                        ':category_id' => $row['numeric_info']
                    )
                );

                $package['category_names'][] = $row['category_name'];

            }

            $package['packages_info'][] = Core::remove_numeric_keys($row);

            if($row['info_type'] == 'order_form') {

                $order_form = $row['numeric_info'];

            }

        }

        $package['order_form'] = self::get_form([
            'mdf_form_id' => $order_form
        ]);

        if(!Core::has_error($package['order_form'])) {

            $investment_levels = [];
            $investment_levels_fields = [];

            foreach($package['packages_options'] as $k => $option) {

                $investment_levels[] = [
                    'value' => $option['packages_option_id'],
                    'label' => '$' . $option['price']*1
                ];

                $investment_levels_fields[] = [
                    'id' => 'packages_option_id_' . $option['packages_option_id'],
                    'type' => 'content_block',
                    'show_if' => [
                        'id' => 'packages_option_id',
                        'value' => $option['packages_option_id']
                    ],
                    'content' => $option['description']
                ];

            }

            array_unshift($investment_levels_fields, [
                'id' => "packages_option_id",
                'label' => "Investment Level",
                'type' => "select",
                'required' => 0,
                'options' => $investment_levels
            ]);

            array_unshift($package['order_form']['form'], [
                'name' => 'Package Selection',
                'fields' => $investment_levels_fields
            ]);

        }

        $package = Core::remove_numeric_keys($package);

        $this->packages[$options['package_id']] = $package;

        return $package;

    }

    function get_form($options = []) {

        Core::ensure_defaults([
            'mdf_form_id' => -1
        ]);

        global $dbh;

        $sql = "SELECT mdf_form_id, form, description FROM " . GAMO_DB . ".mdf_forms WHERE mdf_form_id = :mdf_form_id";
        $sth = $dbh->prepare($sql);
        $sth->execute([
            'mdf_form_id' => $options['mdf_form_id']
        ]);

        $row = $sth->fetch();

        if(!is_array($row)) {

            return Core::error("Could not find the specified form");

        }

        $row['form'] = json_decode($row['form'], true);

        return Core::remove_numeric_keys($row);

    }

    function delete_activity($options = []) {

        global $dbh;

        Core::ensure_defaults([
            'mdf_activity_id' => '',
            'user_id' => -1
        ], $options);

        $activity = self::get_activities([
            'mdf_activity_ids' => [$options['mdf_activity_id']]
        ]);

        if(Core::has_error($activity)) {

            return Core::error("This activity could not be found. Please refresh the page and try again.");
        }

        $activity = $activity['activities'][0];

        $balance = Core::fetch_column(
            "SELECT SUM(amount) FROM " . GAMO_DB . ".wallets_history WHERE reference_id = :reference_id",
            array(
                ':reference_id' => $options['mdf_activity_id']
            )
        );

        $wallet_history = [];
        
        if($balance < 0) {
            
            $sql = "SELECT wallet_id, bucket_category_id, entity_id FROM " . GAMO_DB . ".wallets_history WHERE reference_id = :reference_id AND type = 'order' ORDER BY datetime DESC LIMIT 0, 1";
            $sth = $dbh->prepare($sql);
            $sth->execute([
                ':reference_id' => $options['mdf_activity_id']
            ]);

            $wallet_history = $sth->fetch();

            if(!is_array($wallet_history)) {

                return Core::error("Could not properly local wallet history for this activity. Please contact " . ADMIN_EMAIL . " for further assistance.");

            }

        }

        $update = Core::r('actions')->modify_action([
            'action_id' => $activity['action_id'],
            'values' => 'delete'
        ]);

        if(Core::has_error($update)) {

            return Core::error("There was an error while deleting this activity. Please refresh the page and try again.");

        }

        if($balance < 0) {

            $history = self::create_wallet_history([
                'wallet_id' => $wallet_history['wallet_id'],
                'entity_id' => $wallet_history['entity_id'],
                'bucket_category_id' => $wallet_history['bucket_category_id'],
                'user_id' => $options['user_id'],
                'reference_id' => $options['mdf_activity_id'],
                'type' => 'order_delete',
                'amount' => $balance * -1
            ]);

            if(Core::has_error($history)) {

                return Core::error("There was an error while deleting this activity. Please refresh the page and try again.");

            }

        }

        return array(
            'deleted' => 1
        );

    }

    function get_activities($options = []) {

        global $dbh;

        Core::ensure_defaults(array(
                'mdf_activity_ids' => [],
                'quarter_ids' => [],
                'vendor_entity_ids' => [],
                'bucket_category_ids' => [],
                'category_ids' => [],
                'partner_entity_ids' => [],
            )
        , $options);

        if(!is_array($options['quarter_ids'])) { $options['quarter_ids'] = []; }
        if(!is_array($options['vendor_entity_ids'])) { $options['vendor_entity_ids'] = []; }
        if(!is_array($options['bucket_category_ids'])) { $options['bucket_category_ids'] = []; }
        if(!is_array($options['category_ids'])) { $options['category_ids'] = []; }
        if(!is_array($options['partner_entity_ids'])) { $options['partner_entity_ids'] = []; }

        /*
        'int_other' => $partner['entity_id'],
            'other' => $options['package_id'],
            'other_b' => $mdf_activity_id,
            'other_c' => $options['quarter_id']
            */

        $action_type = Core::r('actions')->action_types_id('create_mdf_activity');

        $sql_filters = [];

        $params = [
            ':action_types_id' => $action_type
        ];

        if(count($options['mdf_activity_ids'])) {

            $mdf_activity_ids = [];
            
            foreach($options['mdf_activity_ids'] as $k => $mdf_activity_id) {

                $mdf_activity_ids[] = addslashes($mdf_activity_id);
                
            }
            
            $sql_filters[] = "other_b IN ('" . implode("','", $mdf_activity_ids) . "')";

        }

        if(count($options['partner_entity_ids'])) {

            $options['partner_entity_ids'] = Core::ensure_numeric($options['partner_entity_ids']);

            $sql_filters[] = "int_other IN (" . implode(",", $options['partner_entity_ids']) . ")";

        }

        if(count($options['quarter_ids'])) {

            $options['quarter_ids'] = Core::ensure_numeric($options['quarter_ids']);

            $sql_filters[] = "other_c IN (" . implode(",", $options['quarter_ids']) . ")";

        }


        if(count($options['vendor_entity_ids'])) {

            $options['vendor_entity_ids'] = Core::ensure_numeric($options['vendor_entity_ids']);

            $sql_filters[] = "(SELECT count(*) FROM " . GAMO_DB . ".packages AS packages WHERE packages.package_id = actions_log.other AND packages.vendor_entity_id IN (" . implode(",", $options['vendor_entity_ids']) . ")) > 0";

        }

        if(count($options['bucket_category_ids'])) {

            $options['bucket_category_ids'] = Core::ensure_numeric($options['bucket_category_ids']);

            $sql_filters[] = "(SELECT count(*) FROM " . GAMO_DB . ".packages AS packages WHERE packages.package_id = actions_log.other AND packages.bucket_category_id IN (" . implode(",", $options['bucket_category_ids']) . ")) > 0";

        }

        if(count($options['category_ids'])) {

            $options['category_ids'] = Core::ensure_numeric($options['category_ids']);

            $sql_filters[] = "(SELECT count(*) FROM " . GAMO_DB . ".packages_info AS packages_info WHERE packages_info.package_id = actions_log.other AND packages_info.info_type = 'category' AND packages_info.numeric_info IN (" . implode(",", $options['category_ids']) . ")) > 0";

        }

        $sql = "SELECT
        action_id,
        action_types_id,
        user_id,
        point_value_used,
        int_other AS partner_entity_id,
        other AS package_id,
        other_b AS mdf_activity_id,
        other_c AS quarter_id,
        time
        FROM " . GAMO_DB . ".actions_log AS actions_log
        WHERE
        action_types_id = :action_types_id
        AND active = 1
        ";

        if(count($sql_filters)) {

            $sql .= ' AND ' . implode(" AND ", $sql_filters);

        }
        
        $sth = $dbh->prepare($sql);
        $sth->execute($params);

        $activities = [];

        $sql_fields = "SELECT info, info_b FROM " . GAMO_DB . ".actions_info WHERE action_id = :action_id AND info_type = 'mdf_field'";
        $fields_sth = $dbh->prepare($sql_fields);

        while($row = $sth->fetch()) {
            
            Core::remove_numeric_keys($row);

            $row['fields'] = [];

            $fields_sth->execute([
                ':action_id' => $row['action_id']
            ]);

            while($field = $fields_sth->fetch()) {

                $row['fields'][$field['info']] = $field['info_b'];

            }

            $row['package'] = self::get_package([
                'package_id' => $row['package_id']
            ]);

            unset($row['package']['order_form']);

            $row['price'] = Core::fetch_column(
                "SELECT SUM(amount) FROM " . GAMO_DB . ".wallets_history WHERE reference_id = :reference_id AND type = 'order'",
                array(
                    ':reference_id' => $row['mdf_activity_id']
                )
            );

            $row['price'] *= -1;
            
            $k = Core::multi_find($row['package']['packages_options'], 'packages_option_id', $row['fields']['packages_option_id']);

            $row['package_option'] = $row['package']['packages_options'][$k];

            $row['display_order_date'] = date("M j, Y", strtotime($row['time']));

            $activities[] = $row;

        }

        return array(
            'activities' => $activities
        );

    }

    function get_packages($options = []) {

        Core::ensure_defaults(array(
                'quarter_ids' => [],
                'vendor_entity_ids' => [],
                'bucket_category_ids' => [],
                'category_ids' => []
            )
        , $options);

        global $dbh;

        $sql_filters = [];

        if(count($options['vendor_entity_ids']) > 0) {

            $vendor_entity_ids = [];

            foreach($options['vendor_entity_ids'] as $k => $vendor_entity_id) {

                if(is_numeric($vendor_entity_id)) {

                    $vendor_entity_ids[] = (int)$vendor_entity_id;

                }

            }

            if(count($vendor_entity_ids)) {

                $sql_filters[] = "vendor_entity_id IN (" . implode(',', $vendor_entity_ids) . ")";

            }

        }

        if(count($options['bucket_category_ids']) > 0) {

            $bucket_category_ids = [];

            foreach($options['bucket_category_ids'] as $k => $bucket_category_id) {

                if(is_numeric($bucket_category_id)) {

                    $bucket_category_ids[] = (int)$bucket_category_id;

                }

            }

            if(count($bucket_category_ids)) {

                $sql_filters[] = "bucket_category_id IN (" . implode(',', $bucket_category_ids) . ")";

            }

        }

        if(count($options['quarter_ids']) > 0) {

            $quarter_ids = [];

            foreach($options['quarter_ids'] as $k => $quarter_id) {

                if(is_numeric($quarter_id)) {

                    $quarter_ids[] = (int)$quarter_id;

                }

            }

            if(count($quarter_ids)) {

                $sql_filters[] = "(SELECT count(*) FROM " . GAMO_DB . ".packages_info AS packages_info WHERE packages_info.package_id = packages.package_id AND packages_info.info_type = 'quarter' AND packages_info.numeric_info IN (" . implode(',', $quarter_ids) . ")) > 0";

            }

        }

        if(count($options['category_ids']) > 0) {

            $category_ids = [];

            foreach($options['category_ids'] as $k => $category_id) {

                if(is_numeric($category_id)) {

                    $category_ids[] = (int)$category_id;

                }

            }

            if(count($category_ids)) {

                $sql_filters[] = "(SELECT count(*) FROM " . GAMO_DB . ".packages_info AS packages_info WHERE packages_info.package_id = packages.package_id AND packages_info.info_type = 'category' AND packages_info.numeric_info IN (" . implode(',', $category_ids) . ")) > 0";

            }

        }

        $sql = "SELECT package_id FROM " . GAMO_DB . ".packages AS packages";

        if(count($sql_filters)) {

            $sql .= ' WHERE ' . implode(' AND ', $sql_filters);

        }        

        $sth = $dbh->prepare($sql);
        $sth->execute();

        $packages = array(
            'packages' => []
        );

        while($row = $sth->fetch()) {

            $include = 1;

            $package = self::get_package(array(
                    'package_id' => $row['package_id']
                )
            );

            $packages['packages'][] = $package;

        }

        return $packages;

    }

}
?>