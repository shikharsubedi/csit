<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Console_Controller extends MY_Controller {

    var $templatedata = array();

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->templatedata['_CONFIG'] = $this->_CONFIG;
        $this->templatedata['flashdata'] = $this->session->flashdata('feedback');
    }

    public function index() {
        $this->load->view('admin/dashboard');
    }

    public function forgotpassword() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|callback_chkuseremail');
            $this->form_validation->set_message('chkuseremail', 'The email/username you entered does not exist in the system.');
            if ($this->form_validation->run($this)) {
                $username = $this->input->post('username');

                $userRepo = &$this->doctrine->em->getRepository('user\models\User');

                $user = $userRepo->findOneByUsername($username);

                if ($user === NULL)
                    $user = $userRepo->findOneByEmail($username);


                $code = md5(time());


                $user->setResetcode($code);
                $user->setResettime(time());

                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();

                $message = "Someone just requested to reset the password for '" . $user->getUsername() . "'<br/>
				If you did not make this request, please ignore this message.<br/><br/>
				To reset your password, click <a href='" . site_url('console/resetpwd/' . $code) . "'>here</a>
							";

                //stored now send the email
                $this->load->library('email');

                $this->email->from($this->_CONFIG['admin_email'], $this->_CONFIG['admin_name']);
                $this->email->to($user->getEmail());

                $subject = $this->_CONFIG['admin_name'] . ' :: Password Assistance';

                $this->email->subject($subject);

                $this->email->message($message);

                if ($this->email->send()) {
                    $this->session->set_success_flashdata('feedback', 'An email has been sent to ' . $user->getEmail() . ' with the link to reset password.');
                    $this->email->print_debugger();
                    redirect('console/forgotpassword');
                }
                $this->email->print_debugger();
                //exit;
            }
        }

        $this->load->view('admin/forgotpassword', $this->templatedata);
    }

    public function resetpwd($code = '') {
        if ($code == '')
            show_404();


        $userRepo = &$this->doctrine->em->getRepository('user\models\User');
        $user = $userRepo->findOneByResetcode($code);

        if (!is_null($user)) {
            //get the date
            $created = $user->getResettime();
            $hours = (time() - $created) / (60 * 60);
            if ($hours > 24)
                show_error("This token is more than 24 hours old and expired. Please click here to request a new one.", 500);
            else {
                //reset the password
                $this->load->helper('string');
                $new_password = random_string('alpha', 8);

                $user->setPassword(md5($new_password));

                //set the reset code null
                $user->setResetcode(NULL);
                $user->setResettime(NULL);

                $this->doctrine->em->persist($user);
                $this->doctrine->em->flush();



                //stored now send the email
                $this->load->library('email');

                $message = "Your password has been successfully reset.<br/><br />
				Your new password is $new_password.<br /><br />
				Click <a href='" . site_url('console/login') . "'>here</a> to log in.";
                $this->email->from($this->_CONFIG['admin_email'], $this->_CONFIG['admin_name']);
                $this->email->to($user->getEmail());

                $subject = $this->_CONFIG['admin_name'] . ' :: Password Assistance';

                $this->email->subject($subject);

                $this->email->message($message);
                $this->email->send();
                $this->session->set_success_flashdata('feedback', 'Your password has been reset and sent to your email \'' . $user->getEmail() . '\'');
                redirect('console/login');
            }
        } else
            show_404();
    }

    function chkuseremail() {
        $username = $this->input->post('username');
        $userRepo = &$this->doctrine->em->getRepository('user\models\User');

        $user = $userRepo->findOneByUsername($username);
        if (!is_null($user))
            return TRUE;
        else {
            $user = $userRepo->findOneByEmail($username);
            if (!is_null($user))
                return TRUE;
        }
        return FALSE;
    }

    public function login() {
        $allowed_ip = Options::get('allowed_ip', '');
        if (!empty($allowed_ip)) {
            $restriction = Options::get('ip_filter', 'NO');
            $restriction = ($restriction == 'YES') ? TRUE : FALSE;

            if ($restriction) {
                $current_ip = $_SERVER['REMOTE_ADDR'];
                if ($allowed_ip != $current_ip)
                    header('Location: ' . site_url());
            }
        }
        $this->load->helper('form');
        $this->load->view('admin/login', $this->templatedata);
    }

    public function authenticate() {

        if ($this->_validate_login() === FALSE) {
            $this->login();
            return;
        }
        admin_redirect('');
    }

    private function _validate_login() {

        $this->form_validation->set_rules('username', 'Username', 'required|callback_chklogin');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('captchacode', 'Captcha Code', 'required|callback_capCheck');
        $this->form_validation->set_message('chklogin', 'Invalid login. Please try again.');

        return $this->form_validation->run($this);
    }

    public function chklogin() {
        return Current_User::login($this->input->post('username'), $this->input->post('password'), $this->_CONFIG['admin_email'], $this->_CONFIG['admin_name']);
    }

    public function logout() {
        $this->session->sess_destroy();
        admin_redirect('');
    }

    public function captcha() {
        //to use this method from another controller, copy the hexrgb() and capCheck() function to that controller...
        $image_width = 120;
        $image_height = 40;
        $characters_on_image = 6;
        $font = theme_path() . 'font.ttf';

        $possible_letters = '23456789bcdfghjkmnpqrstvwxyzABCDEFGHJKLMNQRTVWXYZ';
        $random_dots = 20;
        $random_lines = 5;
        $captcha_text_color = "0x123456";
        $captcha_noice_color = "0x192864";

        $code = '';

        $i = 0;
        while ($i < $characters_on_image) {
            $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1);
            $i++;
        }

        $font_size = $image_height * 0.75;
        $image = @imagecreate($image_width, $image_height);

        $background_color = imagecolorallocate($image, 255, 255, 255);

        $arr_text_color = $this->hexrgb($captcha_text_color);
        $text_color = imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);

        $arr_noice_color = $this->hexrgb($captcha_noice_color);
        $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);

        for ($i = 0; $i < $random_dots; $i++) {
            imagefilledellipse($image, mt_rand(0, $image_width), mt_rand(0, $image_height), 2, 3, $image_noise_color);
        }

        for ($i = 0; $i < $random_lines; $i++) {
            imageline($image, mt_rand(0, $image_width), mt_rand(0, $image_height), mt_rand(0, $image_width), mt_rand(0, $image_height), $image_noise_color);
        }

        $textbox = imagettfbbox($font_size, 0, $font, $code);
        $x = ($image_width - $textbox[4]) / 2;
        $y = ($image_height - $textbox[5]) / 2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $code);

        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);
        $captcha = array('edocpac' => $code);
        $this->session->set_userdata($captcha);
    }

    public function hexrgb($hexstr) {

        $int = hexdec($hexstr);
        return array("red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int);
    }

    public function capCheck($str) {

        $code = $this->session->userdata('edocpac');
        if (strcasecmp($code, $str) == 0) {
            $this->session->unset_userdata('edocpac');
            return true;
        } else {
            $this->session->unset_userdata('edocpac');
            $this->form_validation->set_message('capCheck', 'The Captcha Code is Wrong.<br/>');
            return false;
        }
    }

}
