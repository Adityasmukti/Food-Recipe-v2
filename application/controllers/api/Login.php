<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Login extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MApi', 'm');
  }

  public function index_get()
  {
    $this->response(array("status" => FALSE, "message" => "Unknown method", "result" => ""), REST_Controller::HTTP_METHOD_NOT_ALLOWED);
  }

  public function index_post()
  {
    try {
      $auth_email = $this->post("auth_email"); //username
      $auth_pws = $this->post("auth_pws"); //password
      $data = array("status" => FALSE, "message" => "Email and password is empty!", "result" => "");
      if (isset($auth_email)) {
        if (!empty($auth_email)) {
          if (isset($auth_pws)) {
            if (!empty($auth_pws)) {
              $result = $this->m->login($auth_email, $auth_pws);
              if (!$result)
                throw new Exception("Database Error!");
              if ($result->num_rows() > 0) {
                $data["status"] = TRUE;
                $data["message"] = "Success";
                $data["result"] = $result->unbuffered_row('array');
                $this->response($data, REST_Controller::HTTP_OK);
              } else
                $data["message"] = "Your password is wrong!";
            } else $data["message"] = "Password empty!";
          }
        } else $data["message"] = "Username empty!";
      }
      $this->response($data, REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_put()
  {
    $this->response(array("status" => FALSE, "message" => "Unknown method", "result" => ""), REST_Controller::HTTP_METHOD_NOT_ALLOWED);
  }

  public function index_delete()
  {
    $this->response(array("status" => FALSE, "message" => "Unknown method", "result" => ""), REST_Controller::HTTP_METHOD_NOT_ALLOWED);
  }
}
/** End of file Api.php **/
