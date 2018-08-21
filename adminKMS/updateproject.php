<?php 
session_start();
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection 

  include('koneksi.php'); 
  
  // Attempt insert query execution for brainstorming table
if (isset($_POST['update'])) {
  $statusproject=$_POST['statusproject'];
  $project_progress=$_POST['project_progress'];
  $swot_strengthanalysis=$_POST['swot_strengthanalysis'];
  $swot_weaknessanalysis=$_POST['swot_weaknessanalysis'];
  $swot_opportunityanalysis=$_POST['swot_opportunityanalysis'];
  $swot_threatanalysis=$_POST['swot_threatanalysis'];
  $id_project=$_POST['id_project'];

  $sql = "UPDATE project SET statusproject = '$statusproject' , project_progress = '$project_progress' , swot_strengthanalysis = '$swot_strengthanalysis' , swot_weaknessanalysis = '$swot_weaknessanalysis' , swot_opportunityanalysis = '$swot_opportunityanalysis' , swot_threatanalysis = '$swot_threatanalysis' WHERE id_project = '$id_project';" ;


  if (mysql_query($sql)) {
      // echo "New record created successfully";
    header('location:index.php');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error($conn);
  }

  mysql_close($conn);
}
else{
  echo "error";
}

?>