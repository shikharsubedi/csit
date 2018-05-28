<?php

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
        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\SliderGroup');
        $slidersGroup = $sliderRepo->getGroups();
        if ($this->input->post("update-slider")) {
            Options::update('main_slider_group', $this->input->post('actionMain'));
            Options::update('mini_slider_group', $this->input->post('actionMini'));
        }
        $this->templatedata['sliders'] = $slidersGroup;
        $this->templatedata['maincontent'] = 'slider/admin/listgroups';

        $this->breadcrumb->append_crumb('Slider Groups', admin_url('slider/index'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addslider($gID = null) {

        $sliderGroup = $this->doctrine->em->find('slider\models\SliderGroup', $gID);
        $content = '';

        if ($this->input->post()) {
            $this->form_validation->set_rules('img_name', 'Image Name', 'required');

            if ($this->form_validation->run()) {
                $istab = ($this->input->post('istab') == 'Y') ? 'Y' : 'N';

                //$images = Options::get('slider_images',NULL);
                //upload the image
                $config['upload_path'] = './assets/upload/images/slider/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 0;
                $config['max_width'] = $sliderGroup->getWidth();
                $config['max_height'] = $sliderGroup->getHeight();


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('img_file')) {
                    $_upload_error = $this->upload->display_errors();
                } else {
                    $up_data = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $up_data['full_path'];
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 160;
                    $config['height'] = 100;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $_slider = new slider\models\Slider;
                    $_slider->setName($this->input->post('img_name'));
                    //die(get_class($sliderGroup));
                    $_slider->setGroup($sliderGroup);
                    $_slider->setLinkType($this->input->post('type'));
                    if (($_slider->getLinkType()) == 'internal')
                        $_slider->setContent($this->doctrine->em->find('content\models\Content', $this->input->post('target_page')));
                    else
                        $_slider->setURL($this->input->post('target_url'));
                    $_slider->setImage($up_data['file_name']);
                    $_slider->setThumbnail($up_data['raw_name'] . '_thumb' . $up_data['file_ext']);
                    $_slider->setIsTab($istab);
                    $_slider->setContent_a($this->input->post('first_content'));
                    $_slider->setContent_b($this->input->post('second_content'));
                    $_slider->setContent_c($this->input->post('third_content'));

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
                            admin_redirect("slider/items/$gID");
                        }
                    } else
                        $this->templatedata['upload_error'] = $_upload_error;
                }
            }
            $content = $this->input->post('content_body');
        }
        $this->templatedata['slider'] = $sliderGroup;
        $this->templatedata['maincontent'] = 'slider/admin/add';
        $this->breadcrumb->append_crumb('Add Slider Image', admin_url('slider/add'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editgroup($gID = null) {

        $_slider = $this->doctrine->em->find('slider\models\SliderGroup', $gID);

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run()) {
                $_slider->setName($this->input->post('name'));

                $this->doctrine->em->persist($_slider);
                $this->doctrine->em->flush();
                if ($_slider->id()) {
                    $this->session->set_success_flashdata('feedback', 'Slider Group edited successfully.');
                    admin_redirect('slider');
                }
            }
        }
        $this->templatedata['slider'] = $_slider;
        $this->templatedata['maincontent'] = 'slider/admin/editgroup';
        $this->breadcrumb->append_crumb('Edit Slider Group', admin_url('slider/editgroup'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deletegroup($gID = null) {

        $sliderGroup = $this->doctrine->em->find('slider\models\SliderGroup', $gID);
        $sliders = $this->doctrine->em->getRepository('slider\models\Slider')->findBy(array('group' => $gID));

        foreach ($sliders as $slider) {

            $slider->setGroup(NULL);
            $this->doctrine->em->persist($slider);
        }

        $this->doctrine->em->remove($sliderGroup);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'The slider image was deleted successfully.');

        admin_redirect('slider');
    }

    public function items($gID = null) {

        $sliderRepo = &$this->doctrine->em->getRepository('slider\models\Slider');

        if ($this->input->post('act-content')) {

            $checked = $this->input->post('check');

            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    //activate selected images
                    foreach ($checked as $k => $v) {
                        $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                        $image->activate();
                        $this->doctrine->em->persist($image);
                    }
                    break;

                case "unpublish":
                    //deactivate selected images
                    foreach ($checked as $k => $v) {
                        $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                        $image->deactivate();
                        $this->doctrine->em->persist($image);
                    }
                    break;

                default:
                    //delete
                    foreach ($checked as $k => $v) {
                        $image = & $this->doctrine->em->find('slider\models\Slider', $v);
                        $this->doctrine->em->remove($image);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected images.');
            admin_redirect('slider');
        }
        $this->templatedata['sliders'] = $sliderRepo->getImages("$gID");
        $this->templatedata['maincontent'] = 'slider/admin/list';
        $this->templatedata['group_id'] = $gID;
        $this->breadcrumb->append_crumb('View', admin_url('slider/index'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addgroup() {

        $this->templatedata['maincontent'] = 'slider/admin/addgroup';

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('height', 'Height', 'required');
            $this->form_validation->set_rules('width', 'Width', 'required');

            if ($this->form_validation->run()) {

                $_slider = new slider\models\SliderGroup();
                $_slider->setName($this->input->post('name'));
                $_slider->setHeight($this->input->post('height'));
                $_slider->setWidth($this->input->post('width'));

                $this->doctrine->em->persist($_slider);
                $this->doctrine->em->flush();
                if ($_slider->id()) {
                    $this->session->set_success_flashdata('feedback', 'Slider Group added successfully.');
                    admin_redirect('slider');
                }
            }
        }

        $this->breadcrumb->append_crumb('Add Slider Image', admin_url('slider/add'));
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editslider($id = null) {

        $slider = $this->doctrine->em->find('slider\models\Slider', $id);

        if ($this->input->post()) {

            $this->form_validation->set_rules('img_name', 'Image Name', 'required');
            if ($this->form_validation->run()) {

                $istab = ($this->input->post('istab') == 'Y') ? 'Y' : 'N';

                $slider->setName($this->input->post('img_name'));
                $slider->setLinkType($this->input->post('type'));
                if (($slider->getLinkType()) == 'internal')
                    $slider->setContent($this->doctrine->em->find('content\models\Content', $this->input->post('target_page')));
                else {
                    $slider->setURL($this->input->post('target_url'));
                    $slider->setContent(NULL);
                }
                $slider->setIsTab($istab);
                $slider->setContent_a($this->input->post('first_content'));
                $slider->setContent_b($this->input->post('second_content'));
                $slider->setContent_c($this->input->post('third_content'));
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
                    $config['max_size'] = 0;
                    $config['max_width'] = '1366';
                    $config['max_height'] = '511';

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

    public function deleteslider($id = null) {

        $slider = $this->doctrine->em->find('slider\models\Slider', $id);
        $oldimage = './assets/upload/images/slider/' . $slider->getImage();
        $thumb = './assets/upload/images/slider/' . $slider->getThumbnail();
        @unlink($oldimage);
        @unlink($thumb);

        $this->doctrine->em->remove($slider);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'The slider image was deleted successfully.');

        admin_redirect('slider');
    }

}
