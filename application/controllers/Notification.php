<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require '././vendor/autoload.php';

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('MApp', 'm');
        if ($this->session->userdata('logged_in') !== TRUE) {
          redirect('login');
        }
    }

    //notification FCM page
    public function index()
    {
        $this->load->view('notification', FALSE);
    }
    public function action()
    {
        $this->load->library('fcm');
        $this->fcm->setKey($this->session->userdata('fcmtoken'));
        $this->fcm->setTitle($this->input->post('notificationtitle'));
        $this->fcm->setMessage($this->input->post('notificationconten'));
        $this->fcm->setId('');
        $this->fcm->setIsBackground(false);
        // set payload as null
        $payload = array('notification' => '');
        $this->fcm->setPayload($payload);
        $this->fcm->setImage('');
        $json = $this->fcm->getPush();
        $result = $this->fcm->sendToTopic('global', $json);
        $r = json_decode($result);
        $this->session->set_flashdata('greenalert', "Notification successed send with Id Message " . ($r != null ? $r->message_id : ""));
        header('location:' . base_url("notification"));
    }


    //sending notif
    public function sendnotif()
    {
        $data = [
            "title" => "Send " . $this->maintitle,
            "pageheading" => "Send " . $this->pageheading,
            "error" => false,
            "info" => false,
            "message" => "",
        ];
        $this->load->view('notification/sendnotif', $data, FALSE);
    }
}

/* End of file Notification.php */
