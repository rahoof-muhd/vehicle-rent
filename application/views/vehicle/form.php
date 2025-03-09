<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration Form</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/vehicle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <?php 
        $make = '';
        $model  = '';
        $year_of_manufacture = '';
        $registration_number = '';
        $rc_owner = '';
        $ordometer_reading = '';
        $engine_capacity='';
        $mileage ='';
        $status ='';
        $daily_charge='';
        $color='';
        $seating_capacity='';
        $vehicle_type='';
        $fuel_type='';
        $transmission_type='';
        $license_plate='';
        $vehicle_id='';
        if($mode == 'edit'){
            foreach($vehicles as $v){
                $make = $v->make;
                $model = $v->model;
                $year_of_manufature = $v->year_of_manufacture;
                $registration_number = $v->registration_number;
                $rc_owner = $v->rc_owner;
                $ordometer_reading = $v ->ordometer_reading;
                $engine_capacity = $v->engine_capacity;
                $mileage=$v->mileage;
                $status = $v->status;
                $daily_charge=$v->daily_charge;
                $color=$v->color;
                $seating_capacity = $v->seating_capacity;
                $vehicle_type = $v->vehicle_type;
                $fuel_type=$v->fuel_type;
                $transmission_type=$v->transmission_type;
                $license_plate=$v->license_plate;
                $vehicle_id=$v->vehicle_id;


            }
        }   
    ?>


    <div class="form-container">
    <img style="height: 70px" src="<?php echo base_url(); ?>/assets/images/car-logo1.png" alt="">
        <h2 style=" font-size: 1.5rem;">RIDEONRENT</h2>
        <form action="<?=base_url()?>/vehicle/process" method="POST" enctype="multipart/form-data">
            <input type ="hidden" name="vehicle_id" value="<?=$vehicle_id?>">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="licence_plate">Upload image</label>
                        <input type="file" id="vehicle" name="veh_img"  >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="licence_plate">Licence Plate</label>
                        <input type="text" id="license_plate" name="license_plate" value="<?=$license_plate?>"  >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="make">Make</label>
                        <input type="text" id="make" name="make" value="<?=$make?>"  >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="make">Model</label>
                        <input type="text" id="model" name="model" value="<?=$model?>"  >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="make">Year Of Manufacture</label>
                        <input type="text" id="year_of_manufacture" name="year_of_manufacture" value="<?=$year_of_manufacture?>" >
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="vehicle_type">Vehicle Type</label>
                        <select id="vehicle_type" name="vehicle_type"  >
                            <option value="">Select Type</option>
                            <option <?php if($vehicle_type=='sedan') echo "selected";?>  value="sedan">TRUCK</option>
                            <option <?php if($vehicle_type=='suv') echo "selected";?> value="suv">SUV</option>
                            <option <?php if($vehicle_type=='truck') echo "selected";?> value="truck">TWO WHEELER</option>
                            <option <?php if($vehicle_type=='hatchback') echo "selected";?> value="hatchback">JEEP</option>
                            <option <?php if($vehicle_type=='coup') echo "selected";?> value="coupe">GOODS</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <select id="fuel_type" name="fuel_type"  >
                            <option value="">Select Fuel Type</option>
                            <option <?php if($fuel_type=='petrol') echo "selected";?> value="petrol">Petrol</option>
                            <option <?php if($fuel_type=='diesel') echo "selected";?> value="diesel">Diesel</option>
                            <option <?php if($fuel_type=='electric') echo "selected";?> value="electric">Electric</option>
                            <option <?php if($fuel_type=='hybrid') echo "selected";?> value="hybrid">Hybrid</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="registration_number">Registration Number</label>
                        <input type="text" id="registration_number" name="registration_number" value="<?=$registration_number?>" >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="transmission">Transmission Type</label>
                        <select id="transmission_type" name="transmission_type">
                            <option  value="">Select Transmission</option>
                            <option <?php if($transmission_type=='manual') echo "selected";?> value="manual">Manual</option>
                            <option <?php if($transmission_type=="automatic") echo"selected";?> value="automatic">Automatic</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="owner">Rc Owner</label>
                        <input type="text" id="rc_owner" name="rc_owner" value="<?=$rc_owner?>" >
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="odometer">Odometer Reading (km)</label>
                        <input type="number" id="ordometer_reading" name="ordometer_reading"  value="<?=$ordometer_reading?>" >
                    </div>
                </div>
               
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="make">Engine capacity</label>
                        <input type="text" id="engine_capacity" name="engine_capacity" value="<?=$engine_capacity?>"  >
                    </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="make">Mileage</label>
                            <input type="text" id="mileage" name="mileage" value="<?=$mileage?>"  >
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="make">Status</label>
                                <input type="text" id="status" name="status" value="<?=$status?>"  >
                            </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="make">Daily Charge</label>
                                    <input type="text" id="daily_charge" name="daily_charge" value="<?=$daily_charge?>"  >
                                </div>
                            </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="make">Color</label>
                                        <input type="text" id="color" name="color" value="<?=$color?>"  >
                                    </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="make">Seating Capacity</label>
                                            <input type="text" id="seating_capacity" name="seating_capacity" value="<?=$seating_capacity?>">
    </div>




                                    </div>
                                    </div>


                                    <div class="form-group">
                                        <input type="submit" value="Submit">
                                    </div>
        </form>
    </div>

</body>

</html>