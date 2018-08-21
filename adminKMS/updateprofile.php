<?php
session_start();
include('upload.php');
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection

  include('koneksi.php');

  // Attempt insert query execution for brainstorming table
if (isset($_POST['update'])) {
  $date_birth=$_POST['date_birth'];
  $location=$_POST['location'];
  $email=$_POST['email'];
  $phone_number=$_POST['phone_number'];
  $google_plus=$_POST['google_plus'];
  $twitter=$_POST['twitter'];
  $facebook=$_POST['facebook'];
  $blog=$_POST['blog'];
  $instagram=$_POST['instagram'];
  $linkendin=$_POST['linkendin'];
  $iddepartment=$_POST['iddepartment'];
  $job_title=$_POST['job_title'];
  $idskill=$_POST['idskill'];
  $employees_background=$_POST['employees_background'];
  $pict_employees=$_FILES['pict_employees'];

  if($pict_employees==null){
    //kondisi  buat picture
  }
  $pictemployees=$pict_employees['name'];
  $idemployees=$_SESSION['login'];

  upload_file($pict_employees);

  $sql = "UPDATE employees
  SET date_birth = '$date_birth', location = '$location', email = '$email', phone_number = '$phone_number' , google_plus = '$google_plus' , twitter = '$twitter' , facebook = '$facebook', blog = '$blog' , instagram = '$instagram' , linkendin = '$linkendin' , iddepartment = '$iddepartment' , job_title = '$job_title' , idskill = '$idskill' , employees_background = '$employees_background' , pict_employees = '".$pict_employees['name']."'
  WHERE idemployees = '$idemployees'" ;
  if (mysql_query( $sql) or die(mysql_error())) {
      // echo "New record created successfully";
      header('Location:index.php');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error($conn);
  }

  mysql_close($conn);
} else {
  echo "error";
}

?>
