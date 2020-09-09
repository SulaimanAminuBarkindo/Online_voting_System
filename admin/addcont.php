<?php
date_default_timezone_set('Africa/Niamey');
$studentid = "";
$fullname = "";
$gender = "";
$level = "";
$position ="";
$email = "";
$phone_number = "";
$nickname = "";
$date = date('Y-m-d H:i:s');
$photo ="";
    if(isset($_POST['submit'])){
                require "connection.php";
                require "functions.php";
                $MIN_LENGTH =6;
	            $studentid = secure_data($conn,$_POST['studentid']);
	            $studentid = strtoupper($studentid);
	    	    $fullname = secure_data($conn,$_POST['full_name']);
	    	    $fullname = strtoupper($fullname);
	    		$gender = secure_data($conn,$_POST['gender']);
	    		$gender = strtoupper($gender);
	    		$level = secure_data($conn,$_POST['level']);
	    		$phone_number = secure_data($conn,$_POST['phone_number']);
	    		$email = secure_data($conn,$_POST['email']);
	    		$position = secure_data($conn,$_POST['position']);
	    		$position = strtoupper($position);
	    		$password = $_POST['pass'];
	    		$confpassword = $_POST['confpass'];
    		    $photo = $_FILES['photo']['name'];
    		    $photo_temp_name = $_FILES['photo']['tmp_name'];
    		    $status = 'draft';
				$nickname = secure_data($conn,$_POST['nickname']);
				$nickname = strtoupper($nickname);
                if(ctype_space($studentid) || ctype_space($fullname) || ctype_space($gender) || ctype_space($level) || ctype_space($position) || ctype_space($phone_number) || ctype_space($email) || ctype_space($password)  || ctype_space($confpassword) || ctype_space($photo)){
	               echo "<script>alert('one or more field is empty')</script>";
	               }
	               elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	               echo "<script>alert('invalid email')</script>";
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
$sql = "SELECT studentid,email FROM contestants WHERE studentid = ? OR email = ? LIMIT 1";
$stmt1=mysqli_stmt_init($conn);
if(!$stmt1->prepare($sql))
{
echo "SQL ERROR1";
}else{
$stmt1->bind_param('ss',$studentid,$email);
$stmt1->execute();
$stmt1->bind_result($dbstudentid,$dbemail);
$stmt1->fetch();
    #check if the user have already registered
if($dbstudentid == $studentid || $dbemail == $email){
echo "<script>alert('studentid \'$studentid\' or email \'$email\' already taken by another, please try another one!')</script>";
}
    #register the user if the user have'nt registered
else{
$sql2 = "INSERT INTO contestants (studentid, fullname, nickname, password, gender, level, position, email, phone_number, photo,status,date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";
$stmt2 = mysqli_stmt_init($conn);
if(!$stmt2->prepare($sql2))
{
echo "SQL ERROR ";
}else{
$stmt2->bind_param('sssssissssss',$studentid,$fullname, $nickname, $password ,$gender,$level,$position,$email,$phone_number,$photo,$status,$date);
}
if($stmt2->execute()){
echo "<script>alert('Registration Successful!')</script>";
move_uploaded_file($photo_temp_name,"files/".$photo);
}else{
echo "<script>alert('Please try registering again')</script>";
}
}
}
}
}

?>
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
	<?php
						if (isset($_POST['submit'])) {
		$num=$_POST['num'];
		for ($i=1; $i <=$num ; $i++) { 
			# code...
	?>
<div class="container-fluid">
<form method='post' action='contestantregister.php' enctype = 'multipart/form-data'>
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
		<td><input class="table-style1" type='text' name='full_name' value="<?php echo $fullname;?>" size="24" placeholder="Surname First" required/></td>

	</tr>
	<tr>
		<td align='center'>Nickname:</td>
		<td><input class="table-style1" type='text' name='nickname' value="<?php echo $nickname;?>" size="24" placeholder="Surname First" required/></td>

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
										<?php
}
}
?>
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

