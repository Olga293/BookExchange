<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';

$book_id = $_POST['book_id'];
$user_id = $_POST['user_id'];

mysqli_query($connect, "DELETE FROM `waiting_list` WHERE  `book_id`= '$book_id' AND `user_id`= '$user_id'");
?>