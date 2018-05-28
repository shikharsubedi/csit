<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class F1tube
{
	private $_ci;
	private $_client_id;
	private $_client_secret;
	
	private $auth_url = 'https://accounts.google.com/o/oauth2/auth';
	private $token_url = 'https://accounts.google.com/o/oauth2/token';
	
	private $feed_url = 'https://gdata.youtube.com/feeds/api/';
	
	private $auth_token;
	
	public function __construct($params)
	{
		$this->_ci = & get_instance();
		$this->_ci->load->library('curl');	
		log_message('debug', 'F1tube Class Initialized');
		
		$this->_client_id = $params['CLIENT_ID'];
		$this->_client_secret = $params['CLIENT_SECRET'];
		
		if(Options::get('youtube_auth_token')){
			$this->_refreshToken();
		}
		
		/*if(!Options::get('youtube_auth_code'))
			$this->_getAuthCode();
		
		if(!Options::get('youtube_auth_token'))
			$this->_getToken();*/
		
		
	}
	
	public function getUploads()
	{
		$uploads = $this->doFeedRequest('users/default/uploads');
		
		$videos = array();
		foreach($uploads->entry as $e)
		{
			$parts = explode('/',$e->id);
			$id = $parts[count($parts)-1];
			
			$videos[] = array(	'title'		=>	$e->title,
								'content'	=>	$e->content,
								'id'		=>	$id,
								'thumbnail'	=>	'http://img.youtube.com/vi/'.$id.'/1.jpg'
							);
		}
		
		return $videos;
	}
	
	private function doFeedRequest($method)
	{
		$this->auth_token = Options::get('youtube_auth_token');
		$this->_ci->curl->ssl(FALSE);
		$response = $this->_ci->curl->simple_get($this->feed_url.$method,array(	'access_token'	=>	Options::get('youtube_auth_token')));
		//$response = $this->_ci->curl->simple_get($this->feed_url.$method,array(	'key'	=>	$this->auth_token));
		//show_pre($response);
		$res = simplexml_load_string($response);
		$json = json_encode($res);
		return json_decode($json);
	}
	
	public function _getAuthCode()
	{
		$params = array(	'client_id'		=>	$this->_client_id,
							'redirect_uri'	=>	base_url().'oauth/callback',
							'response_type'	=>	'code',
							'scope'			=>	'https://gdata.youtube.com',
							'access_type'	=>	'offline'
						);
					
		$uri_string = encode_array($params);
		redirect($this->auth_url."?".$uri_string);
	}	
	
	private function _refreshToken()
	{
		$this->_ci->curl->create($this->token_url);
		
		$post = array(	'refresh_token'	=>	Options::get('youtube_refresh_token'),
						'client_id'		=>	$this->_client_id,
						'client_secret'	=>	$this->_client_secret,
						'grant_type'	=>	'refresh_token');
						
		$this->_ci->curl->post($post);
		$this->_ci->curl->ssl(FALSE);
		$this->_ci->curl->http_header("Content-type: application/x-www-form-urlencoded");
	
		$response = json_decode($this->_ci->curl->execute());
		//echo $this->_ci->curl->debug();
		if(!isset($response->error))
		{
			$access_token = $response->access_token;
			$token_type = $response->token_type;
			
			Options::update('youtube_auth_token',$access_token);
			Options::update('youtube_token_time',time());
		}
		else echo $this->_ci->curl->debug();
	}
	
	public function _getToken()
	{
		$this->_ci->curl->create($this->token_url);
		
		$post = array(	'code'			=>	Options::get('youtube_auth_code'),
						'client_id'		=>	$this->_client_id,
						'client_secret'	=>	$this->_client_secret,
						'redirect_uri'	=>	base_url().'oauth/callback',
						'grant_type'	=>	'authorization_code');
						
		$this->_ci->curl->post($post);
		$this->_ci->curl->ssl(FALSE);
		$this->_ci->curl->http_header("Content-type: application/x-www-form-urlencoded");
	
		$response = json_decode($this->_ci->curl->execute());
		if(!isset($response->error))
		{
			$access_token = $response->access_token;
			$token_type = $response->token_type;
			
			Options::update('youtube_auth_token',$access_token);
			Options::update('youtube_token_time',time());
			Options::update('youtube_refresh_token',$response->refresh_token);
		}
		else echo $this->_ci->curl->debug();
	}	
}
?>