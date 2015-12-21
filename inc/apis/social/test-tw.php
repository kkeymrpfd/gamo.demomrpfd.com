<?php
require('config.php');
require_once(DIR_INC.'/core/class.Core.php');
require('class.Social.php');

class Test_Twitter_Service extends Social{
	
	public $pub_options = array(
		'game_desc' => array(
			'accounts' => array(array('id' => '1288744674', 'screen_name' => 'dclient0313')),
			'hashtags' => array('JBLMadness')
		),
		'tw_connection'	=> array(
			'consumer_key' => '7EXCqmCD6yt9QIQZyf4vkg', 
			'consumer_secret' => 'J1rQfdyFghiHF8sZREYB70ayvGBaknwx1KeGM97Pic', 
			'access_token' => '1288744674-WQjFamwT3qDhmXdc0Ghqcb1rTjUdZylStym6B9J', 
			'access_token_secret' => 'hhG5sbvMvEMyyse9rwlqg6a11BN2RALsPQVfDcV8M'
		),
		'service' => Social::SV_TWITTER
	);
	
	function test_get_actions(){
		return $this->get_actions($this->pub_options);
	}
	
	function test_init_scrape(){
		return $this->init_scrape($this->pub_options);
	}
	
	function test_get_follows(){
		$this->get_follows($this->pub_options);
		return $this->scrape->actions_new;
	}
	
	function test_get_hashtags(){
		$this->get_hashtags($this->pub_options);
		return $this->scrape->actions_new;
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

$social = new Test_Twitter_Service(array('services' => array(Social::SV_TWITTER)));

//var_dump($fb->test_init_scrape());
//var_dump($fb->test_get_follows());
//var_dump($fb->test_get_hashtags());

//var_dump($fb->test_find_accounts());
//var_dump($fb->test_get_login_url());
//var_dump($fb->test_create_account());
//var_dump($fb->test_delete_account());
//var_dump($fb->test_get_post_id_from_link());

var_dump($social->test_get_actions());
