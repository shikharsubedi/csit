<?php

use management\models\Management,
    management\models\ManagementType;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Management_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        if (!user_access('administer management list'))
            admin_redirect();
        $this->load->library('ThumbLib');

        $this->breadcrumb->append_crumb('Team', admin_url('management'));
    }

    public function index() {

        $repo = &$this->doctrine->em->getRepository('management\models\ManagementType');
        $teams = $repo->getTeams();

        $this->templatedata['teams'] = $teams;
        $this->templatedata['maincontent'] = 'management/admin/list';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addteam() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('team_name', 'Name', 'required');
            if ($this->form_validation->run($this)) {

                $_mng = new ManagementType;
                $_mng->setName($this->input->post('team_name'));

                $this->doctrine->em->persist($_mng);
                $this->doctrine->em->flush();

                if ($_mng->id()) {
                    $this->session->set_success_flashdata('feedback', 'Team added successfully.');
                    admin_redirect('management');
                }
            }
        }

        $this->breadcrumb->append_crumb('Add a Team', admin_url('#'));
        $this->templatedata['maincontent'] = 'management/admin/addteam';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editteam($team_id) {
        $team = $this->doctrine->em->find('management\models\ManagementType', $team_id);

        if ($this->input->post()) {
            $this->form_validation->set_rules('team_name', 'Name', 'required');
            if ($this->form_validation->run($this)) {
                $team->setName($this->input->post('team_name'));
                $this->doctrine->em->persist($team);
                $this->doctrine->em->flush();

                $this->session->set_success_flashdata('feedback', 'Team saved successfully.');
                admin_redirect('management');
            }
        }

        $this->breadcrumb->append_crumb('Edit Team', admin_url('#'));
        $this->templatedata['team'] = & $team;
        $this->templatedata['maincontent'] = 'management/admin/editteam';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deleteteam($team_id) {
        $team = $this->doctrine->em->find('management\models\ManagementType', $team_id);
        $members = $team->getPeople();

        foreach ($members as $member) {
            $member_image = './assets/upload/images/members/frontpage_thumbs/' . $member->getImage();
            $thumbnail = './assets/upload/images/members/ourteampage_thumbs/' . $member->getImage();

            $this->doctrine->em->remove($member);
            $this->doctrine->em->flush();

            @unlink($member_image);
            @unlink($thumbnail);
        }

        $this->doctrine->em->remove($team);
        $this->doctrine->em->flush();
        $this->session->set_success_flashdata('feedback', 'Team deleted successfully.');

        admin_redirect('management');
    }

    public function viewmembers($team_id) {
        $mgmtRepo = $this->doctrine->em->getRepository('management\models\Management');
        $members = $mgmtRepo->getMembers($team_id);
        $team = $mgmtRepo->getTeams($team_id);
        $tname = $team[0]['name'];

        //count showFront and limit to allow only two show front         
        $count = $mgmtRepo->countShowFront();
        $this->templatedata['count'] = $count;
        //count showFront and limit to allow only two show front  

        $this->breadcrumb->append_crumb('View Team', admin_url('#'));

        if ($this->input->post()) {
            $ord = explode('&', $this->input->post('order'));
            $start = 1;
            foreach ($ord as $o) {
                $member = $this->doctrine->em->find('management\models\Management', $o);
                $member->setOrder($start);
                $this->doctrine->em->persist($member);

                $start++;
            }
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Members order sorted successfully.');
            admin_redirect('management');
        }

        $this->templatedata['team_id'] = $team_id;
        $this->templatedata['team'] = $tname;
        $this->templatedata['members'] = $members;

        $this->templatedata['maincontent'] = 'management/admin/viewteam';
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function addmember($team_id) {
        $team = $this->doctrine->em->find('management\models\ManagementType', $team_id);

        $mgmtRepo = $this->doctrine->em->getRepository('management\models\Management');
        $tname = $mgmtRepo->getTeams($team_id);
        $tname = $tname[0]['name'];

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');


            if ($this->form_validation->run($this)) {
                $_m = new Management($team);
                $_m->setName($this->input->post('name'));
                $_m->setPosition($this->input->post('position'));
                $_m->setDescription($this->input->post('specification'));
                $_m->setExperience($this->input->post('experience'));
                $_m->setTeam($team);

                $isactive = ($this->input->post('is_active') === FALSE ) ? FALSE : TRUE;
                $_m->setStatus($isactive);

                $image = '';

                if (isset($_FILES['image']) and $_FILES['image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/members/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;

                    $this->load->library('upload', $config);
                    if (!$up_data=$this->upload->do_upload('image')) {
                        $_upload_error = $this->upload->display_errors();
                    } else {
                        //resize the image
//                        $thumb = ThumbLib::create($up_data['full_path']);
//                        $thumb->adaptiveResize(125, 100);
//                        $thumb->save('./assets/upload/images/members/thumbs/' . $up_data['file_name']);
                        $up_data = $this->upload->data();
                        $thumb2 = ThumbLib::create($up_data['full_path']);
                        $thumb2->adaptiveResize(270, 260);
                        $thumb2->save('./assets/upload/images/members/ourteampage_thumbs/' . $up_data['file_name']);

                        $thumb3 = ThumbLib::create($up_data['full_path']);
                        $thumb3->adaptiveResize(370, 149);
                        $thumb3->save('./assets/upload/images/members/frontpage_thumbs/' . $up_data['file_name']);
                        @unlink('assets/upload/images/members/' . $up_data['file_name']);
                        $image = $up_data['file_name'];
                    }
                }

                $_m->setImage($image);

                $team->addMember($_m);

                $this->doctrine->em->persist($_m);
                $this->doctrine->em->persist($team);
                $this->doctrine->em->flush();

                if ($_m->id()) {
                    $this->session->set_success_flashdata('feedback', 'Team member added successfully.');
                    admin_redirect('management/viewmembers/' . $team_id);
                }
            }
        }

        $this->breadcrumb->append_crumb($team->getName(), admin_url('management/viewmembers/' . $team->id()));
        $this->breadcrumb->append_crumb('Add a Member', admin_url('#'));
        array_push($this->templatedata['scripts'], 'ckeditor/ckeditor');
        array_push($this->templatedata['scripts'], 'ckfinder/ckfinder');
        $this->templatedata['maincontent'] = 'management/admin/addmember';
        $this->templatedata['tname'] = $tname;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function editmember($member_id, $team_id = NULL) {

        $member = $this->doctrine->em->find('management\models\Management', $member_id);

        $mgmtRepo = $this->doctrine->em->getRepository('management\models\Management');
        $tname = $mgmtRepo->getTeams($team_id);
        $tname = $tname[0]['name'];

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');

            if ($this->form_validation->run($this)) {
                $member->setName($this->input->post('name'));
                $member->setPosition($this->input->post('position'));
                $member->setDescription($this->input->post('specification'));
                $active = ($this->input->post('is_active') === FALSE) ? FALSE : TRUE;
                $member->setStatus($active);
                $member->setExperience($this->input->post('experience'));

                if ($_FILES['image']['name'] != '') {
                    //upload the file
                    $config['upload_path'] = './assets/upload/images/members/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 0;
                    $config['max_width'] = 0;
                    $config['max_height'] = 0;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        //@unlink('assets/upload/images/members/' . $member->getImage());
                        @unlink('assets/upload/images/members/ourteampage_thumbs/' . $member->getImage());
                        @unlink('assets/upload/images/members/frontpage_thumbs/' . $member->getImage());
                        $upinfo = $this->upload->data();
                        $thumb = ThumbLib::create($upinfo['full_path']);
                        $thumb->adaptiveResize(370, 149);
                        $thumb->save('./assets/upload/images/members/frontpage_thumbs/' . $upinfo['file_name']);

                        $thumb2 = ThumbLib::create($upinfo['full_path']);
                        $thumb2->adaptiveResize(270, 260);
                        $thumb2->save('./assets/upload/images/members/ourteampage_thumbs/' . $upinfo['file_name']);



                        $image = $upinfo['file_name'];
                        $member->setImage($image);
                        @unlink('assets/upload/images/members/' . $member->getImage());
                    }
                }

                $this->doctrine->em->persist($member);
                $this->doctrine->em->flush();

                $this->session->set_success_flashdata('feedback', 'Member details saved successfully.');
                admin_redirect('management');
            }
        }

        $this->breadcrumb->append_crumb('Edit Team Member', admin_url('#'));
        array_push($this->templatedata['scripts'], 'ckeditor/ckeditor');
        array_push($this->templatedata['scripts'], 'ckfinder/ckfinder');
        $this->templatedata['member'] = & $member;
        $this->templatedata['maincontent'] = 'management/admin/editmember';
        $this->templatedata['tname'] = $tname;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
        $this->load->view('admin/master', $this->templatedata);
    }

    public function deletemember($member_id) {
        $member = $this->doctrine->em->find('management\models\Management', $member_id);
        if ($member) {
            @unlink('assets/upload/images/members/' . $member->getImage());
//            @unlink('assets/upload/images/members/thumbs/' . $member->getImage());
            @unlink('assets/upload/images/members/thumbs/ourteampage_thumbs/' . $member->getImage());
            @unlink('assets/upload/images/members/thumbs/frontpage_thumbs/' . $member->getImage());
            $this->doctrine->em->remove($member);
            $this->doctrine->em->flush();
            $this->session->set_success_flashdata('feedback', 'Member deleted successfully.');
        }
        admin_redirect('management');
    }

    public function updatefront() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $showfront = ($status == 'true') ? 1 : 0;
            $repo = $this->doctrine->em->find("management\models\Management", $id);

            $repo->setShowFront($showfront);
            $this->doctrine->em->persist($repo);
            $this->doctrine->em->flush();
        }
    }

}
