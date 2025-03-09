<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout List</title>
    
        </div>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <div class="main-container" style="">
    <?php $this->load->view("common/sidebar");?>
        <div class="right-container">
        <div class="header-class">
            <h2>Checkout List</h2>
            <a class="add-a" href="<?=base_url()?>checkout/add/"><button style="height:35px; font-weight:600" class="add-but"> + NEW CHECKOUT</button></a>
        </div>
        <table class="checkout-table">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Customer Name</th>
                    <th> Vehicle Name</th>
                    <th>license Plate</th>
                    <th>Checkout Date</th>
                    <th>Checkin Date</th>
                    <th>Odometer Out</th>
                    <th>Fuel Out</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno=1;
                 foreach($checkout as $c){
                    if($c->replacement_request ==1 && $c->rep_count==0){
                        $bg_color = '#e4ffef';
                        $color = '3d9151';
                    } else{
                        $bg_color   = 'white';
                        $color      = 'black';
                    }
                    ?>
                <tr style="background-color:<?=$bg_color?>; color:<?=$color?>">
                    <td><?=$sno?></td>
                    <td><?=$c->customer_name?></td>
                    <td><?=$c->make." ".$c->model?></td>
                    <td><?=$c->license_plate?></td>
                    <td><?=$c->checkout_date?></td>
                    <td><?=$c->expected_checkin_date?></td>
                    <td><?=$c->ordometer_out?></td>
                    <td><?=$c->fuel_out?></td>
                    <td><?=$c->amount?></td>
                    <td>
                    <?php if ($c->checkin_id == '') { ?>
                        <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$c->checkout_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$c->checkout_id?>">
                                <a href="#" class="dropdown-item" onclick="edit(<?=$c->checkout_id?>)">Edit</a>
                                <a href="#" class="dropdown-item" onclick="delete_item(<?=$c->checkout_id?>)">Delete</a>
                                <?php if ($c->checkin_id == '') { ?>
                                    <a href="#" class="dropdown-item" onclick="checkin(<?=$c->checkout_id?>)">Checkin</a>
                                <?php } ?>
                                <?php if ($c->replacement_request == 1) { ?>
                                    <a href="#" class="dropdown-item" onclick="replacement(<?=$c->checkout_id?>)" >Replacement</a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }else{?>
                        CHECKIN
                    <?php }?>
                    </td>
                </tr>
                <?php $sno++; } ?>
            </tbody>
        </table>
    </div>
    </div>

    <div id="replacement_modal" class="modal fade">
            <div class="modal-dialog modal-md" style="vertical-align: middle;">
                <div class="modal-content">
                    <div class="modal-body" style="padding:25px;">
                        <input type="hidden" name="" id="rental_id">
                    <div class="form-group">
                <label for="vehicle">Vehicle:</label>
                <select id="vehicle_id" name="vehicle_id" >
                    <?php foreach($vehicle as $v) { ?>
                        <option value="<?=$v->vehicle_id?>"><?=$v->vehicle_name?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                    <label for="odometer">Odometer Reading:</label>
                    <input type="text" id="odometer" name="ordometer_out" value="" placeholder="Enter Odometer Reading">
                </div>
                <div class="form-group">
                    <label for="odometer">Fuel reading:</label>
                    <input type="text" id="fuel_out" name="ordometer_out" value="" placeholder="Enter Odometer Reading">
                    </div>
                    <button type="button" class="button" style="margin-left: 80%;background-color: #0056b396;" onclick="replacement_submission()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function replacement(rental_id=0){
                $('#replacement_modal').modal('show');
                $('#rental_id').val(rental_id);
                
                                     
            }
        function edit(vehicle_id){
            window.location.href="<?=base_url()?>checkout/edit/" +vehicle_id;
        }
        function delete_item(checkout_id){
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>checkout/delete/"+checkout_id , function(result) {
                var obj = JSON.parse(result);
                if (obj.status == 1) {
                  
window.location.reload();
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
    function replacement_submission(){ 
        var rental_id=$('#rental_id').val();
        var vehicle_id=$('#vehicle_id').val();
        var fuel_out=$('#fuel_out').val();
        var odometer=$('#odometer').val();
        console.log(rental_id,vehicle_id,fuel_out,odometer);
    
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>replacement/add/"+ rental_id +"/"+vehicle_id+"/"+fuel_out+"/"+odometer , function(result) {
                var obj = JSON.parse(result);
                  if (obj.status == 1) {
                    Swal.fire({
                        position: "top-end",
                        icon: obj.icon,  // 'type' is replaced with 'icon'
                        title: obj.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
    // Reload the page after the timer is finished
    window.location.reload();
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
        function checkin(checkout_id){
            window.location.href="<?=base_url()?>checkin/add/" +checkout_id;
        }
    </script>
   <script>
        document.querySelectorAll('.dropdown-button').forEach(button => {
            button.addEventListener('click', function(event) {
                var dropdownId = this.id.replace("dropdownButton", "dropdownMenu");
                var dropdownMenu = document.getElementById(dropdownId);
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.style.display = 'none'; 
                    }
                });
            
                dropdownMenu.style.display = (dropdownMenu.style.display === "block") ? "none" : "block";
            });
        });
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-button')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
