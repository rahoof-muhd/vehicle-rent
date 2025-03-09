<?php


class Register extends CI_Controller {

	public function index()
	{
		$this->load->view("register");
	}
	public function process(){
		$data=$_POST;
		// print_r($data);
        $password   = $data['password'];
        $hashed_password    = password_hash($password, PASSWORD_DEFAULT);
        echo $hashed_password;
        $login_array=[
            "email"=>$data['email'],
            "password"=>$data['password'],
            "type"=>'CUSTOMER'
        ];
        $this->db->insert("login",$login_array);
        $login_id=$this->db->insert_id();
        $adress_array=[
            "country"=>$data['country'],
            "state"=>$data['state'],
            "district"=>$data['district'],
            "zip_code"=>$data['zip_code'],
            "adress_number"=>$data['adress_number'],
            "street"=>$data['street']
        ];
        $this->db->insert("adress",$adress_array);
        $adress_id=$this->db->insert_id();
        $customer_array=[
            "customer_name"=>$data['fullname'],
            "login_id"=>$login_id,
            "DOB"=>$data['DOB'],
            "gender"=>$data['gender'],
            "phone_number"=>$data['phone_number'],
            "driving_license"=>$data['driving_license'],
            "adress_id"=>$adress_id,
            
        ];
        $this->db->insert("customer",$customer_array);
        redirect("login");
	}
}
