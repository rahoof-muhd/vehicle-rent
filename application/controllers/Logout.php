<?php

class Logout extends CI_Controller{
    public function index(){
        $this->load->library('session');
        $this->session->unset_userdata("login_id");
        $result['status']       = 1;
        echo json_encode ($result);
    }

}
?>