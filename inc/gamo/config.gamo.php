<?
/*
This file should be included at the top of any file. It handles basic "core" requirements such as session handling functions,
database connections, core added functionality, etc
@depend core/class.Core.php
@depend core/class.Session.php
@depend core/class.User.php
*/
DEFINE('DIR', '/sites/sites/jmc');
DEFINE('DIR_MODELS', '/sites/sites/jmc/models');
DEFINE('DIR_CONTROLS', '/sites/sites/jmc/controls');
DEFINE('DIR_VIEWS', '/sites/sites/jmc/views');
DEFINE('DIR_INC', '/sites/sites/jmc/inc');
DEFINE('DEFAULT_LOCALE', 'en/us');
DEFINE('ENCRYPT_KEY', 'e54t20k98Rf4j284N2Aa');
DEFINE('GAMO_DB', 'gamo');
DEFINE('SITE', 'jmc');

$mc = new Memcache;
$mc->connect('localhost', 11211) or die ("Could not connect");

$dbh = new PDO("mysql:host=localhost", 'root', 'Passmysql', array(PDO::ATTR_PERSISTENT => false));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("SET CHARACTER SET utf8");

require_once(DIR_INC . "/lib/class.Core.php"); //@call core/class.Core.php
require_once(DIR_INC . "/lib/class.Session.php"); //@call core/class.Session.php
require_once(DIR_INC . "/lib/class.User.php"); //@call core/class.User.php
require_once(DIR_INC . "/misc/class.Components.php"); //@call core/class.User.php
require_once(DIR_INC . "/gamo/class.Gamo.php");
?>
