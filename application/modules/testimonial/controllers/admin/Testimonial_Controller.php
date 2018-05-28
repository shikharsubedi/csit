<?php

use testimonial\models\Testimonial,
    Doctrine\Common\Util\Debug;

class Testimonial_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('testimonial list'))
            admin_redirect();
        $this->load->library('ThumbLib');
        $this->load->library('form_validation');
        $this->breadcrumb->append_crumb('Testimonials', admin_url('testimonial'));
    }

    public function index() {
        $repo = $this->doctrine->em->getRepository('testimonial\models\Testimonial');
        $testimonial = $repo->findAll();
        if ($this->input->post('act-content')) {

            $checked = $this->input->post('check');

            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    //activate selected images
                    foreach ($checked as $k => $v) {
                        $testimonial = $this->doctrine->em->find('testimonial\models\Testimonial', $v);
                        $testimonial->setStatus('1');
                        $this->doctrine->em->persist($testimonial);
                    }
                    break;

                case "unpublish":
                    //deactivate selected images
                    foreach ($checked as $k => $v) {
                        $testimonial = $this->doctrine->em->find('testimonial\models\Testimonial', $v);

                        $testimonial->setStatus('0');
                        $this->doctrine->em->persist($testimonial);
                    }
                    break;

                default:
                    //delete
                    foreach ($checked as $k => $v) {
                        $testimonial = $this->doctrine->em->find('testimonial\models\Testimonial', $v);

                        $this->doctrine->em->remove($testimonial);
                    }
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected images.');
            admin_redirect('testimonial');
        }
        $this->templatedata['testimonial'] = $testimonial;
        $this->templatedata['maincontent'] = 'testimonial/admin/list';

        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        $this->breadcrumb->append_crumb('Add Testimonial', admin_url('testimonial/add'));
        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            if ($this->form_validation->run()) {
                $testimonial = new Testimonial;
                $testimonial->setName($this->input->post('name'));
                $testimonial->setBody($this->input->post('message'));
                ($this->input->post('isActive') == 'active') ? $testimonial->setStatus('1') : $testimonial->setStatus('0');
                $testimonial->setShowfront($this->input->post('showFront'));

                $image = '';

                if (isset($_FILES['image']) and $_FILES['image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/testimonial/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('image')) {
                        $_upload_error = $this->upload->display_errors();
                    } else {
                        //resize the image
                        $up_data = $this->upload->data();
                        $thumb = ThumbLib::create($up_data['full_path']);
                        $thumb->adaptiveResize(176, 141);
                        $thumb->save('./assets/upload/images/testimonial/thumbs/' . $up_data['file_name']);

                        $image = $up_data['file_name'];
                    }
                }

                $testimonial->setImage($image);
                $this->doctrine->em->persist($testimonial);
                $this->doctrine->em->flush();

                if ($testimonial->GetId()) {
                    $this->session->set_success_flashdata('feedback', 'Testimonials added successfully.');
                    admin_redirect('testimonial');
                }
            }
        }
        $this->templatedata['maincontent'] = 'testimonial/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $this->breadcrumb->append_crumb('Edit Testimonial', admin_url('testimonial/edit/' . $id));
        $testimonial = $this->doctrine->em->find('testimonial\models\Testimonial', $id);
        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $message = $this->input->post('message');
                if (isset($_FILES['image']) and $_FILES['image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/testimonial/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        @unlink('assets/upload/images/testimonial/' . $testimonial->getImage());
                        @unlink('assets/upload/images/testimonial/thumbs/' . $testimonial->getImage());
                        $upinfo = $this->upload->data();
                        $thumb = ThumbLib::create($upinfo['full_path']);
                        $thumb->adaptiveResize(176, 141);
                        $thumb->save('./assets/upload/images/testimonial/thumbs/' . $upinfo['file_name']);
                        $image = $upinfo['file_name'];
                        $testimonial->setImage($image);
                    }
                }

                $testimonial->setName($name);
                $testimonial->setBody($message);
                ($this->input->post('isActive') == '1') ? $testimonial->setStatus('1') : $testimonial->setStatus('0');
                $testimonial->setShowfront($this->input->post('showFront'));
                $this->doctrine->em->persist($testimonial);
                $this->doctrine->em->flush();

                if ($testimonial->getId()) {
                    $this->session->set_success_flashdata('feedback', 'Testimonials added successfully.');
                    admin_redirect('testimonial');
                }
            }
        }
        $this->templatedata['testimonial'] = $testimonial;
        $this->templatedata['maincontent'] = 'testimonial/admin/edit';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $testimonial = $this->doctrine->em->find('testimonial\models\Testimonial', $id);
        @unlink('assets/upload/images/testimonial/' . $testimonial->getImage());
        @unlink('assets/upload/images/testimonial/thumbs/' . $testimonial->getImage());
        $this->doctrine->em->remove($testimonial);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'The testimonial was deleted successfully.');

        admin_redirect('testimonial');
    }

    public function updateFront() {
        if ($this->input->post()) {
            //unset all previous showfront to zero
            $unset = $this->doctrine->em->getRepository('testimonial\models\testimonial')->findAll();
            foreach ($unset as $v) {
                $v->setShowFront(0);
                $this->doctrine->em->persist($v);
                $this->doctrine->em->flush();
            }
            //update new showFront
            $id = $this->input->post('id');
            $status = "1";
            $t = $this->doctrine->em->find('testimonial\models\testimonial', $id);
            $t->setShowFront($status);
            $this->doctrine->em->persist($t);
            $this->doctrine->em->flush();
        }
    }

}
