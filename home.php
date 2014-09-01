<?php
session_start();

if(!$_SESSION['logout'] && $_SESSION['username'])
{
    $_POST = $_SESSION;
}

if($_POST['username'])
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    session_start();
    $_SESSION = $_POST;
}
else
{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <title>SnapBack</title>
</head>
<style>
    .nav-pills
    {
        margin-top: 4px;
    }
</style>
<body style="background-color: black">
<div class="container">
    <img src="snapback.png" style="width: 315px"/>
    <div class="pull-right" style="color: white; margin-top: 10px; margin-right: 2px;">Welcome <?php echo $_POST['username']; ?>
        <a href="login.php?logout=true"><button class="btn btn-group-sm" style="margin-left: 2px;"><span class="glyphicon glyphicon-log-out"></span> Logout</button></a>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills">
                <li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="snaps.php"><span class="glyphicon glyphicon-asterisk"></span> Unopened Snaps</a></li>
                <li><a href="stories.php"><span class="glyphicon glyphicon-book"></span> Stories</a></li>
                <li><a href="sendsnap.php"><span class="glyphicon glyphicon-send"></span> Send Snap</a></li>
            </ul>
        </div>
    </nav>
    <center><img src="instructions.jpg"/></center>
</div>
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>