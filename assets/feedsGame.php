<?php
$con = mysqli_connect("localhost","root","","db_medidu");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$get 	= $_GET['id_game'];
$result = mysqli_query($con,"SELECT * 
FROM tbl_soal 
INNER JOIN tbl_game 
ON tbl_soal.id_game=tbl_game.id 
WHERE tbl_game.id='$get'");

$output = "<?xml version=\"1.0\" ?>\n";
$output .= "<all>";

while ($row = mysqli_fetch_row($result)) {
  if ($row[6] == 0){
   $output .= "<ques>";
   $output .= "<soal>".$row[2]."</soal>";
   $output .= "<q1>".$row[3]."</q1>";
   $output .= "<q2>".$row[4]."</q2>";
   $output .= "<q3>".$row[5]."</q3>"; 
   $output .= "<exp>".$row[7]."</exp>"; 
   $output .= "</ques>";
  }
} 


$output .= "</all>"; 

// tell the browser what kind of file is come in
header("Content-type: text/xml");
// print out XML that describes the schema
echo $output; 
?>