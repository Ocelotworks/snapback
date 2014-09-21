<?php
if($_GET['logout'])
{
    setcookie("username", null, -1);
    setcookie("password", null, -1);
    header("Location: index.php");
}
else if($_POST && is_null($_GET['logout']))
{
    if(is_null($_COOKIE['username']) || is_null($_COOKIE['password']))
    {
        setcookie("username", $_POST['username'], time() + 3600);
        setcookie("password", $_POST['password'], time() + 3600);
    }
    header("Location: home.php");
}
else
{
    (is_null($_COOKIE['username']) || is_null($_COOKIE['password'])) ? header("Location: index.php") : header("Location: home.php");
}
?>