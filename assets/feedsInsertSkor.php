<?php
$con = mysqli_connect("localhost","root","","db_medidu");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$id_user 	= $_GET['id_user'];
$id_game 	= $_GET['id_game'];
$score 		= $_GET['score'];
$exp 		= $_GET['exp'];
$result = mysqli_query($con,"INSERT INTO 
	tbl_skor 
	(
		id_user, 
		id_game, 
		skor, 
		exp, 
	tanggal) 
	VALUES(
		'".$id_user."', 
		'".$id_game."', 
		'".$score."', 
		'".$exp."', 
		'".date("Y-m-d")."' 
	)"
);
?>