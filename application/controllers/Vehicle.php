<?php
class Vehicle extends CI_controller {
     public function index()
     {
          $this->load->library('session');
          $login_id = $this->session->userdata("login_id");
          if($login_id == ''){redirect("login");}
          $emp_type = $this->db->query("SELECT type FROM login WHERE login_id =".$login_id)->row()->type;
          $data['emp_type'] = $emp_type;
      $vehicles = $this->db->query("SELECT * FROM vehicle")->result();
      $data['vehicles'] = $vehicles;
      // echo '<pre>'; print_r($vehicles);exit();
        $this->load->view('vehicle/list',$data);
     }
     public function add(){
          $data['mode']  = 'add';
          $this->load->view("vehicle/form",$data);

     }
     public function edit($vehicle_id){
          $vehicles = $this->db->query("SELECT * FROM vehicle WHERE vehicle_id=".$vehicle_id)->result();
          // print_r($vehicles);
          $data["mode"] = "edit";
          $data['vehicles'] = $vehicles;
          $this->load->view("vehicle/form",$data);
     }
     public function delete($vehicle_id){
          $this->db->where('vehicle_id',$vehicle_id);
          $query = $this->db->get('vehicle');
          $result = $query->row();
          

     
     $this->db->where('vehicle_id',$vehicle_id);

     $this->db->delete('vehicle');
     $results['status'] =1;
     $results['message']='dele';
     echo json_encode($result);
     }

     public function process(){
          $data=$_POST;
          $vehicle_id= $data['vehicle_id'];
          if($vehicle_id==''){
               $this->db->insert("vehicle",$data);
               $vehicle_id=$this->db->insert_id();
          }
          else{
               $this->db->update("vehicle",$data,array('vehicle_id'=>$vehicle_id));
          }
          $config['allowed_types']= '*';
          $config['max_size']     = '0';
          $config['overwrite']    = true;
          $config['upload_path']  = "./upload/vehicles/";
          if (!is_dir($config['upload_path'])) {
              mkdir($config['upload_path'], 0777, true);  
          }
          $this->load->library('upload');
          $_FILES['veh_img']['name'] = "$vehicle_id".'.png';
          $this->upload->initialize($config);
          $this->upload->do_upload('veh_img');
          redirect('vehicle');
      
     }
}