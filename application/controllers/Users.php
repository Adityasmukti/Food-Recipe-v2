<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('MApp', 'm');
  }

  public function index()
  {
    $auth_access = $this->input->get('auth_access');
    $auth_verify = $this->input->get('auth_verify');
    $data = array(
      "data" => $this->m->getUser(isset($auth_access) ? $auth_access : "", isset($auth_verify) ? $auth_verify : "")->result(),
      "access" => $this->m->getAccess()->result(),
      "auth_access" => $auth_access,
      "auth_verify" => $auth_verify
    );
    $this->load->view('users/view', $data);
  }

  //add category page
  public function add()
  {
    $this->load->view('users/add', FALSE);
  }

  public function addaction()
  {
    if ($this->m->cekUsers("auth_email", $this->input->post('auth_email'))) {
      $this->session->set_flashdata('redalert', 'Email is exist!');
    } else {
      $tmppass = $this->m->GeneratePassword();
      $data = array(
        "auth_access" => $this->input->post('auth_access'),
        "auth_fullname" => explode("@", $this->input->post('auth_email'))[0],
        "auth_email" => $this->input->post('auth_email'),
        "auth_pws" => SHA1($tmppass),
        "auth_create" => date("Y-m-d H:i:s"),
        "auth_image" => "noimage.png"
      );
      if ($this->m->insert("tb_auth", $data)) {
        if ($this->m->SendEmailRegister($this->input->post('auth_email'), $tmppass))
          $this->session->set_flashdata('greenalert', 'Success add users');
        else
          $this->session->set_flashdata('redalert', 'Failed send email to users');
      } else
        $this->session->set_flashdata('redalert', 'Failed add users');
    }
    header('location:' . base_url("users"));
  }
  //delete recipe
  public function delete()
  {
    $auth_id = $this->input->post('auth_id');
    if (isset($auth_id) && !empty($auth_id)) {
      if ($this->m->delete("tb_auth", array("auth_id" => $auth_id))) {
        $this->m->DeletedFile($this->m->getUserBy($auth_id)->auth_image);
        $this->session->set_flashdata('greenalert', 'Success delete user');
      } else
        $this->session->set_flashdata('redalert', 'Failed delete user');
    } else
      $this->session->set_flashdata('redalert', 'Failed delete user');
    header('location:' . base_url("users"));
  }
}
