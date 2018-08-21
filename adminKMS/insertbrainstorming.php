<?php 
session_start();
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection 
  // $conn = mysql_connect($host, $username, $password, $database);

  // // Check connection
  // if (! $conn) {
  //   die("Connection failed: " . mysql_error());
  // }

  include('koneksi.php'); 
  
  // Attempt insert query execution for brainstorming table
if (isset($_POST['save'])) {
  $title_bs=$_POST['title_bs'];
  $description_bs=$_POST['description_bs'];
  $idskill=$_POST['id_skill'];
  $statusbrainstorming=$_POST['status'];

  $sql = "INSERT INTO brainstorming(idbrainstorming, title_bs, description_bs, idskill, idemployees, date_posting, statusbrainstorming) 
  VALUES('', '$title_bs', '$description_bs', '$idskill', '".$_SESSION['login']."', '".date("Y-m-d")."', '".$statusbrainstorming."')";
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