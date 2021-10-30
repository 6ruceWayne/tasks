<?php
include 'UserService.php';
session_start();

$db = mysqli_connect('database_link', 'user', 'password', 'database_name');

$errors   = array();

if (isset($_POST['register_btn'])) {
    register();
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: index.php");
}

if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login()
{
    global $db, $username, $errors;
    $username = e($_POST['username']);
    $password = e($_POST['password']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $password = SHA1($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin' || $logged_in_user['user_type'] == 'super_admin') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "You are now logged in";
                header('location: admin/admin_panel.php');
            } else {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "You are now logged in";
                header('location: /index.php');
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

// REGISTER USER
function register()
{
    global $db, $errors;
    $username    =  e($_POST['username']);
    $email       =  e($_POST['email']);
    $password_1  =  e($_POST['password_1']);
    $password_2  =  e($_POST['password_2']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    if (count($errors) == 0) {
        $password = SHA1($password_1);
        if (isset($_POST['user_type'])) {
            $user_type = e($_POST['user_type']);
            $query = "INSERT INTO users (username, email, user_type, is_active, password) 
					  VALUES('$username', '$email', '$user_type','1', '$password')";
            mysqli_query($db, $query);
            $_SESSION['success']  = "New user successfully created!!";
            header('location: home.php');
        } else {
            $query = "INSERT INTO users (username, email, user_type, is_active,password) 
					  VALUES('$username', '$email', 'user','1', '$password')";
            mysqli_query($db, $query);
            $logged_in_user_id = mysqli_insert_id($db);
            $_SESSION['user'] = getUserById($logged_in_user_id);
            $_SESSION['success']  = "You are now logged in";
            header('location: index.php');
        }
    }
}

function e($val)
{
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error()
{
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo $error .'<br>';
        }
        echo '</div>';
    }
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function is_admin()
{
    if (isset($_SESSION['user']) && ($_SESSION['user']['user_type'] == 'admin' || $_SESSION['user']['user_type'] == 'super_admin')) {
        return true;
    } else {
        return false;
    }
}

function is_super_admin()
{
    return $_SESSION['user']['user_type'] == 'super_admin';
}
