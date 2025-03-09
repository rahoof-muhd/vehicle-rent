
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="main-container">
        <?php $this->load->view("common/sidebar");?>
        <div class="right-container">
        <h2>Customer List</h2>
        <table>
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Driving License Number</th>
                    <th>Location</th>
                    <th>Zip Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $bg_color   = 'white';
                $color      = 'black';
                foreach($customers as $c){
                    if($c->verification_status ==0){
                        $bg_color = '#fdebeb';
                        $color = 'red';
                    } else{
                        $bg_color   = 'white';
                        $color      = 'black';
                    }
                ?>
                <tr style="background-color:<?=$bg_color?>; color:<?=$color?>" >
                <td><?=$c->customer_name?></td>
                <td><?=$c->phone_number?></td>
                <td><?=$c->driving_license?></td>
                <td><?=$c->country.",".$c->state.",".$c->district?></td>
                <td><?=$c->zip_code?></td>
                <td>
                   
                        <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$c->login_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$c->login_id?>">
                                <?php if($c->verification_status == 1){ ?>
                                <a href="#" class="dropdown-item" onclick="block_unblock(<?=$c->login_id?>,0)">Block</a>
                                <?php } else{?>
                                <a href="#" class="dropdown-item" onclick="block_unblock(<?=$c->login_id?>,1)">Unblock</a>
                                <?php }?>
                                
                            </div>
                        </div>
                        
                    </td>
                    </tr>
                
                <?php }?>
            </tbody>
        </table>
        
    </div>
    </div>
    <script>
        function block_unblock(login_id,status){
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>employee/block_unblock/"+login_id+"/"+status , function(result) {
                var obj = JSON.parse(result);
                if (obj.status == 1) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",  // 'type' is replaced with 'icon'
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
