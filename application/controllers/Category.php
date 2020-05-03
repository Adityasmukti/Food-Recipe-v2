<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('MApp', 'm');
    }

    // category main page
    public function index()
    {
        $data = array(
            "data" => $this->m->getCategory()->result()
        );
        $this->load->view('category/view', $data, FALSE);
    }

    //add category page
    public function add()
    {
        $this->load->view('category/add', FALSE);
    }
    public function addaction()
    {
        $data = array(
            "category_name" => $this->input->post('category_name'),
            "category_image" => $this->m->UploadImageCategory()
        );

        if ($this->m->insert("tb_category", $data))
            $this->session->set_flashdata('greenalert', 'Success add category');
        else
            $this->session->set_flashdata('redalert', 'Failed add category');
        header('location:' . base_url("category"));
    }

    //edit category page
    public function edit($category_id)
    {
        $data = array(
            "data" => $this->m->getCategoryBy($category_id)
        );
        $this->load->view('category/edit', $data, FALSE);
    }

    public function editaction()
    {
        $category_id = $this->input->post('category_id');
        $data = array(
            "category_name" => $this->input->post('category_name')
        );

        $deleteimage = false;
        if (!empty($_FILES["category_image"]["name"])) {
            $data["category_image"] = $this->m->UploadImageCategory();
            $deleteimage = true;
        } else {
            $data["category_image"] = $this->input->post('category_image_old');
        }
        $this->m->update("tb_category", array("category_id" => $category_id), $data);
        if ($deleteimage)
            $this->m->DeletedFile($this->input->post('category_image_old'));
        $this->session->set_flashdata('greenalert', 'Success edit recipe');
        header('location:' . base_url("category"));
    }

    //delete recipe
    public function delete()
    {
        $category_id = $this->input->post('category_id');
        if (isset($category_id) && !empty($category_id)) {
            if ($this->m->delete("tb_category", array("category_id" => $category_id))) {
                $this->m->DeletedFile($this->m->getCategoryBy($category_id)->category_image);
                $this->session->set_flashdata('greenalert', 'Success delete category');
            } else
                $this->session->set_flashdata('redalert', 'Failed delete category');
        } else
            $this->session->set_flashdata('redalert', 'Failed delete category');
        header('location:' . base_url("category"));
    }
}


/* End of file Category.php */
