<?php
$con = mysqli_connect("localhost","root","","db_medidu");
$output = "<?xml version=\"1.0\" ?>\n";

// Check connection
// 
$output .= "<all>";
if (mysqli_connect_errno())
{
	$output .= "<status>Failed to connect to MySQL: ". mysqli_connect_error()."</status>";
	$output .= "<variable>false</variable>";
}else{
	$output .= "<status>Connected</status>";
	$output .= "<variable>true</variable>";
}
$output .= "</all>";

// tell the browser what kind of file is come in
header("Content-type: text/xml");
// print out XML that describes the schema
echo $output; 
?>