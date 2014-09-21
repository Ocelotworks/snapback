<?php
require_once("snapchat.php");

if(is_null($_COOKIE['username']) || is_null($_COOKIE['password']))
{
    header("Location: index.php");
}

$snapchat = new Snapchat($_COOKIE['username'], $_COOKIE['password']);
$stories = $snapchat->getFriendStories();

//echo '<pre>' . print_r($stories, 1) . '</pre>';

error_reporting(0);
$storyHTML = "";
$userHeader = "";
$storyNames = array();

foreach($stories as $story)
{
    $story = get_object_vars($story);

    if(!array_key_exists($story['username'], $storyNames))
    {
        $storyNames[$story['username']] = $story['username'];
    }
}

foreach($storyNames as $name)
{
    $storyHTML .= "<div class=\"row\"><h3 style='color: white'>$name</h3>";
    foreach($stories as $story)
    {
        $story = get_object_vars($story);

        if($story['username'] == $name)
        {
            $data = $snapchat->getStory($story['media_id'], $story['media_key'], $story['media_iv']);
            $img = imagecreatefromstring($data);
            if($img)
            {
                $b64 = base64_encode($data); // Get what we've just outputted and base64 it
                $storyHTML .= '<div class="col-xs-3"><img src="data:image/png;base64,'.$b64.'" class="thumbnail img-responsive"></div>';
            }
        }
    }
    $storyHTML .= '</div>';
}

error_reporting(E_ALL);
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
    <div class="pull-right" style="color: white; margin-top: 10px; margin-right: 2px;">Welcome <?php echo $_COOKIE['username']; ?>
        <a href="login.php?logout=true"><button class="btn btn-group-sm" style="margin-left: 2px;"><span class="glyphicon glyphicon-log-out"></span> Logout</button></a>
    </div>
    <nav class="navbar navbar-default" role="navigation">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills">
                <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="snaps.php"><span class="glyphicon glyphicon-asterisk"></span> Unopened Snaps</a></li>
                <li class="active"><a href="stories.php"><span class="glyphicon glyphicon-book"></span> Stories</a></li>
                <li><a href="sendsnap.php"><span class="glyphicon glyphicon-send"></span> Send Snap</a></li>
            </ul>
        </div>
    </nav>
    <?php echo $storyHTML; ?>
</div>
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>