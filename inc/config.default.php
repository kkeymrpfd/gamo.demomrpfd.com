<?


/*
This file should be included at the top of any file. It handles basic "core" requirements such as session ha$
database connections, core added functionality, etc
@depend core/class.Core.php
@depend core/class.Session.php
@depend core/class.User.php
*/

error_reporting(1);
DEFINE('DIR', '/var/www/gamo_demomrpfd/');
DEFINE('DIR_MODELS', DIR.'models');
DEFINE('DIR_CONTROLS', DIR.'controls');
DEFINE('DIR_VIEWS', DIR.'views');
DEFINE('DIR_VIEWS_RAW', DIR.'views_raw');
DEFINE('DIR_INC', DIR.'inc');
DEFINE('DEFAULT_LOCALE', 'en/us');
DEFINE('DIR_STORE', DIR.'store');
DEFINE('ENCRYPT_KEY', 'e54t20k98Rf4j284N2Aa');
DEFINE('SIMPLE_HASH', 'jkasd89009akasd');
DEFINE('GAMO_DB', 'gamo_demomrpfd');
DEFINE('CORE_DB', 'gamo_demomrpfd');
DEFINE('MYSQL_USER', 'root');
DEFINE('MYSQL_PASS', '');
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

DEFINE('MC_HOST' , 'localhost');

DEFINE('MC_PORT', '11211');

DEFINE('MC_HOST0' , 'localhost');

DEFINE('MC_PORT0' , '11211');


DEFINE('MC_HOST1' , 'localhost');

DEFINE('MC_PORT1' , '11211');


DEFINE('MC_QTY' , 1);

DEFINE('DB_HOST' , 'localhost');
