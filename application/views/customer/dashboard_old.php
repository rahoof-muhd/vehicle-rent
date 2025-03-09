<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Optionally, include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="padding:0px">
    <div class="main-container">
        <div class="row" style="margin-left:0px; margin-right:0px">
            <div class="col-sm-4 col-md-2 side-bar">
                <div class="logo-div">
                <img style="height: 70px" src="<?php echo base_url(); ?>/assets/images/car-logo1.png" alt="">

                    <h4><strong>RIDEONRENT</strong></h4>
                </div>
                <div class="side-image">
                    <img src="" alt="">
                </div>
            </div>
            <div class="col-sm-8 col-md-10 main-div">
                <div class="row">
                    <?php foreach($customer_details as $c) { ?>
                    <div class="col-sm-6">
                        <h5>Welcome, <?=ucfirst($c->customer_name)?> !</h5>
                        <p>Today is a great day for car rental service</p>
                    </div>
                    <div class="col-sm-6 notification">
                        <!-- <p><i style="font-size:20px" class="fa-regular fa-message " aria-hidden="true"></i></p>
                        <p><i style="font-size:20px" class="fa-regular fa-bell"></i></p> -->
                        <div onclick="logout()"><img style="margin-top:10px;height:30px" src="<?=base_url(); ?>/assets/images/logout.png" alt=""></div>
                        <div class="profile">
                            <img src="<?php echo base_url(); ?>/assets/images/profile.jpg" alt="">
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php foreach($booking_vehicles as $c) {?>
                <div class="row">
                    <div class="col-sm-3 ">

                        <div class="veh-spec">
                            <img style="height:7vh" src="<?php echo base_url(); ?>/assets/images/engin1.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Engine</h6>
                                <h5><strong id="veh_engine"><?=$c->engine_capacity?> CC</strong></h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/mileage.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Mileage</h6>
                                <h5><strong id="veh_mileage"><?=$c->mileage?> kmpl</strong></h5>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/truck.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Type</h6>
                                <h5><strong id="veh_type"><?=$c->vehicle_type?></strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/transmission.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Transmission</h6>
                                <h5><strong id="veh_transmission"><?=$c->transmission_type?></strong></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 3vh;padding-left: 15px;">
                    <div class="col-sm-8 veh-book" style="">
                        <div class="row">
                            <div class="col-sm-7 veh-book-img">
                                <h5 style="font-family: serif;margin-top: 1vh;"><strong id="book_veh_name1"><?=$booking_vehicle_name?></strong> </h5>
                                <div class="">
                                    <img id="vehicle-img" style="height:26vh" src="<?php echo base_url(); ?>upload/vehicles/<?=$min_vehicle_id?>.png" alt="">
                                </div>
                            </div>
                            <div class="col-sm-5 veh-book-spec">
                                <div class="veh-spec-det">
                                    <div class="spec-details" style="background-color:#57eb624a">
                                        <img style="height:6vh;" src="<?php echo base_url(); ?>/assets/images/color.png" alt="">
                                        <p id="veh-color"><?=$c->color?></p>
                                    </div>
                                    <div class="spec-details"  style="background-color:#ff450038">
                                    <img style="height:6vh" src="<?php echo base_url(); ?>/assets/images/seating.png" alt="">
                                    <p id="seating-capacity"><?=$c->seating_capacity?></p>
                                    </div>
                                </div>
                                <div class="veh-spec-det">
                                    <div class="spec-details" style="background-color:#ffe40024">
                                    <img style="height:6vh" src="<?php echo base_url(); ?>/assets/images/fuel.png" alt="">
                                    <p id="fuel-type"><?=$c->fuel_type?></p>
                                    </div>
                                    <div class="spec-details" style="background:none">
                                        <button onclick="next_vehicle()" class="nex-button">NEXT<i class="fa-solid fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                            <?php }?>
                    <div class="col-sm-4">
                        <div class="veh-available">
                            <h6 ><strong>Check Vehicle Availability</strong></h6>
                            <div class="row">
                                <div class="col-sm-12"><label class="labels" for="">Select vehicle</label>
                                    <form action="" id="veh_avb_form">
                                        <select name="vehicle_id" id="">
                                        <?php foreach($vehicle as $v) { ?>
                                            <option value="<?=$v->vehicle_id?>"><?=$v->vehicle_name?></option>
                                        <?php }?>
                                        </select>
                                    </form>
                                </div>
                                <div class="col-sm-6"><label class="labels" for="">From date</label><input type="date" name="" id="avb_from_date"></div>
                                <div class="col-sm-6"><label class="labels">To date</label><input type="date" name="" id="avb_to_date"></div>
                                <div class="col-sm-12 check-avb"><button onclick="check_veh_availability()" class="check-but">CHECK AVAILABILITY</button></div>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="row" style="margin-top: 3vh;padding-left: 15px;height: 27vh;">
                    <div class="col-sm-8 book-list">
                        <table class="veh-history-table">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Vehicle</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Replacement</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $slno =1; foreach($booking as $b){
                                        if($b->status == 1 ){
                                            $status = "ACCEPTED";
                                            $color  = "green";
                                        }else if($b->status == 2){
                                            $status = "REJECTED";
                                            $color = "red";
                                        }else{
                                            $status = "PENDING";
                                            $color = "blue";
                                        }
                                ?>
                                <tr>
                                    <td><?=$slno?></td>
                                    <td><?=ucfirst($b->make )." ".ucfirst($b->model)?></td>
                                    <td><?= date('d-m-Y', strtotime($b->from_date));?></td>
                                    <td><?= date('d-m-Y', strtotime($b->to_date));?></td>
                                    <td><?=$b->booking_amount?></td>
                                    <td style="color:<?=$color?>"><?=$status?></td>
                                    <td>
                                        <?php if($b->status==1 && $b->replacement_request==''){?>
                                    <button class="replacement" onclick="replacement(<?=$b->booking_id?>)">Replacement</button>
                                        <?php } ?>


             
                                    </td>
                                </tr>
                                <?php $slno ++; }?>
                            </tbody>
                        </table>
                    </div>

                   
                    <div class="col-sm-4 ">
                        <div class="last-div" style="padding:10px">
                            <form action="" id="veh_book_form">
                                <h6 id="book_veh_name"><?=$booking_vehicle_name?></h6>
                                <input type="hidden" value="<?=$min_vehicle_id?>" name="vehicle_book_id" id="veh_book_id">
                                <div class="row">
                                    <div class="col-sm-6"><label class="labels" for="">From date</label><input type="date" name="book_from_date" id="book_from_date" oninput="update_bookingamount(this.value,0)"></div>
                                    <div class="col-sm-6"><label class="labels">To date</label><input type="date" name="book_to_date" id="book_to_date" oninput="update_bookingamount(0,this.value)"></div>
                                </div>
                                <?php foreach($booking_vehicles as $c) {?>
                                <h5 style="text-align:right;margin-top:10px"><strong id="book_price">₹ <?=$c->daily_charge?></strong></h5>
                                <input type="hidden" name="" id="booking_day_price" value="<?=$c->daily_charge?>">
                                <input type="hidden" name="total_price" id="total_price" value="">
                                <?php }?>
                            </form>
                                <div class="" style="display:flex; justify-content:center">
                                    <button class="check-but" onclick="book_vehicle()">BOOK NOW</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script>
        function update_bookingamount(){
            var from_date       = $('#book_from_date').val();
            var to_date         = $('#book_to_date').val();
            var book_price      = $('#booking_day_price').val();
            let date1           = new Date(from_date);
            let date2           = new Date(to_date);
            let diff            = date2 - date1;
            let diff_days       = diff / (1000 * 60 * 60 * 24);
            if(isNaN(diff_days) || diff_days <= 0){
                diff_days = 1;
            }
            var days_price      = book_price * diff_days;
            document.getElementById('book_price').innerHTML = '₹'+days_price;
            document.getElementById('total_price').value = days_price; 
        }
        function check_veh_availability(){
            var from_date       = $('#avb_from_date').val();
            var to_date         = $('#avb_to_date').val();
            var new_from_date   = parseDate(from_date);
            var new_to_date     = parseDate(to_date);            
            var diff            = (new_from_date.getTime() - new_to_date.getTime()) / (1000 * 60 * 60 * 24);
            console.log(diff);
            if(diff >0){
                Swal.fire("To date must be greater than from date")
                error = 1;
                return false;
            }else{
                var form_data = $('#veh_avb_form').serialize();
                $.ajax({
                url: "<?= base_url(); ?>customer/vehicle_availability/",  // URL to send the request to
                type: "POST",  // HTTP method (POST)
                data: form_data,  // Data to send with the request
                success: function(result) {  // Callback function on success
                    var obj = JSON.parse(result);  // Parse the JSON response
                    if (obj.status == 1) {  // If status is 1, success
                        Swal.fire({
                            position: "top-end",
                            icon: "success",  // Use 'icon' instead of 'type' for SweetAlert2
                            title: obj.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {  // If status is not 1, error
                        swal(obj.message);  // Display error message
                    }
                },
                error: function(xhr, status, error) {  // Callback function for error
                console.log("AJAX Error: " + status + ": " + error);  // Log error if any
                }
                });
            }
        }
        function next_vehicle(){
            var vehicle_id          =document.getElementById('veh_book_id').value;
            var path                = "<?= base_url(); ?>customer/next_vehicle/"+vehicle_id;
            $.post(path,function(information){
            var data = JSON.parse(information);  
            console.log(data);
                              
            if (data && data.length > 0) {
                document.getElementById('book_veh_name').innerHTML = data[0].make+data[0].model;
                document.getElementById('veh-color').innerHTML =data[0].color;
                document.getElementById('seating-capacity').innerHTML =data[0].seating_capacity;
                document.getElementById('fuel-type').innerHTML = data[0].fuel_type;
                document.getElementById('veh_engine').innerHTML = data[0].engine_capacity+' CC';
                document.getElementById('veh_mileage').innerHTML = data[0].mileage+' kmpl';
                document.getElementById('veh_type').innerHTML = data[0].vehicle_type;
                document.getElementById('veh_transmission').innerHTML = data[0].transmission_type;
                document.getElementById('book_veh_name1').innerHTML = data[0].make+ data[0].model;
                document.getElementById('book_price').innerHTML = '₹'+data[0].daily_charge;
                document.getElementById('booking_day_price').value = data[0].daily_charge;    
                document.getElementById('veh_book_id').value = data[0].vehicle_id;    
                document.getElementById("vehicle-img").src = "<?php echo base_url(); ?>upload/vehicles/"+data[0].vehicle_id+".png";            
                }
            })
        }
        function parseDate(dateStr) {
                var parts = dateStr.split("-");
                return new Date(parts[2], parts[1] - 1, parts[0]);
            }
        function book_vehicle(){
            var from_date       = $('#book_from_date').val();
                var to_date         = $('#book_to_date').val();
                var new_from_date   = parseDate(from_date);
                var new_to_date     = parseDate(to_date);
                console.log(from_date,to_date);
                
                var diff            = (new_from_date.getTime() - new_to_date.getTime()) / (1000 * 60 * 60 * 24);
                console.log(diff);
                // return false;
                
                if(diff >0){
                    Swal.fire("To date must be greater than from date")
                    error = 1;
                    return false;
                }
                else if(from_date==''||to_date==''){
                    Swal.fire("Date can not be Empty");
                    return false;
                    
                }else{
            var form_data = $('#veh_book_form').serialize();
            console.log(form_data); 
            $.ajax({
            url: "<?= base_url(); ?>customer/vehicle_booking/",  
            type: "POST",  // HTTP method (POST)
            data: form_data,  // Data to send with the request
            success: function(result) {  // Callback function on success
                var obj = JSON.parse(result);  // Parse the JSON response

                if (obj.status == 1) {  // If status is 1, success
                    Swal.fire({
                        position: "top-end",
                        icon: "success",  // Use 'icon' instead of 'type' for SweetAlert2
                        title: obj.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {  // If status is not 1, error
                    swal(obj.message);  // Display error message
                }
            },
            error: function(xhr, status, error) {  // Callback function for error
                console.log("AJAX Error: " + status + ": " + error);  // Log error if any
            }
        });
            
          
        }
    }
        function replacement(booking_id){
       Swal.fire({
title: 'Proceed with Replacement',
text: 'Are you sure you want to proceed with the replacement',
icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
showCancelButton: true,
cancelButtonColor: '#ccc',
confirmButtonColor: '#d33',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {  // Use isConfirmed instead of result.value
$.post("<?= base_url(); ?>customer/replacement_request/" + booking_id + "/" + status, function(result) {
var obj = JSON.parse(result);
if (obj.status == 1) {
   Swal.fire({
       position: "top-end",
       icon: "success",  // 'type' is replaced with 'icon'
       title: obj.message,
       showConfirmButton: false,
       timer: 1500
   });
} else {
   Swal.fire({
       icon: 'error',  // Adding an error icon for failure
       title: obj.message
   });
}
});
}
});
   }

   function logout(){
    Swal.fire({
        title: 'Logout!',
        text: 'Do you want to logout ?',
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then((result) => {
        if (result.isConfirmed) {  
            $.post("<?= base_url(); ?>logout", function(result) {
            var obj = JSON.parse(result);
            if (obj.status == 1) {
                window.location.href = "<?= base_url(); ?>login";
            }
        });
        }
    });
}
        

       
   </script>
</body>
</html>