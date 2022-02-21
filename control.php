<?php

session_start();

include_once 'setting.php';

//variable  used 
$name = isset($_POST['name']) ? $_POST['name'] : "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$gander = isset($_POST['gander']) ? $_POST['gander'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$repassword = isset($_POST['repassword']) ? $_POST['repassword'] : "";
$error = [];

// INSERT INTO `users` (`id`, `name`, `phone`, `email`, `image`, `code`, `status`, `geneder`, `password`) VALUES (DEFAULT, 'ali', '0111117548', 'ali@yahoo.com', 'image.png', '', '', 'm', 'Al123456789');


// validation name 
function name($name)
{
    if (empty($name)) {
        $error['name'][0] = "Error! You didn't enter the Name.";
        return false;
    } else {
        if (!preg_match("/^[a-zA-z]*$/", $name)) {
            $error['name'][1] = "Only alphabets and whitespace are allowed.";
            return false;
        } else {
            return true;
        }
    }
}

// validation phone 
function phone($mobileno)
{
    if (empty($mobileno)) {
        $error['phone'][0] = "Error! You didn't enter the phone.";
        return false;
    } else {
        if (!is_numeric($mobileno)) {
            $error['phone'][1] = "Only numeric value is allowed.";
            return false;
        } else {
            return true;
        }
    }
}

// validation re-password
function repassword($psw, $repsw)
{
    if ($psw === $repsw) {
        return true;
    } else {
        $error['repassword'][0] = "Your passwords did not match";
    }
}


// validation email 
function  validatemail($mail)
{
    global $error;
    if (!empty($mail)) {
        $sfmail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        if (filter_var($sfmail, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        } else {
            $error["email"][1] = 'please enter correct e-mail';
            return FALSE;
        }
    } else {
        $error["email"][2] = "please enter email ";
        return FALSE;
    }
}

//validate password
function validatepwd($pwd)
{
    global $error;
    if (!empty($pwd)) {

        if (!preg_match('/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/', $pwd)) {
            $error['pwd'][0] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number';
            return FALSE;
        } else {
            return TRUE;
        }
    } else {
        $error['pwd'][1] = "please enter password ";
        return FALSE;
    }
}

// search about email and password of the database 
function finduser($em, $pass)
{
    global $conn, $error;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$em}' AND password ='{$pass}'");
    if (mysqli_num_rows($result) !== 0) {

        $_SESSION["userinfo"] = $result->fetch_object();
        return TRUE;
    } else {
        $error["email"][0] = "email or password uncorrect";
        return FALSE;
    }
}

//entry data 

function adduser($name, $pho, $mal, $gan, $pasw)
{

    global $conn, $error;
    $sql = "INSERT INTO `users` ( `name`, `phone`, `email`,  `geneder`, `password`) VALUES ( '$name', '$pho', '$mal', '$gan','$pasw');";

    if ($conn->query($sql) === TRUE) {
        return 'true' ; 
    } else {
        $error["signup"][0] = "some thing error please try again in other time .";
        return 'false';
    }
}





//function for  login
function login($eml, $pas)
{
    global $error;
    if (validatemail($eml)) {
        if (validatepwd($pas)) {
            if (finduser($eml, $pas)) {
                header("location: profile.php");
            } else {
                $_SESSION["error"] = $error;
                header("location: login.php");
            }
        } else {
            $_SESSION["error"] = $error;
            header("location: login.php");
        }
    } else {
        $_SESSION["error"] = $error;
        header("location: login.php");
    }
}

//function for signup
function signup($name, $pho, $mal, $gan, $pasw, $repasw)
{
    global $error;
    if (name($name) && phone($pho) && validatepwd($pasw) && repassword($pasw, $repasw) && validatemail($mal)) {
        adduser($name, $pho, $mal, $gan, $pasw);
        $_SESSION["success"] ="<div  style='color:#77D970;'> Done, you now ready to sign in </div>";
        header("location: login.php");

    } else {
        $_SESSION["error"] = $error;
        header("location: login.php?id='1'");
    }
}

if (isset($_POST['login'])) {

    login($email, $password);
}

if (isset($_POST['signup'])) {
    signup($name, $phone, $email, $gander, $password, $repassword);
}
