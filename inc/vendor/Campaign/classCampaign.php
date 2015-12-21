<?php
############
#
# Author: Garrett Gardner
# Version: 1.2.0
# Email : gg@entermarketing.com
# Website: http://entermarketing.com
#
# Copyright (c) 2012 Enter Marketing. All Rights Reserved.
#
############

    class Campaign {

        ## Variables
        private $__campaignURL            =        "";                            # Campaign URL (@var string)
        private $__campaignID            =        42;                            # Campaign ID (@var int)
        
        private function __cleanInput($input) {
            return str_replace("|","!",str_replace("^","v",(strip_tags($input))));
        }
        
        private function __campaignRequest($command, $pin = null, $data = null, $status = null) {
            switch($command){
                case 'getpinbyname':
                    $url = $this->__campaignURL . "/response.php?campaignid=" . $this->__campaignID . "&command=" . $command . "&data=" . urlencode($pin);
                    break;
                case 'getpinbyemail':
                    $url = $this->__campaignURL . "/response.php?campaignid=" . $this->__campaignID . "&command=" . $command . "&data=".urlencode($pin);
                    break;
                case 'checkpin':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command;
                    break;
                case 'initiate':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command . "&status=" . $status . "&data=" . urlencode($data);
                    break;
                case 'savedata':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command . "&status=" . $status . "&data=" . urlencode($data);
                    break;
                case 'addnew':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command . "&status=" . $status . "&data=" . urlencode($data);
                    break;
                case 'readdata':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command;
                    break;
                case 'getresponsestatus':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command;
                    break;
                case 'getsalesrep':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command;
                    break;
                case 'getnewpin':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&command=" . $command;
                    break;
                case 'getgiftcode':
                    $url = $this->__campaignURL."/response.php?campaignid=" . $this->__campaignID . "&pin=" . urlencode($pin) . "&command=" . $command;
                    break;
                default:
                    return false;
                    break;
            }
            
            $snoopy = new Snoopy;
            $snoopy->maxframes         =         0;
            $snoopy->agent             =         'Microsite to CT2.0 Gateway';
            $snoopy->referer           =         "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
            $snoopy->maxlength         =         1024000;

            if($snoopy->fetch($url))
                $result = $snoopy->results;
            else
                $result = $snoopy->error;

            return $result;
        }

        ## Sets Campaign URL
        public function setCampaignURL($campaignURL){
            $this->__campaignURL = $campaignURL;
            return $this;
        }

        ## Sets Campaign ID
        public function setCampaignID($campaignID){
            $this->__campaignID = $campaignID;
            return $this;
        }
        
        public function getNewPin(){
            $pin = $this->__campaignRequest("getnewpin");
            
            if(!$pin)
                return false;
            
            return $pin;
        }
        
        public function checkPin($pin){
            $request = $this->__campaignRequest("checkpin", $pin);
            
            if(!$request)
                return false;
            
            return true;
        }
        
        public function getPinByName($name){
            $pin = $this->__campaignRequest("getpinbyname", $name);
            
            if(!$pin)
                return false;
                
            return $pin;
        }
        
        public function getData($pin){
            $request = $this->__campaignRequest("readdata", $pin);
            
            if(!$request)
                return false;
                
            return unserialize($request);
        }
        
        public function getGiftCode($pin){
            $request = $this->__campaignRequest("getgiftcode", $pin);
            
            if(!$request)
                return false;
            
            return $request;
        }
        
        public function updateStatus($pin, $newStatus, $status = 0){
            $status = ($newStatus > $status) ? $newStatus : $status;
            $request = $this->__campaignRequest("savedata", $pin, "", $status);
            
            if(empty($request))
                return false;
            
            return true;
        }
        
        public function addNewUser($pin, $info){
            $data = array();
            if(isset($info['firstname']))
                $data['ContactName'] = $info['firstname'];
            if(isset($info['lastname']))
                if(isset($data['ContactName']))
                    $data['ContactName'] .= " " . $info['lastname'];
                else
                    $data['ContactName'] = " " . $info['lastname'];
            if(isset($info['title']))
                $data['Title'] = $info['title'];
            if(isset($info['company']))
                $data['Company'] = $info['company'];
            if(isset($info['phone']))
                $data['Phone'] = $info['phone'];
            if(isset($info['email']))
                $data['Email'] = $info['email'];
            if(isset($info['address']))
                $data['Address'] = $info['address'];
            if(isset($info['city']))
                $data['City'] = $info['city'];
            if(isset($info['state']))
                $data['State'] = $info['state'];
            if(isset($info['zip']))
                $data['Zip'] = $info['zip'];
            
            $data = serialize($data);
            $request = $this->__campaignRequest("addnew", $pin, $data, 2);
            
            if(empty($request))
                return false;
            
            return true;
        }
        
        public function saveQuestions($pin, $questions, $status = 0){
            $data = array();
            
            foreach($questions as $key => $question) {
                if(isset($question['question']) && !empty($question['question']) && isset($question['answer']) && !empty($question['answer'])) {
                    $i = 100 + intval($key);            
                    $data[1][$i][1] = $this->__cleanInput($question['question']);
                    $data[1][$i][2] = $this->__cleanInput($question['answer']) . "^1^1^1";
                    $data[1][$i][3] = "1|1|0";
                }
            }
            
            $newStatus = 2;
            
            $data = serialize($data);
            $status = ($newStatus > $status) ? $newStatus : $status;
            $request = $this->__campaignRequest("savedata", $pin, $data, $status);
            
            if(empty($request))
                return false;
            
            return true;
        }
        
        public function respondMeeting($pin, $meeting, $status = 0){
            $data = array();
            
            # Response
            if(isset($meeting['responseLabel']) && !empty($meeting['responseLabel']) && isset($meeting['responseValue']) && !empty($meeting['responseValue'])) {
                $i = 201;
                $data[1][$i][1] = $this->__cleanInput($meeting['responseLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['responseValue']) . "^1^1^1";
                $data[1][$i][3] = "0|0|0";
            }
        
            # Date
            if(isset($meeting['dateLabel']) && !empty($meeting['dateLabel']) && isset($meeting['dateValue']) && !empty($meeting['dateValue'])) {
                $i = 202;
                $data[1][$i][1] = $this->__cleanInput($meeting['dateLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['dateValue']) . "^1^1^1";
                $data[1][$i][3] = "4|1|0";
            }
        
            # Alternate Date
            if(isset($meeting['alternateDateLabel']) && !empty($meeting['alternateDateLabel']) && isset($meeting['alternateDateValue']) && !empty($meeting['alternateDateValue'])) {
                $i = 203;
                $data[1][$i][1] = $this->__cleanInput($meeting['alternateDateLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['alternateDateValue']) . "^1^1^1";
                $data[1][$i][3] = "4|1|0";
            }
        
            # Email
            if(isset($meeting['emailLabel']) && !empty($meeting['emailLabel']) && isset($meeting['emailValue']) && !empty($meeting['emailValue'])) {
                $i = 204;
                $data[1][$i][1] = $this->__cleanInput($meeting['emailLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['emailValue']) . "^1^1^1";
                $data[1][$i][3] = "2|1|0";
            }
        
            # Phone
            if(isset($meeting['phoneLabel']) && !empty($meeting['phoneLabel']) && isset($meeting['phoneValue']) && !empty($meeting['phoneValue'])) {
                $i = 205;
                $data[1][$i][1] = $this->__cleanInput($meeting['phoneLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['phoneValue']) . "^1^1^1";
                $data[1][$i][3] = "2|1|0";
            }
        
            # Discussion Topic
            if(isset($meeting['discussLabel']) && !empty($meeting['discussLabel']) && isset($meeting['discussValue']) && !empty($meeting['discussValue'])) {
                $i = 206;
                $data[1][$i][1] = $this->__cleanInput($meeting['discussLabel']);
                $data[1][$i][2] = $this->__cleanInput($meeting['discussValue']) . "^1^1^1";
                $data[1][$i][3] = "1|1|0";
            }
            if(isset($meeting['status']) && !empty($meeting['status'])) {
                $newStatus = intval($meeting['status']);
            }
            
            if(empty($data))
                return true;
            
            $data = serialize($data);
            $status = ($newStatus > $status) ? $newStatus : $status;
            $request = $this->__campaignRequest("savedata", $pin, $data, $status);
            
            if(empty($request))
                return false;
            
            return true;
        }
        
        public function clickResource($pin, $resource, $status) {
            $data = array();
            # Generate Click Index
            if(isset($resource['id']) && isset($resource['label']) && !empty($resource['label']) && isset($resource['title']) && !empty($resource['title'])) {
                $i = 300 + intval($resource['id']);
                $data[1][$i][1] = $this->__cleanInput($resource['label']);
                $data[1][$i][2] = $this->__cleanInput($resource['title']) . "^1^0^0";
                $data[1][$i][3] = "0|0|0";
            }
            
            if(empty($data))
                return true;
                
            $newStatus = 1;
            $data = serialize($data);
            $status = ($newStatus > $status) ? $newStatus : $status;
            $request = $this->__campaignRequest("savedata", $pin, $data, $status);
            
            if(empty($request))
                return false;
            
            return true;
        }
        
        public function createMeeting($pin, $meeting, $status) {
            $data = array();
            # Generate Click Index
            if(isset($meeting['label']) && !empty($meeting['label']) && isset($meeting['value']) && !empty($meeting['value'])) {
                $i = 901;
                $data[1][$i][1] = $this->__cleanInput($meeting['label']);
                $data[1][$i][2] = $this->__cleanInput($meeting['value']) . "^1^0^0";
                $data[1][$i][3] = "0|0|0";
            }
            
            if(empty($data))
                return true;
                
            $newStatus = 1;
            $data = serialize($data);
            $status = ($newStatus > $status) ? $newStatus : $status;
            $request = $this->__campaignRequest("savedata", $pin, $data, $status);
            
            if(empty($request))
                return false;
            
            return true;
        }
    }