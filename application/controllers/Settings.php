<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->MRef->logged();
    $this->MRef->sessionstart();
    $this->maintitle = "Settings - " . $this->session->userdata('appname');
    $this->pageheading = "Settings";
    $this->load->model('MSettings', 'm');
    $this->load->library('form_validation');
  }

  // setting page
  public function index()
  {
    $row = $this->m->getusers();
    $data = [
      "title" => $this->maintitle,
      "pageheading" => $this->pageheading,
      'action' => site_url('settings/update_action'),
      'auth_name' => set_value('auth_name', $row->auth_name),
      'auth_image' => set_value('auth_image', $row->auth_image),
      'auth_user' => set_value('auth_user', $row->auth_user),
      'auth_email' => set_value('auth_email', $row->auth_email),
      'password' => set_value("password", ""),
      'fcmtoken' => set_value('fcmtoken', $this->m->getfcmtoken()),
    ];
    $this->load->view('settings', $data, FALSE);
  }

  //update setting data
  public function update_action()
  {
    $this->_rules();
    if ($this->form_validation->run() == FALSE) {
      $this->index();
    } else {
      $data = array(
        'auth_name' => $this->input->post('auth_name', TRUE),
        'auth_user' => $this->input->post('auth_user', TRUE),
        'auth_email' => $this->input->post('auth_email', TRUE),
      );

      $pws = $this->input->post('password', TRUE);
      if (!empty($pws))
        $data["auth_pws"] = $pws;

      if (isset($_FILES["fileimage"])) {
        if ($_FILES["fileimage"]["error"] != 0) {
          //means there is no file uploaded
        } else {
          $newfilename = "";
          $filename = 'fileimage';
          $upload = $this->MRef->UploadImage($filename, $newfilename);
          if (!empty($upload)) {
            $this->session->set_flashdata('message', $upload);
            redirect(site_url('settings'));
          } else {
            $data["auth_image"] = $newfilename;
          }
        }
      }

      $this->m->updateuser($this->session->userdata('auth_id'), $data);
      $this->m->updatefcmtoken($this->input->post('fcmtoken', TRUE));

      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('settings'));
    }
  }
  //rule
  public function _rules()
  {
    $this->form_validation->set_rules('auth_name', 'Name', 'trim|required');
    $this->form_validation->set_rules('auth_image', 'Image', 'trim');
    $this->form_validation->set_rules('auth_user', 'Username', 'trim|required');
    $this->form_validation->set_rules('auth_email', 'Email', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim');
    $this->form_validation->set_rules('repeatpassword', 'Repeat Password', 'trim|matches[password]');
    $this->form_validation->set_rules('fcmtoken', 'FCM Token', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}


/* End of file Settings.php */
