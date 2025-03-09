<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/customer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="main-container">
        <div class="row" style="margin-left:0px; margin-right:0px">
            <div class="col-sm-4 col-md-3 side-bar">
                <div class="logo-div">
                <img style="height: 70px" src="<?php echo base_url(); ?>/assets/images/car-logo1.png" alt="">

                    <h4><strong>RIDEONRENT</strong></h4>
                </div>
                <div class="side-image">
                    <img src="" alt="">
                </div>
            </div>
            <div class="col-sm-8 col-md-9 main-div">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Welcome, Arya !</h5>
                        <p>Today is a great day for car rental service</p>
                    </div>
                    <div class="col-sm-6 notification">
                        <p><i style="font-size:20px" class="fa-regular fa-message " aria-hidden="true"></i></p>
                        <p><i style="font-size:20px" class="fa-regular fa-bell"></i></p>
                        <div class="profile">
                            <img src="<?php echo base_url(); ?>/assets/images/profile.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3 ">

                        <div class="veh-spec">
                            <img style="height:7vh" src="<?php echo base_url(); ?>/assets/images/engin1.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Engine</h6>
                                <h5><strong>2600 cc</strong></h5>
                                <p>2.0L</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/mileage.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Mileage</h6>
                                <h5><strong>2600 cc</strong></h5>
                                <p>2.0L</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/truck.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Type</h6>
                                <h5><strong>2600 cc</strong></h5>
                                <p>2.0L</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 ">
                        <div class="veh-spec">
                            <img style="height:8vh" src="<?php echo base_url(); ?>/assets/images/transmission.png" alt="">
                            <div class="" style="line-height:0px">
                                <h6>Transmission</h6>
                                <h5><strong>2600 cc</strong></h5>
                                <p>2.0L</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 3vh;padding-left: 15px;">
                    <div class="col-sm-8 veh-book" style="">
                        <div class="row">
                            <div class="col-sm-7 veh-book-img">
                                <h5 style="font-family: serif;margin-top: 1vh;"><strong>Suzuki Swift</strong> </h5>
                                <div class="">
                                    <img style="height:26vh" src="<?php echo base_url(); ?>/assets/images/car3.png" alt="">
                                </div>
                            </div>
                            <div class="col-sm-5 veh-book-spec">
                                <div class="veh-spec-det">
                                    <div class="spec-details" style="background-color:#57eb624a">
                                        <img style="height:6vh;" src="<?php echo base_url(); ?>/assets/images/color.png" alt="">
                                        <p>Red</p>
                                    </div>
                                    <div class="spec-details"  style="background-color:#ff450038">
                                    <img style="height:6vh" src="<?php echo base_url(); ?>/assets/images/seating.png" alt="">
                                    <p>5</p>
                                    </div>
                                </div>
                                <div class="veh-spec-det">
                                    <div class="spec-details" style="background-color:#ffe40024">
                                    <img style="height:6vh" src="<?php echo base_url(); ?>/assets/images/fuel.png" alt="">
                                    <p>Diesel</p>
                                    </div>
                                    <div class="spec-details" style="background-color:#c37fb438">
                                    <img style="height:6vh" src="<?php echo base_url(); ?>/assets/images/fuel.png" alt="">
                                    <p>Petrol</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="veh-available">
        <h2>Check Vehicle Availability</h2>
        <form action="submit_availability.php" method="POST">
            <div class="form-group">
                <label for="vehicle">Select Vehicle</label>
                <select name="vehicle" id="vehicle" required>
                    <option value="">-- Select a Vehicle --</option>
                    <option value="vehicle1">Vehicle 1</option>
                    <option value="vehicle2">Vehicle 2</option>
                    <option value="vehicle3">Vehicle 3</option>
                    <!-- Add more vehicles as needed -->
                </select>
            </div>

            <div class="form-group">
                <label for="date_from">Date From</label>
                <input type="date" name="date_from" id="date_from" required>
            </div>

            <div class="form-group">
                <label for="date_to">Date To</label>
                <input type="date" name="date_to" id="date_to" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Check Availability">
            </div>
        </form>

                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 3vh;padding-left: 15px;height: 27vh;">
                    <div class="col-sm-8 book-list"></div>
                    <div class="col-sm-4 ">
                        <div class="last-div"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            color: #555;
        }
        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>