<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MAuth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->tabel = "tb_auth";
    }
    public function Verification($username, $password)
    {
        $password = base64_encode($password);
        $queri = "SELECT * FROM `$this->tabel` WHERE (`auth_user`='$username' OR `auth_email`='$username') AND `auth_pws`='$password' AND `auth_access`='ADMIN'";

        $result = $this->db->query($queri);
        if ($result->num_rows() > 0) {
            $token = $this->m->generatetoken($result->row()->auth_id);
            $array = array(
                'username' => $username,
                'auth_id' => $result->row()->auth_id,
                'login' => true,
                'token' => $token,
                'auth_name' => $result->row()->auth_name,
                'auth_image' => $result->row()->auth_image,
            );
            $this->session->set_userdata($array);
            return true;
        } else {
            return false;
        }
    }
    public function generatetoken($auth_id)
    {
        $token = hash('sha256', $auth_id . date("Ymdhis"));
        $this->db->update($this->tabel, array("auth_token" => $token), array('auth_id' => $auth_id));
        return $token;
    }
    public function tokendestroy()
    {
        $this->db->update($this->tabel, array("auth_token" => ""), array('auth_token' => $this->session->userdata('token')));
    }
    public function verify($token)
    {
        $this->db->update($this->tabel, array("auth_verify" => "Y", "auth_token" => ""), array('auth_token' => $token));
        return $this->db->affected_rows();
    }
    public function changepassword($token, $newpassword)
    {
        $this->db->update($this->tabel, array("auth_password" => base64_encode($newpassword), "auth_token" => ""), array('auth_token' => $token));
        return $this->db->affected_rows();
    }
}
