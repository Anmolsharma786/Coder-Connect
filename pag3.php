<?php require ('includes/header.php'); ?>
<?php require('nav.php'); ?>

<body>
  <div class="container">
     <h1> Personal Information!!!!</h1>

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

      //store in projects using fetchAll() method
      $projects = $cmd->fetchAll();

      // echoing out the top of our table
      echo "<table class='table table-striped'>
              <thead>
                <th> Name </th>
                <th> Email </th>
                <th> Movie </th>
                <th> Review </th>
                <th>Action</th>
              </thead>
              <tbody>";

      //use foreach to loop through and populate the table

      foreach($projects as $movie) {
        echo '<tr><td>' . $movie['name'] .'</td>
        <td>'. $movie['email']. '</td>
        <td>' . $movie['location'] . '</td>
        <td>' . $movie['skills'] . '</td>
        <td>'.'<a href="index.php?userid='.$movie['userid'].'" class="btn btn-primary">Edit</a> <a href="delete.php?userid='.$movie['userid'].'" class="btn btn-danger">Delete</a>  </td></tr>';


            }

      echo '</tbody></table>';

      //close the database connection

      $cmd->closeCursor();

    }
    catch(Exception $e) {
      //send an email to the app admin
      mail('anmol_sharma37@yahoo.com', 'Movie Database Problems', $e);
      // send user to error.php page
      header('location:error.php');




    }
    ob_flush();
    ?>
    <a href="comments.php">Personal Comments Related to Project</a>
  </div>
<?php require('includes/footer.php'); ?>
