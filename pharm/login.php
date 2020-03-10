<?php
use Pharm\Manager as Manager;
session_start();
include 'ManagerClass.php';

if(isset($_SESSION['name'])) {
    header('location: index.php');
}

if(isset($_REQUEST['name']) && !empty($_REQUEST['name'])
    && isset($_REQUEST['pass']) && !empty($_REQUEST['pass'])
) {
    extract($_REQUEST);
    $manager = new Manager;
    if ($manager->check($name, $pass)) {
        $_SESSION['name'] = $name;
        if($name == 'admin') {
            $_SESSION['admin'] = true;
        }
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Vinny Pharmaceuticals</title>
    <style>
    *, *:after, *:before {
        font-family: 'Arial Narrow';
    }
    body {
        text-align: center;
        background: gainsboro;
    }
    input, select, textarea, option {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid grey;
        outline:none;
        display: inline-block;
        margin: 4px 0;
        font-family: calibri;
        outline: none;
    }
    textarea {
        resize: none;
    }
    input[type=submit] {
        background-color: #007bac;
        color: white;
        font-weight: bolder;
        border: 1px solid #00638a; 
    }
    form {
        margin: 4px;
        text-align: start;
        background-color: white;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #a59f9f;
        display: inline-block;
    }
    form label {
        width: 5em;
        display: inline-block;
    }
    img {
        width: 14em;
        margin:1em 0;
    }
    form {
        padding: 1em;
        margin-top: 10em;
    }
    </style>
</head>
<body>
    <form method = "post">
        <div class = "logo">
            <img src = "aa.png">
        </div>
        <div>
            <label>Username</label><input type = "text" name = "name">
        </div>
        <div>
            <label>Password</label><input type = "password" name = "pass">
        </div>
        <div> <input type="submit" value = "Log in"></div>
    </form>
</body>
</html>