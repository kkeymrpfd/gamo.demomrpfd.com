<?php
interface Gamo_IAccount_Handler{
	
	function create_account($options=array());
	function delete_account($options=array());
	function find_account($options=array());
	function has_account($options=array());
	
}