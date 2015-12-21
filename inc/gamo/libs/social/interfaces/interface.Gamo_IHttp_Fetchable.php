<?php
require_once('interface.Gamo_IHttp_Handler.php');

interface Gamo_IHttp_Fetchable {
	
	function add_http_handler(Gamo_IHttp_Handler $hh);
	
}