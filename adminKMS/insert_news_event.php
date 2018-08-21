<?php 
session_start();
 // Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection and Check connection

  // if (! $conn) {
  //   die("Connection failed: " . mysql_error());
  // } 
  include('upload.php');
  include('koneksi.php'); 

  // Attempt insert query execution for news and event table

  
  $idskill=$_POST['id_skill'];
  $type=$_POST['type'];
  $id_skill=$_POST['id_skill'];
  $full_name=$_POST['full_name'];
  $title_news_event=$_POST['title_news_event'];
  $description_news_event=$_POST['description_news_event'];
  $picture=$_FILES['picture'];
  $pict_news_event=$picture['name'];

  upload_file($pict_news_event);

  $sql = "INSERT INTO news_event(idnews_event, title_news_event, description_news_event, picture, idemployees, idskill, date_posting, type) 
  VALUES('', '$title_news_event', '$description_news_event', '".$pict_news_event."', '".$_SESSION['login']."', '$idskill', '".date("Y-m-d")."', '$type' )";
      if (mysql_query( $sql) or die(mysql_error())) {
      // echo "New record created successfully";
      header('Location:index.php');
  } else {
      echo "ERROR: Could not able to execute " . $sql  . "<br>" . mysql_error($conn);
  }


?>
