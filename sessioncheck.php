<?php
session_start();
if(!$_SESSION['Student_ID'] AND ['Full_Name']){
	header("location: login.php");
}
?>