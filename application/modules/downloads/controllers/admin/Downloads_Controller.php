<?php

use downloads\models\Download;
use downloads\models\Download_category;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Downloads_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('administer downloads'))
            admin_redirect();

        $this->breadcrumb->append_crumb('Downloads', admin_url('downloads'));
    }

    public function index($offset = 0) {
        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');

        $per_page = 10;
        $_indices = $downloadRepo->getDownloadCategory($offset, $per_page);

        $this->templatedata['categories'] = $_indices['indices'];
        $numContent = $_indices['total'];

        if ($numContent > $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = admin_base_url() . "downloads/index";
            $config['total_rows'] = $numContent;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 4;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';

            $this->pagination->initialize($config);
            $this->templatedata['pagination'] = $this->pagination->create_links();
        }

        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download_category', $v);
                        $grp->activate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download_category', $v);
                        $grp->deactivate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download_category', $v);
                        if ($grp)
                            $this->doctrine->em->remove($grp);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('downloads');
        }

        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->templatedata['maincontent'] = 'downloads/admin/catlist';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addcategory() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('category_title', 'Category Name', 'required');

            if ($this->form_validation->run($this)) {
                $download_category = new Download_category;

                $download_category->setName($this->input->post('category_title'));
                ($this->input->post('published') == STATUS_ACTIVE) ? $download_category->activate() : $download_category->deactivate();

                $this->doctrine->em->persist($download_category);
                $this->doctrine->em->flush();

                if ($download_category->id()) {
                    $this->session->set_success_flashdata('feedback', 'Download Category created successfully.');
                    admin_redirect('downloads');
                }
            }
        }
        $this->breadcrumb->append_crumb('Add Category', admin_url('#'));
        $this->templatedata['maincontent'] = 'downloads/admin/addcategory';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editcategory($cat_id) {
        $category = $this->doctrine->em->find('\downloads\models\Download_category', $cat_id);
        if ($this->input->post()) {
            $this->form_validation->set_rules('category_title', 'Category Name', 'required');

            if ($this->form_validation->run($this)) {

                $category->setName($this->input->post('category_title'));
                ($this->input->post('published') == STATUS_ACTIVE) ? $category->activate() : $category->deactivate();
                $this->doctrine->em->persist($category);
                $this->doctrine->em->flush();

                $this->session->set_success_flashdata('feedback', 'Download Category edited successfully.');
                admin_redirect('downloads');
            }
        }

        $this->templatedata['category'] = &$category;
        $this->breadcrumb->append_crumb('Edit Category', admin_url('#'));
        $this->templatedata['maincontent'] = 'downloads/admin/editcategory';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addfile($cat_id) {
        $category = $this->doctrine->em->find('\downloads\models\Download_category', $cat_id);

        if ($this->input->post()) {
            //show_pre($_FILES);exit;
            $this->form_validation->set_rules('content_title', 'Category Name', 'required');

            if ($this->form_validation->run($this)) {
                $config['upload_path'] = './assets/upload/downloads/';
                $config['allowed_types'] = 'pdf|xls|xlsx|doc|docx|word';
                //$config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|jpeg|doc|docx|word|xl|cod|apk|zip|jad|jar';
                $config['max_size'] = 0;
                $config['max_width'] = 0;
                $config['max_height'] = 0;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $this->templatedata['upload_error'] = $this->upload->display_errors();
                } else {
                    $up_data = $this->upload->data();

                    $download_item = new Download($category);

                    $download_item->setName($this->input->post('content_title'));
                    $download_item->setFile($up_data['file_name']);
                    ($this->input->post('published') == STATUS_ACTIVE) ? $download_item->activate() : $download_item->deactivate();

                    $this->doctrine->em->persist($download_item);
                    $this->doctrine->em->flush();

                    if ($download_item->id()) {
                        $this->session->set_success_flashdata('feedback', 'Download item added successfully.');
                        admin_redirect('downloads/showitems/' . $cat_id);
                    }
                }
            }
        }

        $this->breadcrumb->append_crumb($category->getName(), admin_url('downloads/showitems/' . $cat_id));
        $this->breadcrumb->append_crumb('Add Download Item', admin_url('#'));
        $this->templatedata['maincontent'] = 'downloads/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function showitems($cat_id, $offset = 0) {
        $category = $this->doctrine->em->find('\downloads\models\Download_category', $cat_id);

        $downloadRepo = &$this->doctrine->em->getRepository('downloads\models\Download');

        $per_page = 10;
        $_indices = $downloadRepo->getDownloadItems($cat_id, $offset, $per_page);

        $this->templatedata['items'] = $_indices['indices'];
        $numContent = $_indices['total'];

        if ($numContent > $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = admin_base_url() . "downloads/showitems/" . $cat_id;
            $config['total_rows'] = $numContent;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 5;
            $config['prev_link'] = 'Previous';
            $config['next_link'] = 'Next';

            $this->pagination->initialize($config);
            $this->templatedata['pagination'] = $this->pagination->create_links();
        }

        if ($this->input->post('update')) {

            $checked = $this->input->post('check');
            $action = $this->input->post('action');

            switch ($action) {
                case "publish":
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download', $v);
                        $grp->activate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download', $v);
                        $grp->deactivate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('downloads\models\Download', $v);
                        if ($grp)
                            $this->doctrine->em->remove($grp);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('downloads/showitems/' . $cat_id);
        }


        $this->breadcrumb->append_crumb($category->getName(), admin_url('downloads/showitems/' . $cat_id));
        $this->templatedata['category'] = &$category;
        $this->templatedata['maincontent'] = 'downloads/admin/catitemlist';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($cat_id) {
        $category = $this->doctrine->em->find('\downloads\models\Download_category', $cat_id);

        //delete the files
        $downloads = $category->getDownloads();

        foreach ($downloads as $d) {
            $file = './assets/upload/downloads/' . $d->getFile();
            @unlink($file);
        }

        $this->doctrine->em->remove($category);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'Download category deleted successfully.');
        admin_redirect('downloads');
    }

    public function deleteitem($itemId) {
        $download_item = $this->doctrine->em->find('\downloads\models\Download', $itemId);

        $file = './assets/upload/downloads/' . $download_item->getFile();

        @unlink($file);

        $this->doctrine->em->remove($download_item);
        $this->doctrine->em->flush();

        $this->session->set_success_flashdata('feedback', 'Download item deleted successfully.');
        admin_redirect('downloads');
    }

}

?>