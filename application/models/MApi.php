<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MApi extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  // Recipe Function
  //=========================================================================
  // Get recipe data
  public function getRecipe($id, $category, $recipename, $ingredient, $instruction, &$rows, $start = 0, $limit = 10)
  {
    $queri = "SELECT `R`.`recipe_id`, `category`, `recipe_name`, `recipe_ingredient`, `recipe_instruction`, `recipe_image`, CONCAT('$this->pathrecipe', `recipe_image`) `image`, CONCAT('$this->pathrecipemedium', `recipe_image`) `imagemedium`, CONCAT('$this->pathrecipethumb', `recipe_image`) `imagethumb` FROM `$this->tblrecipe` `R` INNER JOIN `$this->tblrecipecat` `RC` ON `RC`.`recipe_id`=`R`.`recipe_id` INNER JOIN `$this->tblcategory` `CT` ON `CT`.`category_id`=`RC`.`category_id` INNER JOIN (SELECT `recipe_id`, GROUP_CONCAT(`category_name`) `category` FROM `$this->tblrecipecat` `A` INNER JOIN `$this->tblcategory` `B` ON `A`.`category_id` = `B`.`category_id` GROUP BY `A`.`recipe_id`) `C` ON `C`.`recipe_id` = `R`.`recipe_id` WHERE 1=1 " . (empty($id) ? "" : "AND `R`.`recipe_id` = " . $this->db->excape($id)) . (empty($recipename) ? "" : " AND `recipe_name` LIKE '%" . $this->db->escape_like_str($recipename) . "%' ") . (empty($ingredient) ? "" : " AND `recipe_ingredient` LIKE '%" . $this->db->escape_like_str($ingredient) . "%' ") . (empty($instruction) ? "" : " AND `recipe_instruction` LIKE '%" . $this->db->escape_like_str($instruction) . "%' ") . (empty($category) ? "" : " AND `category_name` LIKE '%" . $this->db->escape_like_str($category) . "%' ");
    $rows = $this->db->query($queri)->num_rows();
    return $this->db->query($queri . " ORDER BY `recipe_name` ASC LIMIT " . $this->db->escape_str($start) . ", " . $this->db->escape_str($limit) . ";")->result();
  }

  // Category Function
  //=========================================================================
  // Get Category data
  public function getCategory(&$rows, $start = 0, $limit = 10)
  {
    $queri = "SELECT `C`.`category_id`, `category_name`, `recipe_image` `category_image`, CONCAT('$this->pathrecipe', `recipe_image`) `image`, CONCAT('$this->pathrecipemedium', `recipe_image`) `imagemedium`, CONCAT('$this->pathrecipethumb', `recipe_image`) `imagethumb` FROM `tb_category` `C` LEFT JOIN(SELECT `RC`.`category_id`, `R`.`recipe_image` FROM `tb_recipe_category` `RC`  LEFT JOIN `tb_recipe` `R` ON `R`.`recipe_id`=`RC`.`recipe_id` WHERE `R`.`recipe_image` <>'' ORDER BY RAND())`RC` ON `RC`.`category_id`=`C`.`category_id` GROUP BY `C`.`category_id` ";
    $rows = $this->db->query($queri)->num_rows();
    return $this->db->query($queri . "ORDER BY `category_name` ASC LIMIT " . $this->db->escape_str($start) . ", " . $this->db->escape_str($limit) . ";")->result();
  }

  // Auth Function
  //=========================================================================
  // Login 
  public function login($u, $p)
  {
    $this->db->where("(auth_user=" . $this->db->escape($u) . " OR auth_email=" . $this->db->escape($u) . ") ");
    $this->db->where("auth_pws", md5($this->db->escape($p)));
    $result = $this->db->get($this->tblauth, 1);
    if ($result->num_rows() > 0) {
      $data = array(
        "rows" => $result->num_rows(),
        "auth_id" => $result->row()->auth_id,
        "auth_name" => $result->row()->auth_name,
        "auth_access" => $result->row()->auth_access,
        "auth_user" => $result->row()->auth_user,
        "auth_token" => $result->row()->auth_token,
        "auth_email" => $result->row()->auth_email,
        "auth_verify" => $result->row()->auth_verify,
        "auth_image" => $result->row()->auth_image,
        "imagethumb" => empty($result->row()->auth_image) ? "" : $this->pathpemain . $result->row()->auth_image,
        "imagemedium" => empty($result->row()->auth_image) ? "" : $this->pathpemain . $result->row()->auth_image,
        "imageoriginal" => empty($result->row()->auth_image) ? "" : $this->pathpemain . $result->row()->auth_image,
      );
    } else $data["rows"] = 0;
    return $data;
  }

  //Cek user
  public function cekuser($field, $value)
  {
    return $this->db->get_where($this->tblauth, array($field => $value), 1)->num_rows() == 0 ? true : false;
  }

  // Generate kode Username
  public function KodeUser()
  {
    $this->load->model('MRef', 'r');
    return $this->r->GenerateKode("US", $this->tblauth, "auth_id");
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

  // File Function
  // Upload image    
  public function UploadImage($path, $filename, &$newfilename)
  {
    $this->load->library('upload');
    $config['upload_path'] = $path; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload($filename)) {
      $gbr = $this->upload->data();
      $newfilename = $gbr['file_name'];
      return "";
    } else {
      $newfilename = "";
      return $this->upload->display_errors();
    }
  }

  // Delete image
  public function deletedFile($pathfilename)
  {
    try {
      if (!empty($pathfilename)) {
        if (file_exists($pathfilename))
          unlink($pathfilename);
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

  // Sending email to user
  function SendEmail($email, $subject, $message)
  {
    // Load PHPMailer library
    $this->load->library('phpmailer_lib');
    // PHPMailer object
    $mail = $this->phpmailer_lib->load();
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host     = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'afoodrecipe@gmail.com';
    $mail->Password = 'AAY0S7yQ8ZSNT6hSXi';
    $mail->SMTPSecure = 'ssl';
    $mail->Port     = 465;
    //set from
    $mail->setFrom('info@foodrecipe.com', 'Food Recipe');
    $mail->addReplyTo('info@foodrecipe.com', 'Food Recipe');
    // Add a recipient
    $mail->addAddress($email);
    // Email subject
    $mail->Subject = $subject;
    // Set email format to HTML
    $mail->isHTML(true);
    // Email body content
    $mail->Body = $message;
    // Send email
    return $mail->send();
  }
}

/* End of file MApi.php */
