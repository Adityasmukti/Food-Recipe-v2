<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MNotification extends CI_Model
{
  private $tblnotif;
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->tblnotif = "tb_notif";
  }
  public function getnotif()
  {
    return $this->db->get($this->tblnotif)->result();
  }
  public function getcanotifid($idnotif)
  {
    $this->db->where('notif_id', $idnotif);
    return $this->db->get($this->tblnotif, 1)->row();
  }
  public function insertnotif($data)
  {
    return $this->db->insert($this->tblnotif, $data);
  }
  public function deletenotif($idcat)
  {
    return $this->db->delete($this->tblnotif, "notif_id='$idcat'");
  }
  public function updatenotif($data, $idcat)
  {
    return $this->db->update($this->tblnotif, $data, "notif_id = '$idcat'");
  }
  // get fcm token
  function getfcmtoken()
  {
    $this->db->where("key", "fcmtoken");
    return $this->db->get("tb_settings")->row()->value;
  }
}

/* End of file MNotification.php */
