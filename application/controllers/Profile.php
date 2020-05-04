<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->model('MApp', 'm');
    if ($this->session->userdata('logged_in') !== TRUE) {
      redirect('login');
    }
  }

  //login page controller
  public function index()
  {
    $data = array("data" => $this->m->getUserBy($this->session->userdata('auth_id'))->row());
    $this->load->view('auth/profile', $data);
  }

  public function actionprofile()
  {
    $auth_id = $this->input->post('auth_id');
    $data["auth_fullname"] = $this->input->post('auth_fullname');

    $deleteimage = false;
    if (!empty($_FILES["auth_image"]["name"])) {
      $data["auth_image"] = $this->m->UploadImageUsers();
      $deleteimage = true;
    }

    $lanjut = true;
    $auth_pws = $this->input->post('auth_pws');
    if (isset($auth_pws) || !empty($auth_pws)) {
      if ($this->input->post('auth_pws2') === $auth_pws) {
        $data["auth_pws"] = SHA1($auth_pws);
      }
    }

    if ($lanjut) {
      $this->m->update("tb_auth", array("auth_id" => $auth_id), $data);
      if ($deleteimage)
        $this->m->DeletedFile($this->input->post('auth_image_old'));
      $this->session->set_flashdata('greenalert', 'Profile saved');
    } else
      $this->session->set_flashdata('redalert', "Password didn't match");

    header('location:' . base_url("profile"));
  }
}

/* End of file Account.php */
