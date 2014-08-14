<?php
require_once("snapchat.php");

session_start();
$_POST = $_SESSION;

$snapchat = new Snapchat($_POST['username'], $_POST['password']);
$stories = $snapchat->getFriendStories();

//echo '<pre>';
//echo print_r($stories, 1);
//echo '</pre>';

error_reporting(0);
$storyHTML = "<div class=\"col-lg-4 col-sm-6 col-xs-12\">";
foreach($stories as $story)
{
    $story = get_object_vars($story);
    $data = $snapchat->getStory($story['media_id'], $story['media_key'], $story['media_iv']);
    $img = imagecreatefromstring($data);
    if($img)
    {
        $b64 = base64_encode($data); // Get what we've just outputted and base64 it
        $storyHTML .= "<img src=\"data:image/png;base64,$b64\" class=\"thumbnail img-responsive\"/></div><div class=\"col-lg-4 col-sm-6 col-xs-12\">";
    }
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
    <div class="row">
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
        <div class="col-xs-3">
            <a href="#" class="thumbnail">
                <img src="http://placehold.it/350x150" class="img-responsive">
            </a>
        </div>
    </div>
        <?php echo $storyHTML; ?>
</div>
</html>