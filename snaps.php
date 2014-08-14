<?php
require_once("snapchat.php");

session_start();
$_POST = $_SESSION;

$snapchat = new Snapchat($_POST['username'], $_POST['password']);
$snapList = $snapchat->getSnaps();

//echo '<pre>';
//echo print_r($snapList, 1);
//echo '</pre>';

error_reporting(0);
$snapHTML = '<div class="row">';
for($i = 0; $i < 5; $i++)
{
    $snap = get_object_vars($snapList[$i]);
    $data = $snapchat->getMedia($snap['id']);
    $img = imagecreatefromstring($data);
    if($img)
    {
        $b64 = base64_encode($data); // Get what we've just outputted and base64 it
        //$snapHTML .= "<image src=\"data:image/png;base64,$b64\"/><br/>";
        $snapHTML .= '<div class="col-lg-4 col-sm-6 col-xs-6"><img class="img-responsive thumbnail" style="height: 500px; margin-bottom: 7px;" src="data:image/png;base64,' . $b64 . '" alt="img"></div>';
    }
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
<body>
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
    <?php echo $snapHTML; ?>
</div>
</body>
</html>