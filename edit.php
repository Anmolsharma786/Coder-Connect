<?php
require('includes/header.php');
 ?>
 <?php require('nav.php'); ?>

 <?php
 require('includes/db.php');
  ?>
  <?php
  $id = $_GET['userid'];
   ?>


  <form method="post" action="acedit.php" class="form-check">

    <div class="form-group">
     <br><input type="hidden" name="userid" placeholder="Name" class="form-control" value="<?php echo $id; ?>"></br>
       </div>

    <div class="form-group">
      <label> Name: </label>
     <br><input type="text" name="name" placeholder="Name" class="form-control" required></br>
       </div>

        <div class="form-group">
      <label> Email: </label>
      <br><input type="email" name="email" placeholder="Email" class="form-control" required></br>
      </div>
      <div class="form-group">
      <label> Location: </label>
      <br><input type="text" name="location" placeholder="Location" class="form-control" required></br>
      </div>

     <div class="form-group">
      <label> Skills: </label>
      <br><input type="text" name="skills" placeholder="Skills" class="form-control" required></br>
      </div>
      <!-- adding a hidden fom field with the movie_id -->


   <input type="submit" value="Submit"class="btn btn-lg btn-success">
     </div>
  </form>


 <?php
 require('includes/footer.php');
  ?>
