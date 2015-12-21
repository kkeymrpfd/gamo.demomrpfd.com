<?php
$dir=dirname(__FILE__);
require_once($dir.'/../../core/class.Core.php');

class Options{
	
	public function get_option($options=array()){
		/*
		 Arguments:
		{
			option_name:
		}
		Return:
		if successful:
		{
		}
		if error:
		{
		}
		*/
	}
	
	public function get_last_run($options=array()) {
		global $dbh;
	
		$lock_name = $this->get_lastrun_name($options);
	
		$sql = 'SELECT value FROM ' . GAMO_DB . '.options WHERE tkey = :lock_name';
	
		$sth = $dbh->prepare($sql);
		$sth->execute(array(':lock_name' => $lock_name));
	
		$isLocked = $sth->fetchColumn();
	
		return $isLocked;
	}
	
	public function is_scraper_locked($options=array()) {
		/*
		global $dbh;
		
		$lock_name = $this->get_lock_name($options);
		
		$sql = 'SELECT value FROM ' . GAMO_DB . '.options WHERE tkey = :lock_name';
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(':lock_name' => $lock_name));
		
		$isLocked = $sth->fetchColumn();
		*/
		
		$lock_name = $this->get_lock_name($options);
		$isLocked = Core::get($lock_name);
		
		return $isLocked ? true : false;
	}

	public function lock_scraper($options=array()) {
		/*
		global $dbh;
		
		$lock_name = $this->get_lock_name($options);
		
		$result = Core::db_update(array(447
				'table' => '' . GAMO_DB . '.options',
				'values' => array('value' => 1),
				'where' => array(
					'tkey' => $lock_name,
				)
			)
		);
		*/
		$lock_name = $this->get_lock_name($options);
		
		
		if(!Core::set($lock_name,1,0,1200))
			return false;
		
		return true;
	}
	
	public function unlock_scraper($options=array()) {
		/*
		global $dbh;
	
		$lock_name = $this->get_lock_name($options);
	
		$result = Core::db_update(array(
				'table' => '' . GAMO_DB . '.options',
				'values' => array('value' => 0),
				'where' => array(
						'tkey' => $lock_name,
				)
		)
		);
		*/
		
		$lock_name = $this->get_lock_name($options);
	
		if(!Core::set($lock_name,0,0,1200))
			return false;
	
		return true;
	}
	
	public function set_last_run($options=array()) {
		global $dbh;
	
		$lock_name = $this->get_lastrun_name($options);
	
		try {
			$result = Core::db_update(array(
					'table' => '' . GAMO_DB . '.options',
					'values' => array('value' => time()),
					'where' => array(
							'tkey' => $lock_name,
					)
			)
			);
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		} 
	
		if(!is_numeric($result))
			return false;
	
		return true;
	}
	
	protected function get_lastrun_name($options=array()){
		return 'scraper'.ucwords($options['scraper_slug']).'-lastRun';
	}
	
	protected function get_lock_name($options=array()){
		return 'scraper'.ucwords($options['scraper_slug']).'-lock';
	}
}