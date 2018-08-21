<?php 
session_start();
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection 

  include('koneksi.php'); 
  
  // Attempt insert query execution for brainstorming table
if (isset($_POST['update'])) {
  $statusbrainstorming=$_POST['statusbrainstorming'];
  $idbrainstorming=$_POST['idbrainstorming'];

  $sql = "UPDATE brainstorming SET statusbrainstorming = $statusbrainstorming  WHERE idbrainstorming = $idbrainstorming;" ;
  if (mysql_query($sql)) {
      // echo "New record created successfully";
    header('');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error($conn);
  }

  mysql_close($conn);
  echo "<meta http-equiv='refresh' content='0;URL=brainstorming.php'>";
}
else{
  echo "error";
}


?>


<!-- Run into another page -->