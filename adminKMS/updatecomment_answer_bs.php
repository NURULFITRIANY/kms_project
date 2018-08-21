<?php 
session_start();
// Inserting data to a My SQL database table (MySQL procedural)
  // Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
  // Create connection 

  include('koneksi.php'); 
  
  // Attempt insert query execution for brainstorming table
if (isset($_POST['enter'])) {
  $answer_forumbs=$_POST['answer_forumbs'];
  $comment_forumbs=$_POST['comment_forumbs'];

  $sql = "UPDATE brainstorming SET answer_forumbs = $answer_forumbs, comment_forumbs = $comment_forumbs WHERE idbrainstroming = $idbrainstroming;" ;
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