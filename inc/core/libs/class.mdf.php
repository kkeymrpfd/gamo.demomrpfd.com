<?
class Core_Mdf {

    public $errors; // Store error codes
    public $wallet_history_types;

    function __construct() {

        $this->wallet_history_types = array('order', 'order_adjustment', 'fund_adjustment');

    }

    function create_partner($options = array()) {

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

    function create_vendor($options = array()) {

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
    
    function create_info($options = array()) {

        Core::ensure_defaults(array(
                'table' => GAMO_DB . '.entities_info',
                'values' => array(),
                'unique' => array()
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

    function assign_user_to_partner($options = array()) {

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

    function create_wallet($options = array()) {

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

    function get_entities($options = array()) {

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

        $entities = array();

        while($row = $sth->fetch()) {

            $entities[] = Core::remove_numeric_keys($row);

        }

        return $entities;

    }

    function create_package($options = array()) {

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

    function create_packages_option($options = array()) {

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

    function assign_package_to_quarter($options = array()) {

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

    function assign_package_to_category($options = array()) {

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

    function unassign_package_from_category($options = array()) {

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

    function create_wallet_history($options = array()) {

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

        $save = array(
            'wallet_id' => $options['wallet_id'],
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

    function get_wallet($options = array()) {

        Core::ensure_defaults(array(
                'wallet_id' => '',
                'entity_id' => '',
                'quarter_id' => ''
            )
        , $options);

        if($options['entity_id'] != '' && $options['quarter_id'] != '' && !is_numeric($options['wallet_id'])) {

            $options['entity_id'] = self::ensure_entity_id($options['entity_id'], 'partner');

            if(!is_numeric($options['entity_id'])) {

                return Core::error("Invalid entity id specified for retrieving wallet");

            }

            $options['quarter_id'] = self::ensure_quarter_id($options['entity_id']);

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

        $wallet['buckets'] = array();

        while($row = $sth->fetch()) {

            $wallet['buckets'][] = Core::remove_numeric_keys($row);

        }

        return $wallet;

    }

    function get_package($options = array()) {

        Core::ensure_defaults(array(
                'package_id' => ''
            )
        , $options);

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

        $package['packages_options'] = array();
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
        $package['category_names'] = array();

        $package['packages_info'] = array();

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

        }

        return Core::remove_numeric_keys($package);

    }

    function get_packages($options = array()) {

        Core::ensure_defaults(array(
                'quarter_ids' => array(),
                'vendor_entity_ids' => array(),
                'bucket_category_ids' => array(),
                'category_ids' => array()
            )
        , $options);

        global $dbh;

        $sql_filters = array();

        if(count($options['vendor_entity_ids']) > 0) {

            $vendor_entity_ids = array();

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

            $bucket_category_ids = array();

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

            $quarter_ids = array();

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

            $category_ids = array();

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
            'packages' => array()
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