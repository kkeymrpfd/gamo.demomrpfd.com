<?
############
#
# Author: Garrett Gardner
# Version: 1.0.0
# Email : gg@entermarketing.com
# Website: http://entermarketing.com
#
# Copyright (c) 2012 Enter Marketing. All Rights Reserved.
#
############

	class MeetingRequester {

		## Variables
		private $__URL					=		"";							# Meeting Requester URL (@var string)
		private $__username				=		"";							# Meeting Requester Username (@var string)
		private $__password				=		"";							# Meeting Requester Password (@var string)
		private $__attendees			=		"";							# Meeting Requester Attendees (@var array[string])
		
		## Sets Meeting URL
		public function setURL($URL){
			$this->__URL = $URL;
			return $this;
		}

		## Sets Meeting Username
		public function setUsername($username){
			$this->__username = $username;
			return $this;
		}

		## Sets Meeting Password
		public function setPassword($password){
			$this->__password = $password;
			return $this;
		}
		
		## Requests to make a new meeting
		public function request($meeting){
			$meeting['username'] = sha1($this->__username);
			$meeting['password'] = sha1($this->__password);
			
			$Snoopy = new Snoopy;
			$Snoopy->maxframes 		=		0;
			$Snoopy->agent     		= 		'imPACK to IT Meeting Maker';
			$Snoopy->referer   		= 		"http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
			$Snoopy->maxlength 		= 		1024000;

			if(!$Snoopy->submit($this->__URL, $meeting))
				return false;
				
			return json_decode($Snoopy->results);
		}
	}

?>