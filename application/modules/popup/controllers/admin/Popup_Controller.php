<?php
use popup\models\Popup,
    Doctrine\Common\Util\Debug;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Popup_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //check for permissions
        if (!user_access('administer popup'))
            admin_redirect();

        //$this->load->model('popup/popup','p');
        $this->breadcrumb->append_crumb('Popup', admin_url('popup'));
    }

    public function index($offset = 0) {
        $per_page = 10;
        $popupRepo = &$this->doctrine->em->getRepository('popup\models\Popup');

        $_indices = $popupRepo->getPopup($offset, $per_page);
        $this->templatedata['popups'] = $_indices['indices'];
        $numIndexes = $_indices['total'];
        if ($numIndexes > $per_page) {
            $this->load->library('pagination');

            $config['base_url'] = admin_base_url() . "popup/index";
            $config['total_rows'] = $numIndexes;
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
                        $grp = &$this->doctrine->em->find('popup\models\Popup', $v);
                        $grp->activate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                case "unpublish":
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('popup\models\Popup', $v);
                        $grp->deactivate();
                        $this->doctrine->em->persist($grp);
                    }
                    break;

                default:
                    foreach ($checked as $k => $v) {
                        $grp = &$this->doctrine->em->find('popup\models\Popup', $v);
                        if ($grp)
                            $this->doctrine->em->remove($grp);
                    }
            }

            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'The action was succesfully applied to the selected items.');
            admin_redirect('popup');
        }

        $this->templatedata['maincontent'] = 'popup/admin/list';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function add() {
        $this->load->library('form_validation');
        $content = '';
        if ($this->input->post()) {
            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($this->form_validation->run($this)) {
                $popup = new Popup;

                $popup->setTitle($this->input->post('content_title'));
                $popup->setAuthor(Current_User::user());
                $popup->setBody($this->input->post('content_body'));
                ($this->input->post('published') == 'Y' ) ? $popup->activate() : $popup->deactivate();

                $this->doctrine->em->persist($popup);
                $this->doctrine->em->flush();
                $this->session->set_success_flashdata('feedback', 'Content saved successfully.');
                admin_redirect('popup');
            }

            $content = $this->input->post('content_body');
        }

        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';


        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');

        $ck_config = array('height' => 300,
            'width' => 600,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $content, $ck_config);

        $this->breadcrumb->append_crumb('Add Popup', admin_url('popup/add'));
        $this->templatedata['maincontent'] = 'popup/admin/add';
        $this->load->view('admin/master', $this->templatedata);
    }

    public function edit($id) {
        $this->load->library('form_validation');
        $pop = $this->doctrine->em->find('popup\models\Popup', $id);
        $this->templatedata['popup'] = $pop;

        if ($this->input->post()) {
            $this->form_validation->set_rules('content_title', 'Content Title', 'required');
            $this->form_validation->set_rules('content_body', 'Content Body', 'required');

            if ($this->form_validation->run()) {

                $pop->setTitle($this->input->post('content_title'));
                $pop->setBody($this->input->post('content_body'));

                ($this->input->post('published') == 'Y') ? $pop->activate() : $pop->deactivate();

                $this->doctrine->em->persist($pop);
                $this->doctrine->em->flush();
                $this->session->set_success_flashdata('feedback', 'Content updated successfully.');
                admin_redirect('popup');
            }
        }


        $this->templatedata['maincontent'] = 'popup/admin/edit';

        $this->load->library('ckFinder');
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';

        $this->ckfinder->SetupCKEditor($this->ckeditor, base_url() . 'assets/js/ckfinder');

        $this->breadcrumb->append_crumb('Edit Popup', admin_url('popup/edit'));
        $ck_config = array('height' => 300,
            'width' => 600,
            'toolbar' => 'F1soft',
            'baseHref' => base_url(),
            'skin' => 'moono'
        );
        if (file_exists(theme_path() . 'css/editor.css'))
            $ck_config['contentsCss'] = theme_url() . 'css/editor.css';

        $this->templatedata['ckeditor'] = $this->ckeditor->editor("content_body", $pop->getBody(), $ck_config);

        $this->load->view('admin/master', $this->templatedata);
    }

    public function delete($id) {
        $pop = $this->doctrine->em->find('popup\models\Popup', $id);
        $this->doctrine->em->remove($pop);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'The content was deleted successfully.');

        admin_redirect('popup');
    }

}

?>