<?
class Model_Action_History {

	function run($options = array()) {

		global $gamo, $dbh;

		// pendo Ensure that only an authenticated user can retrieve their actions
		Core::ensure_defaults(array(
				'category_id' => -1,
				'records' => 10,
				'user_id' => -1,
				'start' => 0,
				'action_types' => array(),
				'user_name' => '',
				'active' => 1,
				'filters' => array()
			)
		, $options);
		
		$filters = array(
			'start' => $options['start'],
			'records' => $options['records'],
			'user_id' => $options['user_id'],
			'category_id' => $options['category_id'],
			'action_types' => $options['action_types'],
			'get_count' => 1,
			'user_name' => $options['user_name'],
			'active' => $options['active'],
			'filters' => $options['filters']
		);

		if(is_numeric($options['filters'])) {

			$filters = $options['filters'];

		}

		// Retrieve user info
		$info = Core::r('actions')->get_actions($filters);

		$info['current_page'] = max($options['start'] / $options['records'], 0) + 1;
		$info['last_page'] = ceil($info['records'] / $options['records']);

		if($info['current_page'] > $info['last_page'] && $info['last_page'] != 0) { // The current page is too high. Set it to the last page

			$options['start'] = $info['last_page'] * $options['records'] - $options['records'];

			return $this->run($options);

		} else if($info['current_page'] < 1) { // The current page is too low. Set it to the first page

			$options['start'] = 0;

			return $this->run($options);

		}

		$sql = "SELECT name, title, company, email, msg FROM " . GAMO_DB . ".referrals WHERE referral_id = :referral_id";
		$sth = $dbh->prepare($sql);

		foreach($info['actions'] as $k => $v) {

			$info['actions'][$k]['datetime'] = date("Y-m-d H:i:s", $v['timestamp']);

			if($v['action_key'] == 'submit_referral' || $v['action_key'] == 'claim_referral') {

				
				if( empty($info['actions'][$k]['other_info']) ){
					
					$sth->execute(array(
							':referral_id' => $v['int_other']
						)
					);
	
					$row = $sth->fetch();
					$row = Core::remove_numeric_keys($row);
	
					$i = 0;
	
					foreach($row as $k2 => $v2) {
	
						array_push($info['actions'][$k]['other_info'], array(
								'info_type' => $k2,
								'info' => $v2
							)
						);
	
					}
					
				}

			} else if($v['action_key'] == 'share_resource') {
				
				if( empty($info['actions'][$k]['other_info']) ){

					array_push($info['actions'][$k]['other_info'], array(
							'info_type' => 'to_email',
							'info' => $v['other']
						)
					);
	
					array_push($info['actions'][$k]['other_info'], array(
							'info_type' => 'to_title',
							'info' => $v['other_b']
						)
					);
					
				}

			}

		}

		$data['actions_history'] = $info;

		return $data;

	}

}

?>
