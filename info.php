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
  <a href="pag3.php">Update & Delete Information</a>
  </div>
<?php require('includes/footer.php'); ?>
