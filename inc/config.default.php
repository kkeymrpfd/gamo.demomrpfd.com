<?


/*
This file should be included at the top of any file. It handles basic "core" requirements such as session ha$
database connections, core added functionality, etc
@depend core/class.Core.php
@depend core/class.Session.php
@depend core/class.User.php
*/

error_reporting(0);
DEFINE('DIR', '/www/sites/delloverdrive.com/');
DEFINE('DIR_MODELS', DIR.'models');
DEFINE('DIR_CONTROLS', DIR.'controls');
DEFINE('DIR_VIEWS', DIR.'views');
DEFINE('DIR_VIEWS_RAW', DIR.'views_raw');
DEFINE('DIR_INC', DIR.'inc');
DEFINE('DEFAULT_LOCALE', 'en/us');
DEFINE('DIR_STORE', DIR.'store');
DEFINE('ENCRYPT_KEY', 'e54t20k98Rf4j284N2Aa');
DEFINE('SIMPLE_HASH', 'jkasd89009akasd');
DEFINE('GAMO_DB', 'delloverdrive');
DEFINE('CORE_DB', 'general');
DEFINE('MYSQL_USER', 'root');
DEFINE('MYSQL_PASS', 'passmysql');
DEFINE('URL', 'salesenablement.sparkmotive.com');
DEFINE('ADMIN_EMAIL', 'contact@entermarketing.com');

DEFINE('SITE', 'salesenablement.sparkmotive.com');
DEFINE('SITE_URL', 'salesenablement.sparkmotive.com');
DEFINE('SITE_NAME', 'Sales Enablement');
DEFINE('PROTOCOL', 'http');


DEFINE("SMTP_HOST", 'ssl://smtp.sendgrid.net');
DEFINE("SMTP_PORT", '465');
DEFINE("SMTP_USER", 'it@enternewmedia.com');
DEFINE("SMTP_PASS", '00chickenparty00');

DEFINE('IT_MEETING_USER', 'enterAdmin');
DEFINE('IT_MEETING_PASS', 'Allyson1');
DEFINE('IT_MEETING_EMAIL', 'scheduler@itmeetingmaker.com');

require("/www/config.php");
?>
