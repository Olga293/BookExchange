<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';
require_once 'functions.php';


if (isset($_POST['title'])){
    $title = $_POST['title'];
}

if (isset($_POST['year'])){
    $year = $_POST['year'];
}

if (isset($_POST['annotation'])){
    $annotation = $_POST['annotation'];
}

if (isset($_POST['author'])){
    $author = $_POST['author'];
}

if (isset($_POST['genre'])){
    foreach ($_POST['genre'] as $genre){
        $genres[] = $genre;
    }
}

if(!empty($_FILES['cover']['name'])){
    $path = 'img/covers/'.time().$_FILES['cover']['name']; //$_FILES['cover']['name'] это двумерный глобальный массив, из которого достаем инфу о файле
    move_uploaded_file($_FILES['cover']['tmp_name'], '../'.$path); // загружаем изображение на сервер
} else{
    $path = null;
}

$user = $_SESSION['user']['id'];

$author = addslashes($author);

$author_id_query = mysqli_query($connect, "SELECT `id` FROM `authors` WHERE `author`= '$author' ORDER BY `id` DESC LIMIT 1");
$author_id = mysqli_fetch_assoc($author_id_query)['id'];
if($author_id == null){
    //запись нового автора в БД
    mysqli_query($connect, "INSERT INTO `authors`(`id`, `author`) VALUES (NULL, '$author')");
    //получение id добавленного автора
    $author_id = mysqli_query($connect, "SELECT `id` FROM `authors` WHERE `author`= '$author' ORDER BY `id` DESC LIMIT 1");
    if($author_id){
        $author_id = mysqli_fetch_assoc($author_id)['id'];
    }
}

mysqli_query($connect, "INSERT INTO `books`(`id`, `title`, `cover`, `year`, `annotation`, `author_id`, `status_id`, `user_id`)
        VALUES (NULL, '$title', '$path', '$year', '$annotation', '$author_id', 3, '$user')");


$book_id = mysqli_query($connect, "SELECT `id` FROM `books` WHERE `user_id`= '$user' ORDER BY `id` DESC LIMIT 1");
$book_id = mysqli_fetch_assoc($book_id)['id'];

foreach ($genres as $genre){
    mysqli_query($connect, "INSERT INTO `books_genres`(`id`, `book_id`, `genre_id`)
        VALUES (NULL, '$book_id', '$genre')");
}

header('Location: ../addrequest_page.php');


//
//echo '<br>';
//echo 'Название ';
//var_dump($title);
//echo '<br>';
//echo 'Путь к изображению ';
//var_dump($path);
//echo '<br>';
//echo 'Год ';
//var_dump($year);
//echo '<br>';
//echo 'Аннотация ';
//var_dump($annotation);
//echo '<br>';
//echo 'Пользователь ';
//var_dump($user);
//echo '<br>';
//echo 'Жанры ';
//var_dump($genres);
//echo '<br>';
//echo 'Автор ';
//var_dump($author);
//echo '<br>';
//echo 'id Автора ';
//var_dump($author_id);