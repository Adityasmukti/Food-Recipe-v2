<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MRecipe extends CI_Model
{
  private $tblrecipe, $tblrecipecat, $tblcategory;
  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    $this->tblrecipe = "tb_recipe";
    $this->tblrecipecat = "tb_recipe_category";
    $this->tblcategory = "tb_category";
  }

  public function getrecipe($category = "")
  {

    if (!empty($category))
      $this->db->where('B.category_id', $category);

    # code...
    $this->db->select('A.recipe_id, A.recipe_name, A.recipe_image, A.recipe_ingredient, A.recipe_instruction, D.category');
    $this->db->from($this->tblrecipe . ' A');
    $this->db->join($this->tblrecipecat . ' B', 'A.recipe_id = B.recipe_id ', 'inner');
    $this->db->join($this->tblcategory . ' C', 'B.category_id = C.category_id', 'inner');
    $this->db->join('(SELECT recipe_id, GROUP_CONCAT(category_name) category FROM ' . $this->tblrecipecat . ' A INNER JOIN ' . $this->tblcategory . ' B ON A.category_id = B.category_id GROUP BY A.recipe_id) D', 'A.recipe_id = D.recipe_id', 'inner');
    $this->db->group_by('`A`.`recipe_id`');
    return $this->db->get();
  }
  public function getrecipebyid($idrecipe)
  {
    $this->db->select('A.recipe_id, A.recipe_name, A.recipe_image, A.recipe_ingredient, A.recipe_instruction, D.category');
    $this->db->from($this->tblrecipe . ' A');
    $this->db->join($this->tblrecipecat . ' B', 'A.recipe_id = B.recipe_id ', 'inner');
    $this->db->join($this->tblcategory . ' C', 'B.category_id = C.category_id', 'inner');
    $this->db->join('(SELECT recipe_id, GROUP_CONCAT(category_name) category FROM ' . $this->tblrecipecat . ' A INNER JOIN ' . $this->tblcategory . ' B ON A.category_id = B.category_id GROUP BY A.recipe_id) D', 'A.recipe_id = D.recipe_id', 'inner');
    $this->db->where('A.recipe_id', $idrecipe);
    $this->db->group_by('`A`.`recipe_id`');
    $this->db->limit(1);
    return $this->db->get()->row();
  }
  public function getcategorybyidrecipe($idrecipe)
  {
    $this->db->where('recipe_id', $idrecipe);
    return $this->db->get($this->tblrecipecat)->result();
  }
  public function insertrecipe($data)
  {
    return $this->db->insert($this->tblrecipe, $data);
  }
  public function deleterecipe($idrecipe)
  {
    // $this->db->where('recipe_id', $idrecipe);
    $this->db->delete($this->tblrecipe, "recipe_id='$idrecipe'");
    return $this->db->delete($this->tblrecipecat, "recipe_id='$idrecipe'");    
  }
  public function updaterecipe($data, $idrecipe)
  {
    return $this->db->update($this->tblrecipe, $data, "recipe_id = '$idrecipe'");
  }
  public function insertrecipecat($data)
  {
    return $this->db->insert_batch($this->tblrecipecat, $data);
  }
  public function deleterecipecat($idrecipe)
  {
    return $this->db->delete($this->tblrecipecat, "recipe_id='$idrecipe'");
  }
}

/* End of file MRecipe.php */
