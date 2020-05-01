<?php
defined('BASEPATH') or exit('No direct script access allowed');

require '././vendor/autoload.php';

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->MRef->logged();
        $this->MRef->sessionstart();
        $this->maintitle = "Notification - " . $this->session->userdata('appname');
        $this->pageheading = "Notification";
        $this->load->model('MNotification', 'm');
    }

    //notification FCM page
    public function index()
    {
        $data = [
            "title" => $this->maintitle,
            "pageheading" => $this->pageheading,
            "error" => false,
            "info" => false,
            "message" => ""
        ];

        $btn = $this->input->post('btn-save');
        if (isset($btn)) {
            $this->load->library('fcm');

            $this->fcm->setKey($this->m->getfcmtoken());
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
            $data["info"] = true;
            $r = json_decode($result);
            $data["message"] = "Notification successed send with Id Message " . ($r != null ? $r->message_id : "");
        }

        $this->load->view('notification', $data, FALSE);
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
