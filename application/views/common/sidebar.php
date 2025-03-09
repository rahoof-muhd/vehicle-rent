<div class="left-container">
    <div class="sidebar-header sidebar">
    <img style="height: 70px" src="<?php echo base_url(); ?>/assets/images/car-logo1.png" alt="">
        <h2><strong style="font-style: italic; color: #fff8f8;">RIDEONRENT</strong></h2>
    </div>
    <ul class="sidebar-menu">
        <li><a href="<?=base_url()?>/employee">Dashboard</a></li>
        <li><a href="<?=base_url()?>/vehicle">Vehicles</a></li>
        <li><a href="<?=base_url()?>/checkout">Checkout</a></li>
        <li><a href="<?=base_url()?>/checkin">Checkin</a></li>
        <li><a href="<?=base_url()?>/replacement">Replacement</a></li>
        <li><a href="<?=base_url()?>/customer">Customers</a></li>
        <li><a href="<?=base_url()?>/booking">Bookings</a></li>
        <?php if($emp_type == 'ADMIN'){ ?><li><a href="<?=base_url()?>/employee/list">Employee</a></li><?php }?>
        <li><a href="#" onclick="logout()">Logout</a></li>
        
    </ul>
</div>
<style>
        .dropdown { position: relative; display: inline-block; }
        .dropdown-button { background-color: #5c596b; color: white; padding: 5px 20px; font-size: 16px;  border: none; cursor: pointer; border-radius: 5px; }
        .dropdown-button:hover { background-color: #0056b3; }
        .dropdown-menu {display: none;position: absolute;background-color: #f9f9f9;min-width: 160px;box-shadow: 0px 8px 16px rgba(0,0,0,0.2);z-index: 1;border-radius: 5px; left: -52px; padding: 0 10px 5px 10px;}
        .dropdown-item {color: black;text-decoration: none;display: block;    padding: 10px 0 5px 10px; text-align: left; }
        .dropdown-item:hover {background-color: #f1f1f1;}
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
}</script>