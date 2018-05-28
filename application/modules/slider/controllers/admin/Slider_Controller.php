<?php

use slider\models\Slider;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //check for permissions
        if (!user_access('administer slider'))
            admin_redirect();


        //$this->load->model('slider/slider_model','slider');
        $this->load->library('form_validation');
        $this->breadcrumb->append_crumb('Slider', admin_url('slider'));
    }

    public function index() {
        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');
        if ($this->input->post('act-content')) {
            $checked = $this->input->post('check');

            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    //activate selected images
                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                            $image->activate();
                            $this->doctrine->em->persist($image);
                        }
                    }
                    break;

                case "unpublish":
                    //deactivate selected images
                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                            $image->deactivate();
                            $this->doctrine->em->persist($image);
                        }
                    }
                    break;

                default:
                    //delete
                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                            $this->doctrine->em->remove($image);
                        }
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected images.');
            admin_redirect('slider');
        }
        $this->templatedata['sliders'] = $sliderRepo->getImages();
        $this->templatedata['maincontent'] = 'slider/admin/list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        $dimention = _t('slider_dimention');
        $this->templatedata['dimention'] = $dimention;
        $this->templatedata['maincontent'] = 'slider/admin/add';

        if ($this->input->post()) {
            $this->form_validation->set_rules('img_name', 'Image Name', 'required');
            //revise
            if (($this->input->post('type')) == 'internal') {
                $this->form_validation->set_rules('target_page', 'Name', 'required');
            } else {
                $this->form_validation->set_rules('target_url', 'Name', 'required');
            }
            //revise


            if ($this->form_validation->run()) {
                //get the images
                $images = Options::get('slider_images', NULL);

                //upload the image
                $config['upload_path'] = './assets/upload/images/slider/';
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('img_file')) {
                    $_upload_error = $this->upload->display_errors();
                    $this->session->set_success_flashdata('feedback', $_upload_error);
                    admin_redirect('slider/add');
                } else {
					
                    $up_data = $this->upload->data();

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $up_data['full_path'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 60;
                    $config['height'] = 40;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $_slider = new Slider;
                    $content = $this->doctrine->
                    $_slider->setName($this->input->post('img_name'));
                    $_slider->setImage($up_data['file_name']);
                    $_slider->setThumbnail($up_data['raw_name'] . '_thumb' . $up_data['file_ext']);
                    $_slider->setType($this->input->post('type'));
                    $u = ($this->input->post('type') == 'external') ? trim($this->input->post('target_url')) : $this->input->post('target_page');
                    $_slider->setLink($u);

                    $status = $this->input->post('isActive');
                    if ($status == STATUS_ACTIVE)
                        $_slider->activate();
                    else
                        $_slider->deactivate();

                    if (!isset($_upload_error)) {
                        $this->doctrine->em->persist($_slider);
                        $this->doctrine->em->flush();
                        if ($_slider->id()) {
                            $this->session->set_success_flashdata('feedback', 'Slider image added successfully.');
                            admin_redirect('slider');
                        }
                    } else
                        $this->templatedata['upload_error'] = $_upload_error;
                }
            }
        }

        $this->breadcrumb->append_crumb('Add Slider Image', admin_url('slider/add'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $slider = $this->doctrine->em->find('slider\models\Slider', $id);
        $dimention = _t('slider_dimention');
        $this->templatedata['dimention'] = $dimention;

        if ($this->input->post()) {
            $this->form_validation->set_rules('img_name', 'Image Name', 'required');
            if ($this->form_validation->run()) {
                $slider->setName($this->input->post('img_name'));
                $slider->setType($this->input->post('type'));
                $u = ($this->input->post('type') == 'external') ? trim($this->input->post('target_url')) : $this->input->post('target_page');
                $slider->setLink($u);
                $status = $this->input->post('isActive');

                if ($status == STATUS_ACTIVE)
                    $slider->activate();
                else
                    $slider->deactivate();


                if ($_FILES['img_file']['name'] != '') {
                    $oldfile = './assets/upload/images/slider/' . $slider->getImage();
                    $thumbnail = './assets/upload/images/slider/' . $slider->getThumbnail();

                    //upload the file
                    $config['upload_path'] = './assets/upload/images/slider/';
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('img_file')) {
                        $_upload_error = $this->upload->display_errors();
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

                        $slider->setImage($up_data['file_name']);
                        $slider->setThumbnail($up_data['raw_name'] . '_thumb' . $up_data['file_ext']);
                    }

                    //delete the old files
                    @unlink($oldfile);
                    @unlink($thumbnail);
                }

                if (!isset($_upload_error)) {
                    $this->doctrine->em->persist($slider);
                    $this->doctrine->em->flush();
                    $this->session->set_success_flashdata('feedback', 'Slider image saved successfully.');
                    admin_redirect('slider');
                } else
                    $this->templatedata['upload_error'] = $_upload_error;
            }
        }

        $this->templatedata['maincontent'] = 'slider/admin/edit';
        $this->templatedata['slider'] = &$slider;
        $this->breadcrumb->append_crumb('Edit Slider Image', admin_url('slider/edit'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {

        $slider = $this->doctrine->em->find('slider\models\Slider', $id);

        $oldimage = './assets/upload/slider/' . $slider->getImage();
        $thumb = './assets/upload/slider/' . $slider->getThumbnail();
        @unlink($oldimage);
        @unlink($thumb);

        $this->doctrine->em->remove($slider);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'The slider image was deleted successfully.');

        admin_redirect('slider');
    }

}
