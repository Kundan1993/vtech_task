<?php 
  $connect = mysqli_connect("localhost", "root", "welcome", "task_vtech");
  $query = "SELECT * FROM users ORDER BY id DESC";
  $result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Vtech Task</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      <script src="jquery.tabledit.min.js"></script>
   </head>
   <body>
      <div class="container"><br>
         <div class="panel panel-default">
            <div class="panel-heading"><b>User Details</b></div>
            <div class="panel-body">
               <form id="add_user" >
                  <div class="form-row">
                     <div class="col-sm-3 form-group">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" class="form-control" id="name"
                           name="name" placeholder="Enter your name" >
                     </div>
                     <div class="col-sm-3 form-group">
                        <label>Email <span class="req">*</span></label>
                           <input type="text" class="form-control" id="email" name="email"
                           placeholder="Enter your email" >
                     </div>
                     <div class="col-sm-3 form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" id="mbl"
                           name="mbl" placeholder="Mobile No" >
                     </div>
                     <div class="col-sm-3 form-group">
                        <br>
                        <button type="submit" class="btn btn-primary col-sm-12"
                           name="add" id="add">Save Change</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
        <!--  User List table    -->
        <div class="panel panel-default">
            <div class="panel-heading"><b>User Details List</b></div>
            <div class="panel-body">
            <table class="table table-hover" id="edit_user">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="displayed">
                <?php
                $i = 1;
                  while($row = mysqli_fetch_array($result))
                  { 
                ?>
                  <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['mobile'] ?></td>
                  </tr>
                <?php $i++;}?>
                </tbody>
              </table>
            </div>
         </div>

      </div>
<script>  
  $(document).ready(function(){  
      $('#edit_user').Tabledit({
        url:'update.php',
        columns:{
        identifier:[0, "id"],
        editable:[[1, 'name'], [2, 'email'], [3, 'mobile']]
        },
        restoreButton:false,
        onSuccess:function(data, textStatus, jqXHR)
        {
          // alert(data);
        if(data.action == 'delete')
        {
          $('#'+data.id).remove();
        }
        }
      });
  });  

  $(document).ready(function(){
    $("#add").click(function(e){
      e.preventDefault(); 
      $.ajax({
        url:"insert.php",
        type:"post",
        data:$("#add_user").serialize(),
        success:function(data){
          alert(data);
          location.reload();
          $("#add_user")[0].reset();
        }
      });
    });
  });

</script>
   </body>
</html>