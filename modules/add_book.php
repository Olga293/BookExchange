<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';
require_once 'functions.php';

$error_catch = false;

if (isset($_POST['title'])){
    $title = $_POST['title'];
    if (strlen($title) == "0"){
        $_SESSION['e_title'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['year'])){
    $year = $_POST['year'];
    if (!preg_match('/^\d{4}$/', $year)){
        $_SESSION['e_year'] = "* Год должен быть записан в виде четырехзначного числа <br>";
        $error_catch = true;
    }
    if ($year > date('Y')){
        $_SESSION['e_year'] = "* Нельзя добавить книгу, которая еще не была издана <br>";
        $error_catch = true;
    }
    if ($year < 1700){
        $_SESSION['e_year'] = "* Такая старая книга рискует не пережить путешествие( <br>";
        $error_catch = true;
    }
    if (strlen($year) == "0"){
        $_SESSION['e_year'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['annotation'])){
    $annotation = $_POST['annotation'];
    if (strlen($annotation) == "0"){
        $_SESSION['e_annotation'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['author'])){
    $author = $_POST['author'];
    if (strlen($author) == "0"){
        $_SESSION['e_author'] = "* Заполните поле";
        $error_catch = true;
    }
}

if (isset($_POST['genre'])){
//    $genre = $_POST['genre'];
//    if (strlen($genre) == "0"){
//        $_SESSION['e_genre'] = "* Заполните поле";
//        $error_catch = true;
//    }
    foreach ($_POST['genre'] as $genre){
        $genres[] = $genre;
    }
        var_dump($genres);
}

$path = 'img/covers/'.time().$_FILES['cover']['name']; //$_FILES['cover']['name'] это двумерный глобальный массив, из которого достаем инфу о файле
//if($_FILES['cover']['name'] == ''){
//    //$_SESSION['e_cover'] = "* Изображение не выбрано <br>";
//    $path = null;
//}
if(empty($_FILES['cover']['name'])){
    $path = null;
}
elseif (!$error_catch){
    if(!move_uploaded_file($_FILES['cover']['tmp_name'], '../'.$path)){
        $_SESSION['e_cover'] = "* Ошибка при загрузке изображения <br>";
    }
}

$user = $_SESSION['user']['id'];

if ($error_catch){
    //header('Location: ../add_book_page.php');
    //var_dump($_FILES['cover']['name']);
}
else{
    $check_author = author_id_by_author_name($author);
    echo '<br>';
    var_dump($check_author);
    echo '<br>';
    echo '<br>';


//    mysqli_query($connect, "INSERT INTO `books`(`id`, `title`, `cover`, `year`, `annotation`, `author_id`, `status_id`, `user_id`)
//            VALUES (NULL, '$title', '$path', '$year', '$annotation', '$author', 1, '$user')");

    $book_id = mysqli_query($connect, "SELECT `id` FROM `books` ORDER BY `id` DESC LIMIT 1");
    $book_id = mysqli_fetch_assoc($book_id);
    $book_id = $book_id['id'];

//    foreach ($genres as $genre){
//        mysqli_query($connect, "INSERT INTO `books_genres`(`id`, `book_id`, `genre_id`)
//            VALUES (NULL,'$book_id','$genre')");
//    }
    //header('Location: ../addbook_page.php');

    echo '<br>';
    var_dump($title);
    var_dump($path);
    var_dump($year);
    var_dump($annotation);
    var_dump($user);




}
?>