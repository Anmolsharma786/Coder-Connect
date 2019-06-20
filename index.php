<?php require('includes/header.php'); ?>
<?php require('nav.php'); ?>
<body>
  <?php

  //initializing variables and set to null initially

  $userid = null;
  $name = null;
  $email = null;
  $location = null;
  $skills = null;

  if(!empty($_GET['userid']) && (is_numeric($_GET['userid']))) {

    // grab the location id

    $userid = $_GET['userid'];

    // connect to the db

    require('includes/db.php');

    //set up an SQL query

    $sql = "SELECT * FROM project WHERE userid = :userid;";

    //prepare

    $cmd = $conn->prepare($sql);

    //bind

    $cmd->bindParam(':userid', $userid);

    //execute

    $cmd->execute();

    //use fetchAll to store

    $movies = $cmd->fetchAll();

    //loop through using a foreach loop

    foreach($movies as $movie) {
      $name = $movie['name'];
      $email = $movie['email'];
      $movie = $movie['location'];
      
    }

    $cmd->closeCursor();

  }
  ?>

  <div class="container-fluid">
  <header class="jumbotron">
  <h1 class="display-4">Coder Connect</h1>
  <p>*- Requied info</p>
</header>
     <main>
       <div class="row">
         <section class="col-md-6 col-sm-12">
           <h2>Hey there friend!</h2>
           <p>Just enter your information such that you can connect with some people</p>
         </section>


       <section class="col-md-6 col-sm-12">
         <a href="info.php"> View All other developers!!!</a>
     <form method="post" action="saveingdata.php" class="form-check">
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

           <input name="userid" type="hidden" value="<?php echo $userid; ?>">

      <input type="submit" value="Submit"class="btn btn-lg btn-success">
        </div>
     </form>
     </section>
</main>
<?php require('includes/footer.php'); ?>
