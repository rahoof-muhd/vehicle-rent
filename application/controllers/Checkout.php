<?php

class Checkout extends CI_Controller{
  public function index(){
    $this->load->library('session');
    $login_id = $this->session->userdata("login_id");
    if($login_id == ''){redirect("login");}
    $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
    $data['emp_type'] = $emp_type;
    $checkout=$this->db->query("SELECT C.*,S.customer_name,V.model,V.make,V.license_plate,P.checkin_id,B.replacement_request FROM checkout C LEFT OUTER JOIN customer S ON C.customer_id=S.customer_id LEFT OUTER JOIN vehicle V ON V.vehicle_id = C.vehicle_id LEFT OUTER JOIN checkin P ON P.checkout_id = C.checkout_id LEFT OUTER JOIN booking B ON B.booking_id = C.booking_id " )->result();
    foreach ($checkout as $c){
      $rep_count=$this->db->query("SELECT rep_id FROM replacement WHERE checkout_id=".$c->checkout_id)->result();
      $c->rep_count=count($rep_count);

    }
    // echo '<pre>'; print_r($checkout);exit();
    $data['checkout']=$checkout;
    $vehicle  =$this->db->query("SELECT V.make,V.model,V.vehicle_id,V.license_plate FROM vehicle V WHERE V.status = 'AVAILABLE'")->result();
    foreach($vehicle as $v){
      $v->vehicle_name   = $v->make." " .$v->model." " .$v->license_plate;
    }
    $data["vehicle"]=$vehicle;
    $this->load->view("checkout/list", $data);

  }
  
  
  public function add(){
    $data["mode"]="add";
    $vehicle  =$this->db->query("SELECT V.make,V.model,V.vehicle_id,V.license_plate FROM vehicle V WHERE V.status = 'AVAILABLE'")->result();
    foreach($vehicle as $v){
      $v->vehicle_name   = $v->make." " .$v->model." " .$v->license_plate;
    }
    $customer =$this->db->query("SELECT customer_name,customer_id FROM customer")->result();
    $data["customer"]=$customer;


  //  echo '<pre>'; print_r($customer);exit();
    $data["vehicle"]=$vehicle;
    $this->load->view("checkout/form",$data);
    
  }
  public function edit($checkout_id){
    $checkout=$this->db->query("SELECT * FROM checkout WHERE checkout_id=".$checkout_id)->result();
    foreach($checkout as $c){
      $vehicle_id = $c->vehicle_id;
    }
    $data['checkout']= $checkout;
    // echo '<pre>'; print_r($checkout); exit();
    $data["mode"]="edit";
    $vehicle  =$this->db->query("SELECT V.make,V.model,V.vehicle_id,V.license_plate FROM vehicle V WHERE V.status = 'AVAILABLE' UNION SELECT B.make,B.model,B.vehicle_id,B.license_plate FROM vehicle B WHERE B.vehicle_id =".$vehicle_id)->result();
    foreach($vehicle as $v){
      $v->vehicle_name   = $v->make." " .$v->model." " .$v->license_plate;
    }
    $customer =$this->db->query("SELECT customer_name,customer_id FROM customer")->result();
    $data["customer"]=$customer;
    $data["vehicle"]=$vehicle;
    $this->load->view("checkout/form",$data);
  }
  function make_from_booking($booking_id){
    $booking_details  = $this->db->query("SELECT * FROM booking WHERE booking_id=".$booking_id)->result();
    foreach($booking_details as $c){
      $vehicle_id = $c->vehicle_id;
    }
    $data["mode"]="makefrom_booking";
    $vehicle  =$this->db->query("SELECT V.make,V.model,V.vehicle_id,V.license_plate FROM vehicle V WHERE V.status = 'AVAILABLE' UNION SELECT B.make,B.model,B.vehicle_id,B.license_plate FROM vehicle B WHERE B.vehicle_id =".$vehicle_id)->result();
    foreach($vehicle as $v){
      $v->vehicle_name   = $v->make." " .$v->model." " .$v->license_plate;
    }
    $customer =$this->db->query("SELECT customer_name,customer_id FROM customer")->result();
    $data["booking_details"]=$booking_details;
    $data["customer"]=$customer;
    $data["vehicle"]=$vehicle;
    $this->load->view("checkout/form",$data);
    // echo '<pre>'; print_r($booking_details);
    
  }
    public function delete($checkout_id){
    $this->db->where('checkout_id',$checkout_id);
    $query = $this->db->get('checkout');
    $result = $query->row();
  


$this->db->where('checkout_id',$checkout_id);

$this->db->delete('checkout');
$results['status'] =1;
$results['message']='delete';
echo json_encode($results);
}
  public function process(){
    $data=$_POST;
    // echo '<pre>'; print_r($data); exit();
    $mode=$data['mode'];
    $checkout_id=$data['checkout_id'];
    // echo '<pre>'; print_r($data);exit();
    $checkout_date          = $data['checkout_date']?date('Y-m-d',strtotime($data['checkout_date'])):NULL;
    $checkout_time = isset($data['from_datetime']) ? $data['from_datetime'] : NULL;
    if ($checkout_date && $checkout_time) {
        $checkout_datetime = $checkout_date . ' ' . $checkout_time;
        $checkout_datetime = date('Y-m-d H:i:s', strtotime($checkout_datetime));
    } 
    else{
        $checkout_datetime = $checkout_date;
        $checkout_datetime = date('Y-m-d H:i:s', strtotime($checkout_datetime));
    }
    $expected_checkin_date          = $data['expected_checkin_date']?date('Y-m-d',strtotime($data['expected_checkin_date'])):NULL;
    $checkin_time = isset($data['to_datetime']) ? $data['to_datetime'] : NULL;
    if ($expected_checkin_date && $checkin_time) {
        $checkin_datetime = $expected_checkin_date . ' ' . $checkin_time;
        $checkin_datetime = date('Y-m-d H:i:s', strtotime($checkin_datetime));
    } 
    else{
        $checkin_datetime = $expected_checkin_date;
        $checkin_datetime = date('Y-m-d H:i:s', strtotime($checkin_datetime));
    }
    // echo $checkin_datetime .'<br>';
    // echo $checkout_datetime;
    // exit();
    $checkout=[
        "vehicle_id"      =>$data['vehicle_id'],
        "customer_id"     =>$data['customer_id'],
        "ordometer_out"   =>$data["ordometer_out"],
        "fuel_out"        =>$data["fuel_out"],
        "checkout_date"   =>$checkout_datetime,
        "expected_checkin_date" =>$checkin_datetime,
        "fixed_charge"    =>$data["fixed_charge"],
        "discount"        =>$data["discount"],
        "amount"          =>$data["fixed_charge"] - $data['discount'],
        "remark"          =>$data["remark"],
        "booking_id"      =>$data["booking_id"]
    ];
    $vehicle_array = [
      'status' =>'INSERVICE'
    ];
    $this->db->update('vehicle',$vehicle_array,array('vehicle_id'=>$data['vehicle_id']));
    // print_r($data);
    if($mode == 'add' || $mode == 'makefrom_booking' ){
      $this->db->insert("checkout", $checkout);
    }else{
      $this->db->update('checkout',$checkout,array('checkout_id'=>$checkout_id));
    }
    redirect("checkout");
  }
  function change_vehicle($vehicle_id){
    $result = $this->db->query("SELECT * FROM vehicle WHERE vehicle_id=".$vehicle_id)->result();
    echo json_encode($result);
  }
}



  