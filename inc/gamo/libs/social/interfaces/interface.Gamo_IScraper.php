<?php
interface Gamo_IScraper{
	
	function init_scraper( $scraper_slug );
	function finalize_scraper( $scraper_slug );
	
	function get_last_run( $scraper_slug );
	function set_last_run( $scraper_slug );
		
	function unlock_scraper( $scraper_slug );	
	function lock_scraper( $scraper_slug );	
	function is_scraper_locked( $scraper_slug );
	
}