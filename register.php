<?php
date_default_timezone_set('Africa/Niamey');
$studentid = "";
$firstname = "";
$lastname = "";
$gender = "";
$level = "";
$email = "";
$phone_number = "";

if(isset($_POST['submit'])){

use "PHPMailer/src/Exception.php";
use "PHPMailer/src/PHPMailer.php";

require "connection.php";
require "functions.php";
require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
 
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smp.gmail.com";
$mail->Username = "";
$mail->Password = "";
$mail->setFrom("");  

$upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lower_case = "abcdefghijklmnopqrstuvwxyz";
$numbers = "0123456789";
$special_chars = "?!@#$&";
$generated_upper_case=substr(str_shuffle($upper_case), 0,2);
$generated_lower_case=substr(str_shuffle($lower_case), 0,2);
$generated_numbers=substr(str_shuffle($numbers), 0,2);
$generated_special_chars=substr(str_shuffle($special_chars), 0,2);
$code = "$generated_upper_case$generated_lower_case$generated_numbers$generated_special_chars";
$MIN_LENGTH = 8;

    #storing data sent by the user and validating them
$studentid = secure_data($conn,$_POST['studentid']);
$studentid = strtoupper($studentid);
$firstname = secure_data($conn,$_POST['firstname']);
$firstname = strtoupper($firstname);
$lastname = secure_data($conn,$_POST['lastname']);
$lastname = strtoupper($lastname);
$gender = secure_data($conn,$_POST['gender']);
$gender = strtoupper($gender);
$level = secure_data($conn,$_POST['level']);
$email = secure_data($conn,$_POST['email']);
$phone_number = secure_data($conn,$_POST['phonenumber']);
$password = $_POST['password'];
$confpassword = $_POST['re-password'];
$date = date('d-m-Y H:i:s');
$status= '0';

    #check if the field are not empty
if(ctype_space($studentid) || ctype_space($firstname) || ctype_space($lastname) || ctype_space($gender) || ctype_space($level) || ctype_space($phone_number) || ctype_space($email) || ctype_space($password)  || ctype_space($confpassword)){
echo "<script>alert('one or more field is empty')</script>";
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "<script>alert('invalid email address')</script>";
}
elseif ($confpassword != $password) {
echo "<script>alert('password did not matched')</script>";
}
elseif (strlen($password) < $MIN_LENGTH) {
echo "<script>alert('password should be atleast 6 characters')</script>
";
}
else{
$password = password_hash($password, PASSWORD_DEFAULT);
$sql = "SELECT studentid,email FROM nacoss WHERE studentid = ? OR email = ? LIMIT 1";
$stmt1=mysqli_stmt_init($conn);
if(!$stmt1->prepare($sql))
{
echo "SQL ERROR";
}else{
$stmt1->bind_param('ss',$studentid,$email);
$stmt1->execute();
$stmt1->bind_result($dbstudentid,$dbemail);
$stmt1->fetch();
    #check if the user have already registered
if($dbstudentid == $studentid || $dbemail == $email){
echo "<script>alert('studentid \'$studentid\' or email \'$email\' already taken by another, please try another one!')</script>";
}
    #register the user if the user have'nt register
else{
$sql2 = "INSERT INTO nacoss (studentid, firstname, lastname,password, gender, level, email, phone_number,verification_code,date,status) VALUES(?,?,?,?,?,?,?,?,?,?);";
$stmt2 = mysqli_stmt_init($conn);
if(!$stmt2->prepare($sql2))
{
echo "SQL ERROR ";
}else{
$stmt2->bind_param('sssssisiss',$studentid,$firstname,$lastname,$password ,$gender,$level,$email,$phone_number,$code,$date,$status);
}
if($stmt2->execute()){
echo "<script>alert('Registration Successful!')</script>";
}else{
echo "<script>alert('Please try registering again')</script>";
}
}
}
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

    <title>Registration</title>
	<link href="bootstrap-3.3.7/dist/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap-3.3.7/dist/css/bootstrap-progressbar.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/docs.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/font-awesome.min.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/js/google-code-prettify/prettify.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="bootstrap-3.3.7/dist/css/style.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body>

	<div class="container">
		<div class="centered-form">
			<div class="col-lg-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offse-4">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: white">
						<center><img width="100"; height="100";  src="images/nacos.jpg"></center>
						<h3 class="panel-title" align="center">Create an account</h3>

					</div>
						<div class="panel-body">
							<form role="form" method="post" action="register.php">
								<div class="form-group">
									<label>Student ID</label><input type="text" name="studentid" value="<?php echo stripslashes($studentid);?>" class="form-control input-sm" placeholder="Student ID" required>
								</div>

								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>First Name</label><input type="text" name="firstname" value="<?php echo stripslashes($firstname);?>" class="form-control input-sm" placeholder="First Name" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Last Name</label><input type="text" name="lastname" value="<?php echo stripslashes($lastname);?>" class="form-control input-sm" placeholder="Last Name" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Gender</label><input type="text" name="gender" value="<?php echo stripslashes($gender);?>" class="form-control input-sm" placeholder="Gender" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Level</label><input type="text" name="level" value="<?php echo stripslashes($level);?>" class="form-control input-sm" placeholder="Level" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Email</label><input type="email" name="email" value="<?php echo stripslashes($email);?>" class="form-control input-sm" placeholder="Email Address" required>
								</div>
								<div class="form-group">
									<label>Phone Number</label><input type="text" name="phonenumber" value="<?php echo stripslashes($phone_number);?>" class="form-control input-sm" placeholder="phonenumber" required>
								</div>

								<div class="row">
									<div class="col-xs-6 col-sm-6 col-ms-6">
										<div class="form-group">
											<label>Password</label><input type="password" name="password" value="" class="form-control input-sm" placeholder="Password" required>
										</div>
									</div>

									<div class="col-xs-6 col-sm-6 col-ms-6">
										<div class="form-group">
											<label>Confirm Password</label><input type="password" name="re-password" class="form-control input-sm" placeholder="Confirm Password" required>
										</div>
									</div>
								</div>
								<input type="submit" name="submit" value="Submit" class="btn btn-success btn-block">
								<div>
									<center><span>Already have an account?<br> <a href="accountlogin.php">Login Here</a></br></span></center>
								</div>
							</form>

						</div>
				</div>
			</div>
		</div>
	</div>

	 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <?php require "footer.php"; ?>
</body>
</html>