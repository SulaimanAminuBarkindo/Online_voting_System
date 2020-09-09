<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$message = "";
$name = "";
$subject = "";
$from = "";

if(isset($_POST['submit'])){
  $from = $_POST['email'];
  $user = "sulaimanaminu02@gmail.com";
  $pass = "35494020";
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  $file = $_FILES['file']['tmp_name'];
  if(empty($name)){
    $message .= "<p><label class = 'text-danger'>Name shouldn't be empty</label></p>";
} elseif(empty($from)){
    $message .= "<p><label class = 'text-danger'>Email shouldn't be empty</label></p>";
} elseif(empty($subject)){
    $message .= "<p><label class = 'text-danger'>Subject shouldn't be empty</label></p>";
} /*elseif(!preg_match("/^[a-zA-Z]*$/",$name)){
    $message .= "<p><label class = 'text-danger'>Name can only contain characters and whitespaces</label></p>";
}*/ elseif(!filter_var($from, FILTER_VALIDATE_EMAIL)){
    $message .= "<p><label class = 'text-danger'>Please use a valid email</label></p>";
} else{
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 2;
  $mail->Username = $user;
  $mail->Password = $pass;
  $mail->SMTPSecure = "tls";
  $mail->Port = 587;
  $mail->setFrom($from);
  $mail->addReplyTo($from, $name);
  $mail->addAddress($user);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $subject;
  $mail->addAttachment($file);

  if($mail->send()){
    $message .= "<p><label class = 'text-danger'>mail send succefully</label></p>";
    $name = "";
    $subject = "";
    $from = "";
}
  else
    $message .= "<p><label class = 'text-danger'>mailer error.$mail->ErrorInfo</label></p>";
}
}
?>
<html>
    <head>
        <title>payment page</title>
         <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
             <link rel="stylesheet" href="assets/bootstrap/css/main.css">
    </head>
    
<body>

  
        <div class="container">
              <nav class="navbar navbar-default" >
                <ul class="nav navbar-nav">
                    <li class="active" role="presentation"><a href="index.php">Back to Home page</a></li>
                </ul>
                
                  </div></div>
    
       </ul>
                  <p style="text-align: center; font-size:30px;">Submit Your Journal</p>
    <div class="row .payment-dialog-row" style="background-image:url(&quot;assets/img/literature.jpg&quot;);background-repeat:round;">
        <div class="col-md-4 col-md-offset-4 col-xs-12" style="margin-top:100px;">
            <div class="panel panel-default credit-card-box">
        
                <div class="panel-body">
			<?php echo $message;?>
                    <form id="payment-form" method="post" action="submit-journal.php" enctype="multipart/form-data">
                        
                            <div class="col-xs-12">
                                <div class="form-group"><label class="control-label" for="couponCode">Full Name</label><input class="form-control" type="text" id="couponCode" name="name" value="<?php echo $name;?>" required></div>
                            </div>
                         <div class="col-xs-12">
                                <div class="form-group"><label class="control-label" for="couponCode">E-mail</label><input class="form-control" type="email" id="couponCode" name="email" value="<?php echo $from;?>" required></div>
                            </div>
                        
                          <div class="col-xs-12">
                                <div class="form-group"><label class="control-label" for="couponCode">Subject</label><input class="form-control" type="text" id="couponCode" name="subject" value="<?php echo $subject;?>" required></div>
                            </div>
                             
                       <div class="col-xs-12">
                           
                         <input type="file" name="file">Upload file
                        </div>
        
                        <div class="row">
                            <div class="col-xs-12"><button class="btn btn-info btn-block btn-lg" type="submit" name="submit">SUBMIT</button></div>
                        </div>
                             <br>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>