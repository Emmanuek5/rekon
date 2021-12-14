<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('./connections/config.php');

require './assets/phpmailer/Exception.php';
require './assets/phpmailer/PHPMailer.php';
require './assets/phpmailer/SMTP.php';

include('./connections/config.php');



function check_login($con)
{
	if (isset($_SESSION['success'])) {
		$id = $_SESSION['success']['user_id'];
		$sql= "SELECT * FROM `users` WHERE `user_id` = '$id'";
		$result = mysqli_query($con,$sql);
		$user_data = mysqli_fetch_assoc($result);

		$logedin = 'True';

		return $user_data;
	}else{
		header('location: login');
	}
}




function mailer($email,$name,$subject,$body)
{


 


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
            $mail->setFrom('ReKon', $subject);
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



}












?>