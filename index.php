<?php

if(!is_null($_COOKIE['username']) && !is_null($_COOKIE['password']))
{
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SnapBack Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
    /* Override some defaults */
    body {
    padding-top: 40px;
        }
        .container {
    width: 300px;
        }

        /* The white background content wrapper */
        .container > .content {
            background-color: #fff;
            padding: 20px;
            margin: 0 -20px;
            -webkit-border-radius: 10px 10px 10px 10px;
            -moz-border-radius: 10px 10px 10px 10px;
            border-radius: 10px 10px 10px 10px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
            box-shadow: 0 1px 2px rgba(0,0,0,.15);
        }

        .login-form {
    margin-left: 65px;
        }

        legend {
    margin-right: -50px;
            font-weight: bold;
            color: #404040;
        }

    </style>

</head>
<body style="background-color: black">
<center><img src="images/snapback.png" style="width: 50%"/></center><br>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="login-form">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <fieldset>
                        <div class="clearfix">
                            <input type="text" name="username" placeholder="Username">
                        </div>
                        <div class="clearfix">
                            <input type="password" name="password" placeholder="Password">
                        </div>

                        <button class="btn" type="submit">Sign in</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div> <!-- /container -->
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