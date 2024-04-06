<?php
//connect to database
require_once 'connect.php';

//get all genres from db
function all_genres(){
    global $connect;
    $query = "SELECT * FROM `genres`";
    $get_genres= mysqli_query($connect, $query);
    while($genre = mysqli_fetch_assoc($get_genres)){
        $genres[] = $genre;
    }
    return $genres;
}

function genres_by_book_id($id){
    global $connect;
    $query = "SELECT * FROM `books_genres` WHERE `book_id` = $id";
    $get_book_genre_ids= mysqli_query($connect, $query);

    //get genre's ids of current book
    while($book_genre_id = mysqli_fetch_assoc($get_book_genre_ids)){
        $genre_id = $book_genre_id["genre_id"];
        //get genre by id
        $query_genre = "SELECT * FROM `genres` WHERE `id` = $genre_id";
        $get_genre = mysqli_query($connect, $query_genre);
        $genres[] = mysqli_fetch_assoc($get_genre)['genre'];
    }
    return $genres;
}

function author_by_id($id){
    global $connect;
    $query = "SELECT * FROM `authors` WHERE `id` = $id";
    $get_author = mysqli_query($connect, $query);
    $author = mysqli_fetch_assoc($get_author)['author'];
    return $author;
}

//function author_id_by_author_name($author){
//    var_dump($author);
//    global $connect;
//    var_dump($connect);
//    $query = "SELECT * FROM `authors` WHERE `author` = '$author' ORDER BY `id` DESC LIMIT 1";
//    $get_author_id = mysqli_query($connect, $query);
//    var_dump($get_author_id);
//    $author_ids = mysqli_fetch_assoc($get_author_id)['id'];
//    return $author_ids;
//}

function user_by_id($id){
    global $connect;
    $query = "SELECT * FROM `users` WHERE `id` = $id";
    $get_user = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($get_user);
    return $user;
}

function all_books(){
    global $connect;
    $query = "SELECT * FROM `books` ORDER BY `id` DESC";
    $get_books= mysqli_query($connect, $query);
    while($book = mysqli_fetch_assoc($get_books)){
        $current_book['id'] = $book['id'];
        $current_book['title'] = $book['title'];
        $current_book['cover'] = $book['cover'];
        $current_book['year'] = $book['year'];
        $current_book['annotation'] = $book['annotation'];
        $current_book['author_id'] = $book['author_id'];
        $current_book['status_id'] = $book['status_id'];
        $current_book['user_id'] = $book['user_id'];
        $books[] = $current_book;
    }
    return $books;
}

function all_books_with_status_keep(){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `status_id`= '1' ORDER BY `id` DESC";
    $get_books= mysqli_query($connect, $query);
    while($book = mysqli_fetch_assoc($get_books)){
        $current_book['id'] = $book['id'];
        $current_book['title'] = $book['title'];
        $current_book['cover'] = $book['cover'];
        $current_book['year'] = $book['year'];
        $current_book['annotation'] = $book['annotation'];
        $current_book['author_id'] = $book['author_id'];
        $current_book['status_id'] = $book['status_id'];
        $current_book['user_id'] = $book['user_id'];
        $books[] = $current_book;
    }
    return $books;
}

function all_books_with_status_request(){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `status_id`='3' ORDER BY `id` DESC";
    $get_books= mysqli_query($connect, $query);
    while($book = mysqli_fetch_assoc($get_books)){
        $current_book['id'] = $book['id'];
        $current_book['title'] = $book['title'];
        $current_book['cover'] = $book['cover'];
        $current_book['year'] = $book['year'];
        $current_book['annotation'] = $book['annotation'];
        $current_book['author_id'] = $book['author_id'];
        $current_book['status_id'] = $book['status_id'];
        $current_book['user_id'] = $book['user_id'];
        $books[] = $current_book;
    }
    return $books;
}

function convert_to_hex($rgb){
    if(strlen(dechex($rgb))<2){
        $hex_colour = '0'.dechex($rgb);
    }
    else{
        $hex_colour = dechex($rgb);
    }
    return $hex_colour;
}

