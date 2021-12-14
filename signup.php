<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('./connections/config.php');

require './assets/phpmailer/Exception.php';
require './assets/phpmailer/PHPMailer.php';
require './assets/phpmailer/SMTP.php';

if (isset($_POST['register'])) {


  $username = $_POST['username'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password1 = $_POST['password'];
  $password = password_hash($password1, PASSWORD_BCRYPT);

  $filenewname = date('dmy') . time() . $_FILES['file']['name'];
  $tmpfile = $_FILES['file']['tmp_name'];

  $location = './addons/' . $filenewname;

  $sql1 = "SELECT * FROM `users` WHERE `user_name` = '$username'";
  $result = mysqli_query($con, $sql1);


  if (mysqli_num_rows($result) > 0) {

    $msg['error'] = "Username Is Taken";
  } else {
    # code...


    if (empty($password) && $username < 2) {
      $msg["error"] = 'Enter A Valid UserName';
    } else {
      if (empty($password) && $password < 4) {
        $msg["error"] = 'Enter A Valid Password';
      } else {
        if (empty($email) && $email < 3) {
          $msg["error"] = 'Enter A Valid Email';
        } else {
          if (empty($name)) {
            $msg["error"] = 'Enter A  Name';
          } else {
            $str = rand();
            $result = md5($str);
            $verified = "0";

            $user_id = $result;
            $sql = "INSERT INTO `users`( `user_id`, `user_name`, `name`, `email`, `password`, `image`, `verified`, `is_pro`, `is_verified`, `other_platforms`) VALUES 
('$user_id','$username','$name','$email','$password','$filenewname','$verified','$verified','$verified','$verified')";

            mysqli_query($con, $sql);
            move_uploaded_file($tmpfile, $location);



            $otp = rand(0, 9999);
            $_SESSION['otp'] = $otp;
            $_SESSION['user_id'] = $user_id;
            $subject = "Rekon Otp";

            $body = "Hi There " . $username . "<br>" . "Your Code Is " . $otp;


            $mail = new PHPMailer(true);


            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'greenobsidian42@gmail.com';                     //SMTP username
            $mail->Password   = 'Jesus2010#';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('greenobsidian@gmail.com', $subject);
            $mail->addAddress($email, $name);     //Add a recipient
            $mail->addReplyTo('greenobsidian@gmail.com', 'Information');


            //Attachments
            //Add attachments
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $e = $mail->send();

            header('location: verification');
          }
        }
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Css/register.css">
  <title>Get Started</title>
</head>

<body>

  <form method="POST" enctype="multipart/form-data">
    <?php
    if (isset($msg['error'])) {
      # code...

    ?><p class="error"><?php echo $msg['error']; ?></p>
      </p><?php } ?>
    <label for="">Username</label><br>
    <input type="text" name="username"><br>
    <label>Full Name</label><br>
    <input type="text" name="name">
    <label>Email</label>
    <input type="email" name="email">
    <div class="form"><small>we will send a code to this email address</small><br></div>
    <label>Password</label> <br>
    <input type="password" name="password">
    <label><br> Image</label>
    <input type="file" class="image" accept=".jpg,.png,.jpeg,.gif" name="file"><Br>
    <input type="submit" name="register" class="btn " value="Register"><br>

    <a href="./login"> Login</a>
  </form>
</body>

</html>