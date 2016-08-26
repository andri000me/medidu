<?php
$con = mysqli_connect("localhost","root","","db_medidu");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$username = $_GET['username'];
$password = md5($_GET['password']);
$result = mysqli_query($con,"SELECT * 
FROM tbl_user 
WHERE username = '$username' 
AND password = '$password' 
");

$output = "<?xml version=\"1.0\" ?>\n";
$output .= "<all>";

while ($row = mysqli_fetch_row($result)) {
   $output .= "<personal>";
   $output .= "<id_user>".$row[0]."</id_user>";
   $output .= "<nama_user>".$row[2]."</nama_user>";
   $output .= "</personal>";
} 


$output .= "</all>"; 

// tell the browser what kind of file is come in
header("Content-type: text/xml");
// print out XML that describes the schema
echo $output; 
?>