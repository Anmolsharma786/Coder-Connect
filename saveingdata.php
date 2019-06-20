<?php require('includes/header.php'); ?>
<?php require('nav.php'); ?>

<body>


<?php
// store the form inputs in variables
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$location =  filter_input(INPUT_POST, 'location');
$skills = filter_input(INPUT_POST, 'skills');

//add the movie id in case we are editing
$userid = null;
$userid = filter_input(INPUT_POST, 'userid');




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
if(!empty($userid)) {
  $sql = "UPDATE project SET name = :name, email = :email, location = :location, skills = :skills WHERE userid = :userid;";
}
  else{  // set up an SQL command to save the new game
    $sql = "INSERT INTO project(name, email, location, skills) VALUES (:name,:email,:location,:skills)";
}

    // set up a command object
    $cmd = $conn->prepare($sql);

    // fill the placeholders with the 4 input variables
    $cmd->bindParam(':name', $name);
    $cmd->bindParam(':email', $email);
    $cmd->bindParam(':location', $location);
    $cmd->bindParam(':skills', $skills);

    //if we are editing, we need to bindParam with :movie_id
      if(!empty($userid)) {
        $cmd->bindParam(':userid', $userid);
      }


    // execute the insert
    $cmd->execute();



    //echo success message
    echo "<p>Record saved. thanks $name!</p>";
    //close the database connection
    $cmd->closeCursor();





}
else{

  echo "Error founded";

}
?>


<?php
// output buffering
ob_start();
try {
  //connect to the db
  require('includes/db.php');

  //set up SQL query

  $sql = "SELECT * FROM project;";

  //prepare

  $cmd = $conn->prepare($sql);

  //execute

  $cmd->execute();

  //store in projectss using fetchAll() method
  $projects = $cmd->fetchAll();

  // echoing out the top of our table
  echo "<table class='table table-striped'>
          <thead>
            <th> name </th>
            <th> email </th>
            <th> location </th>
            <th> skills </th>

          </thead>
          <tbody>";

  //use foreach to loop through and populate the table

  foreach($projects as $projec) {
    echo '<tr><td>' . $projec['name'] .'</td>
    <td>'. $projec['email']. '</td>
    <td>' . $projec['location'] . '</td>
    <td>' . $projec['skills'] . '</td>
</tr>';
  }

  echo '</tbody></table>';

  //close the database connection

  $cmd->closeCursor();

}
catch(Exception $e) {
  //send an email to the app admin
  mail('jessicagilfillan@gmail', 'projec Database Problems', $e);
  // send user to error.php page
  header('location:error.php');




}

ob_flush();
?>
<a href="pag3.php"> Update & Delete Information!!!</a>

<?php require('includes/footer.php'); ?>
