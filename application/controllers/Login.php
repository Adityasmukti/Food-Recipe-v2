<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->MRef->sessionstart();
        $this->maintitle = "Login - " . $this->session->userdata('appname');
        $this->pageheading = "Login";
        $this->load->model('MAuth', 'm');
    }

    //login page controller
    public function index()
    {
        $this->MRef->loggedauth();
        $data = [
            "title" => $this->maintitle,
            "pageheading" => $this->pageheading,
            "error" => false,
            "message" => ""
        ];

        $submit = $this->input->post('submit');
        if (isset($submit)) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ((isset($username) && isset($password))) {
                if ($this->m->Verification($username, $password)) {
                    redirect(base_url('recipe'));
                } else {
                    $data["error"] = true;
                    $data["message"] = "username atau password salah!!";
                }
            }
        }
        $this->load->view('auth/login', $data);
    }

    //logout function
    public function logout()
    {
        $this->m->tokendestroy();
        session_destroy();
        redirect(base_url('auth'));
    }
}

/* End of file Account.php */
