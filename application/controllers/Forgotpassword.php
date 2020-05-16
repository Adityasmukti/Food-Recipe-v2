<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgotpassword extends CI_Controller
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
    $this->load->view('auth/forgotpassword');
  }

  public function reset()
  {
    ///Reset password function
    $auth_email = $this->input->post('auth_email');
    if (isset($auth_email) || !empty($auth_email)) {
      if ($this->m->cekUsers("auth_email", $auth_email)) {
        $data = $this->m->get;
        $tmppass = $this->m->GeneratePassword();
        $data = array(
          "auth_pws" => SHA1($tmppass),
        );
        if ($this->m->update("tb_auth", array("auth_email" => $auth_email), $data)) {
          if ($this->m->SendEmailForgot($this->input->post('auth_email'), $tmppass))
            $this->session->set_flashdata('greenalert', 'Reset password success, Check your email!');
          else
            $this->session->set_flashdata('redalert', 'Failed send email to users');
        } else
          $this->session->set_flashdata('redalert', 'Failed to reset users');
      } else
        $this->session->set_flashdata('redalert', 'Email is not exist!');
    } else
      $this->session->set_flashdata('redalert', 'Email is empty!');
    header('location:' . base_url("forgotpassword"));
  }
}
