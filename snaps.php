<?php
require_once("snapchat.php");

session_start();
$_POST = $_SESSION;

if(!$_SESSION['username'] || $_SESSION['logout'])
{
    header("Location: login.php");
}

$snapchat = new Snapchat($_POST['username'], $_POST['password']);
$snapList = $snapchat->getSnaps();

//echo '<pre>' .print_r($snapList, 1) . '</pre>';

error_reporting(0);
$snapHTML = '<div class="row">';
$snapNames = array();
foreach($snapList as $snap)
{
    $snap = get_object_vars($snap);

    if(!array_key_exists($snap['sender'], $snapNames) && $snap['time'] != "")
    {
        $snapNames[$story['sender']] = $snap['sender'];
    }
}

foreach($snapNames as $name)
{
    $snapHTML .= "<div class=\"row\"><h3 style='color: white'>$name</h3>";
    foreach($snapList as $snap)
    {
        $snap = get_object_vars($snap);
        //echo '<pre>' .print_r($snap, 1) . '</pre>';
        if($snap['sender'] == $name && $snap['time'] != "")
        {
            $data = $snapchat->getMedia($snap['id']);
            $img = imagecreatefromstring($data);
            if($img)
            {
                $b64 = base64_encode($data); // Get what we've just outputted and base64 it
                $snapHTML .= '<div class="col-xs-3"><img src="data:image/png;base64,'.$b64.'" class="thumbnail img-responsive"></div>';
            }
        }
    }
    $snapHTML .= '</div>';
}

for($i = 0; $i < 5; $i++)
{

}
$snapHTML .= '</div>';

error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
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
                <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="active"><a href="snaps.php"><span class="glyphicon glyphicon-asterisk"></span> Unopened Snaps</a></li>
                <li><a href="stories.php"><span class="glyphicon glyphicon-book"></span> Stories</a></li>
            </ul>
        </div>
    </nav>
    <?php echo $snapHTML; ?>
</div>
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>