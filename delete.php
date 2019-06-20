<?php
ob_start();

//grab the id of the movie you want to delete
$id = $_GET['userid'];

//connect

require('includes/db.php');
//set up our sql query
$sql = "DELETE FROM project WHERE userid = :id;";
// prepare the query
$cmd = $conn->prepare($sql);
//bind
$cmd->bindParam(':id', $id);
//execute
$cmd->execute();
//close the connection
$cmd->closeCursor();
//send your user to the movies page
header('location:pag3.php');
ob_flush();
?>
