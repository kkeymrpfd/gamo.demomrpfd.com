<?
class Model_Register {

	function run($options) {
		
		global $gamo;

		Core::ensure_defaults(array(
				'pin' => ''
			)
		, $options);

		require_once(DIR_INC . '/ct/class.CT_Campaign.php');
		require_once(DIR_INC . '/ct/class.impack.php');
		require_once(DIR_INC . '/ct/class.meeting_requester.php');
		require_once(DIR_INC . '/ct/class.CT_Snoopy.php');
		
		$data['pin_valid'] = 0;

		$campaign = new Campaign();
        $campaign
                ->setCampaignID(2716)
                ->setCampaignURL('http://ct30.entermarketing.com');

		if(!$campaign->checkPin($options['pin'])) {

			$campaign = new Campaign();
	        $campaign
	                ->setCampaignID(2717)
	                ->setCampaignURL('http://ct30.entermarketing.com');

			if($campaign->checkPin($options['pin'])) {

				$data['pin_valid'] = 1;

			}

		} else {

			$data['pin_valid'] = 1;

		}

		if($data['pin_valid'] == 1) {

			$data['user_data'] = $campaign->getData($options['pin']);
			$data['pin'] = $options['pin'];

		}
		
		return $data;

	}

}

?>
