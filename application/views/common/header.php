<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="header">
    <div class="logo-div">
        <img style="height: 50px;z-index:10" src="<?php echo base_url(); ?>/assets/images/car-logo1.png" alt="">
        <h5><strong>RIDEIONRENT</strong></h5>
    </div>
    <div class=" notification">
        <p><i style="font-size:20px" class="fa-regular fa-message " aria-hidden="true"></i></p>
        <p><i style="font-size:20px" class="fa-regular fa-bell"></i></p>
        <div class="profile">
            <img src="<?php echo base_url(); ?>/assets/images/profile.jpg" alt="">
        </div>
    </div>
</div>
<style>
    .header{width:100%;height:75px; display:flex;justify-content:space-between;padding:10px;background: linear-gradient(45deg, #7d93a5, #1c3f5f);}
    .notification{display: flex;justify-content: end;gap: 3vh;}
    .notification p{margin-top: 10px;}
    .profile{height: 50px; width: 50px; display: flex; justify-content: center; align-items: center; border-radius: 50%; background-color: black;}
    .profile img{height: 47px; width: 47px;border-radius: 50%; object-fit: cover;}
    .logo-div{z-index: 10;}
    .logo-div h5{    position: relative;
    top: -8px;
    text-align: center;
    font-style: italic;
    color: white;
    font-size: 17px;
}
</style>