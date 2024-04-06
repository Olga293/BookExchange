<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>

<?php
require "header1.php";
?>

<?php
require_once 'modules/connect.php';
require_once 'modules/get_book_component.php';
require_once 'modules/functions.php';
?>

<?php
$book_id = $_REQUEST["book_id"];

