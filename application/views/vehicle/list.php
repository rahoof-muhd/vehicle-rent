<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="main-container">
    <?php $this->load->view("common/sidebar");?>
    <div class="right-container">
        <div class="header-class">
            <h2>Vehicle List</h2>
            <button class="add-but"><a class="add-a" href="<?=base_url()?>vehicle/add/"> + NEW VEHICLE</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Make/Model</th>
                    <th>License Plate</th>
                    <th>Registration Number</th>
                    <th>Daily Charge</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $sl_no=1; foreach($vehicles as $v){?>
                <tr>
                    <td><?=$sl_no?></td>
                    <td><?=$v->make." ". $v->model?></td>
                    <td><?=$v->license_plate?></td>
                    <td><?=$v->registration_number?></td>
                    <td><?=$v->daily_charge?></td>
                    <td><?=$v->status?></td>
                    <td>
                        <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$v->vehicle_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$v->vehicle_id?>">
                                <a href="#" class="dropdown-item" onclick="edit(<?=$v->vehicle_id?>)">Edit</a>
                                <a href="#" class="dropdown-item" onclick="delete_item(<?=$v->vehicle_id?>)">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $sl_no ++;}?>
            
                <!-- More rows as needed -->
            </tbody>
        </table>
    </div>
    </div>
    <script>
        function edit(vehicle_id){
            window.location.href = "<?=base_url()?>/vehicle/edit/" + vehicle_id;   
        }
         function delete_item(vehicle_id){
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>vehicle/delete/"+vehicle_id , function(result) {
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
