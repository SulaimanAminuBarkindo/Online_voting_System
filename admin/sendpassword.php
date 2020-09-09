<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'connection.php';

if (isset($_POST['sendPass'])) {
  $query = mysqli_query($conn,"SELECT * FROM nacoss");
  while ($row = mysqli_fetch_assoc($query)) {
    $email = $row['email'];
    $password = $row['password'];
    $name = $row['firstname']." ".$row['lastname'];

    sendPassword($email, $password, $name);
  }
}

function sendPassword($email, $password, $name){
  $message = "";
  $subject = "Your E-voting Passsword";
  $body = "<p>Dear $name your password for E-voting is <b>".$password."</b> <i style = 'color:red;''>handle it with care! share it with no body</i></p>";
  $altbody = "Dear $name your password for E-voting is $password handle it with care! share it with no body";
  $user = "sulaimanaminu02@gmail.com";
  $pass = "35494020";
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 1;
  $mail->Username = $user;
  $mail->Password = $pass;
  $mail->SMTPSecure = "tls";
  $mail->Port = 587;
  $mail->setFrom($user);
  $mail->addReplyTo("no-reply@nuts.com", "ELCOM");
  $mail->addAddress($email);
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AltBody = ($altbody);

  if($mail->send()){
    $message = "<p><label class = 'text-danger'>mail send succefully</label></p>";
}
  else{
    $message .= "<p><label class = 'text-danger'>mailer error.$mail->ErrorInfo</label></p>";
  }
}
?>
<html>
    <head>
        <title>payment page</title>
         <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <form action="" method="post">
            <input type="submit" name="sendPass" value="Submit" class="btn btn-success btn-block">
          </form>
            
            </html>