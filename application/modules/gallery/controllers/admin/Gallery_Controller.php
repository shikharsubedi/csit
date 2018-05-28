<?php

use gallery\models\Album;
use gallery\models\Image;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('administer gallery'))
            admin_redirect();
        $this->breadcrumb->append_crumb('Gallery', admin_url('gallery'));
    }

    public function index() {
        $albumRepo = &$this->doctrine->em->getRepository('gallery\models\Album');

        if ($this->input->post('saveorder')) {

            $ord = explode('&', $this->input->post('order'));
            $index = 1; // 0 reserved for default
            foreach ($ord as $o) {
                if ($o != '') {
                    $gallery = &$this->doctrine->em->find('gallery\models\Album', $o);
                    //if ($content->isSticky()) {
                    $gallery->setOrder($index);
                    //echo $content->getTitle().' = '.$index.'<br/>';
                    $this->doctrine->em->persist($gallery);
                    $index = $index + 1;
                }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Gallery order sorted successfully.');
            admin_redirect('gallery');
        }

        $albums = $albumRepo->getAlbumss();
        $this->breadcrumb->append_crumb('Albums', admin_url('gallery'));
        $this->templatedata['maincontent'] = 'gallery/admin/listalbums';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['albums'] = $albums;
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        $this->load->library('form_validation');

        if ($this->input->post()) {
            //show_pre($_POST);
            //show_pre($_FILES); exit;
            $_album = new Album;
            $_album->setName($this->input->post('album_name'));
            $_album->setDescription($this->input->post('description'));
            $_album->setUser(Current_User::user());

            if ($_FILES['image']['name'] != '') {
                $config['upload_path'] = './assets/upload/images/album/temp';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 0;
                $config['max_width'] = 0;
                $config['max_height'] = 0;

                $this->load->library('upload', $config);

                $this->load->library('ThumbLib');

                foreach ($_FILES['image']['name'] as $k => $v) {
                    if ($v != '') {
                        //upload the image
                        if (!$this->upload->do_my_upload("image", $k)) {
                            $this->templatedata['upload_error'] = $this->upload->display_errors();
                        } else {
                            $up_data = $this->upload->data();

                            $thumb = Thumblib::create($up_data['full_path']);
                            $thumb->adaptiveResize(370, 272);
                            $thumb->save('./assets/upload/images/album/thumbs/' . $up_data['file_name']);

                            $image = Thumblib::create($up_data['full_path']);
                            $image->adaptiveResize(700, 700);
                            $image->save('./assets/upload/images/album/' . $up_data['file_name']);
                            @unlink('./assets/upload/images/album/temp/' . $up_data['file_name']);

                            $_image = new Image($_album);
                            $_image->setName($up_data['file_name']);
                            $_image->setUser(Current_User::user());
                            $_album->addImage($_image);

                            $this->doctrine->em->persist($_image);
                        }
                    }
                }
            }

            $this->doctrine->em->persist($_album);
            $this->doctrine->em->flush();

            if ($_album->id()) {
                //$this->session->set_success_flashdata('feedback', 'Album added successfully.');
                admin_redirect('gallery/preview/' . $_album->id());
            }
        }

        $this->breadcrumb->append_crumb('Add an Album', admin_url('gallery/add'));
        $this->templatedata['maincontent'] = 'gallery/admin/add';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function preview($album_id) {
        $album = $this->doctrine->em->find('\gallery\models\Album', $album_id);

        $images = $album->getImages();

        if ($this->input->post()) { //show_pre($_POST);exit;
            $album->setName($this->input->post('album_name'));
            $album->setDescription($this->input->post('description'));

            ($this->input->post('active') == 'Y' ) ? $album->activate() : $album->deactivate();

            $captions = $this->input->post('caption');
            $activeFlag = $this->input->post('isactive');
            $removeimage = $this->input->post('remove-image');

            //now update the images

            foreach ($captions as $k => $v) {
                $_image = $this->doctrine->em->find('\gallery\models\Image', $k);
                $_image->setCaption($v);
                isset($activeFlag[$k]) ? $_image->activate() : $_image->deactivate();
                $album->addImage($_image);
                if ($_image->id() == $this->input->post('cover_image'))
                    $album->setCoverImage($_image);

                $this->doctrine->em->persist($_image);
            }

            //now look for remaining images in the list -- these are actually the removed images
            if (is_array($removeimage) and count($removeimage) > 0) {
                foreach ($removeimage as $rem) {
                    $_image = $this->doctrine->em->find('\gallery\models\Image', $rem);

                    $remimage = './assets/upload/images/album/' . $_image->getName();
                    $thumbnail = './assets/upload/images/album/thumbs/' . $_image->getName();

                    @unlink($remimage);
                    @unlink($thumbnail);

                    $this->doctrine->em->remove($_image);
                }
            }

            $this->doctrine->em->persist($album);
            $this->doctrine->em->flush();

            $this->session->set_success_flashdata('feedback', 'Album created successfully.');

            admin_redirect('gallery');
        }

        $this->breadcrumb->append_crumb('Preview Album', admin_url('#'));
        $this->templatedata['album'] = &$album;
        $this->templatedata['images'] = &$images;
        $this->templatedata['maincontent'] = 'gallery/admin/preview';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($album_id) {
        $album = $this->doctrine->em->find('\gallery\models\Album', $album_id);
        //echo $this->input->post('cover_image');exit;
        $images = $album->getImages();

        if ($this->input->post()) { //show_pre($_POST);exit;
            $album->setName($this->input->post('album_name'));
            $album->setDescription($this->input->post('description'));

            ($this->input->post('active') == 'Y' ) ? $album->activate() : $album->deactivate();

            $captions = $this->input->post('caption');
            $activeFlag = $this->input->post('isactive');
            $removeimage = $this->input->post('remove-image');

            //now update the images

            foreach ($captions as $k => $v) {
                $_image = $this->doctrine->em->find('\gallery\models\Image', $k);
                $_image->setCaption($v);
                isset($activeFlag[$k]) ? $_image->activate() : $_image->deactivate();
                $album->addImage($_image);
                if ($_image->id() == $this->input->post('cover_image'))
                    $album->setCoverImage($_image);

                $this->doctrine->em->persist($_image);
            }

            //now look for remaining images in the list -- these are actually the removed images
            if (is_array($removeimage) and count($removeimage) > 0) {
                foreach ($removeimage as $rem) {
                    $_image = $this->doctrine->em->find('\gallery\models\Image', $rem);
                    $remimage = './assets/upload/images/album/' . $_image->getName();
                    $thumbnail = './assets/upload/images/album/thumbs/' . $_image->getName();
                    

                    @unlink($remimage);
                    @unlink($thumbnail);

                    $this->doctrine->em->remove($_image);
                }
            }

            $this->doctrine->em->persist($album);
            $this->doctrine->em->flush();

            $this->session->set_success_flashdata('feedback', 'Album edited successfully.');
            admin_redirect('gallery');
        }

        $this->breadcrumb->append_crumb('Edit Album', admin_url('#'));
        $this->templatedata['album'] = &$album;
        $this->templatedata['images'] = &$images;
        $this->templatedata['maincontent'] = 'gallery/admin/edit';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($album_id) {
        $imageRepo = $this->doctrine->em->getRepository('gallery\models\Image');
        $images = $imageRepo->getImages($album_id);

        foreach ($images as $i) {
            $_image = $this->doctrine->em->find('\gallery\models\Image', $i['id']);
            $remimage = './assets/upload/images/album/' . $_image->getName();
            $thumbnail = './assets/upload/images/album/thumbs/' . $_image->getName();
            $thumbnail1 = './assets/upload/images/album/thumbs1/' . $_image->getName();
            @unlink($remimage);
            @unlink($thumbnail);

            $this->doctrine->em->remove($_image);
        }
        $this->doctrine->em->flush();
        $album = $this->doctrine->em->find('\gallery\models\Album', $album_id);
        $this->doctrine->em->remove($album);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'Album deleted successfully.');
        admin_redirect('gallery');
    }

    public function addimage($album_id) {

        $album = $this->doctrine->em->find('\gallery\models\Album', $album_id);

        if ($this->input->post()) {

            $this->load->library('form_validation');

            if ($_FILES['image']['name'] != '') {
                $config['upload_path'] = './assets/upload/images/album/temp';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 0;
                $config['max_width'] = 0;
                $config['max_height'] = 0;

                $this->load->library('upload', $config);

                $this->load->library('ThumbLib');

                foreach ($_FILES['image']['name'] as $k => $v) {
                    if ($v != '') {
                        //upload the image
                        if (!$this->upload->do_my_upload("image", $k)) {
                            $this->templatedata['upload_error'] = $this->upload->display_errors();
                        } else {
                            $up_data = $this->upload->data();

                            $thumb = Thumblib::create($up_data['full_path']);
                            $thumb->adaptiveResize(370, 272);
                            $thumb->save('./assets/upload/images/album/thumbs/' . $up_data['file_name']);

                            $thumb = Thumblib::create($up_data['full_path']);
                            $thumb->adaptiveResize(700, 700);
                            $thumb->save('./assets/upload/images/album/' . $up_data['file_name']);

                            @unlink('./assets/upload/images/album/temp/' . $up_data['file_name']);

                            $_image = new Image($album);
                            $_image->setName($up_data['file_name']);
                            $_image->setUser(Current_User::user());
                            $album->addImage($_image);

                            $this->doctrine->em->persist($_image);
                        }
                    }
                }
            }

            $this->doctrine->em->persist($album);
            $this->doctrine->em->flush();
            admin_redirect('gallery/edit/' . $album->id());
        }

        $this->breadcrumb->append_crumb('Add Image', admin_url('#'));
        $this->templatedata['maincontent'] = 'gallery/admin/addimage';
        $this->templatedata['albumname'] = $album->getName();
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

}
