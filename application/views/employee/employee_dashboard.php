<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Rental Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/main.css">
</head>
<body>
    <div class="main-container">
        <?php $this->load->view("common/sidebar");?>

        <!-- Main content area -->
        <div class="right-container">
            <header>
                <h1>Welcome Admin!</h1>
            </header>

            <section class="dashboard-summary">
                <div class="summary-box">
                    <h3>Total Rentals</h3>
                    <p><?=$total_rental?></p>
                </div>
                <div class="summary-box">
                    <h3>Available Vehicles</h3>
                    <p><?=$available_vehicles?></p>
                </div>
                <div class="summary-box">
                    <h3>Total Customers</h3>
                    <p><?=$total_customer?></p>
                </div>
                <div class="summary-box">
                    <h3>Upcoming Reservations</h3>
                    <p><?=$upcoming_bookings?></p>
                </div>
            </section>

            <section class="recent-rentals" style="height:68vh; overflow-y: auto;">
                <h2>Recent Rentals</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Vehicle</th>
                            <th>Rental Duration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rental as $r){
                            if($r->checkin_id == ''){
                                $status = "CHECKOUT";
                            }else{
                                $status = "CHECKIN";
                            }
                        ?>
                        <tr>
                            <td><?=$r->customer_name?></td>
                            <td><?=ucfirst($r->make )." ".ucfirst($r->model) ." ".$r->license_plate?></td>
                            <td><?=$r->date_difference?></td>
                            <td><?=$status?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
