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

    <div class="d-flex flex-row flex-fill" style="margin-top: 40px">
        <div class="col-2 d-flex flex-column sort-filter">
            <form method="post" class="d-flex flex-column">
                <div class="d-flex flex-row">
                    <h6 class="d-flex flex-row align-items-center">
                        <p class="mr-2 mb-1">Сортировка</p>
                        <div class="checkbox-container">
                            <input id="checkbox" type="checkbox"/>
                            <label for="checkbox" ></label>
                        </div>
                    </h6>
                </div>
                <div class="d-flex flex-row mt-3">
                    <h6>
                        Фильтры
                    </h6>
                </div>
                <label>Автор</label>
                <select name="author" size="1" class="js-example-basic-single" id="filter-author">
                    <option selected="" value="null">Любой</option>
                    <?php
                    for($i=0; $i < count($authors_list); $i++){
                        echo "<option value=".$authors_id_list[$i].">";
                        echo $authors_list[$i];
                        echo "</option>";
                    }
                    ?>
                </select>
                <label>Жанр</label>
                <select name="genre" size="1" class="js-example-basic-single" id="filter-genre">
                    <option selected="" value="null">Любой</option>
                    <?php
                    for($i=0; $i < count($genres_list); $i++){
                        echo "<option value=".$genres_id_list[$i].">";
                        echo $genres_list[$i];
                        echo "</option>";
                    }
                    ?>
                </select>

                <label>Год издания</label>
                <input type="text" name="year" id="filter-year" placeholder="любой">
                <button id="filter-form-btn">Найти</button>
            </form>

        </div>
        <div class="col-10 d-flex flex-column my-books library">


            <?php



            $books = all_books_with_status_request();
            for($i=0; $i<count($books); $i++){?>
                <div class="row mt-3 mb-3">
                    <div class="d-flex flex-column">
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
            <?php } ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $("#filter-form-btn").bind("click", function (){

                let sort_order = $('#sort-order').val();
                //let sort_type = $('#sort-type').val();
                let sort_author = $('#select2-filter-author-container').text();
                let sort_genre = $('#select2-filter-genre-container').text();
                let sort_year = $('#filter-year').val();

                console.log(sort_author);
                console.log(sort_genre);

                $.ajax({
                        url: "modules/filter.php",
                        type: "POST",
                        data: {'sort_order': sort_order, 'sort_author': sort_author, 'sort_genre': sort_genre, 'sort_year': sort_year},
                        dataType:"html",
                        success: function(response) {
                            $('.library').html(response);
                        }
                    }
                );
            });

        });
    </script>
    <footer style="background: #D9B582;" class="mt-5">
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