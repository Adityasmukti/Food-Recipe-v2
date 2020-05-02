<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('MApp', 'm');
    }

    //login page controller
    public function index()
    {

        $this->load->view('auth/login');
    }

    public function login()
    {
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
        # code...
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
