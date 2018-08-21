
<?php 
session_start();
include('upload.php');
 // Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection and Check connection

  // if (! $conn) {
  //   die("Connection failed: " . mysql_error());
  // } 

  include('koneksi.php'); 

  // Attempt insert query execution for project table
  if (isset($_POST['save'])) {
  $title_project=$_POST['title_project'];
  $description_project=$_POST['description_project'];
  $idskill=$_POST['id_skill'];
  $statusproject=$_POST['statusproject'];
  $start_date=$_POST['start_date'];
  $due_date=$_POST['due_date'];
  $swot_strengthanalysis=$_POST['swot_strengthanalysis'];
  $swot_weaknessanalysis=$_POST['swot_weaknessanalysis'];
  $swot_opportunityanalysis=$_POST['swot_opportunityanalysis'];
  $swot_threatanalysis=$_POST['swot_threatanalysis'];
  $filename_project=$_FILES['file_project']; //klo kita mau upload kita mengarahkan ke variabel untuk upload
  $file_project=$filename_project['name'];
  
  upload_file($filename_project);
  $sql = "INSERT INTO project(id_project, title_project, file_project, description_project, swot_strengthanalysis, swot_weaknessanalysis, swot_opportunityanalysis, swot_threatanalysis, statusproject, project_progress, file_type, start_date, due_date, idemployees) 
  VALUES('', '$title_project', '$file_project', '$description_project', '$swot_strengthanalysis', '$swot_weaknessanalysis', '$swot_opportunityanalysis', '$swot_threatanalysis', '$statusproject' , '0','".$filename_project['type']."', '$start_date', '$due_date','".$_SESSION['login']."')";
  if (mysql_query($sql) or die(mysql_error())) {
      // echo "New record created successfully";
      $id_project=mysql_insert_id(); //get last inserted id http://php.net/manual/en/function.mysql-insert-id.php
      $insert_group_project=mysql_query("insert into group_project values('','".$id_project."', '".$_SESSION['login']."')");
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