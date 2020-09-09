<?php
session_start();
require "connection.php";
if(!$_SESSION['studentid']){
  header("location: accountlogin.php");
}

$username = $_SESSION['username'];
$studentid = $_SESSION['studentid'];
?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>HOME</title>
	<link href="bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap-3.3.7/dist/css/bootstrap-progressbar.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/docs.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/font-awesome.min.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/js/google-code-prettify/prettify.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/style.css" rel="stylesheet">
	<style type="text/css">
		.container1{
			margin-left: 55;
		}
		.head3{
			color: darkblue;
			background-color: white;
			font-size: 25px;
			font-family: cambria;
			border-radius: 2px;
			
			
		}
		.footer1{
	height:150;
	width:auto;
	background-color:black;
	border:;
	margin-top:900;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
	
}
/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;

  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 90px;
  background-color: black;
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

body > .container {
  padding: 60px 15px 0;
}
.container .text-muted {
  margin: 20px 0;
}

.footer > .container {
  padding-right: 15px;
  padding-left: 15px;
}

code {
  font-size: 80%;
}

.p{
text-align: center;
font-size: 25px;
color: darkblue;
background: #fff;
margin-top: 5px;
}
.ins{
	color: black;
	font-family: cambria;
	font-size: 20px;
}

	</style>

</head>
<body style="background-color: skyblue;">

 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         
          <a class="navbar-brand" class="active" href="#">NACOSS <small>mautech</small> Online Voting System</a>
        </div></nav>
        
			<div class="container">
<center><img src="images/logo11.png" width="100px"></center>
<div class="p">WELCOME TO NACOSS E-VOTING PAGE</div>
<div class="ins">
	<p><font color="red" size="25px">Instruction</font></p>
	<p>There are five instruction governing election</p>
<ol>
	<li>You can only vote once</li>
	<li>You have only 5minutes  to roundup your vote</li>
	<li> After 5 minutes the system will submit your response</li>
	<li>Ensure that you vote carefully cancellation is not applicable</li>
	<li>You cannnot submit more than one</li>
	</ol>


</div>


            <ul class="pager">
              <li><a href="president.php">Start</a></li>
            </ul>
          </nav>
	  </div>
	  
</body>
	 
    <footer class="footer" bgcolor="black">
      <div class="container">
        <p class="text-muted" align="center">NUTSCODERS 2018<br>Designed by Team Nutscoders</br>Modibbo Adama Univesity of Technology, Yola.</p>
      </div>
    </footer>
</html>