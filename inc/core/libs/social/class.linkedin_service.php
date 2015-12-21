<?php
require_once('interfaces/interface.Core_IAccount_Updatable.php');
require_once('interfaces/interface.Core_IHttp_Fetchable.php');
require_once('interfaces/interface.Core_IScrapable.php');
require_once('helpers/class.Core_Social_Service.php');
//TODO: Remove reliance on Curl - standartize the way the services are accessed
//TODO: Remove the extension of the Social_Accounts - it will use it but not "is a"
//TODO: Modify the code so functions retrieve data per user - and loop those functions


class Core_Linkedin_Service  extends Core_Social_Service {
	
	const ACCOUNT_TYPE = 'li_account';
	
	static $format = array('format' => 'json');
	static $url = 'https://api.linkedin.com';
	static $version = 'v1';
	static $start_date = '04/12/2013';
	public $link_prefix = 'www.linkedin.com/company/';
	
	static $connection_desc = array(
		'app_id' => '1gq2oi2rp1sj',
		'app_secret' => 'VrY0bfKH4apsc7af',
		'access_token' => 'AQXH7n5IjNKvpdgypAQc1AtLUG_pOQ5uWTzYl-ki-pUnbOJ5h754VisGpx1v1UxpwCh6gyz_hV835wh1Renth33M-QPN4VrFB80kj-rbh91PvXO0ejastJPN3dqitEUOgQ3_Uc7L-Isl5NXl19f0id7SQz3FRiBUBzzGI7Z103wivwCFsek'
	);
	
	static $game = array(
		array('id' => '1128', 'name' => 'EmcCorp', 'label' => 'EmcCorp'),
		array('id' => '3570', 'name' => 'ArrowElectronics', 'label' => 'ArrowElectronics')
	);
	
	static function get_start_date(){
		
		strtotime(self::$start_date);
		
	}

	public function get_login_url($options=array()){
		
		throw new Exception("Code not yet implemented");
	}
	
	public function get_actions($options=array()){;
		
		throw new Exception("Code not yet implemented");
	
	}
	
	public function get_follows($options=array()){

		throw new Exception("Code not yet implemented");

	}
	
	public function login_user($options=array()){
		
		throw new Exception("Code not yet implemented");
		
	}
	
	public function logoff_user($options=array()){
		
		throw new Exception("Code not yet implemented");
		
	}
	
	public function get_posts_by_account(  $options=array()  ){
	
		if( empty($options['account_id']) )
				
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
	
		if( !is_object( $this->http_handler ) )
				
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
	
		
		$url = self::$url.'/'.self::$version.'/companies/'.$options['account_id'].'/updates:(timestamp,updateContent)';
		//http://api.linkedin.com/v1/companies/2815/updates?event-type=status-update&format=json
		
		$params = array_merge(self::$format, array(
				'oauth2_access_token' => self::$connection_desc['access_token'],
				'event-type' => 'status-update',
				'format' => 'json'
		));
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		$data = array();
		if( $raw_response ){
			
			$raw_response = json_decode( $raw_response );
			if( !empty( $raw_response->values ) ){
				
				$index = 0;
				foreach( $raw_response->values as $update ){
					
					if( isset ($update->updateContent->companyStatusUpdate->share->comment) ){
						
						$data[$index] = array();
						$data[$index]['id'] = $update->updateContent->companyStatusUpdate->share->id;
						$data[$index]['message'] = $update->updateContent->companyStatusUpdate->share->comment;
						$data[$index]['created_time'] = date( 'Y-m-d H:i:s', intval($update->updateContent->companyStatusUpdate->share->timestamp/1000) );
						$index++;
						
					}
					
				}
				
				return $data;
			}
				
		}
		
		return false;
	
	}
	
	public function get_account_by_name( $options=array() ){
		
		if( empty($options['universal_name']) or empty($options['c_url']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling linkedin_serviceget_company_id_by_email_domain().');
		
		$url = self::$url.'/'.self::$version.'/companies/universal-name='.$options['universal_name'].':(id,name,company-type,ticker,website-url,email-domains,twitter-id,logo-url)';
		
		$params = array_merge(self::$format, array(
				'oauth2_access_token' => self::$connection_desc['access_token']
		));
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
				//'content' =>
			)
		);
		
		$response = json_decode( $raw_response );
		
		if( isset($response->id) ){
		
			if( isset($response->websiteUrl) and stristr( $response->websiteUrl, $options['c_url'] ) ){
					
				$company = array();
				$company['type'] = $response->companyType->code;
				$company['id'] = $response->id;
				$company['name'] = $response->name;
				$company['link'] = 'www.linkedin.com/company/'.$response->id;
				$company['logo'] = $response->logoUrl;
				$company['website'] = $response->websiteUrl;
				
				return $company;
					
			}else{
				
				return false;
				
			}
				
		}else{
				
			return false;
				
		}
		
	}
	
	public function get_account_by_email_domain( $options=array() ){
		
		if( empty($options['email_domain']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling linkedin_serviceget_company_id_by_email_domain().');
		
		$url = self::$url.'/'.self::$version.'/companies:(id,name,company-type,ticker,website-url,email-domains,twitter-id,logo-url)';
		
		$params = array_merge(self::$format, array(
				'oauth2_access_token' => self::$connection_desc['access_token'],
				'email-domain' => $options['email_domain']
		));
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
				//'content' =>
			)
		);
		
		$response = json_decode( $raw_response );
		
		if( isset($response->values) ){
			
			//TODO: Go through each and remove not matching web. We should use the strstr
			$companies = array();
			$index = 0;
			foreach($response->values as  $company){
				
				if( isset($company->websiteUrl) and stristr( $company->websiteUrl, $options['email_domain'] ) ){
					
					$companies[$index] = array();
					$companies[$index]['type'] = $company->companyType->code;
					$companies[$index]['id'] = $company->id;
					$companies[$index]['name'] = $company->name;
					$companies[$index]['twitterid'] = $company->twitterId;
					$companies[$index]['link'] = 'www.linkedin.com/company/'.$company->id;
					$companies[$index]['logo'] = $company->logoUrl;
					
					$website = str_ireplace('http://', '', $company->websiteUrl);
					$companies[$index]['website'] = str_ireplace('https://', '', $website);
					
					$index++;
					
				}
				
			}
			
			if(!empty($companies)){
				
				return $companies;
				
			}else{
				
				return false;
				
			}
			
		}else{
			
			return false;
			
		}
		
		

	}

}