<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use faculty\models\Faculty;
use faculty\models\Applytofaculty;

class Faculty_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('faculty list'))
            admin_redirect();
        $this->load->library('ThumbLib');
        $this->breadcrumb->append_crumb('Faculty', admin_url('faculty'));
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('faculty\models\Faculty');
        $faculty = $repo->findAll();
        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    foreach ($checked as $k => $v) {
                        $facultyUpdate = $this->doctrine->em->find('faculty\models\Faculty', $v);
                        $facultyUpdate->setStatus(1);
                        $this->doctrine->em->persist($facultyUpdate);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $facultyUpdate = $this->doctrine->em->find('faculty\models\Faculty', $v);
                        $facultyUpdate->setStatus(0);
                        $this->doctrine->em->persist($facultyUpdate);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $facultyUpdate = $this->doctrine->em->find('faculty\models\Faculty', $v);
                        if ($facultyUpdate)
                            $this->doctrine->em->remove($facultyUpdate);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('faculty');
        }
        $this->templatedata['faculty'] = $faculty;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faculty/admin/list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        $content = $this->doctrine->em->getRepository("content\models\Content")->findAll();
        $this->templatedata['content'] = $content;
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');
            
            if ($this->form_validation->run()) {
                $faculty = new Faculty();

                $faculty->setName($this->input->post('name'));
                $faculty->setEmail($this->input->post('email'));
                $faculty->setStatus($this->input->post('isActive'));
                $faculty->setDescription($this->input->post('description'));
                
                //get the object of content
                $fContent = $this->doctrine->em->find("content\models\Content", $this->input->post('content'));
                $faculty->setContent($fContent);
                $this->doctrine->em->persist($faculty);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faculty added successfully.');
                admin_redirect('faculty');
            }
        }
        $this->breadcrumb->append_crumb('Add Faculty', admin_url(''));
        array_push($this->templatedata['scripts'], 'ckeditor/ckeditor');
        array_push($this->templatedata['scripts'], 'ckfinder/ckfinder');
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faculty/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $faculty = $this->doctrine->em->find('faculty\models\Faculty', $id);
        $content = $this->doctrine->em->getRepository("content\models\Content")->findAll();
        $this->templatedata['content'] = $content;

        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run()) {
                $faculty->setName($this->input->post('name'));
                $faculty->setEmail($this->input->post('email'));
                $faculty->setStatus($this->input->post('isActive'));
                $faculty->setDescription($this->input->post('description'));
                //get the object of content
                $fContent = $this->doctrine->em->find("content\models\Content", $this->input->post('content'));
                $faculty->setContent($fContent);
                $this->doctrine->em->persist($faculty);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faculty added successfully.');
                admin_redirect('faculty');
            }
        }
        $this->templatedata['faculty'] = $faculty;
        $this->breadcrumb->append_crumb('Edit Faculty', admin_url(''));

        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'faculty/admin/edit';
        array_push($this->templatedata['scripts'], 'ckeditor/ckeditor');
        array_push($this->templatedata['scripts'], 'ckfinder/ckfinder');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $faculty = $this->doctrine->em->find('faculty\models\Faculty', $id);
		
		if(count($faculty->getAppliedStudents()) == 0){
			
			$this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Not allowed to delete this faculty as there is online application form submitted.');
        	admin_redirect('faculty');
		}else{
			
			foreach ($faculty->getAppliedStudents() as $f) {
				
				$this->doctrine->em->remove($f);
				$this->doctrine->em->flush();			
			}
			$this->doctrine->em->remove($faculty);
			$this->doctrine->em->flush();
	
	
			$this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Faculty Deleted successfully.');
			admin_redirect('faculty');
		}
    }

    public function viewFaculty($id) {
        $students = $this->doctrine->em->find('faculty\models\Faculty', $id);

        $this->templatedata['faculty'] = $students;
        $this->templatedata['maincontent'] = 'faculty/admin/viewFaculty';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function viewStudent($id) {
        $student = $this->doctrine->em->find('faculty\models\Applytofaculty', $id);
        $this->templatedata['student'] = $student;
        $this->templatedata['maincontent'] = 'faculty/admin/viewStudent';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deleteStudent($id, $fid) {
        $student = $this->doctrine->em->find('faculty\models\Applytofaculty', $id);
        $this->doctrine->em->remove($student);
        $this->doctrine->em->flush();
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Student deleted successfully');
        admin_redirect('faculty/viewFaculty/' . $fid);
    }

}
