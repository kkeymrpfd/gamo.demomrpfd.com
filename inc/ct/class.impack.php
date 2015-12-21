<?php

class imPack {

	## Variables
	private $_version						=		"2.2";					    	# Current Version (@var string)
	private $_lang							=		"en";							# Language (@var string)
	private $_siteTitle						=		"imPack Mailer";				# Site Title (@var string)
	private $_siteBGColor					=		"";								# Site Background Color (@var string)
	private $_siteBGImage					=		"img/site-background.jpg";		# Site Background Image (@var string)
	private $_siteBGImageAttach				=		"fixed";						# Site Background Image Attachment (@var string)
	private $_siteBGRepeat					=		"no-repeat";					# Site Background Repeat (@var string)
	private $_contentMinHeight				=		"0px";							# Content Minimum Height (@var string)
	private $_contentCoordX					=		"250px";						# Content Coordinates X (left) (@var string)
	private $_contentCoordY					=		"80px";							# Content Coordinates Y (top) (@var string)
	private $_contentBGImagesOn				=		false;							# Content Background Images switch (@var bool)
	private $_contentCapTop					=		"22px";							# Content Top Cap Height (@var string)
	private $_contentCapBottom				=		"28px";							# Content Bottom Cap Height (@var string)
	private $_textColor						=		"#FFFFFF";						# Text Color (@var string)
	private $_linkColor						=		"#FFFFFF";						# Link Color (@var string)
	private $_buttonTextColor				=		"#FFFFFF";						# Button Text Color (@var string)
	private $_buttonHoverTextColor			=		"#FFFFFF";						# Button Text Hover Color (@var string)
			
	private $_giftCodeEnabled				=		false;							# Gift Code Enabled (@var bool)
			
	private $_campaign						=		null;							# Campaign (@var Campaign)
	private $_campaignEnabled				=		false;							# Campaign enabled Switch (@var bool)
		
	private $_pages							=		array();						# imPackPages (@var array[imPackPage])
	private $_totalPages					=		0;								# Total number of imPackPages (@var int)
	private $_beginPage						=		null;							# Begin Page (@var imPackPage)
	private $_meetingPage					=		null;							# Meeting Page (@var imPackPage)
	private $_thankYouPage					=		null;							# Thank You Page (@var imPackPage)
			
	private $_questions						=		array();						# imPackPageQuestions (@var array[imPackPageQuestion])
	private $_totalQuestions				=		0;								# Total number of imPackPageQuestions (@var int)
			
	private $_resources						=		array();						# imPackPartResources (@var array[imPackPartResources])
	private $_totalResources				=		0;								# Total number of imPackPartResources (@var int)
			
	private $_blocks						=		array();						# imPackPartBlocks (@var array[imPackPartBlocks])
	private $_totalBlocks					=		0;								# Total number of imPackPartBlocks (@var int)
	
	private $_meetingRequesterEnabled		=		false;  						# Meeting Requester switch (@var bool)
	private $_meetingRequester				=		null;   						# Meeting Requester (@var meetingRequester)
	private $_meetingRequesterCompany		=		null;   						# Meeting Requester Title (@var string)
	private $_meetingRequesterOrganizerName	=		null;							# Meeting Requester Organizer Name (@var string)
	private $_meetingRequesterOrganizer		=		null;							# Meeting Requester Organizer (@var string)
	private $_meetingRequesterAttendees		=		array();						# Meeting Requester Attendees (@var array[string])
	
	## Constructor
	public function __construct($lang){
		$this->_lang = strtolower($lang);
		if(file_exists(DIR_INC . "/lang/" . $this->_lang . ".php"))
			require_once(DIR_INC . "/lang/" . $this->_lang . ".php");
		else
			require_once(DIR_INC . '/lang/en.php');
		return $this;
	}

	############
	# General Settings Management
	############

	## Gets imPack Mailer Version
    public function getVersion(){
		return $this->_version;
    }

	## Gets imPack Language
    public function getLang(){
		return $this->_lang;
    }

	## Sets Site Title
    public function setSiteTitle($siteTitle){
		$this->_siteTitle = $siteTitle;
		return $this;
    }

	## Gets Site Title
    public function getSiteTitle(){
		return $this->_siteTitle;
    }

	## Sets Site BG Color
    public function setSiteBGColor($BGColor){
		$this->_siteBGColor = $BGColor;
		return $this;
    }

	## Gets Site BG Color
    public function getSiteBGColor(){
		return $this->_siteBGColor;
    }

