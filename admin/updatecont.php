<?php
require "connection.php";
	require "functions.php";

if (isset($_GET['id'])) {
$id = mysqli_real_escape_string($conn,$_GET['id']);
$sql = "SELECT * FROM contestants WHERE studentid = '$id'";
$query = mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($query);
$studentid = $row['studentid'];
$fullname = $row['fullname'];
$gender = $row['gender'];
$level = $row['level'];
$email = $row['email'];
$phone_number = $row['phone_number'];


if(isset($_POST['submit'])){

$MIN_LENGTH = 6;

    #storing data sent by the user and validating them
$studentid = secure_data($conn,$_POST['studentid']);
$studentid = strtoupper($studentid);
$fullname = secure_data($conn,$_POST['fullname']);
$fullname = strtoupper($fullname);
$gender = secure_data($conn,$_POST['gender']);
$gender = strtoupper($gender);
$level = secure_data($conn,$_POST['level']);
$email = secure_data($conn,$_POST['email']);
$phone_number = secure_data($conn,$_POST['phone_number']);
$photo = $_FILES['photo']['name'];
$photo_temp_name = $_FILES['photo']['tmp_name'];
$password = $_POST['pass'];
$confpassword = $_POST['confpass'];


    #check if the field are not empty
if(ctype_space($studentid) || ctype_space($fullname) || ctype_space($gender) || ctype_space($level) || ctype_space($phone_number) || ctype_space($email) || ctype_space($password)  || ctype_space($confpassword)){
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
    #check if the user have already registered
	$sql2 = "UPDATE contestants SET studentid ='$studentid', fullname='$fullname', password='$password', gender='$gender', level='$level',email='$email', phone_number='$phone_number', photo ='$photo' WHERE studentid ='$id';";
if(mysqli_query($conn,$sql2)){
	move_uploaded_file($photo_temp_name,"files/".$photo);
echo "<script>alert('Successfully Updated!')</script>";
}else{
echo "<script>alert('Please try updating again')</script>";
}	
}
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Registration Form</title>
		<link rel="shortcut icon" href="images/nacos.jpg">
		<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-progressbar.css" rel="stylesheet">

    <link href="assets/css/docs.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

	</head>
<style>
body{
	background-image:url(images.jpg);
	background-repeat:no-repeat;
	background-color:light;
}
table{
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

	color:black;
	font-family:cambria;
}
.table-style{
	width:200;

	top-margin-color:white;
}
.table-style1{
	width:230;

	top-margin-color:white;
}

</style>

<body style="margin:30;background-color:lightblack;color:#black;">
<div class="container-fluid">
<form method='post' action='Updatecont.php?id=<?php echo $id;?>' enctype = 'multipart/form-data'>
	<table width='500' height='600'  align='center' bgcolor='white' >
	<tr>
		<td colspan="5" bgcolor="white" width="100" height="100" align="center"><img class="nacosimg" src="images/nacos.jpg" width="100" height="100" align="center"></td>
		<tr>
	<tr>
		<td colspan='5' align='center'><h1 style="margin:0;padding:0px; color:black; ">MEMBERS FORM</h1></td>
		<marquee>Ensure that all information are being checked before submission!</marquee>
	</tr>


	<tr>
		<td align='center'>Student ID:</td>
		<td><input class="table-style1" type='text' name='studentid' value="<?php echo $studentid;?>" size="24" placeholder="Enter your ID Number " required/></td>
	</tr>
	<tr>
		<td align='center'>Full Name:</td>
		<td><input class="table-style1" type='text' name='fullname' value="<?php echo $fullname;?>" size="24" placeholder="Surname First" required/></td>

	</tr>
	<tr>
		<td align='center'>Gender:</td>
		<td><select name="gender" required><option value="" class="table-style">Please Select Gender</option>
		<option value="Male">Male</option>
		<option value="Female">Female</option>
		</td>


	</tr>
	<tr>
		<td align='center'>Level:</td>
		<td ><select name="level" required><option size="24" value="" size="24" class="table-style">Please select your level</option>
			<option value="100">100</option>
			<option value="200">200</option>
			<option value="300">300</option>
			<option value="400">400</option>
			<option value="500">500</option></select></td>
	</tr>
	<tr>
		<td align='center'>Position:</td>
		<td ><select name="position" required><option size="24" value="" size="24" class="table-style">Position</option>
			<option value="President">President</option>
			<option value="Vice presiden">Vice presiden</option>
			<option value="secretary">secretary</option>
			<option value="treasurer">treasurer</option>
			<option value="pro">Pro</option></select></td>
	</tr>
	<tr>
		<td align='center'> Phone Number:</td>
		<td><input type='int' class="table-style1" name='phone_number' size="24" placeholder="+234 "required/>
		</td>
	</tr>
	<tr>
		<td align='center'>Email:</td>
		<td><input type='email' class="table-style1" name='email' value="<?php echo $email;?>" size="24" required/></td>
	</tr>
	<tr>
		<td align='center'>Password:</td>
		<td><input type='password' name='pass' size="24"class="table-style1" required/></td>
	</tr>
	<tr>
		<td align='center'>confirm password:</td>
		<td><input type='password' name='confpass' size="24"class="table-style1" required/></td>
	</tr>
	<tr>
		<td align='center'>Photo:</td>
		<td><input type='file' name="photo" class="table-style1" /></td>
	</tr>
	<tr>
		<td colspan='5' align='center'><button  id="save"  title="Click to Save Your Information" type="submit" name="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Submit</button>
		</td>
	</tr>


		</table>

</form>
</div>
	<center><b>Already registered</b><br><a href='login.php'>Login Here</a></center>
</body>
</html>

