<?php
require('config.php');
require_once(DIR_INC.'/core/class.Core.php');
require('class.Social.php');

class Test_Instagram_Service extends Social{
	
	public $pub_options = array(
		'game_desc' => array(
			'accounts' => array('335617318'),
			'hashtags' => array('microsoft')
		),
		'is_connection'	=> array(
			'client_id' => '043d3b2f34624c3193e6b22684111e03', 
			'client_secret' => '196b6f194d09438aa179da14275995ba'
		),
		'service' => Social::SV_INSTAGRAM
	);
	
	function test_get_actions(){
		return $this->get_actions($this->pub_options);
	}
	
	function test_init_scrape(){
		return $this->init_scrape($this->pub_options);
	}
	
	function test_get_follows(){
		$result = $this->get_follows($this->pub_options);
		return isset($this->scrape->actions_new) ? $this->scrape->actions_new : false;
	}
	
	function test_get_hashtags(){
		$result = $this->get_hashtags($this->pub_options);
		return isset($this->scrape->actions_new) ? $this->scrape->actions_new : false;
	}
	
	function test_find_accounts(){
		return $this->find_accounts();
	}

	function test_get_login_url(){
		return $this->get_login_url(array('redirect_url' => 'https://www.mysite.com/internal/url'));
	}
	
	function test_create_account(){
		$options = array(
			'user_id' => 8,
			'facebook_user_id' => 123412341234,
			'facebook_username' => 'Das Don',
			'access_token' => 'AFDGAFG9879A8FSDG09A8DF0S9G8A0DF9G8ASDF'
		);
		return $this->create_account($options);
	}
	
	function test_delete_account(){
		$options = array("user_id" => 8);
		
		return $this->delete_account($options);
	}
	
	function test_get_post_id_from_link(){
		return $this->get_post_id_from_link(array('link' => 'https://www.facebook.com/permalink.php?story_fbid=102313216628629&id=102256706634280'));
	}
}

$fb = new Test_Instagram_Service();

//var_dump($fb->test_init_scrape());
//var_dump($fb->test_get_follows());
//var_dump($fb->test_get_hashtags());

//var_dump($fb->test_find_accounts());
//var_dump($fb->test_get_login_url());
//var_dump($fb->test_create_account());
//var_dump($fb->test_delete_account());
//var_dump($fb->test_get_post_id_from_link());

//TODO: Test get_login_url and create_account

var_dump($fb->test_get_actions());
