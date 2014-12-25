<?php
require_once("snapchat.php");

if(is_null($_COOKIE['username']) || is_null($_COOKIE['password']))
{
    header("Location: index.php");
}

$snapchat = new Snapchat($_COOKIE['username'], $_COOKIE['password']);

$friends = $snapchat->getFriends();

foreach($friends as $user)
{
    $user = get_object_vars($user);
    if($user['display'] == "")
    {
        $userList[$user['name']] = $user['name'];
    }
    else
    {
        $userList[$user['name']] = $user['display'];
    }
}

$nameSelect = '<div style="color: white">Recipients: <br>(Use CTRL/Command + Click to select multiple recipients.)</div>';
$nameSelect .= '<select name="targets[]" style="height: 125px; margin-top: 7px; float: left;" multiple>';
foreach($userList as $name => $display)
{
    $nameSelect .= "<option value=\"{$name}\">";
    if($display !== "")
    {
        $nameSelect .= "{$display}</option>";
    }
    else
    {
        $nameSelect .= "{$name}</option>";
    }
}

$nameSelect .= '</select><br/><div style="color: white; float: none"></div>';

//echo "<pre>".print_r($_POST, 1)."</pre>";
//echo "<pre>".print_r($_FILES, 1)."</pre>";

if(array_key_exists("file", $_FILES))
{
    if($_FILES["file"]["error"] > 0)
    {
        echo "<pre>Error: " . $_FILES["file"]["error"] . "<br></pre>";
    }
    else
    {
        $imageInfo = getimagesize($_FILES["file"]["tmp_name"]);

        switch($imageInfo[2])
        {
            case IMAGETYPE_PNG  : $convertedRawImage = imagecreatefrompng($_FILES["file"]["tmp_name"]); break;
            case IMAGETYPE_JPEG : $convertedRawImage = imagecreatefromjpeg($_FILES["file"]["tmp_name"]); break;
            default : echo "<br/><br/><br/><pre>Invalid File.</pre>";
        }

        if(isset($convertedRawImage))
        {
            $tmpJpeg = tempnam("/tmp", "tempjpeg");
            $convertedImage = imagejpeg($convertedRawImage, $tmpJpeg, 100);

            sendFile($tmpJpeg, $_POST["targets"], $_POST['time']);
            unlink($tmpJpeg);
        }
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
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">boywanders.us</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="topitem"><a href="/"><i class="fa fa-home"></i>  Home</a></li>
                <li class="minecraft"><a href="/minecraft"><i class="fa fa-cube"></i> Minecraft Server</a></li>
                <li class="irc"><a href="/kiwiirc"><i class="fa fa-comment-o"></i> IRC Chat</a></li>
                <li class="snapback active"><a href="/snapback"><i class="fa fa-camera"></i> Snapback</a></li>
                <li class="blog"><a href="/blog"><i class="fa fa-user"></i> Blog</a></li>
            </ul>
        </div>
    </div>
</div><br/><br/><br/>
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
                <li><a href="managefriends.php"><span class="glyphicon glyphicon-user"></span> Manage Friends</a></li>
            </ul>
        </div>
    </nav>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse&hellip; <input type="file" name="file" accept=".png,.jpg,.jpeg">
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
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u=(("https:" == document.location.protocol) ? "https" : "http") + "://boywanders.us/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
        g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<noscript><p><img src="http://boywanders.us/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>