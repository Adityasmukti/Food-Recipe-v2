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
        $data = array();
        $this->load->view('recipe/view', $data, FALSE);
    }

    //detail recipe
    public function detail($recipeid)
    {
        $data = array();
        $this->load->view('recipe/detail', $data, FALSE);
    }

    //edit recipe
    public function edit($recipeid)
    {
        $data = array();
        $this->load->view('recipe/edit', $data, FALSE);
    }

    public function editaction()
    {
    }

    //add new recipe
    public function add()
    {
        $data = array();
        $this->load->view('recipe/edit', $data, FALSE);
    }

    
}
/* End of file Recipe.php */
