<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MSettings extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  // get data by id
  function getfcmtoken()
  {
    $this->db->where("key", "fcmtoken");
    return $this->db->get("tb_settings")->row()->value;
  }

  //get users data row
  public function getusers()
  {
    $this->db->where("auth_id", $this->session->userdata('auth_id'));
    return $this->db->get("tb_auth")->row();
  }
  // update data
  function updatefcmtoken($token)
  {
    $this->db->where("key", "fcmtoken");
    $this->db->update("tb_settings", array("value" => $token));
  }

  // update data users
  function updateuser($id, $data)
  {
    $this->db->where("auth_id", $id);
    $this->db->update("tb_auth", $data);
  }
}

/* End of file MUsers.php */
/* Location: ./application/models/MUsers.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-11-29 12:43:05 */
/* http://harviacode.com */