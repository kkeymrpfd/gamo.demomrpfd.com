<?php
require_once('interface.Core_IHttp_Handler.php');

interface Core_IHttp_Fetchable {
	
	function add_http_handler(Core_IHttp_Handler $hh);
	
}