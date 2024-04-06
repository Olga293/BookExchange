<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once 'connect.php';
require_once 'functions.php';

$search = $_POST['search'];
$search = mb_strtolower($search); //к нижнему регистру

$books = all_books();
for($i=0; $i<count($books); $i++){
    $book_title = $books[$i]['title'];
    $book_title = mb_strtolower($book_title);
$no_result = true;
    if($search){
        if(strpos($book_title, $search) !== false){
            $no_result = false;
            ?>
            <div class="row mt-3 mb-3">
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
                        <img class="cover d-flex flex-column ml-1" src="<?= $books[$i]['cover']?>">
                        <div class="d-flex flex-column mt-3 ml-3 mt-md-0 mx-md-3">
                            <h6><a href="book_page.php?book_id=4"><?= $books[$i]['title']?></a></h6>
                            <p class="author"><?= author_by_id($books[$i]['id'])?></p>
                            <div class="d-flex book-genres flex-wrap">

                                <?php
                                for($j=0;$j<count(genres_by_book_id($books[$i]['id'])); $j++){?>
                                    <button class="mr-2 my-1 px-2"><?= genres_by_book_id($books[$i]['id'])[$j] ?></button>
                                <?php }
                                ?>

                            </div>
                            <p class="description d-none d-sm-block"><?= $books[$i]['annotation']?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
/*    else if($no_result){
        echo '<p>По вашему запросу ничего не найдено</p>';
    }*/
}
?>