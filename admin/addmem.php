<?php
require "connection.php";

$upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$lower_case = "abcdefghijklmnopqrstuvwxyz";
$numbers = "0123456789";
$special_chars = "?!@#$&";
$post_email = array();
$post_studentid = array();
$dbemail = array();
$dbstudentid = array();
//$mainlist_student_id = array();

if (isset($_POST['post'])) {
	$num = $_POST['num'];
	$query = mysqli_query($conn, "SELECT email, studentid FROM nacoss");
	
	while($row=mysqli_fetch_assoc($query)){
      $dbemail[] = $row['email'];
      $dbstudentid[] = $row['studentid'];
	}
	for ($i=0; $i <$num ; $i++) { 
			$generated_upper_case=substr(str_shuffle($upper_case), 0,2);
			$generated_lower_case=substr(str_shuffle($lower_case), 0,2);
			$generated_numbers=substr(str_shuffle($numbers), 0,2);
			$generated_special_chars=substr(str_shuffle($special_chars), 0,2);
			$post_email[] = $_POST['email'][$i];
			$post_studentid[] = $_POST['student_id'][$i];
			$pass = "$generated_upper_case$generated_lower_case$generated_numbers$generated_special_chars";
	                                    
            if (array_intersect($dbemail,$post_email) && array_intersect($dbstudentid,$post_studentid) ) {
               echo "same email and studentid found in the database";
            }elseif(array_intersect($dbemail,$post_email)){
			   echo "same email found in the database";
			}elseif(array_intersect($dbstudentid,$post_studentid)){
               echo "same id found in the database";
            }else{
               /*$query2 = mysqli_query($conn,"SELECT studentid FROM mainlist");
               while ($row1 = mysqli_fetch_assoc($query1)) {
               	$mainlist_student_id[] = $row1;
               }
               if(array_intersect($mainlist_student_id, $post_studentid)){
				 $query1 = mysqli_query($conn,"INSERT INTO nacoss(studentid,firstname,lastname,password,gender,level,email,phone_number,status) VALUES('".$post_studentid[$i]."','".$_POST['firstname'][$i]."','".$_POST['lastname'][$i]."','$pass','".$_POST['gender'][$i]."','".$_POST['level'][$i]."','".$post_email[$i]."','".$_POST['phone'][$i]."','unvoted')");
                           } 
				} but as of now the mainlist is not available to us*/
			   $post_studentid = array_unique($post_studentid);
               $post_email = array_unique($post_email);
               $query1 = mysqli_query($conn,"INSERT INTO nacoss(studentid,firstname,lastname,password,gender,level,email,phone_number,status) VALUES('".$post_studentid[$i]."','".$_POST['firstname'][$i]."','".$_POST['lastname'][$i]."','$pass','".$_POST['gender'][$i]."','".$_POST['level'][$i]."','".$post_email[$i]."','".$_POST['phone'][$i]."','unvoted')");
               $query2 = mysqli_query($conn."DELETE FROM nacoss WHERE studentid = NULL || email = NULL");
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
						<?php
						if (isset($_POST['submit'])) {
		$num=$_POST['num'];
		for ($i=1; $i <=$num ; $i++) { 
			# code...
	?>
						<h3 class="panel-title" align="center"><b>record#<?php echo $i?></b></h3>

					</div>
						<div class="panel-body">
							<form role="form" method="post" action="addmem.php">
								<div class="form-group">
									<input type="hidden" name="num" value="<?php echo $num;?>">
									<label>Student ID</label><input type="text" name="student_id[]" class="form-control input-sm" placeholder="Student ID" required>
								</div>

								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>First Name</label><input type="text" name="firstname[]"  class="form-control input-sm" placeholder="First Name" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Last Name</label><input type="text" name="lastname[]"  class="form-control input-sm" placeholder="Last Name" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Gender</label><input type="text" name="gender[]"  class="form-control input-sm" placeholder="Gender" required>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label>Level</label><input type="text" name="level[]"  class="form-control input-sm" placeholder="Level" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Email</label><input type="email" name="email[]" class="form-control input-sm" placeholder="Email Address" required>
								</div>
								<div class="form-group">
									<label>Phone Number</label><input type="text" name="phone[]" class="form-control input-sm" placeholder="phonenumber" required>
								</div>

								
									<?php
}
}
?>
								<input type="submit" name="post" value="Submit" class="btn btn-success btn-block">
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