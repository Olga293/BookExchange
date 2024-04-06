<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';
require_once 'functions.php';

$sort_order = $_POST['sort_order'];
$filter_author = $_POST['sort_author'];
$filter_genre = $_POST['sort_genre'];
$filter_year = $_POST['sort_year'];



$author_id = author_id_by_name($filter_author);
//var_dump($author_id);

$genre_id = genre_id_by_name($filter_genre);
//var_dump($genre_id);
if($genre_id){
    $books_genre = get_book_id_by_genre_id($genre_id);
    if($books_genre == null){
        $books_genre = [];
    }
}
if($author_id){
    $books_author = get_book_id_by_author($author_id);
    if($books_author == null){
        $books_author = [];
    }
}
if($filter_year){
    $books_year = get_book_id_by_year($filter_year);
    if($books_year == null){
        $books_year = [];
    }
}

$books_id = get_all_book_id_keep();

if($genre_id){
    $books_id = array_intersect($books_id, $books_genre);
}
if($author_id){
    $books_id = array_intersect($books_id, $books_author);
}
if($filter_year){
    $books_id = array_intersect($books_id, $books_year);
}

$books = get_all_book_id_keep_asc();

if($sort_order == 'true'){
    $books = array_reverse($books);
}


for($i=0; $i<count($books); $i++) {
    $all_books_id[] = $books[$i];
}
$books_id = array_intersect($all_books_id, $books_id);

$books_id = array_values($books_id);

$result = '';
for($i=0; $i<count($books_id); $i++) {
    $book = get_book_by_id($books_id[$i]);

    $result .= '<div class="row mt-3 mb-3">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row justify-content-end bt-get-fav">
                <button>
                    <img src="img/get.svg" class="book-icons">
                </button>
                <button>
                    <img src="img/favorite.svg"  class="book-icons">
                </button>
            </div>
            <div class="d-flex flex-row book-card p-2">
                <img class="cover d-flex flex-column ml-1" src="' . $book['cover'] . '">';

    $result .= '<div class="d-flex flex-column mt-3 ml-3 mt-md-0 mx-md-3">
                    <h6><a href="book_page.php?book_id=' . $book['id'] . '">' . $book['title'] . '</a></h6>';

    $result .= '<p class="author">' . author_by_id($book['author_id']) . '</p>';

    $result .= '<div class="d-flex book-genres flex-wrap">';

    for ($j = 0; $j < count(genres_by_book_id($book['id'])); $j++) {
        $result .= '<button class="mr-2 my-1 px-2">' . genres_by_book_id($book['id'])[$j] . '</button>';
    }

    $result .= '</div>
                    <p class="description d-none d-sm-block">' . $book['annotation'] . '</p>';

    $result .= '</div>
            </div>
        </div>
    </div>';
}

echo $result;



