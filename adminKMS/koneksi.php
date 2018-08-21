<!-- Connecting to the MySQL database  -->
<?php 
$username = 'root'; //variables types
$password = '';
$host = 'localhost'; //server name
$database = 'kmsdb'; //database name

$conn=mysql_connect($host, $username, $password); //script to create connection to database
mysql_select_db($database); //script to connect to database
 ?>