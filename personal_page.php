<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>
<?php
require "header1.php";
require_once "modules/functions.php";

$login = $_SESSION['user']['login'];
?>

<div>
    <div class="d-flex flex-column flex-md-row">

        <div class="col-md-2 d-flex flex-column sort-filter mt-5">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row">
                    <div style="width: 60px; height: 60px; background: #D9B582; border-radius: 100%;">
                        <p style="font-family: ElMessiri; font-size: 3rem; text-align: center; line-height: normal;"><?= strtoupper($login[0])?></p>
                    </div>
                    <h4 class="my-auto mx-3"><?= $login?></h4>
                </div>
                <a class="my-page-bt" href="addbook_page.php">Добавить книгу</a>
                <a class="my-page-bt" href="addrequest_page.php">Оставить заявку</a>
            </div>

            <ul class="nav nav-tabs d-flex flex-column personal-page-tabs my-4" role="tablist">
                <li class="active">
                    <a class="d-flex flex-row" href="#my-book" role="tab" data-toggle="tab">
                        <h6 class="" style="margin: 0">Мои книги</h6>
                    </a>
                </li>
                <li>
                    <a class="d-flex flex-row" href="#waiting-list" role="tab" data-toggle="tab">
                        <h6 class="" style="margin: 0">Список ожидания</h6>
                    </a>
                </li>
                <li>
                    <a class="d-flex flex-row" href="#favorites" role="tab" data-toggle="tab">
                        <h6 class="" style="margin: 0">Избранное</h6>
                    </a>
                </li>
                <li>
                    <a class="d-flex flex-row" href="#on-way" role="tab" data-toggle="tab">
                        <h6 class="" style="margin: 0">В пути</h6>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-5 mr-5 ml-3">
            <div role="tabpanel" class="tab-pane col-md-12 active" id="my-book">
                <div class="d-flex flex-column my-books">
                    <h5>Мои книги</h5>
                    <?php
                    $id_user = $_SESSION['user']['id'];
                    $books = all_books_current_user_keep($id_user);
                    for($i=0; $i<count($books); $i++){?>
                    <div class="row mt-3 mb-3">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row book-card p-2">
                                <img class="cover d-flex flex-column ml-1" src="<?= $books[$i]['cover']?>">
                                <div class="d-flex flex-column mt-3 ml-3 mt-md-0 mx-md-3">
                                    <h6><a href="book_page.php?book_id=<?= $books[$i]['id']?>"><?= $books[$i]['title']?></a></h6>
                                    <p class="author"><?= author_by_id($books[$i]['author_id'])?></p>
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
                    <?php } ?>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane col-10" id="waiting-list">
                <div class="d-flex flex-column my-books">
                            <h5>Список ожидания</h5>
                    <?php
                    $books_id = get_all_book_id_waiting($id_user);
                    if($books_id) {
                        for ($i = 0; $i < count($books_id); $i++) {
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
                    }

                    echo $result;
                    ?>
                        </div>
            </div>
            <div role="tabpanel" class="tab-pane col-10" id="favorites">
                <div class="d-flex flex-column my-books">
                            <h5>Избранное</h5>
                    <?php
                    $books_id = get_all_book_id_favorite($id_user);
                    if($books_id) {
                        for ($i = 0; $i < count($books_id); $i++) {
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
                    }

                    echo $result;
                    ?>
                    </div>
            </div>
            <div role="tabpanel" class="tab-pane col-10" id="on-way">
                <div class="d-flex flex-column my-books">
                            <h5>В пути</h5>
                    <?php
                    $books_id = get_all_book_id_onway($id_user);
                    if($books_id) {
                        for ($i = 0; $i < count($books_id); $i++) {
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
                    }

                    echo $result;
                    ?>
                        </div>
            </div>
        </div>
    </div>
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