<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MApi extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  // CUD function
  //=========================================================================
  // Create data
  public function insert($table, $data)
  {
    $this->db->insert($table, $data);
    return $this->db->affected_rows();
  }

  // Update data
  public function update($tabel, $id, $data)
  {
    foreach ($id as $key => $value) {
      $this->db->where($key, $value);
    }
    $this->db->update($tabel, $data);
    return $this->db->affected_rows();
  }

  // Delete data
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

  // Other Function
  // Get Version of application
  public function getVersion()
  {
    $this->db->order_by('id', 'desc');
    return $this->db->get('version', 1)->result();
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

  // Recipe Function
  //=========================================================================
  // Get recipe data
  public function getRecipe($category_id, $recipe_name, $recipe_ingredient, $recipe_instruction)
  {
    if (!empty($category_id))
      $this->db->where('category_id', $category_id);
    if (!empty($recipe_name))
      $this->db->like('recipe_name', $recipe_name);
    if (!empty($recipe_ingredient))
      $this->db->like('recipe_ingredient', $recipe_ingredient);
    if (!empty($recipe_instruction))
      $this->db->like('recipe_instruction', $recipe_instruction);
    $this->db->select("recipe_id, recipe_name, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(recipe_image IS NULL OR recipe_image = '', 'default.png',recipe_image)) recipe_image_link, category, recipe_ingredient, recipe_instruction");
    $this->db->from('tb_recipe');
    $this->db->join("tb_recipe_category", 'recipe_category_recipe=recipe_id', 'left');
    $this->db->join("tb_category", 'recipe_category_category=category_id', 'left');
    $this->db->join("(SELECT recipe_category_recipe, GROUP_CONCAT(category_name SEPARATOR ', ') category FROM tb_recipe_category LEFT JOIN tb_category ON recipe_category_category = category_id GROUP BY recipe_category_recipe) D", 'recipe_id = D.recipe_category_recipe', 'left');
    $this->db->group_by('recipe_id');
    return $this->db->get();
  }

  public function getRecipeBy($recipe_id)
  {
    $this->db->select("recipe_id, recipe_name, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(recipe_image IS NULL OR recipe_image = '', 'default.png',recipe_image)) recipe_image_link, recipe_ingredient, recipe_instruction");
    $this->db->from('tb_recipe');
    $this->db->where('recipe_id', $recipe_id);
    return $this->db->get();
  }

  public function getRecipeCategoryBy($recipe_category_recipe)
  {
    $this->db->select("category_id, category_name, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(category_image IS NULL OR category_image = '', 'default.png',category_image)) category_image_link");
    $this->db->from("tb_recipe_category");
    $this->db->join('tb_category', 'tb_category.category_id = tb_recipe_category.recipe_category_category', 'left');
    $this->db->where("recipe_category_recipe", $recipe_category_recipe);
    return $this->db->get();
  }

  // Category Function
  //=========================================================================
  // Get Category data
  public function getCategory()
  {
    $this->db->select("category_id, category_name, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(category_image IS NULL OR category_image='', 'default.png', category_image)) category_image_link");
    $this->db->from('tb_category');
    return $this->db->get();
  }

  // Users Function
  //=========================================================================
  // login
  public function login($auth_email, $auth_pws)
  {
    $this->db->select("auth_id, auth_fullname, auth_email, auth_image, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", auth_image) auth_image");
    $this->db->from("tb_auth");
    $this->db->where('auth_email', $auth_email);
    $this->db->where('auth_pws', SHA1($auth_pws));
    $this->db->where('auth_access', "USER");

    return $this->db->get();
  }

  public function cek_akun($tabel, $data)
  {
    return $this->db->get_where($tabel, $data)->num_rows() > 0;
  }

  public function getUserBy($auth_id)
  {
    $this->db->select("auth_id, auth_fullname, auth_email, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(auth_image IS NULL OR auth_image='', 'default.png', auth_image)) auth_image");
    $this->db->from("tb_auth");
    $this->db->where("auth_id", $auth_id);
    return $this->db->get()->row();
  }

  public function getUserByEmail($auth_email)
  {
    $this->db->select("auth_id, auth_fullname, auth_email, CONCAT(" . $this->db->escape(base_url("upload/img/")) . ", IF(auth_image IS NULL OR auth_image='', 'default.png', auth_image)) auth_image");
    $this->db->from("tb_auth");
    $this->db->where("auth_email", $auth_email);
    return $this->db->get()->row();
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

  // Upload Image    
  public function UploadImageUser()
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['encrypt_name'] = TRUE;
    $this->upload->initialize($config);
    if ($this->upload->do_upload("auth_image")) {
      $gbr = $this->upload->data();
      return $gbr['file_name'];
    }
    return "default.png";
  }
}

/* End of file MApi.php */
