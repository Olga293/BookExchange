<?php
session_start();
require_once 'connect.php';

$error_catch = false;

if (isset($_POST['login'])){
    $login = $_POST['login'];
    if (strlen($login) == "0"){
        $_SESSION['e_login'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['password'])){
    $password = $_POST['password'];
    if (strlen($password) == "0"){
        $_SESSION['e_password'] = "* Заполните поле";
        $error_catch = true;
    }
}

if ($error_catch){
    header('Location: ../signin_page.php');
}
else{
    $password = md5($_POST['password']);

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");
    var_dump(mysqli_num_rows($check_user));
    if(mysqli_num_rows($check_user) > 0){
        $user = mysqli_fetch_assoc($check_user);
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "middle_name" => $user['middle_name'],
            "address" => $user['address'],
            "post_index" => $user['post_index'],
            "login" => $user['login'],
            "email" => $user['email']
        ];

        header('Location: ../personal_page.php');
    }else{
        $_SESSION['error']='Неверный логин или пароль';
        header('Location: ../signin_page.php');
    }
}