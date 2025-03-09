
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/list.css">
</head>
<body>

    <div class="container">
        <h1>Customer List</h1>
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
                <?php  foreach($customers as $c){?>
                <tr>
                <td><?=$c->customer_name?></td>
                <td><?=$c->phone_number?></td>
                <td><?=$c->driving_license?></td>
                <td><?=$c->country.",".$c->state.",".$c->district?></td>
                <td><?=$c->zip_code?></td>
                <td>
                        <button class="block-btn">Block</button>
                        
                    </td>
                    </tr>
                
                <?php }?>
                <!-- <tr>
                    <td>John Doe</td>
                    <td>(123) 456-7890</td>
                    <td>DL12345678</td>
                    <td>New York, NY</td>
                    <td>10001</td>
                    <td><button class="block-btn">Block</button></td>
                </tr>
                
                <tr>
                    <td>Jane Smith</td>
                    <td>(987) 654-3210</td>
                    <td>DL98765432</td>
                    <td>Los Angeles, CA</td>
                    <td>90001</td>
                    <td><button class="block-btn">Block</button></td>
                </tr>
                <tr>
                    <td>Robert Brown</td>
                    <td>(555) 123-4567</td>
                    <td>DL55555555</td>
                    <td>Chicago, IL</td>
                    <td>60601</td>
                    <td><button class="block-btn">Block</button></td>
                </tr>
                <tr>
                    <td>Emily Johnson</td>
                    <td>(888) 555-9999</td>
                    <td>DL222333444</td>
                    <td>San Francisco, CA</td>
                    <td>94110</td>
                    <td><button class="block-btn">Block</button></td>
                </tr> -->
            </tbody>
        </table>
        <div class="footer">
            <p>&copy; 2025 Customer Data</p>
        </div>
    </div>

</body>
</html>
