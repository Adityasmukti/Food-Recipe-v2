<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        if ($this->session->userdata('logged_in') !== TRUE) {
            $this->load->view('auth/login');
        } else {
            redirect(base_url());
        }
    }

    public function validate()
    {
        $auth_email    = $this->input->post('auth_email', TRUE);
        $auth_pws = $this->input->post('auth_pws', TRUE);
        $validate = $this->m->login($auth_email, $auth_pws);
        if ($validate->num_rows() > 0) {
            $data  = $validate->row();
            $sesdata = array(
                'auth_id' => $data->auth_id,
                'auth_fullname' => $data->auth_fullname,
                'auth_image' => $data->auth_image,
                'auth_access' => $data->auth_access,
                'auth_email' => $data->auth_email,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            redirect(base_url());
        } else {
            $this->session->set_flashdata('redalert', 'Email or password wrong!');
            redirect('login');
        }
    }

    //logout function
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

/* End of file Account.php */
