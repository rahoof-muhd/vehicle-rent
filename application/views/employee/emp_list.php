<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee List</title>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/emplist.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="main-container">
  <?php $this->load->view("common/sidebar");?>
  <div class="right-container"> 
    <h2>Employee List</h2>
    <a class="add-a" href="<?=base_url()?>employee/add/"><button style="height:35px; font-weight:600; margin-left: 87%;" class="add-but" > + NEW EMPLOYEE</button></a>
    <div style="height:80vh;overflow-y:scroll;">
    <table>
      <thead>
        <tr>
          <th>s_no</th>
          <th>Employee Name</th>
          <th>Department</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $s_no=1; foreach($employees as $e){?>
          <tr>
            <td><?=$s_no?></td>
            <td><?=$e->emp_name?></td>
            <td><?=$e->department?></td>
            <td><?=$e->email?></td>
          <td><?=$e->phone_number?></td>
          <td> 
            <div class="dropdown">
                            <button class="dropdown-button" id="dropdownButton<?=$e->emp_id?>">More</button>
                            <div class="dropdown-menu" id="dropdownMenu<?=$e->emp_id?>">
                              
                                <a href="#" class="dropdown-item" onclick="edit(<?=$e->emp_id?>)">Edit</a>
                                
                                <a href="#" class="dropdown-item" onclick="delete_item(<?=$e->emp_id?>)">Delete</a>
                               
                                
                            </div>
                        </div>
          </td>
        </tr>
        <?php $s_no ++;}?>
        
      </tbody>
    </table>
    </div>
    </div>
  </div>
  <script>
    function edit(emp_id){
      window.location.href ="<?=base_url()?>employee/edit/" + emp_id;
    }
    function delete_item(emp_id){
      Swal.fire({
        title: 'Are you sure?',
         
        icon: 'warning', // SweetAlert2 uses 'icon' instead of 'type'
        showCancelButton: true,
        cancelButtonColor: '#ccc',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {  // Use isConfirmed instead of result.value
            $.post("<?= base_url(); ?>employee/delete/"+emp_id , function(result) {
                var obj = JSON.parse(result);
                if (obj.status == 1) {
                  
window.location.reload();
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
    // funtion delete_item(emp_id){
    //   // window.location.href="<?//=base_url()?>employee/delete" + emp_id;
    // }
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
