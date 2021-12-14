<?php
session_start();
include('./connections/config.php');





if (isset($_POST['otp'])) {
    $otp = $_POST['code'];
    $otp1 = $_SESSION['otp'];
    if ($otp == $otp1) {
        $user_id =$_SESSION['user_id'];
       $sql = " UPDATE `users` SET `verified`= '1' WHERE  `user_id` = '$user_id'";
       mysqli_query($con,$sql);
       header('location: login'); 




     
    }else {
        $msg['error'] ="Otp  Inorrect";
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
    <title>Verification</title>
</head>

<body>
<?php
if (isset($msg['error'])) {
    # code...

?><p class="error"><?php  echo $msg['error']; ?></p> </p><?php }?>
    <form  method="POST" class="verify">
        <label>Otp Code</label>
        <input type="password" name="code" placeholder="Code Here..">


        <br><input type="submit" name="otp" class="code" value="Enter">
    <a href="./resend" >Resend Code</a> 
    </form>
    
</body>

</html>