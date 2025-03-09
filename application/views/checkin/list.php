<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkin List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="main-container" style="">
    <?php $this->load->view("common/sidebar");?>
    <div class="right-container">
    <div class="header-class">
            <h2>Checkin List</h2>
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
                    <th>Odometer In</th>
                    <th>Fuel In</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sno=1;
                 foreach($checkin as $c){
                    ?>
                <tr>
                    <td><?=$sno?></td>
                    <td><?=$c->customer_name?></td>
                    <td><?=$c->make." ".$c->model?></td>
                    <td><?=$c->license_plate?></td>
                    <td><?=$c->checkout_date?></td>
                    <td><?=$c->checkin_date?></td>
                    <td><?=$c->ordometer_in?></td>
                    <td><?=$c->fuel_in?></td>
                    <td><?=$c->amount?></td>
                    <td>
                      
                        <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$c->checkin_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$c->checkin_id?>">
                                <a href="#" class="dropdown-item" onclick="edit(<?=$c->checkin_id?>)">Edit</a>
                                <a href="#" class="dropdown-item" onclick="delete_item(<?=$c->checkin_id?>)">Delete</a>
                               
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $sno++; } ?>
            </tbody>
        </table>
    </div>
    </div>
    <script>
        function edit(checkin_id){
            window.location.href="<?=base_url()?>checkin/edit/" +checkin_id;
        }
        function delete_item(checkin_id){
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>checkin/delete/"+checkin-id , function(result) {
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
