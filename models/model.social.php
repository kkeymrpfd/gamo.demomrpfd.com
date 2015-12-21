<?php
class Model_Social{
	
	public function get_connected(){
		global $session, $gamo;
		
		$data = array(
	        'facebook' => false,
	        'twitter' => false,
	        'instagram' => false,
			'linkedin' => false,
			'youtube' => false,
			'foursquare' => false
	    );
		
		require_once(DIR_INC . "/apis/social/class.Social.php");
		$user_id = $session->get('user_id');
		
		$data['facebook'] = Core::r('social_account','/social/')->has_account(array('account_type' => 'facebook_account', 'user_id' => $user_id));
		$data['facebookg'] = Core::r('social_account','/social/')->has_account(array('account_type' => 'facebook_account', 'user_id' => $user_id));
		
		$social = new Social(array('services' => array(Social::SV_TWITTER)));
		$data['twitter'] = $social->has_account(array('service' => Social::SV_TWITTER, 'user_id' => $user_id));
		
		$social = new Social(array('services' => array(Social::SV_INSTAGRAM)));
		$data['instagram'] = $social->has_account(array('service' => Social::SV_INSTAGRAM, 'user_id' => $user_id));
		
		$social = new Social(array('services' => array(Social::SV_LINKEDIN)));
		$data['linkedin'] = $social->has_account(array('service' => Social::SV_LINKEDIN, 'user_id' => $user_id));
		
		$social = new Social(array('services' => array(Social::SV_YOUTUBE)));
		$data['youtube'] = $social->has_account(array('service' => Social::SV_YOUTUBE, 'user_id' => $user_id));
		
		
		
		return $data;
	}
	
	public function prepare_connection_message($options){
		global $data, $page_settings;
		
		error_log(print_r($options,true));
		
		if($options['msg'] == 'facebook_linked') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Facebook account is now connected to the app!'
			);
		
		} else if($options['msg'] == 'twitter_linked') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Twitter account is now connected to the app!'
			);
		
		} else if($options['msg'] == 'instagram_linked') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Instagram account is now connected to the app!'
			);
		
		} else if($options['msg'] == 'youtube_linked') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Youtube account is now connected to the app!'
			);
		
		} else if($options['msg'] == 'linkedin_linked') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your LinkedIn account is now connected to the app!'
			);
		
		} else if($options['msg'] == 'facebook_error') {
		
			$data['modal_msg'] = array(
					'alert' => 'error',
					'msg' => 'There was an error while linking your Facebook account.<br><br>Please try again.'
			);
		
		} else if($options['msg'] == 'twitter_error') {
		
			$data['modal_msg'] = array(
					'alert' => 'error',
					'msg' => 'There was an error while linking your Twitter account.<br><br>Please try again.'
			);
		
		} else if($options['msg'] == 'instagram_error') {
		
			$data['modal_msg'] = array(
					'alert' => 'error',
					'msg' => 'There was an error while linking your Instagram account.<br><br>Please try again.'
			);
		
		} else if($options['msg'] == 'youtube_error') {
		
			$data['modal_msg'] = array(
					'alert' => 'error',
					'msg' => 'There was an error while connecting your YouTube account.<br><br>Please try again.'
			);
		
		} else if($options['msg'] == 'linkedin_error') {
		
			$data['modal_msg'] = array(
					'alert' => 'error',
					'msg' => 'There was an error while linking your Linkedin account.<br><br>Please try again.'
			);
		
		} else if($options['msg'] == 'facebook_disconnect') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Facebook account has been disconnected from this site.'
			);
		
		} else if($options['msg'] == 'twitter_disconnect') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Twitter account has been disconnected from this site.'
			);
		
		} else if($options['msg'] == 'instagram_disconnect') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Instagram account has been disconnected from this site.'
			);
			
		} else if($options['msg'] == 'youtube_disconnect') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Youtube account has been disconnected from this site.'
			);
			
		} else if($options['msg'] == 'linkedin_disconnect') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your Linkedin account has been disconnected from this site.'
			);
			
		} else if($options['msg'] == 'blog_created') {
		
			$data['modal_msg'] = array(
					'alert' => 'success',
					'msg' => 'Your blog was saved! Please note that it may take up to 24 hours for an admin to approve your blog submittal.'
			);
			
		}
		
	}
}