<?php

session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file system & fliter</title>
    <style>
        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

        *,
        :after,
        :before {
            box-sizing: border-box
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table
        }

        .clearfix:after {
            clear: both;
            display: block
        }

        a {
            color: inherit;
            text-decoration: none
        }

        .login-wrap {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgba(40, 57, 101, .9);
        }

        .login-html .sign-in-htm,
        .login-html .sign-up-htm {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            transition: all .4s linear;
        }

        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check {
            display: none;
        }

        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button {
            text-transform: uppercase;
        }

        .login-html .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }

        .login-html .sign-in:checked+.tab,
        .login-html .sign-up:checked+.tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-form {
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-form .group {
            margin-bottom: 15px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-form .group .button {
            background: #1161ee;
        }

        .login-form .group label .icon {
            width: 15px;
            height: 15px;
            border-radius: 2px;
            position: relative;
            display: inline-block;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group label .icon:before,
        .login-form .group label .icon:after {
            content: '';
            width: 10px;
            height: 2px;
            background: #fff;
            position: absolute;
            transition: all .2s ease-in-out 0s;
        }

        .login-form .group label .icon:before {
            left: 3px;
            width: 5px;
            bottom: 6px;
            transform: scale(0) rotate(0);
        }

        .login-form .group label .icon:after {
            top: 6px;
            right: 0;
            transform: scale(0) rotate(0);
        }

        .login-form .group .check:checked+label {
            color: #fff;
        }

        .login-form .group .check:checked+label .icon {
            background: #1161ee;
        }

        .login-form .group .check:checked+label .icon:before {
            transform: scale(1) rotate(45deg);
        }

        .login-form .group .check:checked+label .icon:after {
            transform: scale(1) rotate(-45deg);
        }

        .login-html .sign-in:checked+.tab+.sign-up+.tab+.login-form .sign-in-htm {
            transform: rotate(0);
        }

        .login-html .sign-up:checked+.tab+.login-form .sign-up-htm {
            transform: rotate(0);
        }

        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot-lnk {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
        <?=isset($_SESSION["success"])?$_SESSION["success"]:""; ?>
            <input id="tab-1" type="radio" name="tab" class="sign-in" <?= (isset($_GET['id']) == "1" || (!isset($_GET['id']))) ? "checked" : ""; ?>><label for="tab-1" class="tab">Sign In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up" <?= (isset($_GET['id']) == "2") ? "checked" : ""; ?>><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
                <form action="control.php" method="POST">
                    <div class="sign-in-htm">
                        <div class="group">
                            <label for="user" class="label">email</label>
                            <input id="user" name="email" type="text" class="input" required>
                            <?php if (isset($_SESSION["error"]['email'])) {
                                foreach (($_SESSION["error"]['email']) as $value) {
                                    echo "<div style='color:#DA1212;'>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" name="password" type="password" class="input" data-type="password" required>
                            <?php if (isset($_SESSION["error"]['pwd'])) {
                                foreach (($_SESSION["error"]['pwd']) as $value) {
                                    echo "<div style='color:#DA1212; '>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <input name="login" type="submit" name="signin" value="signin" class="button" >
                        </div>
                        
                    </div>
                </form>
                <form action="control.php" method="POST" id="signup">
                <?php if (isset($_SESSION["error"]["signup"])) {
                        foreach (($_SESSION["error"]["signup"]) as $value) {
                            echo "<div style='color:#DA1212;'>" . $value . "</div>";
                        }
                    }
                    ?>
                    <div class="sign-up-htm">
                        <div class="group">
                            <label for="name" class="label">name</label>
                            <input id="name" name="name" type="text" class="input" required>
                            <?php if (isset($_SESSION["error"]['name'])) {
                                foreach (($_SESSION["error"]['name']) as $value) {

                                    echo "<div style='color:#DA1212;'>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <label for="phone" class="label">phone</label>
                            <input id="phone" name="phone" type="text" class="input" required>
                            <?php if (isset($_SESSION["error"]['phone'])) {
                                foreach (($_SESSION["error"]['phone']) as $value) {
                                    echo "<div style='color:#DA1212;'>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div style="color: #aaa; font-size: 18px; ">
                            <label for="male" class="label">male</label>
                            <input id="male" type="radio" name="gander" value="m">
                            <label for="famale" class="label">famale</label>
                            <input id="famale" type="radio" name="gander" value="f">

                        </div>
                        <div class="group">
                            <label for="pass" class="label">Password</label>
                            <input id="pass" name="password" type="password" class="input" data-type="password" required>
                            <?php if (isset($_SESSION["error"]['pwd'])) {
                                foreach (($_SESSION["error"]['pwd']) as $value) {

                                    echo "<div style='color:#DA1212; '>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Repeat Password</label>
                            <input id="pass" name="repassword" type="password" class="input" data-type="password" required>
                            <?php if (isset($_SESSION["error"]['repassword'])) {
                                foreach (($_SESSION["error"]['repassword']) as $value) {

                                    echo "<div style='color:#DA1212; '>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <label for="email" class="label">Email Address</label>
                            <input id="email" type="text" name="email" class="input" required>
                            <?php if (isset($_SESSION["error"]['email'])) {
                                foreach (($_SESSION["error"]['email']) as $value) {

                                    echo "<div style='color:#DA1212;'>" . $value . "</div>";
                                }
                            }
                            ?>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" name="signup" value="signup" >
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <label for="tab-1">Already Member?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php

if (isset($_SESSION["error"])) {
    unset($_SESSION["error"]);
}
if(isset($_SESSION["success"])){
    unset($_SESSION["success"]);
}

?>