function get_colour($img){

    $info = getimagesize($img);
    switch ($info[2]) {
        case 1:
            $img = imageCreateFromGif($img);
            break;
        case 2:
            $img = imageCreateFromJpeg($img);
            break;
        case 3:
            $img = imageCreateFromPng($img);
            break;
    }

    $width = ImageSX($img);
    $height = ImageSY($img);

    $thumb = imagecreatetruecolor(11, 11);
    imagecopyresampled($thumb, $img, 0, 0, 0, 0, 11, 11, $width, $height);

    $rgb = imagecolorat($thumb, 0, 0);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;

    $colour1 = '#'.convert_to_hex($r).convert_to_hex($g).convert_to_hex($b);

    $rgb = imagecolorat($thumb, 5, 5);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;

    $colour2 = '#'.convert_to_hex($r).convert_to_hex($g).convert_to_hex($b);

    $colours[] = $colour1;
    $colours[] = $colour2;

    imageDestroy($img);
    imageDestroy($thumb);

    return $colours;
}

function get_book_id_by_genre_id($id){
    global $connect;
    $query = "SELECT * FROM `books_genres` WHERE `genre_id` = $id";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["book_id"];
    }
    return $books_ids;
}

function get_book_by_id($id){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `id` = $id";
    $get_books = mysqli_query($connect, $query);
    $book = mysqli_fetch_assoc($get_books);
    return $book;
}

function sending_info_by_book_id_last($id){
    global $connect;
    $query = "SELECT * FROM `sending` WHERE `book_id` = $id ORDER BY `id` DESC LIMIT 1";
    $get_sending_info = mysqli_query($connect, $query);
    $sending_info = mysqli_fetch_assoc($get_sending_info);
    return $sending_info;
}

function check_sending_status_by_book_id($id){
    global $connect;
    $query = "SELECT * FROM `sending` WHERE `book_id` = $id AND `finished` = '0'";
    $get_sending_info = mysqli_query($connect, $query);
    $sending_status = mysqli_fetch_assoc($get_sending_info);
    if($sending_status){
        return true;
    }
    else{
        return false;
    }
}

function author_id_by_name($author){
    global $connect;
    $author_id_query = mysqli_query($connect, "SELECT `id` FROM `authors` WHERE `author`= '$author' ORDER BY `id` DESC LIMIT 1");
    $author_id = mysqli_fetch_assoc($author_id_query)['id'];
    return $author_id;
}

function genre_id_by_name($genre){
    global $connect;
    $genre_id_query = mysqli_query($connect, "SELECT `id` FROM `genres` WHERE `genre`= '$genre' ORDER BY `id` DESC LIMIT 1");
    $genre_id = mysqli_fetch_assoc($genre_id_query)['id'];
    return $genre_id;
}

function get_book_id_by_author($id){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `author_id` = $id";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["id"];
    }
    return $books_ids;
}

function get_book_id_by_year($year){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `year` = $year";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["id"];
    }
    return $books_ids;
}

function get_all_book_id_keep(){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `status_id` = '1'";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["id"];
    }
    return $books_ids;
}

function get_all_book_id_keep_asc(){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `status_id` = '1' ORDER BY `title` ASC";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["id"];
    }
    return $books_ids;
}

function get_all_book_id_keep_desc(){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `status_id` = '1' ORDER BY `title` DESC";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["id"];
    }
    return $books_ids;
}

function all_books_current_user_keep($id){
    global $connect;
    $query = "SELECT * FROM `books` WHERE `user_id`= '$id' ORDER BY `id` DESC";
    $get_books= mysqli_query($connect, $query);
    while($book = mysqli_fetch_assoc($get_books)){
        $current_book['id'] = $book['id'];
        $current_book['title'] = $book['title'];
        $current_book['cover'] = $book['cover'];
        $current_book['year'] = $book['year'];
        $current_book['annotation'] = $book['annotation'];
        $current_book['author_id'] = $book['author_id'];
        $current_book['status_id'] = $book['status_id'];
        $current_book['user_id'] = $book['user_id'];
        $books[] = $current_book;
    }
    return $books;
}

function get_all_book_id_waiting($user_id){
    global $connect;
    $query = "SELECT `book_id` FROM `waiting_list` WHERE `user_id` = '$user_id'";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["book_id"];
    }
    return $books_ids;
}

function get_all_book_id_favorite($user_id){
    global $connect;
    $query = "SELECT `book_id` FROM `favorites` WHERE `user_id` = '$user_id'";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["book_id"];
    }
    return $books_ids;
}

function get_all_book_id_onway($user_id){
    global $connect;
    $query = "SELECT `book_id` FROM `sending` WHERE (`from_user_id` = '$user_id' OR `to_user_id` = '$user_id') AND `finished`='0'";
    $get_book_ids= mysqli_query($connect, $query);

    while($book_ids = mysqli_fetch_assoc($get_book_ids)){
        $books_ids[] = $book_ids["book_id"];
    }
    return $books_ids;
}





