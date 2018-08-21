
<!-- process sign out -->
<?php   
  session_start(); //to ensure you are using same session
  session_destroy(); //destroy the session
  header("location:../new_index.php"); //to redirect back to front page (new_index.php) after logging out
  exit();
?>