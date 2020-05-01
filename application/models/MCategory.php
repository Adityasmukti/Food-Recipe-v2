<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MCategory extends CI_Model
{
  private $tblcategory;
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->tblcategory = "tb_category";
  }
  public function getcategory()
  {
    return $this->db->get($this->tblcategory)->result();
  }
  public function getcategorybyid($idcategory)
  {
    $this->db->where('category_id', $idcategory);
    return $this->db->get($this->tblcategory, 1)->row();
  }
  public function insertcategory($data)
  {
    return $this->db->insert($this->tblcategory, $data);
  }
  public function deletecategory($idcat)
  {
    return $this->db->delete($this->tblcategory, "category_id='$idcat'");
  }
  public function updatecategory($data, $idcat)
  {
    return $this->db->update($this->tblcategory, $data, "category_id = '$idcat'");
  }
}

/* End of file MCategory.php */
