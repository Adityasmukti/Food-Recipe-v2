<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Recipe extends CI_Controller
{
    var $maintitle, $pageheading;
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('MApp', 'm');
    }

    //recipe page
    public function index()
    {
        $category_id = $this->input->get("category_id");
        $data = array(
            "category" => $this->m->getCategory()->result(),
            "category_id" => $category_id,
            "data" => $this->m->getRecipe(isset($category_id))->result()
        );
        $this->load->view('recipe/view', $data, FALSE);
    }

    //detail recipe
    public function detail($recipe_id)
    {
        $data = array(
            "category" => $this->m->getCategory()->result(),
            "data" => $this->m->getRecipeBy(isset($recipe_id))->row(),
            "recipecategory" => $this->m->getRecipeCategoryBy($recipe_id)->result()
        );
        $this->load->view('recipe/detail', $data, FALSE);
    }

    //edit recipe
    public function edit($recipe_id)
    {
        $data = array(
            "data" => $this->m->getRecipeBy(isset($recipe_id))->result(),
            "category" => $this->m->getCategory()->result(),
            "recipecategory" => $this->m->getRecipeCategoryBy($recipe_id)->result()
        );
        $this->load->view('recipe/edit', $data, FALSE);
    }

    public function editaction()
    {
        $recipe_id = $this->input->post('recipe_id');
        $data = array(
            "recipe_name" => $this->input->post('recipe_name'),
            "recipe_ingredient" => $this->input->post('recipe_ingredient'),
            "recipe_instruction" => $this->input->post('recipe_instruction'),
        );

        if (!empty($_FILES["recipe_image"]["name"])) {
            $data["recipe_image"] = $this->m->UploadImageRecipe();
        } else {
            $data["recipe_image"] = $this->input->post('recipe_image_old');
        }
        $this->m->update("tb_recipe", array("recipe_id" => $recipe_id), $data);
        $this->m->delete("tb_recipe_category", array("recipe_category_recipe" => $recipe_id));
        foreach ($this->input->post("category") as $value) {
            $this->m->insert("tb_recipe_category", array("recipe_category_recipe" => $recipe_id, "recipe_category_category" => $value));
        }
        header('location:' . base_url("recipe"));
    }

    //add new recipe
    public function add()
    {
        $data = array(
            "category" => $this->m->getCategory()->result(),
        );
        $this->load->view('recipe/edit', $data, FALSE);
    }

    public function addaction()
    {
        header('location:' . base_url("recipe"));
    }
}
/* End of file Recipe.php */
