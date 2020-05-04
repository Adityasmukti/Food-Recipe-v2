<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Recipe extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('MApi', 'm');
  }

  public function index_get()
  {
    try {
      $category_id = $this->get('category_id'); // category
      $recipe_name = $this->get('recipe_name'); //recipe name
      $recipe_ingredient = $this->get('recipe_ingredient'); //ingredient
      $recipe_instruction = $this->get('recipe_instruction'); //instruction
      $result = $this->m->getRecipe(isset($category_id) ? $category_id : "", isset($recipe_name) ? $recipe_name : "", isset($recipe_ingredient) ? $recipe_ingredient : "", isset($recipe_instruction) ? $recipe_instruction : "")->result();
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

  public function byid_get()
  {
    try {
      $recipe_id = $this->get('recipe_id'); // category
      $recipe = $this->m->getRecipeBy($recipe_id)->row();
      $category = $this->m->getRecipeCategoryBy($recipe_id)->result();
      $data = array(
        "status" => TRUE,
        "message" => "",
        "result" => array(
          "recipe" => $recipe,
          "category" => $category
        )
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
