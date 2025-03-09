<?php

class  replacement extends CI_controller{
    function index(){
        $this->load->library('session');
        $login_id = $this->session->userdata("login_id");
        if($login_id == ''){redirect("login");}
        $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
        $data['emp_type'] = $emp_type;
        $replacement=$this->db->query("SELECT R.*,V.make,V.model,H.make as old_make,H.model as old_model FROM replacement R LEFT OUTER JOIN checkout C ON R.checkout_id=C.checkout_id LEFT OUTER JOIN vehicle V ON V.vehicle_id=R.vehicle_id LEFT OUTER JOIN vehicle H ON H.vehicle_id=C.vehicle_id")->result();
        $data['replacement']=$replacement;
        // echo '<pre>';print_r($replacement);
        // exit();
        $this->load->view("replacement/list",$data);
    }
    function add($rental_id='',$vehicle_id='',$odometer='',$fuel_out=''){
        $rep_count  = $this->db->query("SELECT rep_id FROM replacement WHERE checkout_id=".$rental_id)->result();
        $count=count($rep_count);
        if($count>0){
            $results ['status'] = 1;
            $results['message']='Already Replaced';
            $results['icon'] = "warning";
        }else{
        $replacement_array = [
            'vehicle_id' =>$vehicle_id,
            'checkout_id'  =>$rental_id,
            'ordometer_out'   =>$odometer,
            'fuel_out'   =>$fuel_out,
        ];
        $this->db->insert('replacement',$replacement_array);
        $veh_array=['status'=>'INSERVICE'];
        $this->db->update("vehicle",$veh_array,array('vehicle_id'=>$vehicle_id));
        $results ['status'] = 1;
        $results['message']='replacement';
        $results['icon'] = "success";
    }
        echo json_encode($results);


    }
    function return($vehicle_id='',$rep_id=''){
        $result['status']=0;
        $result['message']="Replacement Return failed";
        if($vehicle_id!=''){
            $veh_array=['status'=>'AVAILABLE'];
        $this->db->update("vehicle",$veh_array,array('vehicle_id'=>$vehicle_id));
        $replacement_array=['expected_checkin_date'=>date('Y-m-d')];
        $this->db->update("replacement",$replacement_array,array('rep_id'=>$rep_id));
        $result['status']=1;
        $result['message']="Replacement Return Successfully";
    }
    echo json_encode($result);
}
}