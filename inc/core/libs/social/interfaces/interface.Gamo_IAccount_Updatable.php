<?php
require_once('interface.Core_IAccount_Handler.php');

interface Core_IAccount_Updatable{
	
	function add_account_handler(Core_IAccount_Handler $ah);
	
}