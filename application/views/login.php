<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="main-container">
        <div class="left-container">
            <div class="left-div">
                <h2 style="font-family: monospace;color:white">Welcome To</h2>
                <h1 class="title_name" style="">RIDEONRENT</h1>
                <form action="<?=base_url()?>/Login/process" method="post" style="margin-top:7vh">
                    <div class="form-group">
                        <p style="height:10px;color:white">Email</p>
                        <input type="text" name="email"  class="form-class">
                    </div>
                    <div class="form-group">
                        <p style="height:10px;color:white">Password</p>
                        <input type="text" name="password" class="form-class">
                    </div>
                    <div class="but-div">
                        <button class="sub-btn">LOGIN</button>
                    </div>
                    <div class="register">
                        <p style="color:white; margin-top:10px">Don't have an account? <a href="<?=base_url()?>register" style="font-weight:900;color:#2a4969">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="right-container">
            <img src="<?php echo base_url() ?>/assets/images/car-logo1.png" alt="">
        </div>
    </div>
</body>
</html>