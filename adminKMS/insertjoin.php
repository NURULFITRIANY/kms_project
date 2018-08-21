<?php 
session_start();
include('koneksi.php'); 
  
if (isset($_GET['id_project'])) {
  $id_project=$_GET['id_project'];

 $sql = "INSERT INTO group_project (idgroup_project, id_project, idemployees) 
  VALUES('', '$id_project', '".$_SESSION['login']."')";
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