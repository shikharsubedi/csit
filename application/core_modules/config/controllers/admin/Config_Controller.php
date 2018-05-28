<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_Controller extends Admin_Controller {

    public function __construct() {
        $this->mainmenu = MAINMENU_SETTING;
        parent::__construct();
        if (!user_access('siteconfig'))
            admin_redirect();
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->input->post('btn_submit_siteconfig')) {
            $this->form_validation->set_rules('admin_name', 'Admin Name', 'required');
            $this->form_validation->set_rules('admin_email', 'Admin Email', 'required|email');
            if ($this->form_validation->run()) {
                $data = array('admin_name' => $this->input->post('admin_name'),
                    'admin_email' => $this->input->post('admin_email'),
                    'slogan' => $this->input->post('slogan'));

                //show_pre($_FILES);			
                if ($_FILES['logo']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/config/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '400';
                    $config['max_width'] = '920';
                    $config['max_height'] = '370';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('logo')) {
                        $upError = $this->templatedata['upload_error'] = $this->upload->display_errors();
                    } else {
                        //resize the image
                        $up_data = $this->upload->data();

                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $up_data['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 160;
                        $config['height'] = 100;

                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        //$data['brand_image'] = $up_data['file_name'];
                        //$data['brand_thumbnail'] = $up_data['raw_name'].'_thumb'.$up_data['file_ext'];
                        Options::update('brand_image', $up_data['file_name']);
                        Options::update('brand_thumbnail', $up_data['raw_name'] . '_thumb' . $up_data['file_ext']);
                    }
                }

                Options::update('siteconfig', $data);
                Options::update('toll_free_no', $this->input->post('toll_free_no'));
                Options::update('footer_slogan', $this->input->post('footer_slogan'));
                //Options::update('nepali_website',$this->input->post('nepali_website'));
                Options::update('feedback_email', $this->input->post('feedback_email'));


                $contact = $this->input->post('contact_details');
                Options::update('contact_details', $contact);
                if (isset($upError) && $upError != NULL) {
                    $this->session->set_success_flashdata('feedback', "$upError");
                } else {
                    $this->session->set_success_flashdata('feedback', 'Settings saved successfully.');
                }
                admin_redirect('config');
            }
        }

        if ($this->input->post('btn_submit_main')) {
            $value = ($this->input->post('maintenance') === FALSE) ? 'NO' : 'YES';
            Options::update('site_maintenance', $value);

            $this->session->set_success_flashdata('feedback', 'Settings saved successfully.');
            admin_redirect('config');
        } //maintainance


        if ($this->input->post('btn_submit_content')) {
                       
            Options::update('googleplus_id', $this->input->post('googleplus_id'));
            Options::update('facebook_id', $this->input->post('facebook_id'));
            Options::update('twitter_id', $this->input->post('twitter_id'));
            Options::update('linkedIn_id', $this->input->post('linkedIn_id'));            
            //for adding http:// to the url if not exist already
            $this->load->helper('url');
             
            $this->session->set_success_flashdata('feedback', 'Settings saved successfully.');
            admin_redirect('config');   
        } //contents
		
		if($this->input->post('btn_submit_meta')){
			
			$mtitle   = $this->input->post('meta_title');
			$mdesc    = $this->input->post('meta_description');
			$mkeyword = $this->input->post('meta_keyword');
			
			Options::update('meta_title' ,$mtitle);
			Options::update('meta_description',$mdesc);
			Options::update('meta_keyword', $mkeyword);
			
			$this->session->set_success_flashdata('feedback', 'Settings saved successfully.');
			admin_redirect('config');
		
		}//meta


       	if ($this->input->post('btn_submit_homepage')) {            
            Options::update('homepage_message', $this->input->post('homepage_message'));
            Options::update('mid-first', $this->input->post('mid-first')); 
            Options::update('mid-second', $this->input->post('mid-second'));
            Options::update('mid-third', $this->input->post('mid-third'));
            Options::update('home-category', $this->input->post('home-category'));
            Options::update('home-category-first', $this->input->post('home-category-first'));
            Options::update('footer-content', $this->input->post('footer-content'));
            $this->session->set_success_flashdata('feedback', 'Settings saved successfully.');
            admin_redirect('config');
        } //maintainance

        array_push($this->templatedata['scripts'], 'ckeditor/ckeditor');
        array_push($this->templatedata['scripts'], 'ckfinder/ckfinder');
        $this->templatedata['maincontent'] = 'config/admin/config';

        $this->breadcrumb->append_crumb('Site Config', 'config');
        $this->load->view('admin/master', $this->templatedata);
    }

//index
}

//class