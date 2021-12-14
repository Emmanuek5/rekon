<?php
session_start();
include('./connections/config.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReKon</title>
    <link rel="stylesheet" href="./Css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="check" class="checkbox">
        <label for="check"  class="checkbox"><i class="fa fa-bars" aria-hidden="true"></i>
</label>
     

        <label class="logo">ReKon</label>
        <ul>
            <li><a href="#" class="active">Chat</a></li>
            <li><a href="#">Teams</a></li>
            <li><a href="#">Forums</a></li>
            <li><a href="signup">Sign-Up</a></li>
        </ul>
    </nav>

</body>

</html>