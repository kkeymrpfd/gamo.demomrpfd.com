<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_View_Site {

	function run() {

		global $data, $page_settings, $models, $session, $gamo, $has_menu;
		
		$page_settings['allow_json'] = 0;

		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if( strpos($actual_link, 'delloverdrive.com') !== FALSE
			&& strpos($actual_link, 'local.delloverdrive.com') === FALSE
		    && strpos($actual_link, 'www.delloverdrive.com') === FALSE ) {

			$actual_link = str_replace('delloverdrive.com', 'www.delloverdrive.com', $actual_link);
			//header("Location: " . $actual_link);
			//die();

		}

		$pages = array(
			'register',
			'reg_survey',
			'profile_landing',
			'login',
			'live_trivia_dash',
			'live_trivia',
			'trivia_broadcast',
			'trivia_pin',
			'quiz_host_board',
			'daily_trivia',
			'qr_trivia',
			'leaderboard',
			'meetings',
			'profile',
			'qr_scanned',
			'trivia_complete',
			'social',
			'prizes',
			'forgot_password',
			'reset_password',
			'slot_meetings',
			'user_responses',
			'points',
			'badges',
			'whatsnew',
			'training',
			'trivia',
			'demandgen',
			'demandgen_send',
			'demandgen_preview',
			'about',
			'demandgen_comingsoon',
			'dg_landing',
			'mdf',
			'mdf_order'
		);

		$no_header = array(
			'register',
			'login',
			'daily_trivia',
			'forgot_password',
			'reset_password',
			'slot_meetings',
			'user_responses',
			'demandgen_preview',
			'dg_landing'
		);

		$has_menu = array('whatsnew','training','trivia','demandgen','meetings');
		
		if($data['user_id'] != 759 && $data['user_id'] != 881) {

			if($page_settings['page'] == 'demandgen') {

				//$page_settings['page'] = 'demandgen_comingsoon';

			}

		}
		
		if(!in_array($page_settings['page'], $no_header)) {
		
			Core::authorize();
		
		}
		
		
		if(!in_array($page_settings['page'], $pages)) {

			$page_settings['page'] = 'whatsnew';

		}
		
		if($page_settings['page'] == 'profile_landing') {

			header("Location: /?p=profile");
			die();

		}


		$result = array();
		
		require_once(DIR_MODELS . "/model.home.php");
		$model = new Model_Home();
		$result = $model->run(array('user_id' => $data['user_id']));
		
		
		Core::shift_data($result);
		
		$has_badges = array();		
		
		foreach($result['$badges'] as $badge){
			$has_badges[$badge['badge_id']] = '';
		}
		
		foreach($result['user']['has'] as $badge){
			$has_badges[$badge['badge_id']] = '-active';
		}
		
		$data['has-badge'] = $has_badges;
		
		require_once(DIR_MODELS . "/model.game_nav.php");
		$model = new Model_Game_Nav();
		$result = $model->run();
		
		Core::shift_data($result);

		
		if( $page_settings['page'] == 'whatsnew' ){
		
			require_once(DIR_MODELS . "/model.whats_new.php");
			$model = new Model_Whats_New();
			$result = $model->run();
		
			Core::shift_data($result);
		
		} else if( $page_settings['page'] == 'training' ){
			
			$data['resource_category'] = Core::get_input('resource_category', 'get');
			$data['resource_categories'] = array(
				'all' => array(
					'label' => 'All Resources',
					'selected' => ''
				),
				'tzseries' => array(
					'label' => 'TZ Series',
					'selected' => ''
				),
				'nsaseries' => array(
					'label' => 'NSA Series',
					'selected' => ''
				),
				'supermassive' => array(
					'label' => 'Supermassive',
					'selected' => ''
				),
				'videos' => array(
					'label' => 'Videos',
					'selected' => ''
				),
			);

			foreach($data['resource_categories'] as $k => $v) {

				if($data['resource_category'] == $k) {

					$data['resource_categories'][$k]['selected'] = ' selected';

				}

			}

			$data['resources'] = Core::r('resources')->get_resources(array(
					'active' => 1,
					'start' => 0,
					'number' => 20,
					'category' => $data['resource_category']
				)
			);
			
			foreach($data['resources'] as $index => $resource){
					
				if( !(!empty($resource['resource_info_type']) and $resource['resource_info_type'] == 'filter_type' and !empty($resource['resource_info_a']) and $resource['resource_info_a'] == 'download_resource') ){
					unset($data['resources'][$index]);
				}
		
			}

				
		} else if( $page_settings['page'] == 'demandgen' ){
				
			$data['email_templates'] = Core::r('demandgen')->get_email_templates(array(
					'user_id' => $data['user_id']
				)
			);
				
		} else if( $page_settings['page'] == 'demandgen_send' ){
			
			$data['email_template_id'] = Core::get_input('email_template_id', 'get');
			$data['email_template'] = Core::r('demandgen')->get_email_template(array(
					'email_template_id' => $data['email_template_id']
				)
			);
				
		} else if( $page_settings['page'] == 'demandgen_preview' ){
			
			$data['email_template_id'] = Core::get_input('email_template_id', 'get');
			$data['email_template'] = Core::r('demandgen')->get_email_template(array(
					'email_template_id' => $data['email_template_id']
				)
			);
				
		} else if( $page_settings['page'] == 'dg_landing' ){
			
			$data['hash'] = Core::get_input('hash', 'get');

			$data['demandgen_contact_id'] = Core::fetch_column(
				"SELECT demandgen_contact_id FROM " . GAMO_DB . ".demandgen_contacts WHERE hash = :hash",
				array(
					':hash' => $data['hash']
				)
			);

			if(!is_numeric($data['demandgen_contact_id'])) {

				echo "Invalid URL";
				die();

			}

			Core::db_update(array(
					'table' => GAMO_DB . ".demandgen_contacts",
					'values'=> array(
						'clicked' => Core::datetime(),
						'ip' => Core::get_ip()
					),
					'where' => array(
						'demandgen_contact_id' => $data['demandgen_contact_id']
					)
				)
			);
				
		} else if($page_settings['page'] == 'trivia') {
		
			$data['quiz_id'] = 1;
		
		}
		
		if($page_settings['page'] == 'live_trivia_dash') {

			require_once(DIR_MODELS . "/model.quiz_set.php");
			$model = new Model_Quiz_Set();
			$result = $model->run(array(
					'user_id' => $data['user_id'],
					'set' => 'live_trivia'
				)
			);

			Core::shift_data($result);

		} else if($page_settings['page'] == 'daily_trivia') {

			require_once(DIR_MODELS . "/model.quiz_set.php");
			$model = new Model_Quiz_Set();
			$result = $model->run(array(
					'user_id' => $data['user_id'],
					'set' => 'daily_trivia'
				)
			);

			Core::shift_data($result);

			require_once(DIR_MODELS . "/model.badge_check.php");
			$model = new Model_Badge_Check();
			$data['badge'] = $model->run(array(
					'badge_ids' => '33',
					'user_id' => $data['user_id']
				)
			);

		} else if($page_settings['page'] == 'qr_trivia') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

			require_once(DIR_MODELS . "/model.quiz_set.php");
			$model = new Model_Quiz_Set();
			$result = $model->run(array(
					'user_id' => $data['user_id'],
					'set' => 'qr_trivia'
				)
			);

			Core::shift_data($result);

			require_once(DIR_MODELS . "/model.badge_check.php");
			$model = new Model_Badge_Check();
			$data['badge'] = $model->run(array(
					'badge_ids' => '35',
					'user_id' => $data['user_id']
				)
			);

		} else if($page_settings['page'] == 'meetings') {

			$data['user'] = Core::r('users')->get_user(array(
					'user_id' => $data['user_id'],
					'get_has' => 0
				)
			);

		} else if($page_settings['page'] == 'leaderboard') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

			$data['leaders'] = Core::r('users')->get_users(array(
					'start' => 0,
					'records' => 20,
					'get_has' => 1
				)
			);

		} else if($page_settings['page'] == 'live_trivia') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

		} else if($page_settings['page'] == 'trivia_broadcast') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

			$data['quiz_pin'] = Core::fetch_column(
				"SELECT info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'require_pin' LIMIT 0, 1",
				array(
					':quiz_id' => $data['quiz_id']
				)
			);

		} else if($page_settings['page'] == 'trivia_pin') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

		} else if($page_settings['page'] == 'qr_scanned') {

			$data['quiz_id'] = Core::get_input('quiz_id', 'get');

			require_once(DIR_MODELS . "/model.quiz_set.php");
			$model = new Model_Quiz_Set();
			$result = $model->run(array(
					'user_id' => $data['user_id'],
					'set' => 'qr_trivia'
				)
			);

			$found = 0;
			$allowed = 0;

			$data['quiz_taken'] = 0;

			foreach($result['quiz_list'] as $k => $quiz) {

				if($quiz['quiz_id'] == $data['quiz_id']) {

					$data['quiz_taken'] = $quiz['quiz_taken'];
					
					$found = 1;

					$use_quiz = $quiz;
					if($quiz['quiz']['allow_quiz'] == 1) {

						$allowed = 1;

					}

					break;

				}

			}
			
			if($found == 0 || $allowed == 0) {

				header("Location: /");
				die();

			}

			Core::shift_data($result);

		} else if($page_settings['page'] == 'profile_landing' || $page_settings['page'] == 'profile' || $page_settings['page'] == 'prizes') {
			
			/*
			require_once(DIR_MODELS . "/model.profile_landing.php");
			$profile_landing = new Model_Profile_Landing();
			$result = $profile_landing->run();
			Core::shift_data($result);

			require_once(DIR_MODELS . "/model.home.php");
			$model = new Model_Home();
			$result = $model->run(array(
					'user_id' => $data['user_id']
				)
			);
			Core::shift_data($result);
			*/

		} else if($page_settings['page'] == 'trivia_complete') {

			require_once(DIR_MODELS . "/model.badge_check.php");
			$model = new Model_Badge_Check();
			$data['badge_check'] = $model->run(array(
					'badge_ids' => '30_31_32_29_33_35',
					'user_id' => $data['user_id']
				)
			);

		} else if( strpos($page_settings['page'],'social') !== false ){
            	
            	//error_log('Here');
            	
            	require(DIR_MODELS . '/model.social.php');
            	$model_social = new Model_Social();
            	
            	$data['connected'] = $model_social->get_connected();
            	$social_connect_msg = $session->get('social_connect_msg');
            	
            	//error_log(print_r($social_connect_msg,true));
            	if( !empty( $social_connect_msg ) ){
            		$model_social->prepare_connection_message(array('msg' => $social_connect_msg ));
            		$session->remove('social_connect_msg');
            	}
            	//error_log(print_r($data['connected'],true));
            	
        } else if($page_settings['page'] == 'reset_password') {

			$data['key_valid'] = 0;

			global $dbh;

			$sql = "SELECT
				count(*)
				FROM " . GAMO_DB . ".password_request
				WHERE
				reset_key = :reset_key
				AND used_time <= request_time";

			$key = substr(Core::get_input('key', 'get'), 0, 40);

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':reset_key' => $key
				)
			);

			$c = $sth->fetchColumn();

			if($c > 0) {

				$data['key_valid'] = 1;
				$data['reset_key'] = $key;

			}

		} else if($page_settings['page'] == 'slot_meetings') {

			require_once(DIR_MODELS . "/model.slot_meetings.php");
			$model = new Model_Slot_Meetings();
			$result = $model->run();

			Core::shift_data($result);

			if(Core::get_input('export', 'get') == 1) {

				$csv = '"First Name","Last Name","E-mail","Title","Company","Phone","User Group","Slot"' . "\n";

				foreach($data['reservations'] as $k => $reserve) {
					
					$csv .= '"' . $reserve['user']['first_name'] . '",';
					$csv .= '"' . $reserve['user']['last_name'] . '",';
					$csv .= '"' . $reserve['user']['email'] . '",';
					$csv .= '"' . $reserve['user']['title'] . '",';
					$csv .= '"' . $reserve['user']['company'] . '",';
					$csv .= '"' . $reserve['user']['phone'] . '",';
					$csv .= '"' . $reserve['user']['has'][ Core::multi_find($reserve['user']['has'], 'info_type', 'user_group') ]['info'] . '",';
					$csv .= '"' . $data['slots'][ Core::multi_find($data['slots'], 'slot_id', $reserve['slot_id']) ]['display_time_range'] . '"';
					$csv .= "\n";

				}

				header('Content-type: text/calendar; charset=utf-8');
				header('Content-Disposition: inline; filename=slot_meetings.csv');
				echo $csv;
				die();

			} else {

				Core::authorize(array(
						'user_id' => 'get',
						'levels' => 'admin'
					)
				);

			}

		} else if($page_settings['page'] == 'user_responses') {

			Core::authorize(array(
					'user_id' => 'get',
					'levels' => 'admin'
				)
			);

			$data['get_user_id'] = (int)Core::get_input('user_id', 'get');

			require_once(DIR_MODELS . "/model.user_responses.php");
			$model = new Model_User_Responses();
			$result = $model->run(array(
					'user_id' => $data['get_user_id']
				)
			);

			Core::shift_data($result);

		}
	       
	    $page_settings['pages'] = array($page_settings['page']);

		$data['page'] = $page_settings['page'];

		return $data;

	}

}
?>
