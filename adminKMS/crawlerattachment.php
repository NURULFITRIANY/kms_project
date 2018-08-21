<?php
$url = 'http://www.oooff.com'; //holder of things (the url string)
$output = file_get_contents($url); //read entire file into a string (to get only the content from URL)
echo $output;


// $url = "oooff.com";
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// // run all the variable we set
// $curl_scraped_page = curl_exec($ch);
// // close handle to release resources
// curl_close($ch);
// echo $curl_scraped_page;

?>