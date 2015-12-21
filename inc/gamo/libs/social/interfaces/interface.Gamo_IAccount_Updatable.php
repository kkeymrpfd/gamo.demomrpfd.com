<?php
require_once('interface.Gamo_IAccount_Handler.php');

interface Gamo_IAccount_Updatable{
	
	function add_account_handler(Gamo_IAccount_Handler $ah);
	
}