<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/customer_dash.css">
    <!-- <link rel="stylesheet" href="<?//php echo base_url()?>/assets/css/customer.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <?php $this->load->view("common/header") ?>
    <div class="main-container">
        <?php $this->load->view("common/leftbar") ?>
        <div class="rightbar">
            <div class="row" style="margin:0px !important">
                <!-- <div class="col-sm- filter-div"></div> -->
                <div class="col-sm-8 veh-div row">
                    <?php 
                    foreach($vehicle as $v){
                    //  for($i=1;$i<10;$i++){?>
                    <div class="col-12 col-lg-4">
                        <div class="veh-container" id="veh_container<?=$v->vehicle_id?>" onclick="select_vehicle(<?=$v->vehicle_id?>)">
                            <div class="top-div">
                            <div class="status-div">
                                <?php if($v->status == 'AVAILABLE'){$veh_status = "Available now";$clr ="#1e811e";$bg_clr = "#beffdde6"; }else{$veh_status = "Not available"; $clr = "#ff0000"; $bg_clr = "#ffc8bee6";} ?>
                                <div class="available-container" style="color:<?=$clr;?>;background-color:<?=$bg_clr;?>"><?=$veh_status?></div>
                                <svg onclick="favourite_list(this,<?=$v->vehicle_id?>)"  class="heart" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </div>
                            <div class="image-div">
                                <img style="height:150px" src="<?php echo base_url(); ?>upload/vehicles/<?=$v->vehicle_id?>.png" alt="">
                            </div>
                            <div class="veh-spec" >
                                <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/fuelgas.png" alt=""> <p><?=ucfirst($v->fuel_type)?></p></div>
                                <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/steering.png" alt=""><p><?=ucfirst($v->transmission_type)?></p> </div>
                                <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/seat.png" alt=""><p><?=$v->seating_capacity?></p></div>
                            </div>
                        </div>
                        <div class="">
                            <div class="line"></div>
                            <div class="bottom-div">
                                <h5 style="color:#535658;font-size:14px"><?=ucfirst($v->make )." ".ucfirst($v->model)?></h5>
                                <h5 style="color:#535658;font-size:16px">$<?=$v->daily_charge?>/ <small>day</small></h5>
                            </div>
                        </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="col-sm-4 last-div">
                    <!-- <label for="">Select a vehicle:</label>
                    <input id="vehicle_id" style="width: 250px;" /> -->
                    <!-- <div class="search_div"></div> -->
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
                    <div class="booking_vehicle">
                        <?php foreach($first_vehicle as $f) {?>
                        <h5 id="book_vehname" class="vehicle_name"><?=ucfirst($f->make )." ".ucfirst($f->model)?></h5>
                        <div class="image-div">
                            <img id="rent_vehicle" style="height:200px" src="<?php echo base_url(); ?>upload/vehicles/<?=$f->vehicle_id?>.png" alt="">
                        </div>
                        <div class="veh-spec" style="height:35px">
                            <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/fuelgas.png" alt=""> <p id="book_fuel"><?=$f->fuel_type?></p></div>
                            <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/steering.png" alt=""><p id="book_transmission"><?=$f->transmission_type?></p> </div>
                            <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/seat.png" alt=""><p id="book_seat"><?=$f->seating_capacity?></p></div>
                            <div class="spec-div"><img src="<?php echo base_url(); ?>assets/images/engine.png" alt=""><p id="book_engine"><?=$f->engine_capacity?> CC</p></div>
                        </div>
                        <div class="line"></div>
                        <!-- <div class="vehicle_name" id="book_vehname"><?//=ucfirst($f->make )." ".ucfirst($f->model)?></div> -->
                        <div class="row" style="padding:0 20px">
                            <div class="col-sm-6"><label class="labels" for="">From date</label><input type="date" name="book_from_date" id="book_from_date" oninput="update_bookingamount(this.value,0)"></div>
                            <div class="col-sm-6"><label class="labels">To date</label><input type="date" name="book_to_date" id="book_to_date" oninput="update_bookingamount(0,this.value)"></div>
                        </div>
                        <div class="rentamount-div " onclick="book_vehicle()">RENT NOW</div>
                        <input type="hidden" id="book_vehid">
                        <input type="hidden" name="" id="booking_day_price" value="">
                        <input type="hidden" name="total_price" id="total_price" value="">
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/kendo-ui-core/2024.1.119/js/kendo.all.min.js"></script>
        <script>
            // $(document).ready(function () {
            //     console.log("jQuery Version:", jQuery.fn.jquery);
            //     console.log("Kendo UI Loaded:", typeof kendo !== "undefined");
            //     if (typeof kendo === "undefined") {
            //         console.error("Kendo UI is not loaded!");
            //         return;
            //     }
            
            //     $("#vehicle_id").kendoDropDownList({
            //         dataSource: {
            //             transport: {
            //                 read: {
            //                     url: "<?//=base_url()?>customer/availabale_vehicles",
            //                     dataType: "json"
            //                 }
            //             }
            //         },
            //         dataTextField: "vehicle_name",
            //         dataValueField: "vehicle_id",
            //         optionLabel: "Select an option..."
            //     });
            // });
            function select_vehicle(i){
                let containers = document.querySelectorAll(".veh-container");
                containers.forEach(container => {
                    container.style.border = "none";
                });
                document.getElementById("veh_container"+i).style.border = "2px solid #395874 ";
                document.getElementById("rent_vehicle").src = "<?php echo base_url(); ?>upload/vehicles/"+i+".png"; 
                var path                = "<?= base_url(); ?>customer/select_vehicle/"+i;
                $.post(path,function(information){
                var data = JSON.parse(information);
                    console.log(data);
                    $('#book_vehname').html(data[0].make+" "+data[0].model);
                    $('#book_fuel').html(data[0].fuel_type);
                    $('#book_transmission').html(data[0].transmission_type);
                    $('#book_seat').html(data[0].seating_capacity);
                    $('#book_engine').html(data[0].engine_capacity +"CC");
                    $('#book_vehid').val(data[0].vehicle_id);
                    $('#booking_day_price').val(data[0].daily_charge);
                })
            }
            function favourite_list(element,i) {
                // alert(i)
                element.classList.toggle("filled");
            }
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
                // document.getElementById('book_price').innerHTML = '₹'+days_price;
                document.getElementById('total_price').value = days_price; 
            }
            function book_vehicle(){
                var from_date       = $('#book_from_date').val();
                var to_date         = $('#book_to_date').val();
                var new_from_date   = parseDate(from_date);
                var new_to_date     = parseDate(to_date);
                console.log(from_date,to_date);
                var diff            = (new_from_date.getTime() - new_to_date.getTime()) / (1000 * 60 * 60 * 24);
                console.log(diff);
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
        </script>
</body>
</html>