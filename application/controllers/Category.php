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
        $data = [
            "title" => $this->maintitle,
            "pageheading" => $this->pageheading,
            "state" => "Category Add",
            "edit" => false,
            "message" => "",
            "error" => false,
            "categoryid" => $this->MRef->GenerateKode("CT", "tb_category", "category_id"),
            "category_name" => "",
        ];

        $categorykode = $this->input->post('categorykode');
        if (isset($categorykode)) {
            $insertcategory = [
                "category_id" => $this->input->post('categorykode'),
                "category_name" => $this->input->post('categoryname'),
            ];
            if ($this->m->insertcategory($insertcategory)) {
                redirect('category', 'refresh');
            } else {
                $data["error"] = true;
                $data["message"] = "Error when saving";
                $data["category_name"] = $this->input->post('categoryname');
                $this->load->view('category/manage', $data, FALSE);
            }
            // echo json_encode(array("insertrecipe" => $insertrecipe, "insertrecipecat" => $insertrecipecat));

        } else {
            $this->load->view('category/manage', $data, FALSE);
        }
    }

    //edit category page
    public function edit($categoryid)
    {
        $category = $this->m->getcategorybyid(base64_decode(urldecode($categoryid)));
        $data = [
            "title" => $this->maintitle,
            "pageheading" => $this->pageheading,
            "state" => "Category Edit",
            "edit" => true,
            "message" => "",
            "error" => false,
            "categoryid" => $category->category_id,
            "category_name" => $category->category_name,
            "urlencode" => $categoryid
        ];

        $categorykode = $this->input->post('categorykode');
        if (isset($categorykode)) {
            $updatecategory = [
                "category_name" => $this->input->post('categoryname'),
            ];
            if ($this->m->updatecategory($updatecategory, $categorykode)) {
                redirect('category', 'refresh');
            } else {
                $data["error"] = true;
                $data["message"] = "Error when saving";
                $data["category_name"] = $this->input->post('categoryname');
                $this->load->view('category/manage', $data, FALSE);
            }
        } else {
            $this->load->view('category/manage', $data, FALSE);
        }
    }
}


/* End of file Category.php */
