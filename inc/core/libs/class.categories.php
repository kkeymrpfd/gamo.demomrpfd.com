<?
class Core_Categories {

    public $errors; // Store error codes

    function __construct() {

    }

    function create_category($options = array()) {

    	Core::ensure_defaults(array(
    			'category_name' => '',
    			'category_type' => '',
    			'category_tag' => ''
    		)
    	, $options);

    	$category_id = Core::fetch_column(
    		"SELECT category_id FROM " . GAMO_DB . ".categories WHERE category_name = :category_name AND category_type = :category_type AND category_tag = :category_tag",
    		array(
    			':category_name' => $options['category_name'],
    			':category_type' => $options['category_type'],
    			':category_tag' => $options['category_tag']
    		)
    	);

    	if(!is_numeric($category_id)) {

    		$category_id = Core::db_insert(array(
    				'table' => GAMO_DB . ".categories",
    				'values' => array(
    					'category_name' => $options['category_name'],
		    			'category_type' => $options['category_type'],
		    			'category_tag' => $options['category_tag']
    				)
    			)
    		);

    	}

    	if(!is_numeric($category_id)) {

    		return Core::error("There was a database level error while saving your category");

    	}

    	return array(
    		'category_id' => $category_id
    	);

    }

    function ensure_category_id($category_id, $type) {

        if(!is_numeric($category_id)) {

            $category_id = Core::fetch_column(
                "SELECT category_id FROM " . GAMO_DB . ".categories WHERE category_name = :category_name AND category_type = :category_type",
                array(
                    ':category_name' => $category_id,
                    ':category_type' => $type
                )
            );

            if(!is_numeric($category_id)) {

                return Core::error("category could not be found based on category name");

            }

        }

        $c = Core::db_count(array(
                'table' => GAMO_DB . ".categories",
                'values' => array(
                    'category_id' => $category_id
                )
            )
        );

        if($c == 0) {

            return Core::error("category could not be found based on category id");

        }

        return $category_id;

    }

    function get_categories($options = array()) {

    	Core::ensure_defaults(array(
    			'category_type' => ''
    		)
    	, $options);

    	global $dbh;

    	$sql = "SELECT category_id, category_name, category_type, category_tag FROM " . GAMO_DB . ".categories WHERE category_type = :category_type";

    	$sth = $dbh->prepare($sql);
    	$sth->execute(array(
    			':category_type' => $options['category_type']
    		)
    	);

    	$categories = array();

    	while($row = $sth->fetch()) {
    		
    		$categories[] = Core::remove_numeric_keys($row);

    	}

    	return $categories;

    }

}