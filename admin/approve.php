<?php
require "connection.php";
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);
$position = mysqli_real_escape_string($conn,$_GET['position']);
$position = strtolower($position);
$fullname = mysqli_real_escape_string($conn,$_GET['fullname']);
$nickname = mysqli_real_escape_string($conn,$_GET['nickname']);
$sql1 = "ALTER TABLE $position ADD $nickname INT NOT NULL";
$query1 = mysqli_query($conn,$sql1);
$sql2 = "UPDATE contestants set status='approved' WHERE studentid='$id'";
$query2 = mysqli_query($conn,$sql2);
if ($query1&&$query2) {
	echo "<script>alert('approved successfull')</script>";
	echo "<script>window.open('adminview.php','_self')</script>";
}else{
	echo "<script>alert('try again')</script>";
	echo "<script>window.open('adminview.php','_self')</script>";
}
}

?>