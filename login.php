<?php
session_start();
include('./connections/config.php');
include('./function.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $password1 = $row['password'];
    $status = $row['verified'];


    if (empty($email) && $email < 3) {
        $msg['error'] = "Enter a Valid Email";
    } else{
    if (empty($password) && $password < 4) {
        $msg['error'] = "Enter a Valid Password";
    } else{
    if (mysqli_num_rows($result) < 0) {
        $msg['error'] = "User Does Not Exist";
    } else{
    if (password_verify($password, $password1)) {
            if ($status == '0') {
                        $msg['error'] = "Not Verified";
                    }else{

                    }
    } else{
        $msg['error'] = "Password Invalid";
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
    <title>Rekon Login</title>
</head>

<body>
    
    <form method="POST" class="login">
        <?php
    if (isset($msg['error'])) {
        # code...

    ?><p class="error"><?php echo $msg['error']; ?></p>
        </p><?php } ?>
        <label for="">Email</label><br>
        <input type="text" name="email"><br>
        <label>Password</label> <br>
        <input type="password" name="password"><br>
        <br><input type="submit" name="login" class="btn" value="Login"><br>
        <a href="./signup" class="login">Sign Up</a>
    </form>
</body>

</html>