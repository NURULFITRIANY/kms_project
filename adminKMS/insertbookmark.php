<?php 
session_start();
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection 

  include('koneksi.php'); 
  
  // Attempt insert query execution for brainstorming table
if (isset($_GET['iddocument'])) {
  $iddocument=$_GET['iddocument'];
  
  

  $sql = "INSERT INTO bookmark (idbookmark, iddocument, idemployees) 
  VALUES('', '$iddocument', '".$_SESSION['login']."')";
  if (mysql_query( $sql) or die(mysql_error())) {
      // echo "New record created successfully";
      header('Location:index.php');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error($conn);
  }

  mysql_close($conn);
}
else{
  echo "error";
}
?>