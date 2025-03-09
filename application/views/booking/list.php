<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>
    <div class="main-container">
    <?php $this->load->view("common/sidebar");?>
    <div class="right-container">
    <div class="header-class">
            <h2>Booking List</h2>
           
        </div>
        <div style="overflow-y: scroll;height:80vh;">

        <table>
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Customer Name</th>
                    <th>Vehicle Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody>
                
            <?php $sl_no=1; foreach($booking as $b){?>
                    <td><?=$sl_no?></td>
                    <td><?=$b->customer_name?></td>
                    <td><?=$b->make." ".$b->model?></td>
                    <td><?=$b->from_date?></td>
                    <td><?=$b->to_date?></td>
                    <td>

                        <?php if($b->status == 0){ ?>
                        <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$b->booking_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$b->booking_id?>">
                                <a href="#" class="dropdown-item" onclick="status_update(<?=$b->booking_id?>,1)">Accept</a>
                                <a href="#" class="dropdown-item" onclick="status_update(<?=$b->booking_id?>,2)">Reject</a>
                                </div>
                        </div>
                                 
                           <?php }
                           else if($b->status == 1){?>
                           <button style=" background-color:#11ab13e8; color: white; padding: 5px 20px; font-size: 16px;  border: none; cursor: pointer; border-radius: 5px;"onclick="checkout(<?=$b->booking_id?>)">Checkout</button>
                           

                            <?php }else{ ?>
                                <h5 style="color:red;">REJECTED</h5>
                               <?php }?>
                            
                    </td>
                </tr>
                <?php $sl_no ++;}?>
                
            </tbody>
        </table>
        </div>
    </div>
    </div>
    <script>
        function status_update(booking_id,status){
            if(status==1){
                var heading = "Accept Booking ?";
                var description ="Do You Want to accept the booking";
            }
            else{
                 var heading ="Reject Booking ?";
                 var description ="Do You want to Reject the booking";
            }
            Swal.fire({
        title: heading,
        text:description,
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Accept'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>booking/update_status/" + booking_id + "/" + status, function(result) {
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
        function checkout(booking_id){
            window.location.href="<?=base_url()?>/checkout/make_from_booking/" +booking_id;
            
        }
    </script>
</body>
</html>

