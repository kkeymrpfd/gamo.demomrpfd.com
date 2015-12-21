<?php
############
#
# Author: Garrett Gardner
# Original Author: Ahmad Amin
# Version: 1.0.0
# Email : gg@entermarketing.com
# Website: http://entermarketing.com
#
# Copyright (c) 2012 Enter Marketing. All Rights Reserved.
#
############
 
class Invite {

        ## Variables
        private $_uid                                   =               "";                                                             # User ID (@var string)
        private $_method                                =               "PUBLISH";                                              # Event Method (@var string)
        private $_start                                 =               null;                                                   # Event Start DateTime (@var DateTime)
        private $_end                                   =               null;                                                   # Event End DateTime (@var DateTime)
        private $_hasSender                             =               false;                                                  # Event Sender switch (@var bool)
        private $_senderName                    =               "";                                                             # Event Sender Name (@var string)
        private $_senderEmail                   =               "";                                                             # Event Sender Email (@var string)
        private $_subject                               =               "";                                                             # Event Name (@var string)
        private $_body                                  =               "";                                                             # Event Body Text (@var string)
        private $_location                              =               "";                                                             # Event Location (@var string)
        private $_summary                               =               "";                                                             # Event Summary (@var string)
        private $_attendees                             =               array();                                                # Array of Attendees (@var array[string])
        private $_generated                             =               "";                                                             # ICS Generated Content (@var string)
        private $_savePath                              =               "./invites/";                                   # Invites
        private $_savedFile                             =               "";                                                             # Invites

        ## Constructor
    public function __construct($uid = null) {
                if(empty($uid))
                        $this->_uid = uniqid(rand(0, getmypid())) . "@entermarketing.com";
                else
                        $this->_uid = $uid . "@entermarketing.com";
                        
                return $this;
    }

        ## Gets User ID
    public function getUID() {
                return $this->_uid;
    }

        ## Set the Event Method
    public function setMethod($method) {
                $this->_method = strtoupper($method);
                return $this;
    }

        ## Gets Event Method
    public function getMethod() {
                return $this->_method;
    }

        ## Set the Start DateTime
    public function setStart(DateTime $start) {
                $this->_start = $start;
                $this->_start->setTimezone(new DateTimeZone("GMT"));
                return $this;
    }

        ## Gets Event Start DateTime (Formatted)
    public function getStart($formatted = false) {
                if($formatted)
                        return $this->_start->format("Ymd\THis\Z");
                else
                        return $this->_start;
    }
        
        ## Set the End DateTime
    public function setEnd(DateTime $end) {
                $this->_end = $end;
                $this->_end->setTimezone(new DateTimeZone("GMT"));
                return $this;
    }

        ## Gets Event End DateTime (Formatted)
    public function getEnd($formatted = false) {
                if($formatted)
                        return $this->_end->format("Ymd\THis\Z");
                else
                        return $this->_end;
    }
        
        ## Set Event Sender Email and Name
    public function setSender($email, $name = null) {
                if(empty($name))
                        $name = $email;

                $this->_hasSender = true;
                $this->_senderEmail = $email;
                $this->_senderName = $name;

                return $this;
    }
        
        ## Gets Event Sender switch
    public function hasSender() {
                return $this->_hasSender;
    }
        
        ## Gets Event Sender Email
    public function getSenderEmail() {
                return $this->_senderEmail;
    }
        
        ## Gets Event Sender Name
    public function getSenderName() {
                return $this->_senderName;
    }

        ## Set Event Subject
    public function setSubject($subject) {
                $this->_subject = $subject;
                return $this;
    }
        
        ## Gets Event Subject
    public function getSubject() {
                return $this->_subject;
    }

        ## Set Event Body Text
    public function setBody($body) {
                $this->_body = $body;
                return $this;
    }
        
        ## Gets Event Body Text
    public function getBody() {
                return $this->_body;
    }

        ## Set Event Location
    public function setLocation($location) {
                $this->_location = $location;
                return $this;
    }
        
        ## Gets Event Location
    public function getLocation() {
                return $this->_location;
    }

        ## Set Event Summary
    public function setSummary($summary) {
                $this->_summary = $summary;
                return $this;
    }
        
        ## Gets Event Summary
    public function getSummary() {
                return $this->_summary;
    }

        ## Add guest to Event
    public function addAttendee($email, $name = null) {
                if(empty($name))
                        $name = $email;

                $this->_attendees[$email] = $name;

                return $this;
    }
        
        ## Gets Event guests
    public function getAttendees() {
                return $this->_attendees;
    }
        
        ## Gets Saved File
    public function getSavedFile() {
                return $this->_savedFile;
    }

        ## Generate the content
    public function generate() {
                $content = "BEGIN:VCALENDAR\n";
                $content .= "VERSION:2.0\n";
                $content .= "CALSCALE:GREGORIAN\n";
                $content .= "METHOD:{$this->getMethod()}\n";
                $content .= "BEGIN:VEVENT\n";
                $content .= "UID:{$this->getUID()}\n";
                $content .= "DTSTART:{$this->getStart(true)}\n";
                $content .= "DTEND:{$this->getEnd(true)}\n";
                $content .= "DTSTAMP:{$this->getStart(true)}\n";
                
                if($this->hasSender())
                        $content .= "ORGANIZER;CN={$this->getSenderName()}:mailto:{$this->getSenderEmail()}\n";

                foreach($this->getAttendees() as $email => $name)
                        $content .= "ATTENDEE;CN={$name}:mailto:{$email}\n";
                        //$content .= "ATTENDEE;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN={$name};X-NUM-GUESTS=0:mailto:{$email}\n";

                $content .= "CREATED:\n";
                $content .= "DESCRIPTION:{$this->getBody()}\n";
                $content .= "LAST-MODIFIED:{$this->getStart(true)}\n";
                $content .= "LOCATION:{$this->getLocation()}\n";
                $content .= "SUMMARY:{$this->getSummary()}\n";
                $content .= "SEQUENCE:0\n";
                $content .= "STATUS:NEEDS-ACTION\n";
                $content .= "TRANSP:OPAQUE\n";
                $content .= "END:VEVENT\n";
                $content .= "END:VCALENDAR";

                $this->_generated = $content;
                return $this;
    }

        ## Get the invite file saved path
    public static function getSavedPath() {
                if(isset($_SESSION['savepath']))
                        return $_SESSION['savepath'];
                
                return false;
    }

        ## Download the invite file
    public function download() {
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-type: text/Calendar");
                header("Content-Disposition: inline; filename=\"invite.ics\"");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . strlen($this->_generated));
                print $this->_generated;
    }
        
    public function save($path = null, $name = null){
                if(empty($path))
                        $path = $this->_savePath;

                if(empty($name))
                        $name = $this->getUID() . '.ics';

                # Create path if it doesn't exist
                if (!is_dir($path)) {
                        try {
                                mkdir($path, 0777, TRUE);
                        } catch (Exception $e) {
                                exit;
                        }
                }

                if(!empty($this->_generated)) {
                        try {
                                $handler = fopen($path . $name, 'w+');
                                $f = fwrite($handler, $this->_generated);
                                fclose($handler);

                                # Save the file
                                $this->_savedFile = $path . $name;
                                
                        } catch (Exception $e) {
                                exit;
                        }
                }

                return $this;
    }

}

?>