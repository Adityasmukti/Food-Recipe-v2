<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Category extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MApi', 'm');
  }

  public function index_get()
  {
    try {
      $result = $this->m->getCategory()->result();
      $data = array(
        "status" => TRUE,
        "message" => "",
        "result" => $result
      );
      $this->response($data, REST_Controller::HTTP_OK);
    } catch (Exception $e) {
      $this->response(array("status" => FALSE, "message" => $e->getMessage(), "result" => ""), REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_post()
  {
    $this->response(array("status" => FALSE, "message" => "Unknown method", "result" => ""), REST_Controller::HTTP_METHOD_NOT_ALLOWED);
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
