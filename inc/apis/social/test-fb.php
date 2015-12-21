<?php
require('config.php');
require_once(DIR_INC.'/core/class.Core.php');
require('class.Social.php');

class Test_Facebook_Service extends Social{
	
	public $pub_options = array(
			'game_desc' => array(
					'pages' => array(array('id' => '102256706634280', 'name' => 'Developers', 'label' => 'false'))
			),
			'fb_connection'	=> array(
					'app_id' => '444548422291754',
					'app_secret' => '54f62165c8776d977203d94b08f9ea33'
			),
			'service' => Social::SV_FACEBOOK
	);
	
	function test_get_actions(){
		return $this->get_actions($this->pub_options);
	}
	
	function test_init_scrape($options){
		return $this->init_scrape($options);
	}
	
	function test_find_accounts(){
		return $this->find_accounts();
	}
	
	function test_get_shareable_accounts(){
		$this->init_scrape( array('scraper_slug' => 'facebookShare'));
		return $this->get_shareable_objects();
	}
	
	function test_get_likes_comments_wposts(){
		$this->get_likes_comments_wposts();
		return $this->actions_new;
	}
	
	function test_get_page_likes(){
		$this->get_page_likes();
		return $this->actions_new;
	}
	
	function test_get_shares(){
		$this->get_shares();
		return $this->actions_new;
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

$fb = new Test_Facebook_Service();

//var_dump($fb->test_init_scrape(array('scraper_slug' => 'facebookShare')));
//var_dump($fb->test_find_accounts());
//var_dump($fb->test_get_likes_comments_wposts());
//var_dump($fb->test_get_page_likes());
//var_dump($fb->test_get_shares());
//var_dump($fb->test_get_login_url());
//var_dump($fb->test_create_account());
//var_dump($fb->test_delete_account());
//var_dump($fb->test_get_post_id_from_link());

var_dump($fb->test_get_actions());

