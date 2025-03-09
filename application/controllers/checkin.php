<?php

class checkin extends CI_Controller{
  public function index(){
    $this->load->library('session');
    $login_id = $this->session->userdata("login_id");
    if($login_id == ''){redirect("login");}
    $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
    $data['emp_type'] = $emp_type;
    $checkin=$this->db->query("SELECT I.*,S.customer_name,V.model,V.make,V.license_plate,C.checkout_date FROM checkin I JOIN checkout C ON C.checkout_id=I.checkout_id JOIN customer S ON C.customer_id=S.customer_id JOIN vehicle V ON V.vehicle_id = C.vehicle_id" )->result();
    // echo "<pre>";
    // print_r($checkin);exit();
    $data['checkin']=$checkin;
    $this->load->view("checkin/list", $data);
 
  }            
  public function add($checkout_id){  
    $checkin=$this->db->query("SELECT C.*,S.customer_name,V.model,V.make,V.license_plate,V.color,V.fuel_type FROM checkout C LEFT OUTER JOIN customer S ON S.customer_id=C.customer_id LEFT OUTER JOIN vehicle V ON V.vehicle_id=C.vehicle_id WHERE checkout_id=".$checkout_id)->result();
    $data["checkin"]=$checkin;
    $data["mode"]="add";
    $this->load->view("checkin/form",$data);
  }
  public function edit($checkin_id){
    $checkin=$this->db->query("SELECT I.*,C.customer_id,C.vehicle_id,S.customer_name,V.model,V.make,V.license_plate,V.color,V.fuel_type,C.checkout_date FROM checkin I LEFT OUTER JOIN checkout C ON I.checkout_id= C.checkout_id LEFT OUTER JOIN customer S ON S.customer_id=C.customer_id LEFT OUTER JOIN vehicle V ON V.vehicle_id=C.vehicle_id WHERE checkin_id=".$checkin_id)->result();
    $data['checkin']= $checkin;
    // echo '<pre>'; print_r($checkout); exit();
    $data["mode"]="edit";
    $this->load->view("checkin/form",$data);
  }
  public function delete($checkin_id){
    $this->db->where('checkin_id',$checkin_id);
    $query = $this->db->get('checkin');
    $result = $query->row();
    


$this->db->where('checkin_id',$checkin_id);

$this->db->delete('checkin');
$results['status'] =1;
$results['message']='delete';
echo json_encode($results);
}
  
  public function process(){
    $data=$_POST;
    // print_r($data);exit();
    $mode = $data["mode"];
    $checkin_id = $data["checkin_id"];
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
    
    $checkin=[
        "checkout_id"      =>$data['checkout_id'],
      
        "ordometer_in"    =>$data["ordometer_in"],
        "fuel_in"         =>$data["fuel_in"],
        "checkin_date" =>$checkin_datetime,
        "fixed_charge"    =>$data["fixed_charge"],
        "discount"        =>$data["discount"],
        "amount"          =>$data["fixed_charge"] - $data['discount'],
        "notes"           =>$data["notes"]
    ];
    $vehicle_array = [
      'status' =>'AVAILABLE'
    ];
    $this->db->update('vehicle',$vehicle_array,array('vehicle_id'=>$data['vehicle_id']));
    if($mode == 'add'){
      $this->db->insert("checkin",$checkin);
    }else{
      $this->db->update('checkin',$checkin,array('checkin_id'=>$checkin_id));
    }
    redirect("checkin");
  }
}



  
