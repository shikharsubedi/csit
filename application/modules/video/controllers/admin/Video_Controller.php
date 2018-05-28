<?php

use video\models\Category;
use video\models\Video;
use video\models\Subtopic;

class Video_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('administer video'))
            admin_redirect();
        $this->load->library('ThumbLib');

        $this->breadcrumb->append_crumb('Video', admin_url('video'));
    }

    public function index($offset = 0) {

        $repo = $this->doctrine->em->getRepository('video\models\Video');
        $cat = $repo->getCategory();
        if ($this->input->post('update')) {

            $checked = $this->input->post('check');

            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
//activate selected images
                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $video = & $this->doctrine->em->find('video\models\Category', $v);
                            $video->activate();
                            $this->doctrine->em->persist($video);
                        }
                    }
                    break;

                case "unpublish":
//deactivate selected images
                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $video = & $this->doctrine->em->find('video\models\Category', $v);
                            $video->deactivate();
                            $this->doctrine->em->persist($video);
                        }
                    }
                    break;

                default:
//delete
                    if (count($checked)) {

                        foreach ($checked as $videoId) {

                            $cat = &$this->doctrine->em->find('video\models\Category', $videoId);
                            $video = $this->doctrine->em->getRepository('video\models\Video')->findBy(array('category' => $videoId));

                            if ($video) {
                                foreach ($video as $e) {
                                    if (is_file("./assets/upload/video/" . $e->getLogo()))
                                        @unlink("./assets/upload/video/" . $e->getLogo());
                                    $this->doctrine->em->remove($e);
                                }


                                $this->doctrine->em->remove($cat);
                            }
                        }
                    }
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected images.');
            admin_redirect('video');
        }
        if ($this->input->post('saveorder')) {
            $ord = explode('&', $this->input->post('order'));
            $start = 0;
            foreach ($ord as $o) {
                $ecat = $this->doctrine->em->find('video\models\Category', $o);
                $ecat->setOrder($start);
                $this->doctrine->em->persist($ecat);

                $start++;
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Video category order sorted successfully.');
            admin_redirect('video');
        }

        $this->breadcrumb->append_crumb('Video', admin_url(''));
        $this->templatedata['cat'] = $cat;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/cat_list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addcat() {
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');

            if ($this->form_validation->run()) {
                $cat = new Category;
                $cat->setTitle($this->input->post('title'));
                ($this->input->post('isActive') == 'active') ? $cat->activate() : $cat->deactivate();
                $cat->setUser(Current_User::user());

                $this->doctrine->em->persist($cat);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video category added successfully.');
                admin_redirect('video');
            }
        }
        $this->breadcrumb->append_crumb('Add Video Category', admin_url('video/addcat'));
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/add_cat';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editcat($id) {
        $cat = $this->doctrine->em->find('video\models\Category', $id);
        if ($this->input->post()) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');

            if ($this->form_validation->run()) {

                $cat->setTitle($this->input->post('title'));
                ($this->input->post('isActive') == 'active') ? $cat->activate() : $cat->deactivate();
                $cat->setUser(Current_User::user());

                $this->doctrine->em->persist($cat);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video added successfully.');
                admin_redirect('video');
            }
        }

        $this->breadcrumb->append_crumb('Edit Video Category', admin_url('video/editcat/' . $id));
        $this->templatedata['cat'] = $cat;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/edit_cat';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deletecat($id) {

        $cat = &$this->doctrine->em->find('video\models\Category', $id);
        $video = $this->doctrine->em->getRepository('video\models\Video')->findBy(array('category' => $id));

        if ($video) {
            foreach ($video as $e) {

                $this->doctrine->em->remove($e);
            }
        }
        $this->doctrine->em->remove($cat);

        $this->doctrine->em->flush();

        $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video Category  deleted successfully.');
        admin_redirect('video');
    }

    public function videolist($id) {
        $repo = $this->doctrine->em->getRepository('video\models\Video');
        $videos = $repo->getVideo($id);

        if ($this->input->post('update')) {

            $checked = $this->input->post('check');

            $action = $this->input->post('action');

            switch ($action) {
                case "publish":

                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $video = & $this->doctrine->em->find('video\models\Video', $v);
                            $video->activate();
                            $this->doctrine->em->persist($video);
                        }
                    }
                    break;

                case "unpublish":

                    if (count($checked)) {
                        foreach ($checked as $k => $v) {
                            $video = & $this->doctrine->em->find('video\models\Video', $v);
                            $video->deactivate();
                            $this->doctrine->em->persist($video);
                        }
                    }
                    break;

                default:

                    if (count($checked)) {

                        foreach ($checked as $videoId) {

                            $cat = &$this->doctrine->em->find('video\models\Video', $videoId);
                            $video = $this->doctrine->em->getRepository('video\models\Video')->findBy(array('category' => $videoId));

                            $this->doctrine->em->remove($video);
                        }
                    }
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected images.');
            admin_redirect('video');
        }
        if ($this->input->post('saveorder')) {
            $ord = explode('&', $this->input->post('order'));
            $start = 0;
            foreach ($ord as $o) {
                $vid = $this->doctrine->em->find('video\models\Video', $o);
                $vid->setOrder($start);
                $this->doctrine->em->persist($vid);

                $start++;
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Video  order sorted successfully.');
            admin_redirect('video');
        }
        $this->breadcrumb->append_crumb('List Video ', admin_url('video/videolist/' . $id));
        $this->templatedata['videos'] = $videos;
        $this->templatedata['id'] = $id;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/list';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add($id) {

        $cat = $this->doctrine->em->find('video\models\Category', $id);
        if ($this->input->post()) {
            //show_pre($_POST);exit;
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('yCode', 'Youtube Code', 'required');

            if ($this->form_validation->run()) {
                $ltype = 'yt_code';
                //$link = ($ltype == 'yt_code') ? $this->input->post('media_link') : $this->input->post('url');                
                $video = new Video($cat);
                $video->setTitle($this->input->post('title'));
                $video->setYlink($this->input->post('yCode'));
                $video->setLinktype($ltype);
                ($this->input->post('isActive') == 'active') ? $video->activate() : $video->deactivate();



                $url = 'http://www.youtube.com/watch?v=1dtx_FGb_g8';
                $youtube = "http://www.youtube.com/oembed?url=" . $url . "&format=json";


                if ($ltype == 'yt_code') {
                    $video_ID = $this->input->post('media_link');
                    $JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
                    $JSON_Data = json_decode($JSON);
                    $views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
                } else {
                    $views = 0;
                }

               // $video->setViews($views);
                if ($_FILES['image'] != '') {



                    $config['upload_path'] = './assets/upload/images/videothumb/';
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('image')) {
                        $this->templatedata['upload_error'] = $this->upload->display_errors();
                    } else {
                        $up_data = $this->upload->data();
                        $h = $up_data['image_height'];
                        $w = $up_data['image_width'];

                        if ($h != 162 or $w != 270) {
                            $this->session->set_error_flashdata('feedback', ' <div class="error_msg">Please upload image exactly of size 270px × 162px.</div>');
                            admin_redirect('video/add/' . $id);
                        }


                        $video->setImage($up_data['file_name']);
                    }
                }

                $sub_title = $this->input->post('sub_title');
                $sub_value = $this->input->post('sub_value');
                foreach ($sub_title as $key => $value) {

                    $sub = new Subtopic($video);
                    $sub->setTitle($value);
                    $sub->setValue($sub_value[$key]);
                    $this->doctrine->em->persist($sub);
                }

                $this->doctrine->em->persist($video);
                $this->doctrine->em->persist($cat);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video added successfully.');
                admin_redirect('video/videolist/' . $id);
            }
        }
        $this->breadcrumb->append_crumb('Add Video', admin_url(''));
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {

        $video = $this->doctrine->em->find('video\models\Video', $id);
        $subtopic = $this->doctrine->em->getRepository('video\models\Subtopic')->findBy(array('video' => $id));
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($subtopic);exit;
        if ($this->input->post()) {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('yCode', 'Youtube Code', 'required');

            if ($this->form_validation->run()) {

                foreach ($subtopic as $st) {
                    $this->doctrine->em->remove($st);
                    $this->doctrine->em->flush();
                }
                $ltype = 'yt_code';
                //$link = ($ltype == 'yt_code') ? $this->input->post('media_link') : $this->input->post('url');
                $video->setTitle($this->input->post('title'));
                $video->setYlink($this->input->post('yCode'));
                $video->setLinktype($ltype);
                ($this->input->post('isActive') == '1') ? $video->activate() : $video->deactivate();

//                if ($ltype == 'yt_code') {
//                    $video_ID = $this->input->post('media_link');
//                    $JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$video_ID}?v=2&alt=json");
//                    $JSON_Data = json_decode($JSON);
//                    $views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
//                } else {
//                    $views = 0;
//                }

               // $video->setViews(0);

//                if ($_FILES['image'] != '') {
//
//
//
//                    $config ['upload_path'] = './assets/upload/images/videothumb/';
//                    $config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|tiff';
//                    $config['max_size'] = 0;
//                    $config['max_width'] = 0;
//                    $config['max_height'] = 0;
//
//                    $this->load->library('upload', $config);
//
//                    if (!$this->upload->do_upload('image')) {
//                        $this->templatedata['upload_error'] = $this->upload->display_errors();
//                    } else {
//                        $up_data = $this->upload->data();
//                        $h = $up_data['image_height'];
//                        $w = $up_data['image_width'];
//
//                        if ($h != 162 or $w != 270) {
//                            $this->session->set_error_flashdata('feedback', ' <div class="error_msg">Please upload image exactly of size 270px × 162px.</div>');
//                            admin_redirect('video/edit/' . $id);
//                        }
//
//
//                        $video->setImage($up_data['file_name']);
//                    }
//                }

//                $sub_title = $this->input->post('sub_title');
//                $sub_value = $this->input->post('sub_value');

//                foreach ($sub_title as $key => $value) {
//
//                    $sub = new Subtopic($video);
//                    $sub->setTitle($value);
//                    $sub->setValue($sub_value[$key]);
//                    $this->doctrine->em->persist($sub);
//                }

                $this->doctrine->em->persist($video);
                $this->doctrine->em->flush();

                $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video edited successfully.');
                admin_redirect('video');
            }
        }
        $this->breadcrumb->append_crumb('Edit Video', admin_url(''));
        $this->templatedata['subtopic'] = $subtopic;
        $this->templatedata['video'] = $video;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'video/admin/edit';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $video = &$this->doctrine->em->find('video\models\Video', $id);
        $sub = $this->doctrine->em->getRepository('video\models\Subtopic')->findBy(array('video' => $id));

        if ($sub) {
            foreach ($sub as $s) {
                $this->doctrine->em->remove($s);
            }
        }
        $this->doctrine->em->remove($video);
        $this->doctrine->em->flush();

        $this->templatedata['flashdata'] = $this->session->flashdata('feedback', 'Video  deleted successfully.');
        admin_redirect('video');
    }

}
