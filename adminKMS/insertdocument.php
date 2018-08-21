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

  // Attempt insert query execution for document table
  if (isset($_POST['save'])) {
  $title_document=$_POST['title_document'];
  $description_document=$_POST['description_document'];
  $idskill=$_POST['id_skill'];
  $file_document=$_FILES['filename_document'];
  $filename_document=$file_document['name'];
  
  upload_file($file_document);
  // var_dump($file_document);
  
  $sql = "INSERT INTO document(iddocument, title_document, description_document, filename_document, idemployees, iddepartment, idskill, date_posting, file_type) 
  VALUES('', '$title_document', '$description_document', '$filename_document', '".$_SESSION['login']."','1', '$idskill', '".date("Y-m-d")."', '".$file_document['type']."')";
  if (mysql_query($sql)) {
      // echo "New record created successfully";
      header('Location:index.php');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error();
  }

  // mysql_close($conn);
}
else{
  echo "error";
}
?>