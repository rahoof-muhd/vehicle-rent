<?php
 class Customer extends CI_Controller{
     public function index(){
        $this->load->library('session');
        $login_id = $this->session->userdata("login_id");
        if($login_id == ''){redirect("login");}
        $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
        $data['emp_type'] = $emp_type;
        $customers=$this->db->query("SELECT C.*,A.*,L.verification_status FROM customer C LEFT OUTER JOIN adress A ON A.adress_id=C.adress_id LEFT OUTER JOIN login L ON L.login_id = C.login_id")->result();
        $data['customers']=$customers;
        // echo '<pre>';
        // print_r($customers);
        // exit();
        $this->load->view("customer/list",$data);
     }
     public function dashboard()
     {
        $this->load->library('session');
        $login_id = $this->session->userdata("login_id");
        $customer_details   = $this->db->query("SELECT C.customer_name,C.customer_id FROM customer C LEFT OUTER JOIN login L ON L.login_id = C.login_id WHERE L.login_id=".$login_id)->result();
        foreach($customer_details as $c){
            $customer_id = $c->customer_id;
        }
        $booking=$this->db->query("SELECT B.*,V.make,V.model,V.daily_charge FROM booking B LEFT OUTER JOIN vehicle V ON V.vehicle_id=B.vehicle_id WHERE B.customer_id=".$customer_id)->result();
        $data["booking"]=$booking;
        $data['customer_details']   = $customer_details;
        $vehicle  =$this->db->query("SELECT V.make,V.model,V.vehicle_id,V.license_plate FROM vehicle V")->result();
            foreach($vehicle as $v){
                $v->vehicle_name   = $v->make." " .$v->model." " .$v->license_plate;
            }
        $data["vehicle"] = $vehicle;
        foreach($booking as $b){
            $from_date =  date('Y-m-d', strtotime($b->from_date));
            $to_date =  date('Y-m-d', strtotime($b->to_date));
            $datetime1 = new DateTime($from_date);
            $datetime2 = new DateTime($to_date);
            $interval = $datetime1->diff($datetime2);
            $date_difference =  $interval->days; 
            if($date_difference <= 0){
                $date_difference =1;
            } 
            // echo $date_difference; exit();
            $b->booking_amount = $date_difference * $b->daily_charge;
        }
        $data['min_vehicle_id'] = $this->db->query("SELECT MIN(vehicle_id) AS min_veh_id FROM vehicle")->row()->min_veh_id;
        // echo $data['min_vehicle_id']; exit();
        $booking_vehicle  =$this->db->query("SELECT V.* FROM vehicle V WHERE vehicle_id = ".$data['min_vehicle_id'])->result();
        foreach($booking_vehicle as $b){
            $data['booking_vehicle_name'] = $b->make . "" .$b->model;  
              }
              $data['booking_vehicles'] = $booking_vehicle;
        // echo '<pre>'; print_r($booking_vehicle); exit();
		$this->load->view("customer/dashboard",$data);

     }
     public function vehicle_availability(){
        $result['message']      = 'AVAILABLE';
        $result['status']       = 1;
        $vehicle_id             = $this->input->post('vehicle_id');
        $veh_status = $this->db->query("SELECT status FROM vehicle WHERE vehicle_id=".$vehicle_id)->row()->status;
        if($veh_status != 'AVAILABLE'){
            $result['message']      = 'NOT AVAILABLE';
            $result['status']       = 1;
            echo json_encode ($result);
            exit();
        }
        echo json_encode ($result);
     }
     function next_vehicle_copy($vehicle_id =0){
         $min_vehicle_id = $this->db->query("SELECT MIN(vehicle_id) AS max_veh_id FROM vehicle")->row()->max_veh_id;
         $max_vehicle_id = $this->db->query("SELECT MAX(vehicle_id) AS max_veh_id FROM vehicle")->row()->max_veh_id;
         if($vehicle_id==""){
            $vehicle_id=$min_vehicle_id;
         }
         $vehicle_id = $vehicle_id+1;
        for($i=$vehicle_id; $i<=$max_vehicle_id; $i++){
            $count = $this->db->query("SELECT vehicle_id FROM vehicle WHERE vehicle_id=".$vehicle_id)->result();            
            if($count == 0){
                $vehicle_id +=1;
            } else {
                // Exit the loop when the condition in the else block is met
                break;
            }
        }
        if($vehicle_id == $max_vehicle_id){
            $vehicle_id = $min_vehicle_id;
        }
        // echo 'vehicle'.$vehicle_id; exit();
        $result     = $this->db->query("SELECT * FROM vehicle WHERE vehicle_id = ".$vehicle_id)->result();
        // $vehicle_ids = $this->db->query("SELECT vehicle_id FROM vehicle ORDER BY vehicle_id ASC")->result();
        // for($i =1; $i<=$max_vehicle_id; $i++){
        //    echo $i; 
        // }
        // echo '<pre>'; print_r($vehicle_ids); exit();
        // print_r($result);
        echo json_encode($result);
     }
     function next_vehicle($vehicle_id =0){
        $min_vehicle_id = $this->db->query("SELECT MIN(vehicle_id) AS max_veh_id FROM vehicle")->row()->max_veh_id;
         $max_vehicle_id = $this->db->query("SELECT MAX(vehicle_id) AS max_veh_id FROM vehicle")->row()->max_veh_id;
         if($vehicle_id==""){
            $vehicle_id=$min_vehicle_id;
         }
         $vehicle_id = $vehicle_id+1;
         if($vehicle_id == $max_vehicle_id+1){
            $vehicle_id = $min_vehicle_id;
        }
        $result     = $this->db->query("SELECT * FROM vehicle WHERE vehicle_id = ".$vehicle_id)->result();
        echo json_encode($result);
     }
     function vehicle_booking(){
        $this->load->library('session');
        $result['message']      = 'Booked succesfully';
        $result['status']       = 1;
        $login_id = $this->session->userdata("login_id");
        $customer_id    = $this->db->query("SELECT C.customer_id FROM customer C WHERE C.login_id=".$login_id)->row()->customer_id;
        $from_date      = $this->input->post('book_from_date');
        $to_date        = $this->input->post('book_to_date');
        $vehicle_id     = $this->input->post('vehicle_book_id');
        $amount         = $this->input->post('total_price');
        $booking_array=[
            'customer_id'   =>$customer_id,
            'vehicle_id'    =>$vehicle_id,
            'from_date'     =>$from_date,
            'to_date'       =>$to_date,
            'status'        => '0',
            'amount'        => $amount,
        ];
        // echo '<pre>'; print_r($booking_array);
        $this->db->insert('booking',$booking_array);
        $veh_status = "RESERVED";
        $vehicle_array=[
            'status'=>$veh_status
        ];
        $this->db->update("vehicle",$vehicle_array,array('vehicle_id'=>$vehicle_id));
        echo json_encode ($result);
     }
     function replacement_request($booking_id){
        $booking_array= [
            "replacement_request"=>  1
        ];
        $this->db->update("booking",$booking_array,array('booking_id'=>$booking_id));
        $result['status'] =1;
        $result['message']='Your request was sent successfully';
        echo json_encode($result);
        

     }
    
 }