<?php

use college\models\College;
use college\models\University;
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class College_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('college list'))
            admin_redirect();
        $this->load->library('ThumbLib');

        $this->breadcrumb->append_crumb('University', admin_url('college')); 
    }

     public function index() {
        $repo = $this->doctrine->em->getRepository('college\models\University');
        $university = $repo->findAll();
        $this->templatedata['university'] = $university;
        $this->templatedata['maincontent'] = 'college/admin/list';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            if($this->form_validation->run($this)){
                $university = new University();
                $university->setName(strip_tags(trim($this->input->post('name'))));
                if($this->input->post('status') == '1'){
                    $university->setStatus(1);
                }else{
                    $university->setStatus(0);
                }

                $this->doctrine->em->persist($university);
                $this->doctrine->em->flush();
                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'University added successfully.');
                admin_redirect('college');
            }
            
        }

        
        $this->breadcrumb->append_crumb('Add University', admin_url('college/add'));
        $this->templatedata['maincontent'] = 'college/admin/add';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function edit($id){
        $university = $this->doctrine->em->find('college\models\University', $id);
        if($this->input->post()){
            $this->form_validation->set_rules('name', 'Name', 'required');
            if($this->form_validation->run($this)){
                $university->setName(strip_tags(trim($this->input->post('name'))));
                if($this->input->post('status') == '1'){
                    $university->setStatus(1);
                }else{
                    $university->setStatus(0);
                }

                $this->doctrine->em->persist($university);
                $this->doctrine->em->flush();
                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'University updated successfully.');
                admin_redirect('college');
            }
        }

        $this->templatedata['university'] = $university;
        $this->breadcrumb->append_crumb('Edit University', admin_url('college/edti'));
        $this->templatedata['maincontent'] = 'college/admin/edit';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function delete($id){
        $university = $this->doctrine->em->find('college\models\University', $id);
        $college = $this->doctrine->em->getRepository('college\models\College')->findby(array('university' => $id));
        if($college){
            foreach($college as $c){
                $coll = $this->doctrine->em->find('college\models\College', $c->id());
                $this->doctrine->em->remove($faq);
                $this->doctrine->em->flush();
            }
        }
        $this->doctrine->em->remove($university);
        $this->doctrine->em->flush();
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'University deleted successfully.');
        admin_redirect('college');
    }
    
   public function listcollege($id, $offset = 0)
    {
        $collegeRepo = &$this->doctrine->em->getRepository('college\models\College');
        $per_page = 10;
        $college = $collegeRepo->getListCollege(NULL,$per_page,$offset,$id);
        
       
        if($this->input->post('update')){
            

            $checked = $this->input->post('check');
            $action = $this->input->post('action');
                
            switch($action){
                case "publish":
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        $college->activate();
                        $this->doctrine->em->persist($college);
                    }
                break;
                
                case "unpublish":
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        $college->deactivate();
                        $this->doctrine->em->persist($college);
                    }
                    
                break;
                
                default:
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        if ($college) $this->doctrine->em->remove($college);
                    }
            }
                
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('college');
        }           
            
        $numContent = $college['total'];
            
        if($numContent > $per_page)
        {
            $this->load->library('pagination');
            
            $config['base_url'] = admin_base_url()."college/listcollege";
            $config['total_rows'] = $numContent;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 5;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';
            
            $this->pagination->initialize($config);
            $pg = $this->pagination->create_links();
            $this->templatedata['pagination'] = $pg;
        }
            
        $this->breadcrumb->append_crumb('College', admin_url(''));
        $this->templatedata['college'] = $college['college'];
        
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'college/admin/listcollege';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function listAllCollege($offset = 0){
        $collegeRepo = &$this->doctrine->em->getRepository('college\models\College');
        $per_page = 10;
        $college = $collegeRepo->getListCollege(NULL,$per_page,$offset);
        
       
        if($this->input->post('update')){
            

            $checked = $this->input->post('check');
            $action = $this->input->post('action');
                
            switch($action){
                case "publish":
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        $college->activate();
                        $this->doctrine->em->persist($college);
                    }
                break;
                
                case "unpublish":
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        $college->deactivate();
                        $this->doctrine->em->persist($college);
                    }
                    
                break;
                
                default:
                    foreach($checked as $k => $v)
                    {
                        $college = &$this->doctrine->em->find('college\models\College',$v);
                        if ($college) $this->doctrine->em->remove($college);
                    }
            }
                
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('college');
        }           
            
        $numContent = $college['total'];
            
        if($numContent > $per_page)
        {
            $this->load->library('pagination');
            
            $config['base_url'] = admin_base_url()."college/listcollege";
            $config['total_rows'] = $numContent;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 4;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';
            
            $this->pagination->initialize($config);
            $pg = $this->pagination->create_links();
            $this->templatedata['pagination'] = $pg;
        }
            
        $this->breadcrumb->append_crumb('College', admin_url(''));
        $this->templatedata['college'] = $college['college'];
        
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'college/admin/listcollege';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function addcollege(){
        if($this->input->post()){
            // show_pre($_POST); exit;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('address', 'Address', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required');
            // $this->form_validation->set_rules('contact', 'Contact', 'required');
            if($this->form_validation->run($this)){
                $college = new College();
                $university = $this->doctrine->em->find('college\models\University', $this->input->post('university'));
                $college->setName($this->input->post('name'));
                $college->setAddress($this->input->post('address'));
                $college->setEmail($this->input->post('email'));
                $college->setContact($this->input->post('contact'));
                $college->setDescription($this->input->post('description'));
                $college->setUrl($this->input->post('url'));
                $college->setUniversity($university);
                 $err = '';
                if (isset($_FILES['image']) and $_FILES['image']['name'] != '') {
                    //$this->form_validation->set_rules('url', 'Image Url', 'required');
                    $config['upload_path'] = './assets/upload/college/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 0;
                    //$config['max_width']      = 900;
                    //$config['max_height']         = 900;  


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $err = $this->upload->display_errors();
                    } else {

                        $up_data = $this->upload->data();
                        $college->setImage($up_data['file_name']);
                    }
                }

                $this->doctrine->em->persist($college);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'College added successfully.');
                admin_redirect('college');

            }
            
        }
        $content = $this->input->post('description');
        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');


        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("description", $content, $ck_config);
        $this->templatedata['university'] = University::getUniversity();
        $this->breadcrumb->append_crumb('Add College', admin_url('college/addcollege'));
        $this->templatedata['maincontent'] = 'college/admin/addcollege';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function editcollege($id){
        $college = $this->doctrine->em->find('college\models\College', $id);
        if($this->input->post()){
            // show_pre($_FILES); exit;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('address', 'Address', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required');
            // $this->form_validation->set_rules('contact', 'Contact', 'required');
            if($this->form_validation->run($this)){
              
                $university = $this->doctrine->em->find('college\models\University', $this->input->post('university'));
                $college->setName($this->input->post('name'));
                $college->setAddress($this->input->post('address'));
                $college->setEmail($this->input->post('email'));
                $college->setContact($this->input->post('contact'));
                $college->setUniversity($university);
                $college->setUrl($this->input->post('url'));
                 $college->setDescription($this->input->post('description'));
                 $err = '';
                if (isset($_FILES['image']) and $_FILES['image']['name'] != '') {
                    //$this->form_validation->set_rules('url', 'Image Url', 'required');
                    $config['upload_path'] = './assets/upload/college/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 0;
                    //$config['max_width']      = 900;
                    //$config['max_height']         = 900;  


                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('image')) {
                        $err = $this->upload->display_errors();
                    } else {
                        if ($college->getImage() != '')
                            @unlink('./assets/upload/college/' . $college->getImage());
                        $up_data = $this->upload->data();
                        $college->setImage($up_data['file_name']);
                    }
                }

                $this->doctrine->em->persist($college);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'College added successfully.');
                admin_redirect('college');

            }
        }
        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');


        //setup ckeditor parameters
        $ck_config = array('height' => 300,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("description", $college->getDescription(), $ck_config);
        $this->templatedata['university'] = University::getUniversity();
        $this->templatedata['college'] = $college;
        $this->breadcrumb->append_crumb('Edit College', admin_url('college/editcollege'));
        $this->templatedata['maincontent'] = 'college/admin/editcollege';
        $this->load->view('admin/master',$this->templatedata);
    }

    public function deletecollege($id){
        $college = $this->doctrine->em->find('college\models\College', $id);
        if($college){
            $this->doctrine->em->remove($college);
            $this->doctrine->em->flush();
            $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'College deleted successfully.');
            admin_redirect('college');
        }
    }

}
