<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| API Controller
| -------------------------------------------------------------------
| This file will contain api rest server
|
 */
require APPPATH . 'libraries/REST_Controller.php';
class Users extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MApi', 'm');
  }

  public function index_get()
  {
    try {
      $user_id = $this->get('user_id');
      if (!isset($user_id) || empty($user_id))
        throw new Exception("User id is empty!", 1);

      $data = array(
        "status" => TRUE,
        "message" => "",
        "result" =>  $this->m->getUserBy(isset($user_id) ? $user_id : "")
      );
      $this->response($data, REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_post()
  {
    try {
      if (!$this->m->cek_akun('tb_auth', array("auth_email" => $this->post("auth_email")))) {
        $tmppass = $this->m->GeneratePassword();
        $data = array(
          "auth_access" => "USER",
          "auth_fullname" => $this->post('auth_fullname'),
          "auth_email" => $this->post('auth_email'),
          "auth_pws" => SHA1($tmppass),
          "auth_create" => date("Y-m-d H:i:s"),
          "auth_image" => "default.png"
        );

        if ($this->m->insert("tb_auth", $data)) {
          if ($this->m->SendEmailRegister($this->post('auth_email'), $tmppass))
            $this->response(array("status" => TRUE, "message" => "Success users registered", "result" => $data), REST_Controller::HTTP_OK);
          else
            $this->response(array("status" => FALSE, "message" => "Failed send email to user", "result" => ""), REST_Controller::HTTP_OK);
        }
        $this->response(array("status" => FALSE, "message" => "Register user failed", "result" => ""), REST_Controller::HTTP_OK);
      }
      $this->response(array("status" => FALSE, "message" => "Email is exist!", "result" => ""), REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_delete()
  {
    $this->response(array("status" => FALSE, "message" => "Unknown method", "result" => ""), REST_Controller::HTTP_METHOD_NOT_ALLOWED);
  }

  public function index_put()
  {
    try {
      $auth_id = $this->put("auth_id");
      if (!isset($auth_id))
        throw new Exception("Id User not found!");

      if (!$this->m->getUserBy($auth_id))
        throw new Exception("User not found!");

      $data = array(
        "auth_fullname" => $this->put('auth_fullname'),
        "auth_email" => $this->put('auth_email'),
      );

      if ($this->m->update("tb_auth", array("auth_id" => $auth_id), $data)) {
        $this->response(array("status" => TRUE, "message" => "Save Successful", "result" => $this->m->getUserBy($auth_id)), REST_Controller::HTTP_OK);
      }
      $this->response(array("status" => FALSE, "message" => "Save failed", "result" => ""), REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function updatepassword_put()
  {
    try {
      $auth_id = $this->put("auth_id");
      if (!isset($auth_id) || empty($auth_id))
        throw new Exception("Id User not found!");

      if (!$this->m->getUserBy($auth_id))
        throw new Exception("User not found!");

      $auth_pws = $this->put('auth_pws');
      if (!isset($auth_pws) || empty($auth_pws))
        throw new Exception("Password empty!");

      $data = array(
        "auth_pws" => SHA1($auth_pws)
      );

      if ($this->m->update("tb_auth", array("auth_id" => $auth_id), $data)) {
        $this->response(array("status" => TRUE, "message" => "Save Successful", "result" => $this->m->getUserBy($auth_id)), REST_Controller::HTTP_OK);
      }
      $this->response(array("status" => FALSE, "message" => "Save failed", "result" => ""), REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function updatephoto_post()
  {
    try {
      $auth_id = $this->post("auth_id");
      $rows = $this->m->getUserBy($auth_id);
      if (!$rows)
        throw new Exception("User not found!");

      $data = array(
        "auth_image" => $rows->auth_image,
      );

      if (!isset($_FILES["auth_image"]) || empty($_FILES["auth_image"]))
        throw new Exception("Image not found!");

      if (!empty($_FILES["auth_image"]["name"]))
        $data["auth_image"] = $this->m->UploadImageUser();

      if ($this->m->update("tb_auth", array("auth_id" => $auth_id), $data)) {
        if (!empty($rows->auth_image))
          $this->m->deletedFile($rows->auth_image);
        $this->response(array("status" => TRUE, "message" => "Save Successful", "result" => $this->m->getUserBy($auth_id)), REST_Controller::HTTP_OK);
      }
      $this->response(array("status" => FALSE, "message" => "Save failed", "result" => ""), REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function forgotpass_post()
  {
    try {
      $auth_email = $this->post("auth_email");
      $rows = $this->m->getUserByEmail($auth_email);
      if (!$rows)
        throw new Exception("Email not found!");
      $tmppass = $this->m->GeneratePassword();
      $data = array(
        "auth_pws" => SHA1($tmppass)
      );

      if ($this->m->update("tb_auth", array("auth_email" => $auth_email), $data)) {
        $error = "";
        if ($this->m->SendEmailForgot($this->post("auth_email"), $tmppass, $error)) // send email after save
          $this->response(array("status" => true, "message" => "Password Send", "result" => ""), REST_Controller::HTTP_OK, false);
        $this->response(array("status" => false, "message" => "Failed Send Email", "result" => $error), REST_Controller::HTTP_OK, false);
      }
      $this->response(array("status" => FALSE, "message" => "Failed Save", "result" => ""), REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}
