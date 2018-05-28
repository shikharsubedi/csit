<?php
	
class Oauth_Controller extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function callback()
	{
		if($code = $this->input->get('code'))
		{
			Options::update('youtube_auth_code',$code);
			admin_redirect('videogallery/requestAuthToken');
		}
		
	}
}
?>