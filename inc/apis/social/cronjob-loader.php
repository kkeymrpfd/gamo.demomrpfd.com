<?php
$current_dir = dirname(__FILE__);
require($current_dir.'/../../config.php');

require(DIR_INC . '/gamo/class.Gamo.php');
require_once(DIR_INC . "/core/class.Core.php");
require_once(DIR_INC . "/apis/social/class.Social.php");

$mc = new Memcache;
$mc->connect(MC_HOST, MC_PORT) or die ("Could not connect");

$dbh = new PDO("mysql:host=" . DB_HOST, MYSQL_USER, MYSQL_PASS, array(PDO::ATTR_PERSISTENT => false));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("SET CHARACTER SET utf8");




