<?php
require_once("snapchat.php");

if(is_null($_COOKIE['username']) || is_null($_COOKIE['password']))
{
    header("Location: index.php");
}

$snapchat = new Snapchat($_COOKIE['username'], $_COOKIE['password']);

$friends = $snapchat->getFriends();
//echo "<pre>" . print_r($friends, 1) . "</pre>";
foreach($friends as $person)
{
    $user = get_object_vars($person);
    if($user['display'] == "")
    {
        $userList[$user['name']] = $user['name'];
    }
    else
    {
        $userList[$user['name']] = $user['display'];
    }
}
sort($userList);

$nameSelect = '<div style="color: white">Recipients: <br>(Use CTRL + Click / Command + Click to select multiple recipients.)</div>';
$nameSelect .= '<select name="targets[]" style="height: 125px; margin-top: 7px; float: left;" multiple>';
foreach($userList as $name => $display)
{
    $nameSelect .= '<option value="'.$name.'">';
    if($display != "")
    {
        $nameSelect .= $display.'</option>';
    }
    else
    {
        $nameSelect .= $name.'</option>';
    }
}

$nameSelect .= '</select><br><div style="color: white; float: none"></div>';


$allowedExtensions = array("jpeg", "jpg");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if($_FILES['file'])
{
    if((($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg"))
        && in_array($extension, $allowedExtensions))
    {
        if($_FILES["file"]["error"] > 0)
        {
            echo "<pre>";
            echo "Error: " . $_FILES["file"]["error"] . "<br>";
            echo "</pre>";
        }
        else
        {
            /*
            echo "<pre>";
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Stored in: " . $_FILES["file"]["tmp_name"];
            echo "</pre>";
            */
            sendFile($_FILES["file"]["tmp_name"], $_POST['targets'], $_POST['time']);
        }
    }
    else
    {
        echo "<pre>";
        echo "Invalid file";
        echo "</pre>";
    }
}

function sendFile($file, $target, $time)
{
    global $snapchat;
    $id = $snapchat->upload(Snapchat::MEDIA_IMAGE, file_get_contents($file));
    $snapchat->send($id, $target, $time);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>SnapBack</title>
</head>
<style>
    .nav-pills
    {
        margin-top: 4px;
    }

    .btn-file
    {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file]
    {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }

    input[readonly]
    {
        background-color: white !important;
        cursor: text !important;
    }
</style>
<script>
    $(document).on('change', '.btn-file :file', function()
    {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function()
    {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label)
        {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if(input.length)
            {
                input.val(log);
            }
            else
            {
                if(log) alert(log);
            }

        });
    });
</script>
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
                <li><a href="stories.php"><span class="glyphicon glyphicon-book"></span> Stories</a></li>
                <li class="active"><a href="sendsnap.php"><span class="glyphicon glyphicon-send"></span> Send Snap</a></li>
            </ul>
        </div>
    </nav>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse&hellip; <input type="file" name="file">
                    </span>
                </span>
            <input type="text" style="width: 20%; margin-right: 15px;" class="form-control" readonly>
            <button type="submit" class="btn btn-group">Submit</button>
        </div>
        <?php echo $nameSelect; ?>
        <span style="float: left; margin-left: 10px; margin-top: 10px;">
            <div style="color: white">Time (seconds):</div>
            <input type="number" name="time" min="1" max="10" value="3">
        </span>
    </form>
</div>
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>