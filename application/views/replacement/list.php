<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Replacement List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="main-container">
<?php $this->load->view("common/sidebar");?>
<div class="right-container">
        <div class="header-class">
            <h2>Replacement List</h2>
            </div>

    <table>
        
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Old Vehicle Name</th>
                <th>New Vehicle Name</th>
                <th>Fuel Out</th>
                <th>Odometer Out</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $sl_no=1; foreach($replacement as $r){?>
            <tr>
                <td><?=$sl_no?></td>
                <td><?=$r->old_model." ".$r->old_make?></td>
                <td><?=$r->model." ".$r->make?></td>
                <td><?=$r->fuel_out?></td>
                <td><?=$r->ordometer_out?></td>
                <td>
                    <?php if($r->expected_checkin_date ==''){ ?>
                    <button style=" background-color: #3767dc; color: white; padding: 5px 20px; font-size: 16px;  border: none; cursor: pointer; border-radius: 5px;" onclick="replacement_return(<?=$r->vehicle_id?>,<?=$r->rep_id?>)">Return</button>
                    <?php }?>
                </td>

            </tr>
            <?php $sl_no ++;}?>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
    </div>
    <script>
        function replacement_return(vehicle_id,rep_id){
            Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>replacement/return/"+vehicle_id+"/"+rep_id , function(result) {
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
})} else {
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

</body>
</html>
