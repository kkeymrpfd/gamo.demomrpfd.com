<?php
require_once('interface.Gamo_IScraper.php');

interface Gamo_IScrapable{
	
	function add_scraper(Gamo_IScraper $sc);
	
}