<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MApp extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->load->library('upload');
  }
  //insert
  public function select($table, $where = "")
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

  // Upload Image    
  public function UploadImage($filename, &$newfilename)
  {
    $config['upload_path'] = './upload/img/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
    $this->upload->initialize($config);
    if ($this->upload->do_upload($filename)) {
      $gbr = $this->upload->data();
      $this->image_lib->initialize(array(
        'image_library' => 'gd2',
        'source_image' => './upload/img/' . $gbr['file_name'],
        'maintain_ratio' => true,
        'create_thumb' => false,
        'quality' => '50%',
        'new_image' => './upload/img/thumb/' . $gbr['file_name'],
        'width' => 150,
      ));
      $this->image_lib->resize();
      $newfilename = $gbr['file_name'];
      return "";
    } else {
      $newfilename = "";
      return $this->upload->display_errors();
    }
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
        $file = './upload/img/thumb/' . $filename;
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
  ///=======================================================================================================


  ///=======================================================================================================
  /// Login
  ///=======================================================================================================

  ///=======================================================================================================


  ///=======================================================================================================
  /// Notification
  ///=======================================================================================================

  ///=======================================================================================================


  ///=======================================================================================================
  /// Recipe
  ///=======================================================================================================

  ///=======================================================================================================


  ///=======================================================================================================
  /// Setting
  ///=======================================================================================================

  ///=======================================================================================================


  ///=======================================================================================================
  /// User
  ///=======================================================================================================
  public function SendEmailForgotPass($email)
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
    $config['newline'] = "\r\n"; //use double quotes
    $this->email->initialize($config);
    /*-----------email body ends-----------*/
    $this->email->from($senderemail, $sendername); //sender's email
    $this->email->to($email);
    $this->email->subject($subject);
    $this->email->message($message);
    return $this->email->send();
  }
  ///=======================================================================================================

}