	## Sets Site BG Image
    public function setSiteBGImage($BGImage){
		$this->_siteBGImage = $BGImage;
		return $this;
    }

	## Gets Site BG Image
    public function getSiteBGImage(){
		return $this->_siteBGImage;
    }

	## Sets Site BG Image Attachment mode
    public function setSiteBGImageAttach($BGImageAttach){
		$this->_siteBGImageAttach = $BGImageAttach;
		return $this;
    }

	## Gets Site BG Image Attachment mode
    public function getSiteBGImageAttach(){
		return $this->_siteBGImageAttach;
    }

	## Sets Site BG Image Attachment mode
    public function setSiteBGRepeat($BGRepeat){
		$this->_siteBGRepeat = $BGRepeat;
		return $this;
    }

	## Gets Site BG Image Attachment mode
    public function getSiteBGRepeat(){
		return $this->_siteBGRepeat;
    }

	## Sets Content Background Images Enabled
    public function setContentBGImageOn($contentBGImagesOn){
		if($contentBGImagesOn)
			$this->_contentBGImagesOn = true;
		return $this;
    }

	## Gets Content Background Images Enabled
    public function getContentBGImageOn(){
		return $this->_contentBGImagesOn;
    }

	## Sets Content Min Height
    public function setContentMinHeight($contentMinHeight){
		$this->_contentMinHeight = $contentMinHeight;
		return $this;
    }

	## Gets Content Min Height
    public function getContentMinHeight(){
		return $this->_contentMinHeight;
    }

	## Sets Content Coordinates
    public function setContentCoords($coordX, $coordY){
		$this->_contentCoordX = $coordX;
		$this->_contentCoordY = $coordY;
		return $this;
    }

	## Gets Content X Coordinate
    public function getContentCoordX(){
		return $this->_contentCoordX;
    }

	## Gets Content Y Coordinate
    public function getContentCoordY(){
		return $this->_contentCoordY;
    }

	## Sets Content Cap Heights
    public function setContentCapHeights($capHeightTop, $capHeightBottom){
		$this->_capHeightTop = $capHeightTop;
		$this->_capHeightBottom = $capHeightBottom;
		return $this;
    }

	## Gets Content Top Cap Height
    public function setContentCapHeightTop(){
		return $this->_capHeightTop;
    }

	## Gets Content Bottom Cap Height
    public function setContentCapHeightBottom(){
		return $this->_capHeightBottom;
    }

	## Sets Text Color
    public function setTextColor($textColor){
		$this->_textColor = $textColor;
		return $this;
    }

	## Gets Text Color
    public function getTextColor(){
		return $this->_textColor;
    }

	## Sets Text Color
    public function setLinkColor($linkColor){
		$this->_linkColor = $linkColor;
		return $this;
    }

	## Gets Text Color
    public function getLinkColor(){
		return $this->_linkColor;
    }

	## Sets Button Text Color
    public function setButtonTextColor($buttonTextColor){
		$this->_buttonTextColor = $buttonTextColor;
		return $this;
    }

	## Gets Button Text Color
    public function getButtonTextColor(){
		return $this->_buttonTextColor;
    }

	## Sets Button Text Color
    public function setButtonTextHoverColor($buttonTextHoverColor){
		$this->_buttonTextHoverColor = $buttonTextHoverColor;
		return $this;
    }

	## Gets Button Text Color
    public function getButtonTextHoverColor(){
		return $this->_buttonTextHoverColor;
    }

	## Sets Gift Code
    public function enableGiftCode($enable){
		if($enable)
			$this->_giftCodeEnabled = true;
		return $this;
    }

	## Gets Gift Code Status
    public function getGiftCodeEnabled(){
		if($this->_giftCodeEnabled && $this->_beginPage->getBeginType() != "gateway")
			return true;
		else
			return false;
    }

	## Sets Campaign
    public function setCampaign(Campaign $campaign){
		$this->_campaign = $campaign;
		return $this;
    }

	## Sets Campaign Enabled Switch
    public function setCampaignEnabled($campaignEnabled){
		if($campaignEnabled)
			$this->_campaignEnabled = true;
		return $this;
    }

	## Gets Campaign Enabled Switch
    public function getCampaignEnabled(){
		return $this->_campaignEnabled;
    }

	############
	# Adding Pages/Parts Management
	############

