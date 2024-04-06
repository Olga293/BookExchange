<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';

$from_user_id = $_POST['from_user_id'];  // от кого
$to_user_id = $_POST['to_user_id'];  // кому
$mark  = intval($_POST['rating']);   // оценка
$book_id  = $_POST['book_id'];   // книга
$sending_info_id  = $_POST['sending_info_id'];   // id конкретной передачи

var_dump($sending_info_id);

mysqli_query($connect, "UPDATE `sending` SET `finished`='1' WHERE `id`='$sending_info_id'");

mysqli_query($connect, "INSERT INTO `marks`(`id`, `mark`, `from_user_id`, `to_user_id`)
            VALUES (NULL, '$mark', '$to_user_id', '$from_user_id')");

mysqli_query($connect, "UPDATE `books` SET `user_id`='$to_user_id' WHERE `id`='$book_id'");

header('Location: ../book_page.php?book_id='.$book_id);


