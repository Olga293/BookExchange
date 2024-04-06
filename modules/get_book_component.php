<?php
require_once 'modules/connect.php';

// получение списка авторов и жанров из БД

$check_author = mysqli_query($connect, "SELECT * FROM `authors`");
while ($author = mysqli_fetch_assoc($check_author)){
    $authors_list[] = $author['author']; //все авторы
    $authors_id_list[] = $author['id']; //все id авторов
}

$check_genre = mysqli_query($connect, "SELECT * FROM `genres`");
while ($genre = mysqli_fetch_assoc($check_genre)){
    $genres_list[] = $genre['genre']; //все жанры
    $genres_id_list[] = $genre['id']; //все id жанров
}
?>