	## Adds a imPackPage
    public function addPage($imPackPage){
		$imPackPage->setPageIndex(count($this->_pages));
		$this->_pages[] = $imPackPage;
		$this->_totalPages = count($this->_pages);
		switch($imPackPage->getPageType()) {
			case "begin" :
				$this->_beginPage = $imPackPage;
				break;
			case "question" :
				$this->addQuestion($imPackPage);
				break;
			case "meeting" :
				$this->_meetingPage = $imPackPage;
				break;
			case "thankyou" :
				$this->_thankYouPage = $imPackPage;
				break;
			default :
				break;
		}
		return $this;
    }

	## Gets Total imPackPages
    public function getTotalPages(){
		return $this->_totalPages;
    }

	## Adds an imPackQuestion
    private function addQuestion($imPackQuestion){
		$imPackQuestion->setQuestionIndex(count($this->_questions));
		$this->_questions[] = $imPackQuestion;
		$this->_totalQuestions = count($this->_questions);
		return $this;
    }

	## Gets current imPackQuestion
    public function getQuestion($questionIndex){
		return $this->_questions[$questionIndex];
    }

	## Gets Total imPackQuestions
    public function getTotalQuestions(){
		return $this->_totalQuestions;
    }

	## Adds an imPackPartResource
    public function addResource($imPackPartResource){
		$imPackPartResource->setIndex(count($this->_resources));
		$this->_resources[] = $imPackPartResource;
		$this->_totalResources = count($this->_resources);
		return $this;
    }

	## Gets current imPackPartResource
    public function getResource($index){
		if(isset($this->_resources[$index]))
			return $this->_resources[$index];
		else
			return false;
    }

	## Gets total imPackPartResources
	public function getTotalResources(){
		return $this->_totalResources;
    }

	## Adds an imPackPartBlock
    public function addBlock($imPackPartBlock){
		$imPackPartBlock->setIndex(count($this->_blocks));
		$this->_blocks[] = $imPackPartBlock;
		$this->_totalBlocks = count($this->_blocks);
		return $this;
    }

	## Gets total resources
	public function getTotalBlocks(){
		return $this->_totalBlocks;
    }

	## Sets Meeting Requester
	public function setMeetingRequester(MeetingRequester $meetingRequester){
		$this->_meetingRequester = $meetingRequester;
		return $this;
	}
	
	## Sets Meeting Requester Enabled Switch
	public function setMeetingRequesterEnabled($meetingRequesterEnabled){
		$this->_meetingRequesterEnabled = $meetingRequesterEnabled;
		return $this;
	}
	
	## Gets Meeeting Requester Enabled switch
	public function getMeetingRequesterEnabled(){
		return $this->_meetingRequesterEnabled;
	}
	
	## Sets Meeting Requester Title
	public function setMeetingRequesterCompany($company){
		$this->_meetingRequesterCompany = $company;
		return $this;
	}
	
	## Gets Meeeting Requester Title
	public function getMeetingRequesterCompany(){
		return $this->_meetingRequesterCompany;
	}
	
	## Sets Meeting Requester Organizer Name
	public function setMeetingRequesterOrganizerName($name){
		$this->_meetingRequesterOrganizerName = $name;
		return $this;
	}
	
	## Gets Meeeting Requester Organizer Name
	public function getMeetingRequesterOrganizerName(){
		return $this->_meetingRequesterOrganizerName;
	}
	
	## Sets Meeting Requester Organizer
	public function setMeetingRequesterOrganizer($email){
		$this->_meetingRequesterOrganizer = $email;
		return $this;
	}
	
	## Gets Meeeting Requester Organizer
	public function getMeetingRequesterOrganizer(){
		return $this->_meetingRequesterOrganizer;
	}
	
	## Adds Meeting Requester Attendees
	public function addMeetingRequesterAttendee($email){
		$this->_meetingRequesterAttendees[] = $email;
		return $this;
	}
	
	## Gets Meeting Requester Attendees
	public function getMeetingRequesterAttendees(){
		return $this->_meetingRequesterAttendees;
	}

	############
	# Generating imPack Content
	############
	
	## Creates the imPack Mailer
	public function create() {
		if($this->_beginPage == null)
			die("Error: Begin Page not found.");
		if($this->_meetingPage == null)
			die("Error: Meeting Page not found.");
		if($this->_thankYouPage == null)
			die("Error: Thank You Page not found.");
		include("tpl/tpl.index.php");
		return $this;
	}
	
	## Generates all Pages
	public function generatePages() {
		foreach($this->_pages as $pageIndex => $imPackPage)
			$imPackPage->generatePage();
		return $this;
	}
	
