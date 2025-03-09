<?php


class Login extends CI_Controller {

	public function index()
	{
		$this->load->view("login");
	}
	public function process(){
		$this->load->library('session');
		$data = $_POST;
		$password = $data['password'];
		$email=$data['email'];
	
		 $result =$this->db->query("SELECT * FROM login WHERE email= '$email'")->result();
		 $obj = '';
		 if(!empty ($result) )
		 {
			foreach ($result as $row)
			{
				$obj = $row;
			}
		 }
		 $db_password = $obj->password;
		 $type = $obj->type;
		 $login_email = $obj->email;
		 $login_id = $obj->login_id;
		 $verify= $obj->verification_status;
		if ($password == $db_password ) {
			if($verify!=0){
			$session_array =[
				'login_id'		=>$login_id,
				'login_email'	=>$login_email
			];
			// $employee_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
			// print_r($session_array);exit();
			
			$this->session->set_userdata($session_array);
			if($type =='CUSTOMER'){
				redirect('customer/dashboard',$data);
			}else{
				redirect('employee');
			}
		}else{
			echo "Blocked";
		}
	} else {
   		 echo "Invalid username or password";
		}
	}
}

