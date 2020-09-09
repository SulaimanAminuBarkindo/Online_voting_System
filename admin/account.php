<?php
session_start();
require "connection.php";
$studentid = "";

if(isset($_POST['submit'])){
$admin_id = strtoupper($_POST['admin_id']);
$password = $_POST['password'];

    #check if the fields are field out
if(ctype_space($admin_id) || ctype_space($password) ){
echo "<script>alert('please fill in the fields')</script>";

    #check if the admin is valid admin
}else{

$sql = "SELECT password,name FROM admin WHERE admin_id = ? LIMIT 1;";
$stmt = mysqli_stmt_init($conn);
if (!$stmt->prepare($sql)) {
echo "SQL ERROR 1";
}else{
$stmt->bind_param('s',$admin_id);
$stmt->execute();
$stmt->bind_result($hashedpw,$name);
$stmt->fetch();
if(password_verify($password, $hashedpw) == 1){
$_SESSION['admin_id'] = $admin_id;
$_SESSION['admin_name'] = $name; 
echo "<script>window.open('president.php','_self')</script>";
}else{
echo "<script>alert('inavlid ID or Password')</script>";
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
<body style="background-color: lightblue">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img width="50" height="50" src="images/logos.png"><a class="navbar-brand" href="#"><font color="white">NACOSS online voting system <small></small></font></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         
         
             
         </div>
        </div><!--/.nav-collapse -->
     </div>
   </nav>

    <div class="container">
        <div class="centered-form">
            <div class="col-lg-6 col-sm-8 col-md-4 col-sm-offset-2 col-md-offse-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><img width="70"; height="70";  src="images/nacos.jpg"></center>
                        <h3 class="panel-title" align="center">Login to account</h3>
                        
                    </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="adminview.php">
                                <div class="form-group">
                                    <input type="text" name="admin_id" value="<?php echo $studentid;?>"  class="form-control input-sm" placeholder="Student ID" required>
                                </div>
                                <form role="form"  method='post' action='aadminview.php'>
                                <div class="form-group">
                                    <input type="password" name="password"  class="form-control input-sm" placeholder="Password" required>
                                </div>

                                
                                <input type="submit" name="submit" value="Login" class="btn btn-success btn-block">
                                <div>
                                    <center><span>Not yet a member?<br> <a href="register.php">Sign Up Here</a></br></span></center>
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

      <!-- Footer
    ==================================================
    <footer style="background-color: black; height:auto; width:auto; margin-top: 550; margin: 0; margin-bottom: 0;">
    
    
        <p><a>Computer Science Department Mautech Yola, Adamawa State</a></p>
        <p>Programmed and Designed by: <a><strong>Nutscoders </strong></p><img src="logos.png" height="60", width="90">
     
      
    </footer>
     -->
  
</body>
</html>