	## Generates Resource Parts
	public function generateResources() {
		foreach($this->_resources as $resourceKey => $imPackPartResource)
			$imPackPartResource->generatePart();
		return $this;
	}
	
	## Generates Block Parts
	public function generateBlocks() {
		foreach($this->_blocks as $blockKey => $imPackPartBlock)
			$imPackPartBlock->generatePart();
		return $this;
	}

	############
	# User Actions
	############
	
	## User Action: Get Data
	public function getData($pin) {
		$request = $this->_campaign->getData($pin);
		
		if(!$request || empty($request))
			return false;
		
		$_SESSION['pin'] = $pin;
		$_SESSION['user'] = $request;
		
		return true;
	}
	
	## User Action: Signup
	public function signupUser($userInfo) {
		$errors = array();
		foreach($userInfo as $key => $infoPiece) {
			if(!validateInput($infoPiece,"empty"))
				$errors[$key][] = 201;
			if(!validateInput($infoPiece,"too-long"))
				$errors[$key][] = 202;
			if($key == "phone" && !validateInput($infoPiece,"phone"))
				$errors[$key][] = 203;
			if($key == "email" && !validateInput($infoPiece,"email"))
				$errors[$key][] = 204;
		}
		
		if(!empty($errors))
			return array(101,$errors);
			
		$pin = $this->_campaign->getNewPin();
		if(!$pin)
			return array(201,null);
		
		$request = $this->_campaign->addNewUser($pin, $userInfo);
		
		if(!$request)
			return array(202,null);
		
		if(!$this->getData($pin)) {
			session_destroy();
			return array(202,null);
		}
		
		return array(1,null);
	}
	
	## User Action: Check PIN
	public function checkPin($pin) {
		if(!validateInput($pin,"empty"))
			return 101;
	
		if(!validateInput($pin,"too-long"))
			return 102;
			
		if(!$this->_campaign->checkPin($pin)) {
			session_destroy();
			return 201;
		}
		
		if(!$this->getData($pin)) {
			session_destroy();
			return 201;
		}
			
		$currResponseStatus = 0;
		if(isset($_SESSION['user']['ResponseStatus']))
			$currResponseStatus = $_SESSION['user']['ResponseStatus'];
			
		if(!$this->_campaign->updateStatus($pin, 1, $currResponseStatus)) {
			session_destroy();
			return 201;
		}
		
		if($this->getGiftCodeEnabled()) {
			$request = $this->_campaign->getGiftCode($pin);
			
			if(!$request || empty($request))
				return 203;
			
			$_SESSION['giftCode'] = $request;
		}
		
		return 1;
	}
	
	## User Action: Get PIN by Name
	public function getPinByName($name) {
		if(!validateInput($name,"empty"))
			return false;
	
		if(!validateInput($name,"too-long"))
			return false;
			
			
		$pin = $this->_campaign->getPinByName($name);
		if(!$pin) {
			session_destroy();
			return false;
		}
		
		if(!$this->getData($pin)) {
			session_destroy();
			return false;
		}
			
		$currResponseStatus = 0;
		if(isset($_SESSION['user']['ResponseStatus']))
			$currResponseStatus = $_SESSION['user']['ResponseStatus'];
			
		if(!$this->_campaign->updateStatus($pin, 1, $currResponseStatus)) {
			session_destroy();
			return false;
		}
		
		if($this->getGiftCodeEnabled()) {
			$request = $this->_campaign->getGiftCode($pin);
			
			if(!$request || empty($request))
				return true;
			
			$_SESSION['giftCode'] = $request;
		}
		
		return true;
	}
	
	## User Action: Answer to a question
	public function answerQuestion($questionKey, $answer) {		
		if(!isset($_SESSION['pin']))
			return array(101,false);
	
		if(!isset($this->_questions[$questionKey]))
			return array(102,false);
	
		if(!validateInput($answer,"empty") || $answer == QUESTION_UNANSWERED)
			return array(103,false);
	
		if(!validateInput($answer,"too-long"))
			return array(104,false);
		
		$question[$questionKey] = array(
			'question' => $this->_questions[$questionKey]->getQuestionText(),
			'answer' => $answer
		);
		
		$skip = in_array($answer, $this->_questions[$questionKey]->getSkipAnswers());
		
		$currResponseStatus = 0;
		if(isset($_SESSION['user']['ResponseStatus']))
			$currResponseStatus = $_SESSION['user']['ResponseStatus'];
		
		//Status 2: Profiled
		$request = $this->_campaign->saveQuestions($_SESSION['pin'], $question, $currResponseStatus);
		
		if(!$request)
			return array(201,false);
		
		if(!$this->getData($_SESSION['pin']))
			return array(202,false);
			
		return array(1,$skip);
	}
	
