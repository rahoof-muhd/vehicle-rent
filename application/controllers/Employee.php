<?php

class Employee extends CI_Controller {

    public function index()
    {
        $this->load->library('session');
        $login_id = $this->session->userdata("login_id");
        if($login_id == ''){redirect("login");}
        $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
        $data['emp_type'] = $emp_type;
        $rental=$this->db->query("SELECT C.checkout_date,C.expected_checkin_date,S.customer_name,V.model,V.make,V.license_plate,I.checkin_id FROM checkout C LEFT OUTER JOIN customer S ON C.customer_id=S.customer_id LEFT OUTER JOIN vehicle V ON V.vehicle_id = C.vehicle_id LEFT OUTER JOIN checkin I ON I.checkout_id = C.checkout_id" )->result();
        foreach ($rental as $r) {
            $from_date =  date('Y-m-d', strtotime($r->checkout_date));
            $to_date =  date('Y-m-d', strtotime($r->expected_checkin_date));
            $datetime1 = new DateTime($from_date);
            $datetime2 = new DateTime($to_date);
            $interval = $datetime1->diff($datetime2);
            $r->date_difference =  $interval->days; 
            
        }
        $data['rental'] = $rental;
        $data['total_rental']   = count($rental);
        $avb_vehicles       = $this->db->query("SELECT vehicle_id FROM vehicle WHERE status = 'AVAILABLE'")->result();
        $data['available_vehicles'] = count($avb_vehicles);
        $upcoming_bookings      = $this->db->query("SELECT booking_id FROM booking WHERE status = '0'")->result();
        // echo '<pre>'; print_r($upcoming_bookings);
        $data["upcoming_bookings"] = count($upcoming_bookings);
        $total_customer   =$this->db->query("SELECT customer_id FROM customer")->result();
        $data["total_customer"] = count($total_customer);
        // echo  $data["upcoming_bookings"]; exit();
        // echo '<pre>'; print_r($rental); exit();
        
        $this->load->view("employee/employee_dashboard",$data);
       
    }
    public function list() {
        $this->load->library('session');
          $login_id = $this->session->userdata("login_id");
          $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
          $data['emp_type'] = $emp_type;
        $employees=$this->db->query("SELECT * FROM employee E LEFT OUTER JOIN login A ON A.login_id=E.login_id")->result();
        $data['employees']=$employees;
        $this->load->view("employee/emp_list",$data);
    }   
    function add(){
        $data["mode"]='add';
        $this->load->view("employee/emp_form",$data);
    }
    function edit($emp_id){
        $employees=$this->db->query("SELECT * FROM employee E LEFT OUTER JOIN adress A ON A.adress_id=E.adress_id LEFT OUTER JOIN login L ON L.login_id=E.login_id ")->result();
        // print_r($employees);
        $data["mode"]="edit";
        $data["employees"]=$employees;
        // echo '<pre>'; print_r($employees); exit();
        $this->load->view("employee/emp_form",$data);
    }


    
    public function process(){
        $data=$_POST;
        $mode=$data['mode']; 
        //insertion///////////////////////////////////////
        if($mode== 'add'){
        $login_array=[
            "email"=>$data['email'],
            "password"=>$data['password'],
            "type"=>'EMPLOYEE'
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
        $employee_array=[
            "emp_name"=>$data['fullname'],
            "login_id"=>$login_id,
            "DOB"=>$data['DOB'],
            "gender"=>$data['gender'],
            "phone_number"=>$data['phone_number'],
            "adress_id"=>$adress_id,
            "salary"=>$data['salary'],
            "salary_type" =>$data['salary_type'],
            "department"=>$data['department']
            
        ];
        $this->db->insert("employee",$employee_array);
        $result=$this->db->insert_id();
        if($result){ 
            // $this->load->view("employee/emp_list");
            redirect("employee/list");
        }
        //updation////////////////////////////////////
    }else{
        $login_id       =$data['login_id'];
        $address_id     =$data['address_id'];
        $emp_id         =$data['emp_id'];
        $login_array=[
            "email"=>$data['email'],
            "password"=>$data['password'],
            "type"=>'EMPLOYEE'
        ];
        $this->db->update("login",$login_array,array("login_id"=>$login_id));
        $adress_array=[
            "country"=>$data['country'],
            "state"=>$data['state'],
            "district"=>$data['district'],
            "zip_code"=>$data['zip_code'],
            "adress_number"=>$data['adress_number'],
            "street"=>$data['street']
        ];
        $this->db->update("adress",$adress_array,array('adress_id'=>$address_id));
        $employee_array=[
            "emp_name"=>$data['fullname'],
            "DOB"=>$data['DOB'],
            "gender"=>$data['gender'],
            "phone_number"=>$data['phone_number'],
            "salary"=>$data['salary'],
            "salary_type" =>$data['salary_type'],
            "department"=>$data['department']
            
        ];
        $this->db->update("employee",$employee_array,array('emp_id'=>$emp_id));

    


        }
            redirect("employee/list");
    }
    public function delete($emp_id){
        $this->db->where('emp_id',$emp_id);
        $query = $this->db->get('employee');
        $result = $query->row();
        

   
   $this->db->where('emp_id',$emp_id);

   $this->db->delete('employee');
   $results['status'] =1;
   $results['message']='delete';
   echo json_encode($results);
   }
      
    function block_unblock($login_id,$status){
        $login_array= [
            "verification_status"=>  $status
        ];
        $this->db->update("login",$login_array,array('login_id'=>$login_id));
        $result['status'] =1;
        $result['message']='Customer has been updated';
        echo json_encode($result);
        
    }
}
    
