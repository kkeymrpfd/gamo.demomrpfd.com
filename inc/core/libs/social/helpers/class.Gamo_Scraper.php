<?php
class Core_Scraper implements Core_IScraper{
	
	function init_scraper( $scraper_slug ){
		
		if( $this->is_scraper_locked( $scraper_slug ) )
			return false;
		
		if( !$this->lock_scraper( $scraper_slug ) ){
			return false;
		}
		
		return true;

	}
	
	function finalize_scraper( $scraper_slug ){
		
		$this->unlock_scraper( $scraper_slug );
		$this->set_last_run( $scraper_slug );
		
	}
	
	function get_last_run( $scraper_slug ){
		
		$last_run_name = $this->get_lastrun_name( $scraper_slug );
		
		return Core::get($last_run_name);

	}
	
	function set_last_run( $scraper_slug ){
		
		$last_run_name = $this->get_lastrun_name( $scraper_slug );
		
		if( !Core::set( $last_run_name, time() ) )
			return false;
		
		return true;
		
	}
	
	function unlock_scraper( $scraper_slug ){
		
		$lock_name = $this->get_lock_name( $scraper_slug );
		
		if(!Core::set($lock_name,0,0,305))
			return false;
		
		return true;
		
	}
	
	function lock_scraper( $scraper_slug ){
		
		$lock_name = $this->get_lock_name( $scraper_slug );
		
		
		if(!Core::set($lock_name,1,0,305))
			return false;
		
		return true;
		
	}
	
	function is_scraper_locked( $scraper_slug ){
		
		$lock_name = $this->get_lock_name( $scraper_slug );
		$isLocked = Core::get($lock_name);
		
		return $isLocked ? true : false;
		
	}
	
	protected function get_lastrun_name( $scraper_slug ){
		
		return 'scraper'.ucwords( $scraper_slug ).'-lastRun';
		
	}
	
	protected function get_lock_name( $scraper_slug ){
		
		return 'scraper'.ucwords( $scraper_slug ).'-lock';
		
	}
	
}