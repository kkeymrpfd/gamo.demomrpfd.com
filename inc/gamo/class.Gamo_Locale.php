<?
/*
This class handles the localization for ' . GAMO_DB . '.
*/
class Gamo_Locale {

	public $errors; // Store error codes
	public $locale_id;
	public $english;

	function __construct() {

		// Save the locale id for english
		$this->english = 45;

		// Set default locale to English
		$this->locale_id = $this->english;

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not create new locale'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'There is already a locale with matching information'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Invalid information specified for updating a locale'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Could not update locale'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'A locale already exists with matching information'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Could not map locale based on locale alias'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Invalid locale id specified'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'The specified locale text name is already in use for this locale'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'Invalid locale text name was specified'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'Could not create locale text entry'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'Could not update locale text entry'
			)
		);

	}

	/*
	Creates a new locale
	*/
	function create_locale($options = array()) {

		/*
		arguments:
		{
			locale: a short name for the locale
			locale_name: the full name of the locale
			locale_id_alias: an external alias for the alias
		}

		if successful:
			{
				locale_id: the id of the newly created locale row
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'locale' => '',
				'locale_name' => '',
				'locale_id_alias' => ''
			)
		, $options);

		// Determine that the locale info is unique
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.locales',
				'values' => array(
					'locale' => $options['locale'],
					'locale_name' => $options['locale_name'],
					'locale_id_alias' => $options['locale_id_alias']
				),
				'type' => 'or'
			)
		);

		if($c > 0) { // This locale info is not unique

			return Core::error($this->errors, 2);

		}

		// pendo Validate locales
		$locale_id = Core::db_insert(array(
				'table' => '' . GAMO_DB . '.locales',
				'values' => array(
					'locale' => $options['locale'],
					'locale_name' => $options['locale_name'],
					'locale_id_alias' => $options['locale_id_alias']
				)
			)
		);

		if(!is_numeric($locale_id)) {

			return Core::error($this->errors, 1);

		}

		return array(
			'locale_id' => $locale_id
		);

	}

	/*
	When we pull a locale from Averetek, it has a locale ID already associated with it. This is the locale ID that each user
	is mapped to when we pull the users. When we save a locale to Gamo, it is given it's own locale ID. This system handles
	mapping the user to the locale ID in ' . GAMO_DB . '.
	*/
	function map_locale($locale_id_alias = '') {

		/*
		arguments:
		locale_id_alias: the locale id from Averetek (this argument is just passed as a string instead of in an array)

		Return:
			if successful:
			{
				locale_id: the locale id from gamo
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		global $dbh;

		$sql = 'SELECT locale_id FROM ' . GAMO_DB . '.locales WHERE locale_id_alias = :locale_id_alias';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(':locale_id_alias' => $locale_id_alias));

		$row = $sth->fetch();

		if(!is_array($row)) {

			return Core::error($this->errors, 6);

		}

		return array(
			'locale_id' => $row['locale_id']
		);

	}

	/*
	Update the information for a locale
	*/
	function update_locale($options = array()) {

		/*
		arguments:
		{
			locale_id: the id of the locale to update
			values: { (if set to delete, will delete the locale along with any locale entries
				locale: a short name for the locale
				locale_name: the full name of the locale
				locale_id_alias: an external alias for the alias
			}
		}

		if successful:
			{
				valid: 1
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'locale_id' => -1,
				'values' => array()
			)
		, $options);

		// pendo ensure values

		if($options['values'] != 'delete' && count($options['values']) == 0) { // No valid informaiton was provided to update and a delete request wasn't made

			return Core::error($this->errors, 3);

		}

		global $dbh;

		if(is_array($options['values'])) { // Update record

			// Ensure that another row doesn't already exist with this value
			$c = Core::db_count(array(
					'table' => '' . GAMO_DB . '.locales',
					'values' => $options['values']
				)
			);

			if($c > 0) { // A locale already exists with matching information

				return Core::error($this->errors, 5);

			}

			// Try updating the record
			$result = Core::db_update(array(
					'table' => '' . GAMO_DB . '.locales',
					'values' => $options['values'],
					'where' => array(
						'locale_id' => $options['locale_id']
					)
				)
			);

			if($result != 1) { // Could not update the record

				return Core::error($this->errors, 4);

			}

		} else { // Delete the record (don't need a more specific check since we already validate this before)

			$sql = 'DELETE FROM ' . GAMO_DB . '.locales WHERE locale_id = :locale_id';

			$sth = $dbh->prepare($sql);
			$result = $sth->execute(array(
					':locale_id' => $options['locale_id']
				)
			);

		}

		if(!$result) { // Could not delete the record

			return Core::error($this->errors, 4);

		}

		// Record was updated/deleted
		return array(
			'valid' => 1
		);

	}

	/*
	Retrieve a list of all locales
	*/
	function get_locales() {

		/*
		arguments:
			none:

		returns:
			an array of locales
		*/

		global $dbh;

		$sql = 'SELECT
			locale_id,
			locale,
			locale_name,
			locale_id_alias
			FROM ' . GAMO_DB . '.locales ORDER BY locale_name ASC';

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$locales = array();

		while($row = $sth->fetch()) {

			array_push($locales, Core::remove_numeric_keys($row));

		}

		return $locales;

	}

	/*
	Create a new text entry
	*/
	function create_text($options = array()) {
		
		/*
		arguments:
			text_name: the english display name. Keep it simple and without spaces so they can be used as memcache keys
			locale_id: the id of the locale
			info: the actual text

		if successful:
			{
				locale_text_id: the entry id
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'text_name' => '',
				'locale_id' => '',
				'info' => ''
			)
		, $options);

		if(trim($options['text_name']) == '') {

			return Core::error($this->errors, 9);

		}

		// Ensure that the locale_id is valid
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.locales',
				'values' => array(
					'locale_id' => $options['locale_id']
				)
			)
		);

		if($c == 0) {

			return Core::error($this->errors, 7);

		}

		// Ensure that the text name/locale id combination is unique
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.locale_text',
				'values' => array(
					'text_name' => $options['text_name'],
					'locale_id' => $options['locale_id']
				)
			)
		);

		if($c > 0) {

			return Core::error($this->errors, 8);

		}

		$locale_text_id = Core::db_insert(array(
				'table' => '' . GAMO_DB . '.locale_text',
				'values' => array(
					'text_name' => $options['text_name'],
					'locale_id' => $options['locale_id'],
					'info' => $options['info']
				)
			)
		);

		if(!is_numeric($locale_text_id)) {

			return Core::error($this->errors, 10);

		}

		return array(
			'locale_text_id' => $locale_text_id
		);

	}

	/*
	Update a text entry
	*/
	function update_text($options = array()) {
		
		/*
		arguments:
			locale_text_id: the entry to update
			values: { which values to update. Each is optional
				text_name: the english display name. Keep it simple and without spaces so they can be used as memcache keys
				locale_id: the id of the locale
				info: the actual text
			}

		if successful:
			{
				valid: 1
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'locale_text_id' => -1,
				'values' => array(

				)
			)
		, $options);

		global $dbh;

		if(!is_numeric($options['locale_text_id'])) { // The entry name was given instead of the id. Retrieve the id

			$sql = 'SELECT locale_id FROM ' . GAMO_DB . '.locale_text WHERE text_name = :text_name';

			$sth = $dbh->prepare($sql);
			$sth->execute(array(':text_name' => $options['locale_text_id']));

			$locale_id = $sth->fetchColumn();

			if(!is_numeric($locale_id)) { // Could not retrieve locale id

				return Core::error($this->errors, 7);

			}

		}

		// Ensure that the text name is valid if applicable
		if(isset($options['values']['text_name'])) { // The text name is being updated. Test it to ensure validity

			if(trim($options['values']['text_name']) == '') { // No text name was entered

				return Core::error($this->errors, 9);

			}

			// Ensure that the text name/locale id combination is unique
			if(isset($options['values']['locale_id'])) { // The locale id is specified for updating. Use that

				$locale_id = $options['values']['locale_id'];

			} else { // The locale_id is not specified. Retrieve the locale_id for this locale text entry

				$sql = 'SELECT locale_id FROM ' . GAMO_DB . '.locale_text WHERE locale_text_id = :locale_text_id';
				$sth = $dbh->prepare($sql);
				$sth->execute(array(
						':locale_text_id' => $options['locale_text_id'],
					)
				);

				$locale_id = $sth->fetchColumn();

			}

			// Ensure that the text name is unique
			$sql = 'SELECT count(*) FROM ' . GAMO_DB . '.locale_text WHERE locale_text_id != :locale_text_id AND text_name = :text_name AND locale_id = :locale_id';
			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':locale_text_id' => $options['locale_text_id'],
					':text_name' => $options['values']['text_name'],
					':locale_id' => $locale_id
				)
			);

			$c = $sth->fetchColumn();
			
			if($c > 0) { // This text name is already in use

				return Core::error($this->errors, 8);

			}

		}

		// Ensure that the locale_id is valid if applicable
		if(isset($options['values']['locale_id'])) { // There was a locale id specified. Validate it

			$c = Core::db_count(array(
					'table' => '' . GAMO_DB . '.locales',
					'values' => array(
						'locale_id' => $options['values']['locale_id']
					)
				)
			);

			if($c == 0) {

				return Core::error($this->errors, 7);

			}

		}

		$result = Core::db_update(array(
				'table' => '' . GAMO_DB . '.locale_text',
				'values' => $options['values'],
				'where' => array(
					'locale_text_id' => $options['locale_text_id']
				)
			)
		);
		
		if($result != 1) { // Could not update record

			return Core::error($this->errors, 11);

		}

		// Record was succesfully updated
		return array(
			'valid' => 1
		);

	}

	/*
	Retrieve multiple locale text entries
	*/
	function get_texts($options = array()) {

		/*
		arguments:
			filters: { // Optional filters to retrieve a locale_text entry by
				locale_id,
				text_name,
				..
				..
			}

		returns
		if successful:
			{
				{
					locale_text_id,
					text_name,
					locale_id,
					info
				},
				{
					locale_text_id,
					text_name,
					locale_id,
					info
				},
				..
				..
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'filters' => array()
			)
		, $options);

		if(!is_array($options['filters'])) {

			$options['filters'] = array();

		}

		$sql_filters = Core::db_params(array(
				'values' => $options['filters']
			)
		);

		// Retrieve records
		$records = array();

		global $dbh;

		$sql = 'SELECT
			locale_text_id,
			text_name,
			locale_id,
			info
			FROM ' . GAMO_DB . '.locale_text';

		if(count($sql_filters['params']) > 0) {

			$sql .= ' WHERE ' . $sql_filters['sql'];

		}

		$sth = $dbh->prepare($sql);
		$sth->execute($sql_filters['params']);

		while($row = $sth->fetch()) {

			array_push($records, Core::remove_numeric_keys($row));

		}

		return $records;

	}

	/*
	Get text in a locale (used get() instead of get_text() to make it easier for front-end development)
	*/
	function get($text_name, $locale_id = 'get') {

		/*
		arguments: (these are passed as individual arguments, not as an array. This was done to make using it easier for front-end development)
			phrase: the name of the phrase
			locale: the locale name to pull for (defaults to the locale set)

		returns:
			text: the text (returned as a string, not as an array to make life easier)
		*/

		// Determine the locale
		if($locale_id == 'get') {

			global $session;
			$locale_id = $this->locale_id;

		}

		$text = Core::fetch_column(
			'SELECT info FROM ' . GAMO_DB . '.locale_text WHERE text_name = :text_name AND locale_id = :locale_id',
			array(
				':text_name' => $text_name,
				':locale_id' => $locale_id
			)
		);

		// Could not retrieve text based on the set locale which was not english. Just retrieve the english version
		if($text == '' && $locale_id != $this->english) { 

			$text = Core::fetch_column(
				'SELECT info FROM ' . GAMO_DB . '.locale_text WHERE text_name = :text_name AND locale_id = :locale_id',
				array(
					':text_name' => $text_name,
					':locale_id' => 45
				)
			);

		}

		return $text;

	}

}
?>
