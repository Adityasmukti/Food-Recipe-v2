<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notfound extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->MRef->logged();
        $this->MRef->sessionstart();
    }
    //error 404 page
    public function index()
    {
        $this->load->view('notfound');
    }
}

/* End of file Notfound.php */
