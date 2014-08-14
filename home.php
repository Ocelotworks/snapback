<?php
/*
if (isset($_POST['username']) && isset($_POST['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
    if($_POST && isset($_POST['remember']))
    {
        // Set cookie to last 1 year
        setcookie('username', $_POST['username'], time() + 60 * 60 * 24 * 365);
        setcookie('password', md5($_POST['password']), time() + 60 * 60 * 24 * 365);

    }
    elseif($_POST || !isset($_POST['remember']))
    {
        // Cookie expires when browser closes
        setcookie('username', $_POST['username'], false);
        setcookie('password', md5($_POST['password']), false);
    }
}
else
{
    header('Location: login.php');
}
*/

if($_POST)
{
    $page = $_POST['dataType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    session_start();
    $_SESSION = $_POST;
    header("Location: $page");
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
<div class="container">
    <h1>SnapBack</h1>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="snaps.php">Unopened Snaps</a></li>
                    <li><a href="stories.php">Stories</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</html>