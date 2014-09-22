<?php
require_once("snapchat.php");

if(is_null($_COOKIE['username']) || is_null($_COOKIE['password']))
{
    header("Location: index.php");
}

//$snapchat = new Snapchat($_COOKIE['username'], $_COOKIE['password']);

//$friends = $snapchat->getFriends();
//echo "<pre>" . print_r($friends, 1) . "</pre>";
$friends = array(
    0 => array(
        'can_see_custom_stories' => 1,
        'direction' => 'OUTGOING',
        'name' => 'stevie-bot',
        'display' => '',
        'type' => 0
    ),
    1 => array(
        'can_see_custom_stories' => 1,
        'direction' => 'OUTGOING',
        'name' => 'skibum1',
        'display' => 'Cam Wilson',
        'type' => 0
    ),
    2 => array(
        'can_see_custom_stories' => 1,
        'direction' => 'OUTGOING',
        'name' => 'schreindorferj',
        'display' => 'Jess',
        'type' => 0
    )
);

foreach($friends as $person)
{
    $userList[] = array(
        'display' => $person['display'],
        'name' => $person['name']
    );
}
sort($userList);

echo "<br/><br/><br/><br/><pre>".print_r($userList, 1)."</pre>";

foreach($userList as $name)
{
    $nameSelect .= "<a href='' class='list-group-item'><input type='submit' value='Delete' name='".$name['name']."' class='btn btn-danger' style='margin-right: 7px' />";
    $nameSelect .= $name['display'] == "" ? $name['name'] : $name['display'];
    $nameSelect .= '</a>';
}

if($_POST)
{
    echo "<br/><br/><br/><br/><pre>".print_r($_POST, 1)."</pre>";
    $key = array_search('Delete', $_POST);
    echo "<br/><br/><br/><br/><pre>".$userList[$key]['name']."</pre>";
}

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
                <li><a href="sendsnap.php"><span class="glyphicon glyphicon-send"></span> Send Snap</a></li>
                <li class="active"><a href="managefriends.php"><span class="glyphicon glyphicon-user"></span> Manage Friends</a></li>
            </ul>
        </div>
    </nav>
    <form action="" method="post">
        <div class="list-group" style="width: 50%; margin-left: 25%">
            <?php echo $nameSelect; ?>
        </div>
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