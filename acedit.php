<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Coders Connect</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pag3.php">Records</a>
    </li>
  </ul>
</nav>

<?php

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$location =  filter_input(INPUT_POST, 'location');
$skills = filter_input(INPUT_POST, 'skills');

$userid = filter_input(INPUT_POST, 'userid');





// store the form inputs in variables

  // SET UP AS A FLAG variables
  $ok= true;
if(empty($name)){
  $ok = false;
  echo"<p>Name is Required</p>";
}
if(empty($email)){
  $ok = false;
  echo"<p>Email is Required</p>";
}
if(empty($location)){
  $ok = false;
  echo"<p>Movie is Required</p>";
}
if(empty($skills)){
  $ok = false;
  echo"<p>Review is Required</p>";
}
//checking whether the email is correctely formatted or not
if($email===false){
  echo"<p>not correctly formatted</p>";
}

if($ok==true){

    //connecting to database
require('includes/db.php');
if(!empty($movie_id)) {
  $sql = "UPDATE project SET name = :name, email = :email, movie = :movie, review = :review WHERE movie_id = :movie_id;"; 
}


    // set up a command object
    $cmd = $conn->prepare($sql);

    // fill the placeholders with the 4 input variables
    $cmd->bindParam(':name', $name);
    $cmd->bindParam(':email', $email);
    $cmd->bindParam(':location', $location);
    $cmd->bindParam(':skills', $skills);
      $cmd->bindParam(':userid', $userid);


    // execute the insert
    $cmd->execute();

    echo "<br/><br/><span>Data Inserted successfully...!!</span>";

    //echo success message
    echo "<p>Record saved. thanks $name!</p>";
    //close the database connection
    $cmd->closeCursor();
 ?>

</body>
</html>
