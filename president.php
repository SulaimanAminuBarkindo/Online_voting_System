<?php
session_start();
require "connection.php";
if(!$_SESSION['studentid']){
  header("location: accountlogin.php");
}

$username = $_SESSION['username'];
$studentid = $_SESSION['studentid'];

if(isset($_POST['vote'])){

$voted = $_POST['voted'];
$vote = 1;
$status = "voted";

		#check double voting.
$check_double_voting_for_presidency ="SELECT studentid,presidency FROM already_voted WHERE studentid = '$studentid' LIMIT 1;";
$check_query = mysqli_query($conn,$check_double_voting_for_presidency);
$row = mysqli_fetch_assoc($check_query);
$voted_prez  = $row['presidency'];

if($voted_prez == 'voted'){
echo "<font color='red'><script>alert('sorry, you already voted presidency')</script></font>";
}
else{

	#adding vote to choosed candidate
$add_vote = "INSERT INTO president ($voted) VALUES(?);";
$stmt_add = mysqli_stmt_init($conn);
if(!$stmt_add->prepare($add_vote)){
echo "<script>alert(ERROR IN PREPARING TO UPDATE CANDIDATE)</script>";
}else{
$stmt_add->bind_param('i',$vote);
$stmt_add->execute();
}

	#changing voted member status to 'voted' in order to avoid double voting
$sql_voted = "INSERT INTO already_voted (studentid,presidency) VALUES(?,?);";
$stmt_voted = mysqli_stmt_init($conn);
if(!$stmt_voted->prepare($sql_voted)){
echo "<script>alert(ERROR IN PREPARING TO UPDATE VOTED MEMBER)</script>";
}else{
$stmt_voted->bind_param('ss',$studentid,$status);
$stmt_voted->execute();
}

	#showing up choosed candidate current votes
$sql_result = "SELECT $voted FROM president WHERE $voted > 0 ;";
$query_result = mysqli_query($conn,$sql_result);
$voted_votes = mysqli_num_rows($query_result);
echo "<script>alert('Thank you for voting')</script>";
echo "<br/>";
}
}
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

	</style>
</head>
<body style="background-color: skyblue;">

 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
         
          <a class="navbar-brand" class="active" href="#">NACOSS <small>mautech</small> Online Voting System</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="#"></a></li>
            
          </ul>
            <form class="navbar-form navbar-right">
             <a class="btn btn-default btn-default" href="#" role="button">Logout &raquo;</a>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


			<div class="container">
<!-- Three columns of text below the carousel -->
			 <div class="row" ">
			 	<center><h3 class="head3"><img src="images/nacos.jpg" width="50" height="50"> PRESIDENTIAL ASPIRANTS</h3></center>
			<div class="col-md-2">
			 
			</div>
<?php
$position ="president";
$status = 'approved';
$i=0;
$sql = "SELECT * FROM contestants WHERE position = ? && status= ? ;";
$stmt_cand = mysqli_stmt_init($conn);
if(!$stmt_cand->prepare($sql)){
echo "<script>alert(ERROR IN FETCHING CANDIDATES)</script>";
}else{
$stmt_cand->bind_param('ss',$position,$status);
$stmt_cand->execute();
$result = mysqli_stmt_get_result($stmt_cand);
while($row=mysqli_fetch_assoc($result)){
$id = $row['studentid'];
$image = $row['photo'];
$name = $row['fullname'];
$nickname = $row['nickname'];

echo "<div class='col-md-3' style='box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: white; margin-left:12px; '>";
echo  "<center> <img class='img-circle' src='admin/files/".$image."' alt='Generic placeholder image' width='140' height='140'>";
echo "<h2>$name<br><small>Presidential Aspirant</small></br></h2>";
echo "<p>NACOSS </p>";
echo "<p>";
echo "<form action='president.php' method='post'>";
echo "<input type ='hidden' name ='voted' value='$nickname'>";
echo "<button style='border: 0px;' href='#' name='vote'><img src='images/a.png' width='50%' height=''>";
echo "</button>";
echo "</form>";
echo "</p>";
echo"</center>";
echo "</div>";
}
}
?>
	
			<div class="col-md-2">
			 
		   </div>
			<div class="col-md-2">
			 
			</div>
     </div>
     
	  </div>
	  <nav>
            <ul class="pager">
              <!--<li><a href="#">Previous</a></li>-->
              <li><a href="#">Next</a></li>
            </ul>
          </nav>
          <br/><br/>
</body>
	 
    <footer class="footer" bgcolor="black">
      <div class="container">
        <p class="text-muted" align="center">NUTSCODERS 2018<br>Designed by Team Nutscoders</br>Modibbo Adama Univesity of Technology, Yola.</p>
      </div>
    </footer>
</html>