<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| About Controller
| -------------------------------------------------------------------
| This file will contain controller of about this website
|
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|    ['maintitle']  construct for title page
|    ['pageheading']  construct page heading title for web page
|
 */
class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    // about page
    public function index()
    {
        $data = [
            "pageheading" => $this->pageheading,
        ];
        $this->load->view('about', $data, false);
    }
}

/* End of file About.php */
