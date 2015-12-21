<?
class Model_Locale_Editor {

	function run($options = array()) {
		
		/*
		arguments:
		{
			locale_id: the locale to use as the foreign language
		}
		*/

		global $gamo;

		// Ensure defaults
		Core::ensure_defaults(array(
				'foreign_locale_id' => Core::r('locale')->english
			)
		, $options);

		$data['entries'] = Core::r('locale')->get_texts(array(
				'filters' => array(
					'locale_id' => Core::r('locale')->english // Retrieve all entries in english to start
				)
			)
		);

		foreach($data['entries'] as $k => $entry) {

			$data['entries'][$k]['foreign'] = Core::r('locale')->get($entry['text_name'], $options['foreign_locale_id']);

		}

		$data['foreign_locale_id'] = (int) $options['foreign_locale_id'];
		$data['locales'] = Core::r('locale')->get_locales();
		
		return $data;

	}

}

?>
