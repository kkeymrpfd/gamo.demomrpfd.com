<?php
require_once('interface.Core_IScraper.php');

interface Core_IScrapable{
	
	function add_scraper(Core_IScraper $sc);
	
}