# Informatica action:rewards #
***
### **Info** ###
**Website**	:	[entermarketing.com](http://entermarketing.com/ "enter:marketing")  

***
### **Requirements** ###
* **PHP 5.2.8 or greater**
* **MySQL**
* Apache: **mod_rewrite**

***
### **Notes** ###

* Memcached is required
* Php requires the Memcache extension (Note: This is NOT the same as the Memcached extension)
* Mysql is required with support for mysqli
* For SCSS (css pre-processor), Rube 1.9.3 with SCSS is required. See tutorial at:
* http://sass-lang.com/tutorial.html
* The following command needs to be running to process the raw css files on the dev machine before git push:
* screen scss --watch /var/www/sites/triviafevergame/css_raw/desktop:/var/www/sites/triviafevergame/pub/css/desktop
* **screen php /www/sites/salesenablement.sparkmotive.com/workers/generate_views.php**
* 
* Set the following directories to hidden:
* /site/pub/core/
* /site/pub/view/
* /site/pub/css_raw

cp -r ~/Downloads/phpMyAdmin-4.0.4.1-english pub/phpmyadmin
cp inc/config.default.php inc/config.php
tar -zxvf store.tar.gz store
cp inc/apis/social/config-stag.php config.php
cp inc/vendor/google-service/config-default.php inc/vendor/google-service/config.php

chmod 777 store
chmod -R 777 user_img
chmod -R 777 resources
chmod -R 777 resources_img

pub/.htaccess -> 
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www.localhost$ [NC]
RewriteRule ^(.*)$ http://localhost/$1 [R=301,L]
#RewriteCond %{HTTP_HOST} ^gamon.entermarketing.com$ [NC]
#RewriteRule ^(.*)$ http://localhost/$1 [R=301,L]
#RewriteCond %{HTTP_HOST} ^www.gamon.entermarketing.com$ [NC]
#RewriteRule ^(.*)$ http://var/www.localhost/$1 [R=301,L]
RewriteRule ^get_vevent_email_img/([0-9]+).png$ /vevent_email_img.php?id=$1 [L] 
RewriteRule ^get_user_img/([0-9]+).png$ /user_img.php?user_id=$1 [L] 
RewriteRule ^get_vevent_img/([0-9]+).png$ /vevent_img.php?id=$1 [L] 

***

##### *Copyright (c) 2013 [enter:marketing](http://entermarketing.com/ "enter:marketing"). All Rights Reserved.* #####