	## User Action: Response to the Meeting Request
	public function respondMeeting($response, $meetingData) {
		if(!validateInput($response,"empty") || $response == QUESTION_UNANSWERED)
			return array(101, false, false);
			
		$date = "";
		$dateAlternate = "";
		$email = "";
		$phone = "";
		$discuss = "";
		
		$engagementRequested = false;
		
		if($response != MEETING_DECLINE) {
			$engagementRequested = true;
		
			if(!empty($meetingData['date']) && isset($meetingData['time']) && isset($meetingData['timezone']))
				$date = $meetingData['date'] . ' ' . $meetingData['time'] . ' ' . $meetingData['timezone'];
			else
				return array(102, false, false);
				
			if(!empty($meetingData['date-alternate']) && isset($meetingData['time-alternate']) && isset($meetingData['timezone-alternate']))
				$dateAlternate = $meetingData['date-alternate'] . ' ' . $meetingData['time-alternate'] . ' ' . $meetingData['timezone-alternate'];
				
			if(!validateInput($meetingData['date'],"date"))
				return array(103, false, false);
				
			if(!empty($dateAlternate) && !validateInput($meetingData['date-alternate'],"date"))
				return array(103, false, false);
				
			if(!validateInput($meetingData['email'],"empty"))
				return array(104, false, false);
				
			$email = $meetingData['email'];
			if(!validateInput($meetingData['email'],"too-long") || !validateInput($meetingData['email'],"email"))
				return array(105, false, false);
				
			if(!validateInput($meetingData['phone'],"empty"))
				return array(106, false, false);
				
			if(!validateInput($meetingData['phone'],"too-long") || !validateInput($meetingData['phone'],"phone"))
				return array(107, false, false);
				
			$phone = $meetingData['phone'];
				
			$discuss = "";
			if(isset($meetingData['discuss']) && !validateInput($meetingData['discuss'],"too-long"))
				return array(108, false, false);
				
			if(isset($meetingData['discuss']))
				$discuss = $meetingData['discuss'];
		}
		
		$meeting = array(
			'responseLabel' => MEETING_RESPONSE_QUESTION,
			'responseValue' => $response,
			'dateLabel' => MEETING_LABEL_DATE,
			'dateValue' => $date,
			'alternateDateLabel' => MEETING_LABEL_DATE_ALTERNATE,
			'alternateDateValue' => $dateAlternate,
			'emailLabel' => MEETING_LABEL_EMAIL,
			'emailValue' => $email,
			'phoneLabel' => MEETING_LABEL_PHONE,
			'phoneValue' => $phone,
			'discussLabel' => MEETING_LABEL_DISCUSS,
			'discussValue' => $discuss,
			'status' => 2
		);
		
		# If the response requests a meeting, make status 4
		if($response != MEETING_DECLINE)
			$meeting['status'] = 4;
		
		$currResponseStatus = 0;
		if(isset($_SESSION['user']['ResponseStatus']))
			$currResponseStatus = $_SESSION['user']['ResponseStatus'];
		
		$request = $this->_campaign->respondMeeting($_SESSION['pin'], $meeting, $currResponseStatus);
		
		if(!$request)
			return array(201, false, false);
		
		if(!$this->getData($_SESSION['pin']))
			return array(202, false, false);
		
		# If the Meeting Requester is turned on and a meeting was requested, generate the meeting
		if($this->getMeetingRequesterEnabled() && $engagementRequested) {
			$user = array(
				'Email' => $email,
				'Phone' => $phone
			);
			$user = array_merge($_SESSION['user'], $user);
			$scheduleMeeting = $this->scheduleMeeting($user, $meeting);
			
			$scheduleSuccess = true;
			if(!isset($scheduleMeeting->code) || $scheduleMeeting->code != 201)
				$scheduleSuccess = false;
		
			$createMeeting['label'] = MEETING_CREATED;
			$createMeeting['value'] = MEETING_CREATED;
			if(!$scheduleSuccess) {
				$createMeeting['value'] = ERROR_INPUT_LABEL;
				if(isset($scheduleMeeting->message))
					$createMeeting['value'] .= $scheduleMeeting->message;
				else
					$createMeeting['value'] .= ERROR_CANNOT_SAVE;
			}
			
			$currResponseStatus = 0;
			if(isset($_SESSION['user']['ResponseStatus']))
				$currResponseStatus = $_SESSION['user']['ResponseStatus'];
			$this->_campaign->createMeeting($_SESSION['pin'], $createMeeting, $currResponseStatus);
		
			if(!$scheduleSuccess)
				return array(1, true, true);
		}
			
		return array(1, $engagementRequested, false);
	}       
    
