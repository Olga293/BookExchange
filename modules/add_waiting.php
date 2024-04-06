<?php
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    require_once 'connect.php';

    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];

    mysqli_query($connect, "INSERT INTO `waiting_list`(`id`, `book_id`, `user_id`)
            VALUES (NULL, '$book_id', '$user_id')");
?>