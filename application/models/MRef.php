<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once FCPATH . 'vendor/autoload.php';
//include 'third_party/ImageResize.php';
//require_once BASEPATH . '/../vendor/gumlet/lib/ImageResize.php';
//use \Gumlet\ImageResize;
//include APPPATH . 'third_party/ImageResize.php';

class MRef extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('upload');
    }

    //insert
    public function select($table, $where = "")
    {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->get($table);
        return $this->db->affected_rows();
    }

    //insert
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    //delete
    public function delete($tabel, $id)
    {
        $del = false;
        foreach ($id as $key => $value) {
            $this->db->where($key, $value);
            $del = true;
        }
        if ($del) {
            $this->db->delete($tabel);
            return $this->db->affected_rows();
        }
        return 0;
    }

    //update 
    public function update($tabel, $id, $data)
    {
        $update = false;
        foreach ($id as $key => $value) {
            $this->db->where($key, $value);
            $update = true;
        }
        if ($update) {
            $this->db->update($tabel, $data);
            return $this->db->affected_rows();
        }
        return 0;
    }

    public function GeneratePassword()
    {
        $alphabet = '!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    public function GenerateKode($prefix, $tabel, $field)
    {
        $temprefix = $prefix . $this->GetEndIpAddress() . date("ymd");
        $postfix = "";
        $queri = "SELECT RIGHT(`$field`,4) `r` FROM `$tabel` WHERE LEFT(`$field`, 11) ='$temprefix' ORDER BY `$field` DESC LIMIT 1";
        $result = $this->db->query($queri);
        if ($result->num_rows() > 0)
            $postfix = $result->row()->r + 1;
        return $temprefix . $this->GeneratePostFix($postfix);
    }
    function GeneratePostFix($postfix)
    {
        if (strlen($postfix) == 0)
            $postfix = "0001";
        else if ($postfix == "9999") {
        } else if (strlen($postfix) < 4) {
            $panjang = strlen($postfix);
            for ($i = $panjang; $i < 4; $i++)
                $postfix = "0" . $postfix;
        }
        return $postfix;
    }
    public function GetEndIpAddress()
    {
        $array = explode(".", $this->get_client_ip());
        $tmpip = end($array);
        if (strlen($tmpip) < 3) {
            for ($i = strlen($tmpip); $i < 3; $i++)
                $tmpip = $tmpip . "0";
        }

        if (strlen($tmpip) == 3)
            return $tmpip;
        else
            return "000";
    }
    // Function to get the client IP address
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function SendEmail($email, $subject, $message)
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //'srv35.niagahoster.com';
        $config['smtp_port'] = '465'; //'587';//'465';
        $config['smtp_user'] = 'cianjurgo.noreplay@gmail.com'; //'noreplay@fajarms8.com';
        $config['smtp_pass'] = '4iyLyCQeH9v/yg29u4';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        /*-----------email body ends-----------*/
        $this->email->from('noreplay@fajarms8.com', 'Cianjur GO'); //sender's email
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }
    // Upload Image    
    public function UploadImage($filename, &$newfilename)
    {
        $config['upload_path'] = './upload/img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
        $this->upload->initialize($config);
        if ($this->upload->do_upload($filename)) {
            $gbr = $this->upload->data();
            $this->load->library('image_lib');
            $this->image_lib->initialize(array(
                'image_library' => 'gd2',
                'source_image' => './upload/img/' . $gbr['file_name'],
                'maintain_ratio' => true,
                'create_thumb' => false,
                'quality' => '80%',
                'width' => 600,
                'new_image' => './upload/img/medium/' . $gbr['file_name'],

            ));
            $this->image_lib->resize();
            $this->image_lib->initialize(array(
                'image_library' => 'gd2',
                'source_image' => './upload/img/' . $gbr['file_name'],
                'maintain_ratio' => true,
                'create_thumb' => false,
                'quality' => '50%',
                'new_image' => './upload/img/thumb/' . $gbr['file_name'],
                'width' => 150,
            ));
            $this->image_lib->resize();
            $newfilename = $gbr['file_name'];
            return "";
        } else {
            $newfilename = "";
            return $this->upload->display_errors();
        }
    }
    public function DeletedFile($filename)
    {
        # code...
        try {
            if (!empty($filename)) {
                //code...
                $file = './upload/img/' . $filename;
                if (file_exists($file))
                    unlink($file);
                $file = './upload/img/medium/' . $filename;
                if (file_exists($file))
                    unlink($file);
                $file = './upload/img/thumb/' . $filename;
                if (file_exists($file))
                    unlink($file);
                return true;
            }
        } catch (\Throwable $th) {
        }
        return false;
    }
    public function LoadCategory()
    {
        # code...
        $this->db->order_by('category_name', 'asc');
        return $this->db->get('tb_category')->result();
    }
    public function sessionstart()
    {
        if (empty($this->session->userdata('appname')))
            $this->session->set_userdata("appname", "Food Recipe");
    }
    public function logged()
    {
        $token = $this->session->userdata('token');
        if (isset($token)) {
            $queri = "SELECT `auth_id` FROM `tb_auth` WHERE `auth_token`='$token';";
            $result = $this->db->query($queri);
            if ($result->num_rows() == 0) {
                session_destroy();
                redirect('auth', 'refresh');
            }
        } else
            redirect('auth', 'refresh');
    }
    public function loggedauth()
    {
        $token = $this->session->userdata('token');
        if (isset($token)) {
            $queri = "SELECT `auth_id` FROM `tb_auth` WHERE `auth_token`='$token';";
            $result = $this->db->query($queri);
            if ($result->num_rows() > 0) {
                redirect('recipe', 'refresh');
            }
        }
    }
}
