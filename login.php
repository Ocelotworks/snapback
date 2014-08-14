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
        html, body {
            background-color: #eee;
        }
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
<body>
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
                        <!--
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember">Remember me
                            </label>
                        </div>
                        -->
                        <div class="dropdown">
                            <label>View Data Type</label>
                            <select name="dataType">
                                <option value="snaps.php" selected="true">Unopened Snaps</option>
                                <option value="stories.php">Stories</option>
                            </select>
                        </div>

                        <button class="btn primary" type="submit">Sign in</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div> <!-- /container -->
</body>
</html>