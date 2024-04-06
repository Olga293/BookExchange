<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>
<?php
require "header1.php";
require_once 'modules/functions.php';
?>

<div class="container">
    <div class="my-4 genres">
    <?php
    $genres = all_genres();
    for($i=0; 10 > $i; $i++){?>

        <button class="mx-2 my-1 px-2"><?=$genres[$i]['genre']?></button>

    <?php }
    ?>
    </div>
</div>

<div class="mx-0">
    <?php
        $all_books = all_books_with_status_keep();
        // 3 last books added to db
        $slider_books = array_slice($all_books, 0, 3);

        $colours = get_colour($slider_books[2]['cover']);
        $colour1 = $colours[0];
        $colour2 = $colours[1];
    ?>

    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active d-flex justify-content-center  h-100" style="background: linear-gradient(135deg, <?= $colour1?> 0%, <?= $colour2?> 80%);">
                <div  class="d-flex flex-column flex-md-row align-items-center my-3">
                    <div class="col-12 col-md-6 d-flex justify-content-center">
                        <img src="<?= $slider_books[2]['cover'] ?>" alt="..." class="slide-img">
                    </div>
                    <div class="col-12 col-md-6 d-flex flex-column justify-content-end align-items-center align-items-md-start">
                        <h3 class="mb-1 mb-md-3 mt-1"><a href="book_page.php?book_id=<?= $slider_books[2]['id']?>"><?= $slider_books[2]['title'] ?></a></h3>
                        <p class="mb-1 mb-mb-5"><?= author_by_id($slider_books[2]['author_id']); ?></p>
                        <p class="m-0 user">Добавил: <?= user_by_id($slider_books[2]['user_id'])['login']; ?></p>
                    </div>
                </div>
            </div>
            <?php
                for($i=0; $i<count($colours); $i++){
                    $colours = get_colour($slider_books[$i]['cover']);
                    $colour1 = $colours[0];
                    $colour2 = $colours[1];
                    ?>
                    <div class="carousel-item d-flex justify-content-center h-100" style="background: linear-gradient(135deg, <?= $colour1?> 0%, <?= $colour2?> 80%);">
                        <div  class="d-flex flex-column flex-md-row align-items-center my-3">
                            <div class="col-10 col-md-6 d-flex justify-content-center">
                                <img src="<?= $slider_books[$i]['cover'] ?>" alt="..." class="slide-img">
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-end align-items-center align-items-md-start">
                                <h3 class="mb-1 mb-md-3 mt-1"><a href="book_page.php?book_id=<?= $slider_books[$i]['id']?>"><?= $slider_books[$i]['title'] ?></a></h3>
                                <p class="mb-1 mb-mb-5"><?= author_by_id($slider_books[$i]['author_id']); ?></p>
                                <p class="m-0 user">Добавил: <?= user_by_id($slider_books[$i]['user_id'])['login']; ?></p>
                            </div>
                        </div>
                    </div>

                <?php }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>


<div class="container my-4">

<?php
$all_genres = all_genres();
for ($i=0; $i<count($all_genres); $i++){
    if(get_book_id_by_genre_id($all_genres[$i]['id'])){?>

        <div class="d-flex flex-column main-page-genre-block p-4 my-4">
            <div class="d-flex flex-row justify-content-between title px-2 py-1">
                <h2><?= $all_genres[$i]["genre"] ?></h2>
                <a href="#">Еще...</a>
            </div>
            <div class="py-3 justify-content-start d-flex flex-row books-in-genre">
                <?php
                $book_ids = get_book_id_by_genre_id($all_genres[$i]['id']);
                for($j=0; $j<count($book_ids); $j++){
                    $book = get_book_by_id($book_ids[$j]);
                    $book_title = $book['title'];
                    $book_cover = $book['cover'];
                    $book_author = author_by_id($book['author_id']);
                    ?>
                    <div class="d-flex flex-row px-2 mr-2 col-5 col-md-3 col-lg-2">
                        <div class="d-flex flex-column align-items-center">
                            <img src="<?= $book_cover ?>">
                            <h6 class="mt-2"><a href="book_page.php?book_id=<?= $book['id']?>"><?= $book_title ?></a></h6>
                            <p><?= $book_author ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    <?php
    }
}
?>

</div>



<footer style="background: #D9B582;">
    <div class="d-flex flex-row justify-content-between container p-3">
        <div class="ml-0 ">
            <span style="color: black">© BookExchange 2023</span>
        </div>
        <div class="mr-0 ">
            <img src="img/VK.svg" class="ml-2">
            <img src="img/inst.svg" class="ml-2">
            <img src="img/tvit.svg" class="ml-2">
        </div>
    </div>

</footer>








<?php
require "footer.php";
?>
