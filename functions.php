<?php

require "connection.php";

//securing data
function secure_data($dbc,$data){
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = mysqli_real_escape_string($dbc,$data);
	return $data;
}
?>