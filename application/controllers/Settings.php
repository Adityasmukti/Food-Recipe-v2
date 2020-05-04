<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
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

  // setting page
  public function index()
  {
    $this->application();
  }

  public function encode()
  {
    $result = $this->load->view('auth/emailverifikasi', null, true);
    var_dump(htmlspecialchars($result, ENT_QUOTES));
  }

  public function application()
  {
    $data = $this->m->getSettings("Application");
    $this->load->view('settings/application', $data, FALSE);
  }

  public function actionapplication()
  {

    $data = array(
      "name" => $this->input->post('name')
    );

    if (!empty($_FILES["logo"]["name"])) {
      $data["logo"] = $this->m->UploadImageLogo();
      $this->m->DeletedFile($this->input->post('logo_old'));
    }

    if (!empty($_FILES["favicon"]["name"])) {
      $data["favicon"] = $this->m->UploadImageFavicon();
      $this->m->DeletedFile($this->input->post('favicon_old'));
    }

    $this->m->setSettings("Application", $data);
    $this->session->set_flashdata('greenalert', 'Success save settings');
    header('location:' . base_url("settings/application"));
  }

  public function admin()
  {
    $data = $this->m->getSettings("Application");
    $this->load->view('settings/admin', $data, FALSE);
  }

  public function actionadmin()
  {
    $data = array(
      "appname" => $this->input->post('appname'),
      "copyright" => $this->input->post('copyright'),
      "version" => $this->input->post('version'),
      "about" => htmlentities($this->input->post('about'), ENT_QUOTES)
    );
    $this->m->setSettings("Application", $data);
    $this->session->set_flashdata('greenalert', 'Success save settings');
    header('location:' . base_url("settings/admin"));
  }

  public function fcm()
  {
    $data = $this->m->getSettings("Application");
    $this->load->view('settings/fcm', $data, FALSE);
  }

  public function actionfcm()
  {
    $data = array(
      "fcmtoken" => $this->input->post('fcmtoken'),
    );
    $this->m->setSettings("Application", $data);
    $this->session->set_flashdata('greenalert', 'Success save settings');
    header('location:' . base_url("settings/fcm"));
  }

  public function registeremail()
  {
    $data = $this->m->getSettings("Register Email");
    $this->load->view('settings/registeremail', $data, FALSE);
  }

  public function actionregisteremail()
  {
    $data = array(
      "protocol" => $this->input->post('protocol'),
      "smtp_host" => $this->input->post('smtp_host'),
      "smtp_port" => $this->input->post('smtp_port'),
      "smtp_user" => $this->input->post('smtp_user'),
      "smtp_pass" => $this->input->post('smtp_pass'),
      "senderemail" => $this->input->post('senderemail'),
      "sendername" => $this->input->post('sendername'),
      "subject" => $this->input->post('subject'),
      "message" => htmlentities($this->input->post('message'), ENT_QUOTES)
    );
    $this->m->setSettings("Register Email", $data);
    $this->session->set_flashdata('greenalert', 'Success save settings');
    header('location:' . base_url("settings/registeremail"));
  }

  public function forgotpassemail()
  {
    $data = $this->m->getSettings("Forgot Email");
    $this->load->view('settings/forgotpassemail', $data, FALSE);
  }

  public function actionforgotpassemail()
  {
    $data = array(
      "protocol" => $this->input->post('protocol'),
      "smtp_host" => $this->input->post('smtp_host'),
      "smtp_port" => $this->input->post('smtp_port'),
      "smtp_user" => $this->input->post('smtp_user'),
      "smtp_pass" => $this->input->post('smtp_pass'),
      "senderemail" => $this->input->post('senderemail'),
      "sendername" => $this->input->post('sendername'),
      "subject" => $this->input->post('subject'),
      "message" => htmlentities($this->input->post('message'), ENT_QUOTES)
    );
    $this->m->setSettings("Forgot Email", $data);
    $this->session->set_flashdata('greenalert', 'Success save settings');
    header('location:' . base_url("settings/forgotpassemail"));
  }
}
