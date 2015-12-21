<?
$mc_connect_tries = 0;
$mc = new Memcache;

function mc_loop_connect() {
	
	global $mc, $mc_connect_tries;

	++$mc_connect_tries;

	if($mc_connect_tries > 4) {

		echo "Connection error. Please try again.";
		die();

	} else if($mc_connect_tries > 1) {

		sleep(1);

	}

	$mc->connect(MC_HOST, MC_PORT) or mc_loop_connect();

}

mc_loop_connect();

$dbh = new PDO("mysql:host=" . DB_HOST, MYSQL_USER, MYSQL_PASS, array(PDO::ATTR_PERSISTENT => false));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("SET CHARACTER SET utf8");

date_default_timezone_set('UTC');

require_once(DIR . '/vendor/autoload.php');
require_once(DIR_INC . "/core/class.Core.php"); //@call core/class.Core.php
require_once(DIR_INC . "/core/class.Validate.php"); //@call core/class.Validate.php
require_once(DIR_INC . "/core/class.Helper.php"); //@call core/class.Helper.php
require_once(DIR_INC . "/core/class.Session.php"); //@call core/class.Session.php
require_once(DIR_INC . "/misc/class.Components.php"); //@call core/class.User.php 