	# Schedule a meeting with Meeting Requester
	public function scheduleMeeting($user, $meeting) {
		$nl = "\n";

		# Add attendees
		$attendees = array();
		$attendees[] = $user['Email'];
		foreach($this->getMeetingRequesterAttendees() as $attendee) {
			$attendees[] = $attendee;
		}
		
		# Create location Text
		$response = explode(':', $meeting['responseValue']);
		$location = $response[0];
	
		# Create Summary Text
		$summary = $location . ' ' . MEETING_WITH . ' ' . $this->getMeetingRequesterCompany();
		if(isset($user['ContactName']) && !empty($user['ContactName'])) {
			$summary .= ' ' . MEETING_AND . ' ' . $user['ContactName'];
			if(isset($user['Company']) && !empty($user['Company'])) {
				$summary .= ' (' . $user['Company'] . ')';
			}
		}
		
		# Create Description Text
		$description = sprintf(MEETING_CONFIRMATION, $this->getMeetingRequesterCompany()) . $nl . $nl;
		$description .= MEETING_CONTACT_INFO . $nl . $nl;
		if(isset($user['ContactName']) && !empty($user['ContactName']))
			$description .= $user['ContactName'] . $nl; 
		if(isset($user['Email']) && !empty($user['Email']))
			$description .= $user['Email'] . $nl;
		if(isset($user['Phone']) && !empty($user['Phone']))
			$description .= $user['Phone'] . $nl;
		if(isset($user['Address']) && isset($user['City']) && isset($user['State']) && isset($user['Zip']))
			$description .= $user['Address'] . $nl . $user['City'] . ", " . $user['State'] . ' ' . $user['Zip']  . $nl;
		$description .= $nl;
		$description .= MEETING_CONTACT_INFO_ACCURATE . $nl . $nl;
		$description .= MEETING_RESULTS . $nl . $nl;
		for($i = 100; $i < 199; $i++) {
			if(isset($user[0][$i]))  {
				$description .= "Q: " . $user[0][$i][1] . $nl;
                $description .= "A: " . substr($user[0][$i][2], 0, -6) . $nl;
            }
		}
		if(!empty($meeting['discussValue']))
			$description .= $meeting['discussLabel'] . ' ' . $meeting['discussValue'] . $nl;
		$description .=  $nl;
		if(isset($meeting['alternateDateValue']) && !empty($meeting['alternateDateValue'])) {
            $description .= MEETING_ALTERNATE_DATE . ' ' . $meeting['alternateDateValue'] . $nl . $nl;
        }
		$description .= MEETING_FOOTER . $nl . $nl;
		$description .= MEETING_THANKS . $nl;
		$description .= $this->getMeetingRequesterOrganizerName() . $nl;
		$description .= $this->getMeetingRequesterOrganizer();
		
		$meetingRequest['summary'] = $summary;
		$meetingRequest['location'] = $location;
		$meetingRequest['description'] = $description;
		$meetingRequest['dateTime'] = $meeting['dateValue'];
		$meetingRequest['organizer'] = $meeting['organizer'];
		$meetingRequest['attendees'] = $attendees;
		$meetingRequest['length'] = "+1 hour";
		
		return $this->_meetingRequester->request($meetingRequest);
	}
	
	## User Action: Resource Click
	public function clickResource($resourceID) {	
		if(!isset($_SESSION['pin']))
			exit;
		
		$currResource = $this->getResource($resourceID);
		if(!$currResource)
			exit;
		
		## Status 1: Interest Click
		$clickInfo['id'] = $currResource->getIndex();
		$clickInfo['label'] = $currResource->getTitle();
		$clickInfo['title'] = RESOURCE_CLICKED;
		$clickInfo['status'] = 1;
		
		$currResponseStatus = 0;
		if(isset($_SESSION['user']['ResponseStatus']))
			$currResponseStatus = $_SESSION['user']['ResponseStatus'];
		
		$request = $this->_campaign->clickResource($_SESSION['pin'], $clickInfo, $currResponseStatus);
			
		header("Location: " . $currResource->getLink());
		
		exit;
	}
	
}

?>