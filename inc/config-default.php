<?


/*
This file should be included at the top of any file. It handles basic "core" requirements such as session ha$
database connections, core added functionality, etc
@depend core/class.Core.php
@depend core/class.Session.php
@depend core/class.User.php
*/


DEFINE('DIR', '/www/sites/bluecoat-sparkmotive/');
DEFINE('DIR_MODELS', DIR.'models');
DEFINE('DIR_CONTROLS', DIR.'controls');
DEFINE('DIR_VIEWS', DIR.'views');
DEFINE('DIR_VIEWS_RAW', DIR.'views_raw');
DEFINE('DIR_INC', DIR.'inc');
DEFINE('DEFAULT_LOCALE', 'en/us');
DEFINE('DIR_STORE', DIR.'store');
DEFINE('ENCRYPT_KEY', 'e54t20k98Rf4j284N2Aa');
DEFINE('SIMPLE_HASH', 'jkasd89009akasd');
DEFINE('GAMO_DB', 'bluecoat_sparkmotive');
DEFINE('CORE_DB', 'general');
DEFINE('MYSQL_USER', 'root');
DEFINE('MYSQL_PASS', 'Passmysql');
DEFINE('URL', 'bluecoat-sparkmotive.local');
DEFINE('ADMIN_EMAIL', 'denis@entermarketing.com');

DEFINE('SITE', 'bluecoat-sparkmotive.local');
DEFINE('SITE_URL', 'bluecoat-sparkmotive.local');
DEFINE('SITE_NAME', 'Game On');
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