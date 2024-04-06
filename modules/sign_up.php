<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';

$error_catch = false;

if (isset($_POST['name'])){
    $name = $_POST['name'];
    if (!preg_match('/^[а-я]+$/ui', $name)){
        $_SESSION['e_name'] = "* Имя может содержать только буквы русского алфавита<br>";
        $error_catch = true;
    }
    if (strlen($name) == "0"){
        $_SESSION['e_name'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['surname'])){
    $surname = $_POST['surname'];
    if (!preg_match('/^[а-я]+$/ui', $surname)){
        $_SESSION['e_surname'] = "* Фамилия может содержать только буквы русского алфавита<br>";
        $error_catch = true;
    }
    if (strlen($surname) == "0"){
        $_SESSION['e_surname'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['middle_name'])){
    $middle_name = $_POST['middle_name'];
    if (!preg_match('/^[а-я]+$/ui', $middle_name)){
        $_SESSION['e_middle_name'] = "* Отчество может содержать только буквы русского алфавита<br>";
        $error_catch = true;
    }
    // if (strlen($middle_name) == "0"){
    //     $_SESSION['e_middle_name'] = "* Заполните поле";
    //     $error_catch = true;
    // }
}

if (isset($_POST['address'])){
    $address = $_POST['address'];
    if (strlen($address) == "0"){
        $_SESSION['e_address'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['post_index'])){
    $post_index = $_POST['post_index'];
    if (strlen($post_index) == "0"){
        $_SESSION['e_post_index'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['email'])){
    $email = $_POST['email'];
    if (!preg_match('/.+@.+\..+/i', $email)){
        $_SESSION['e_email'] = "* Неверный адрес.<br>";
        $error_catch = true;
    }
    if (strlen($email) == "0"){
        $_SESSION['e_email'] = "* Заполните поле";
        $error_catch = true;
    }
    $query = "SELECT id FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    var_dump($result);
    if ($result) {
        $row = mysqli_fetch_row($result);
        var_dump(!empty($row[0]));
        if (!empty($row[0])){
            $_SESSION['e_email'] = "* Аккаунт с этой почтой уже существует";
        }
    }
}

if (isset($_POST['login'])){
    $login = $_POST['login'];
    if (!preg_match('/^[а-яa-z0-9_-]{4,}$/ui', $login)){
        $_SESSION['e_login'] = "* Длина логина не менее 4 символов (русский и английский алфавиты, цифры, '_-').<br>";
        $error_catch = true;
    }
    if (strlen($login) == "0"){
        $_SESSION['e_login'] = "* Заполните поле";
        $error_catch = true;
    }
    $query = "SELECT id FROM users WHERE login='$login'";
    $result = mysqli_query($connect, $query);
    var_dump($result);
    if ($result) {
        $row = mysqli_fetch_row($result);
        var_dump(!empty($row[0]));
        if (!empty($row[0])){
            $_SESSION['e_login'] = "* Данный логин занят";
        }
    }
}

if (isset($_POST['password'])){
    $password = $_POST['password'];
    if (!preg_match('/^[а-яa-z0-9]{6,}$/ui', $password)){
        $_SESSION['e_password'] = "* Длина пороля не менее 6 символов (русский и английский алфавиты, цифры) <br>";
        $error_catch = true;
    }
    if (strlen($password) == "0"){
        $_SESSION['e_password'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['password_confirm'])){
    $password_confirm = $_POST['password_confirm'];
    if ($password_confirm != $password){
        $_SESSION['e_password_confirm'] = "* Пароли не совпадают <br>";
        $error_catch = true;
    }
    if (strlen($password_confirm) == "0"){
        $_SESSION['e_password_confirm'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['password'])){
    $password = $_POST['password'];
    if (!preg_match('/^[а-яa-z0-9]{6,}$/ui', $password)){
        $_SESSION['e_password'] = "* Длина пороля не менее 6 символов (русский и английский алфавиты, цифры) <br>";
        $error_catch = true;
    }
    if (strlen($password) == "0"){
        $_SESSION['e_password'] = "* Заполните поле";
        $error_catch = true;
    }
}

if ($error_catch){
    header('Location: ../index.php');
}
else{
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO `users`(`id`, `surname`, `name`, `middle_name`, `address`, `postcode`, `login`, `password`, `email`) 
                VALUES (NULL,'$surname','$name','$middle_name','$address','$post_index','$login','$password','$email')");
    header('Location: ../signin_page.php');
}
?>