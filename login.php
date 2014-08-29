<?php
if($_GET['logout'])
{
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['logout'] = "true";
    header("Location: login.php");
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
<center><img src="snapback.png" style="width: 50%"/></center><br>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="login-form">
                <h2>Login</h2>
                <form action="home.php" method="post">
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
</body>
<center>
    <footer>
        <small>© Copyright 2014, Ocelotworks</small>
    </footer>
</center>
</html>