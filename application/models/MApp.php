<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MApp extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('upload');
    $this->LoadSetting();
  }
  //insert
  public function select($table, $where)
  {
    foreach ($where as $key => $value) {
      $this->db->where($key, $value);
    }
    $this->db->get($table);
    return $this->db->affected_rows();
  }

  //insert
  public function insert($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }

  //delete
  public function delete($tabel, $id)
  {
    $del = false;
    foreach ($id as $key => $value) {
      $this->db->where($key, $value);
      $del = true;
    }
    if ($del) {
      $this->db->delete($tabel);
      return $this->db->affected_rows();
    }
    return 0;
  }

  //update 
  public function update($tabel, $id, $data)
  {
    $update = false;
    foreach ($id as $key => $value) {
      $this->db->where($key, $value);
      $update = true;
    }
    if ($update) {
      $this->db->update($tabel, $data);
      return $this->db->affected_rows();
    }
    return 0;
  }

  public function GeneratePassword()
  {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass);
  }

  public function DeletedFile($filename)
  {
    # code...
    try {
      if (!empty($filename)) {
        //code...
        $file = './upload/img/' . $filename;
        if (file_exists($file))
          unlink($file);
        return true;
      }
    } catch (\Throwable $th) {
    }
    return false;
  }

  ///=======================================================================================================
  /// Category
  ///=======================================================================================================
  public function getCategory()
  {
    $this->db->order_by('category_name', 'asc');
    return $this->db->get('tb_category');
  }
  public function getCategoryBy($category_id)
  {
    $this->db->where('category_id', $category_id);
    return $this->db->get('tb_category')->row();
  }
  // Upload Image    
  public function UploadImageCategory()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload("category_image")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }
  ///=======================================================================================================

  ///=======================================================================================================
  /// Recipe
  ///=======================================================================================================
  public function getRecipe($category_id)
  {
    if (!empty($category_id))
      $this->db->where('category_id', $category_id);
    $this->db->select('recipe_id, recipe_name, recipe_image, category');
    $this->db->from('tb_recipe');
    $this->db->join("tb_recipe_category", 'recipe_category_recipe=recipe_id', 'left');
    $this->db->join("tb_category", 'recipe_category_category=category_id', 'left');
    $this->db->join("(SELECT recipe_category_recipe, GROUP_CONCAT(category_name SEPARATOR ', ') category FROM tb_recipe_category LEFT JOIN tb_category ON recipe_category_category = category_id GROUP BY recipe_category_recipe) D", 'recipe_id = D.recipe_category_recipe', 'left');
    $this->db->group_by('recipe_id');
    return $this->db->get();
  }
  public function getRecipeBy($recipe_id)
  {
    $this->db->select('*');
    $this->db->from('tb_recipe');
    $this->db->where('recipe_id', $recipe_id);
    return $this->db->get();
  }
  public function getRecipeCategoryBy($recipe_id)
  {
    $this->db->select('*');
    $this->db->from('tb_recipe_category');
    $this->db->where('recipe_category_recipe', $recipe_id);
    return $this->db->get();
  }

  // Upload Image    
  public function UploadImageRecipe()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload("recipe_image")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }

  public function getIdRecipe()
  {
    $this->db->select('MAX(recipe_id) recipe_id');
    $this->db->from('tb_recipe');
    return $this->db->get()->row()->recipe_id;
  }
  ///=======================================================================================================


  ///=======================================================================================================
  /// Setting
  ///=======================================================================================================
  public function LoadSetting()
  {
    $queri = $this->db->get_where('tb_settings', array("setting_name" => "Application"))->result();
    $settings = array();
    foreach ($queri as $value) {
      $settings[$value->setting_value_name] = $value->setting_value_data;
    }
    $this->session->set_userdata($settings);
  }

  public function getSettings($setting)
  {
    $queri = $this->db->get_where('tb_settings', array("setting_name" => $setting))->result();
    $settings = array();
    foreach ($queri as $value) {
      $settings[$value->setting_value_name] = $value->setting_value_data;
    }
    return $settings;
  }

  public function setSettings($setting, $data)
  {
    foreach ($data as $key => $value) {
      $this->db->where("setting_name", $setting);
      $this->db->where("setting_value_name", $key);
      $this->db->update("tb_settings", array("setting_value_data" => $value));
    }
  }

  // Upload Image    
  public function UploadImageLogo()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload("logo")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }

  // Upload Image    
  public function UploadImageFavicon()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|ico'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload("favicon")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }
  ///=======================================================================================================


  ///=======================================================================================================
  /// User
  ///=======================================================================================================
  public function login($auth_email, $auth_pws)
  {
    $this->db->select("auth_id, auth_fullname, auth_image, auth_access, auth_email, auth_token, auth_create, auth_verify");
    $this->db->from("tb_auth");
    $this->db->where("auth_email", $auth_email);
    $this->db->where("auth_pws", SHA1($auth_pws));
    $this->db->where('auth_access', 'ADMIN');

    return $this->db->get();
  }

  public function SendEmailForgot($email, $password)
  {
    $loadsetting = $this->db->get_where('tb_settings', array("setting_name" => "Forgot Email"))->result();
    foreach ($loadsetting as $value) {
      switch ($value->setting_value_name) {
        case 'senderemail':
          $senderemail = $value->setting_value_data;
          break;
        case 'sendername':
          $sendername = $value->setting_value_data;
          break;
        case 'subject':
          $subject = $value->setting_value_data;
          break;
        case 'message':
          $message = $value->setting_value_data;
          break;
        default:
          $config[$value->setting_value_name] = $value->setting_value_data;
          break;
      }
    }

    $row = $this->db->get_where("tb_auth", array("auth_email" => $email))->row();
    $message = htmlspecialchars_decode($message);
    $message = str_replace("{NAME}", $row->auth_fullname, $message);
    $message = str_replace("{EMAIL}", $row->auth_email, $message);
    $message = str_replace("{PASSWORD}", $password, $message);

    $config['newline'] = "\r\n"; //use double quotes
    $this->email->initialize($config);
    /*-----------email body ends-----------*/
    $this->email->from($senderemail, $sendername); //sender's email
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
  }

  public function getUser($auth_acces, $auth_verify)
  {
    if (!empty($auth_acces))
      $this->db->where("auth_access", $auth_acces);
    if (!empty($auth_verify))
      $this->db->where("auth_verify", $auth_verify);
    $this->db->order_by('auth_access', 'asc');
    $this->db->order_by('auth_fullname', 'asc');
    return $this->db->get('tb_auth');
  }

  public function getUserBy($auth_id)
  {
    $this->db->where("auth_id", $auth_id);
    return $this->db->get('tb_auth');
  }

  public function getAccess()
  {
    $this->db->select('auth_access');
    $this->db->from('tb_auth');
    $this->db->group_by('auth_access');
    $this->db->order_by('auth_access', 'asc');
    return $this->db->get();
  }
  // Upload Image    
  public function UploadImageUsers()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload("auth_image")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }

  public function cekUsers($field, $value)
  {
    $this->db->where($field, $value);
    return $this->db->get('tb_auth')->num_rows() === 1;
  }

  public function SendEmailRegister($email, $password)
  {
    $loadsetting = $this->db->get_where('tb_settings', array("setting_name" => "Register Email"))->result();
    foreach ($loadsetting as $value) {
      switch ($value->setting_value_name) {
        case 'senderemail':
          $senderemail = $value->setting_value_data;
          break;
        case 'sendername':
          $sendername = $value->setting_value_data;
          break;
        case 'subject':
          $subject = $value->setting_value_data;
          break;
        case 'message':
          $message = $value->setting_value_data;
          break;
        default:
          $config[$value->setting_value_name] = $value->setting_value_data;
          break;
      }
    }

    $row = $this->db->get_where("tb_auth", array("auth_email" => $email))->row();
    $message = htmlspecialchars_decode($message);
    $message = str_replace("{NAME}", $row->auth_fullname, $message);
    $message = str_replace("{EMAIL}", $row->auth_email, $message);
    $message = str_replace("{PASSWORD}", $password, $message);

    $config['newline'] = "\r\n"; //use double quotes
    $this->email->initialize($config);
    /*-----------email body ends-----------*/
    $this->email->from($senderemail, $sendername); //sender's email
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
    //$error = $this->email->print_debugger();
  }
  ///=======================================================================================================

}
