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

    $query = "select * from `books` where `id`= $book_id";
    $check_books= mysqli_query($connect, $query);
    $book = mysqli_fetch_assoc($check_books);

    $title = $book["title"];
    $year = $book["year"];
    $cover = $book["cover"];
    $annotation = $book["annotation"];

    $author_id = $book["author_id"];
    $status_id = $book["status_id"];
    $owner_id = $book["user_id"];

    $book_genres = [];
    $check_genre = mysqli_query($connect,"SELECT * FROM `books_genres` WHERE `book_id`='$book_id'");
    while($genre = mysqli_fetch_assoc($check_genre)){
        $genre_id = $genre['genre_id'];
        $get_genre = mysqli_query($connect,"SELECT * FROM `genres` WHERE `id`='$genre_id'");
        $current_genre = mysqli_fetch_assoc($get_genre);
        $book_genres[] = $current_genre["genre"];
    }



    $check_author= mysqli_query($connect,"SELECT author FROM authors WHERE `id`='$author_id'");
    $author = mysqli_fetch_assoc($check_author)['author'];

    $check_status= mysqli_query($connect,"SELECT status FROM statuses WHERE `id`='$status_id'");
    $status = mysqli_fetch_assoc($check_status)['status'];

    $check_user= mysqli_query($connect,"SELECT login FROM users WHERE `id`='$owner_id'");
    $owner = mysqli_fetch_assoc($check_user)['login'];

    // $user = $_SESSION['user'];
    if(!empty($_SESSION['user'])){
        $guest = '';
    }
    else{
        $guest = ' guest';
    }



    // Get data for waiting list
    $waiting_list= mysqli_query($connect,"SELECT `user_id` FROM `waiting_list` WHERE `book_id`='$book_id'");
    while($waiting_list_user = mysqli_fetch_assoc($waiting_list)){
        $waiting_list_user_id[] = $waiting_list_user['user_id'];
    }



?>
<div class="container col-md-10 mt-5">
    <div class="d-flex flex-row justify-content-center justify-content-md-start book-page">
        <div>
            <img src="<?= $cover?>" class="book-page-cover">
        </div>
        <div class="d-flex flex-column ml-2 ml-md-4 mt-3 info-block">
            <h3><?= $title; ?></h3>
            <h4><?= $author; ?></h4>
            <h6 class="mt-2">Год издания: <?=$year; ?></h6>
            <div class="d-flex book-genres flex-wrap mt-1 mt-md-3">
                <?php
                for($j=0; $j < count($book_genres); $j++){
                    echo '<button class="mr-2 my-1 px-2">'.$book_genres[$j].'</button>';
                }
                ?>
            </div>

                <?php
                $user_id = $_SESSION['user']['id'];
                $check_favorite = mysqli_query($connect, "SELECT * FROM `favorites` WHERE `book_id`= '$book_id' AND `user_id`= '$user_id'");
                $row = mysqli_fetch_assoc($check_favorite);
                if(!$row || empty($_SESSION['user'])){
                    $display_favorite = 'd-flex';
                    $display_unfavorite = 'd-none';
                }
                else{
                    $display_favorite = 'd-none';
                    $display_unfavorite = 'd-flex';
                }
                ?>
                <div class="d-flex flex-row interact mt-3 mt-md-5">
                    <div class="d-flex flex-row mr-2 <?= $display_favorite?> <?= $guest?>" id="favorite" data-book="<?=$book_id?>" data-user="<?=$user_id?>">
                        <img src="img/favorite.svg">
                        <p class="d-none d-sm-block">Добавить в избранное</p>
                    </div>

                <div class="d-flex flex-row mr-2 <?= $display_unfavorite?> <?= $guest?>" id="unfavorite" data-book="<?=$book_id?>" data-user="<?=$user_id?>">
                    <img src="img/unfavorite.svg">
                    <p class="d-none d-sm-block">Удалить из избранного</p>
                </div>

                <?php
                $user_id = $_SESSION['user']['id'];
                $check_wait = mysqli_query($connect, "SELECT * FROM `waiting_list` WHERE `book_id`= '$book_id' AND `user_id`= '$user_id'");
                $row = mysqli_fetch_assoc($check_wait);
                if(!$row || empty($_SESSION['user'])){
                    $display_get = 'd-flex';
                    $display_unget = 'd-none';
                }
                else{
                    $display_get = 'd-none';
                    $display_unget = 'd-flex';
                }
                ?>
                <div class="<?= $display_get?> <?= $guest?> flex-row" id="get" data-book="<?=$book_id?>" data-user="<?=$user_id?>">
                    <img src="img/get.svg">
                    <p class="d-none d-sm-block">Оставить заявку</p>
                </div>
                <div class="<?= $display_unget?> <?= $guest?> flex-row" id="unget" data-book="<?=$book_id?>" data-user="<?=$user_id?>">
                    <img src="img/unget.svg">
                    <p class="d-none d-sm-block">Отменить заявку</p>
                </div>
            </div>
        </div>
    </div>
</div>




<div>
    <div class="d-flex flex-column book-page-info align-items-center">
        <div class="d-flex row col-10 info">
            <div class="d-flex flex-column flex-md-row">
                <div class="col-lg-9 mx-lg-0-0">
                    <div class="d-flex flex-row book-page-title p-2 pt-md-3">
                        <h3>О книге</h3>
                    </div>
                    <div class="d-flex flex-row annotation-order pt-3">
                        <div class="annotation">
                            <p>
                                <?= $annotation ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mx-lg-0">
                    <div class="d-flex flex-row book-page-title p-2 pt-md-3">
                        <h4>Владелец: <?= $owner; ?></h4>
                    </div>
                    <div class="d-flex flex-row annotation-order">
                        <div class="d-flex flex-column order">
                            <h5>Список ожидания</h5>
                            <?php
                            if($waiting_list_user_id){
                                for($i=0; $i<count($waiting_list_user_id); $i++)
                                {
                                    $user_id = $waiting_list_user_id[$i];
                                    $get_user_name = mysqli_query($connect,"SELECT * FROM `users` WHERE `id`='$user_id'");
                                    $current_user = mysqli_fetch_assoc($get_user_name)['login'];
                                    ?>
                                    <div class="d-flex flex-row user">
                                        <p class="col-4"><?= $current_user?></p>
                                        <div class="d-flex flex-row col-2">
                                            <p>4.5</p>
                                            <img src="img/star_fill.svg">
                                        </div>
                                        <div class="d-flex flex-row col-6 justify-content-end">
                                            <div class="button approve" data-book="<?=$book_id?>" data-user="<?=$user_id?>">Принять</div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }else{
                                echo '<p>Пуст</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="send-info d-flex flex-column">
                <?php

                if(check_sending_status_by_book_id($book_id)){

                }
                $current_user_id = $_SESSION['user']['id'];

                $sending_info = sending_info_by_book_id_last($book_id);
                $from_user_id = $sending_info['from_user_id'];
                $to_user_id = $sending_info['to_user_id'];
                $finished = $sending_info['finished'];
                $sending_info_id = $sending_info['id'];

                $from_user_query = mysqli_query($connect, "SELECT * FROM `users` WHERE  `id`= '$from_user_id'");
                $from_user = mysqli_fetch_assoc($from_user_query);
                $to_user_query = mysqli_query($connect, "SELECT * FROM `users` WHERE  `id`= '$to_user_id'");
                $to_user = mysqli_fetch_assoc($to_user_query);


                if(($current_user_id == $from_user_id || $current_user_id == $to_user_id)&&check_sending_status_by_book_id($book_id)){?>

                    <div class="book-page-title p-2 pt-md-3">
                        <h3 class="">Данные по отправке книги</h3>
                    </div>
                    <div class="d-flex flex-row send-info-user justify-content-between">
                        <div class="d-flex flex-column col-6 mt-2">
                            <h6>Отправитель</h6>
                            <p>
                                <?= $from_user['surname'].' '.$from_user['name'].' '.$from_user['middle_name']?>
                                <br>
                                <?= $from_user['address']?>
                                <br>
                                <?= $from_user['postcode']?>
                            </p>
                        </div>
                        <div class="d-flex flex-column col-6 mt-2">
                            <h6>Получатель</h6>
                            <p>
                                <?= $to_user['surname'].' '.$to_user['name'].' '.$to_user['middle_name']?>
                                <br>
                                <?= $to_user['address']?>
                                <br>
                                <?= $to_user['postcode']?>
                            </p>
                        </div>
                    </div>
                    <?php
                    if($current_user_id == $from_user_id){
                        if($sending_info['post_number']){?>
                            <div class="d-flex flex-row mx-5 col-6">
                                <div class="d-flex flex-column px-4">
                                    <h6>Книга отправлена</h6>
                                    <h6>Код посылки: <?= $sending_info['post_number'] ?></h6>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="d-flex flex-column col-12 ">
                                <div class="sending">
                                    <input class="col-9 post-number" type="text" name="post_number" data-sending="<?=$sending_info_id?>" placeholder="Введите почтовый идентификатор">
                                    <button class="col-2 sending-btn">Подтвердить</button>
                                </div>
                            </div>
                        <?php }
                    } else if($current_user_id == $to_user_id){
                        if($sending_info['post_number']){?>
                            <div class="d-flex flex-row mx-5 justify-content-between">
                                <div class="d-flex flex-column px-4  col-6">
                                    <h6>Книга отправлена</h6>
                                    <h6>Код посылки: <?= $sending_info['post_number'] ?></h6>
                                </div>
                                <div class="col-6">
                                    <h6>Оцените отправителя</h6>
                                    <form method="post" action="modules/put_mark.php">
                                        <div class="rating-area">
                                            <input type="text" name="from_user_id" value="<?= $from_user_id ?>" style="display: none">
                                            <input type="text" name="to_user_id" value="<?= $to_user_id ?>" style="display: none">
                                            <input type="text" name="book_id" value="<?= $book_id ?>" style="display: none">
                                            <input type="text" name="sending_info_id" value="<?= $sending_info_id ?>" style="display: none">
                                            <input type="radio" id="star-5" name="rating" value="5">
                                            <label for="star-5" title="Оценка «5»"></label>
                                            <input type="radio" id="star-4" name="rating" value="4">
                                            <label for="star-4" title="Оценка «4»"></label>
                                            <input type="radio" id="star-3" name="rating" value="3">
                                            <label for="star-3" title="Оценка «3»"></label>
                                            <input type="radio" id="star-2" name="rating" value="2">
                                            <label for="star-2" title="Оценка «2»"></label>
                                            <input type="radio" id="star-1" name="rating" value="1">
                                            <label for="star-1" title="Оценка «1»"></label>
                                        </div>
                                        <button type="submit" style="border-radius: 4px">Подтвердить получение</button>
                                    </form>
                                </div>
                            </div>
                        <?php }
                    }
                }
                ?>

            </div>
            <div class="d-flex flex-column write mb-5">
                <div class="book-page-title p-2 pt-md-5 " ">
                    <h3>Написать владельцу</h3>
                </div>
                <div class="form-email">
                    <form class="d-flex flex-row justify-content-end">
                        <textarea placeholder="Текст сообщения"></textarea>
                        <button type="submit">Отправить</button>
                    </form>
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



<script>
    $(document).ready(function () {

        if($("#get").hasClass("guest")){
            $(".guest").bind("click", function (){
                alert("Данная функция доступна только зарегестрированным пользователям");
            });
        }
        else {
            $("#get").bind("click", function () {
                let link = $(this);
                let book_id = link.data('book');
                let user_id = link.data('user');

                $.ajax({
                        url: "modules/add_waiting.php",
                        type: "POST",
                        data: {'book_id': book_id, 'user_id': user_id},
                        dataType: "html",
                        success: function (response) {
                            $('#get').addClass('d-none');
                            $('#get').removeClass('d-flex');
                            $('#unget').addClass('d-flex');
                            $('#unget').removeClass('d-none');
                        }
                    }
                );
            });
        }

        if($("#favorite").hasClass("guest")){
            $(".guest").bind("click", function (){
                alert("Данная функция доступна только зарегестрированным пользователям");
            });
        }
        else {
            $("#favorite").bind("click", function () {
                let link = $(this);
                let book_id = link.data('book');
                let user_id = link.data('user');

                $.ajax({
                        url: "modules/make_favorite.php",
                        type: "POST",
                        data: {'book_id': book_id, 'user_id': user_id},
                        dataType: "html",
                        success: function (response) {
                            $('#favorite').addClass('d-none');
                            $('#favorite').removeClass('d-flex');
                            $('#unfavorite').addClass('d-flex');
                            $('#unfavorite').removeClass('d-none');
                        }
                    }
                );
            });


            $("#unfavorite").bind("click", function (){
                let link = $(this);
                let book_id = link.data('book');
                let user_id = link.data('user');

                $.ajax({
                        url: "modules/remove_favorite.php",
                        type: "POST",
                        data: {'book_id': book_id, 'user_id': user_id},
                        dataType:"html",
                        success: function(response) {
                            $('#favorite').addClass('d-flex');
                            $('#favorite').removeClass('d-none');
                            $('#unfavorite').addClass('d-none');
                            $('#unfavorite').removeClass('d-flex');
                        }
                    }
                );
            });

            $(".approve").bind("click", function (){
                let link = $(this);
                let book_id = link.data('book');
                let user_id = link.data('user');

                $.ajax({
                        url: "modules/send-info.php",
                        type: "POST",
                        data: {'book_id': book_id, 'user_id': user_id},
                        dataType:"html",
                        success: function(response) {
                            $('.send-info').html(response);
                        }
                    }
                );
            });

            $(".sending-btn").bind("click", function (){
                let post_number = $('input.post-number').val();
                let sending_id = $('input.post-number').data('sending');

                $.ajax({
                        url: "modules/set_post_number.php",
                        type: "POST",
                        data: {'post_number': post_number, 'sending_id': sending_id},
                        dataType:"html",
                        success: function(response) {
                            $('.sending').html(response);
                        }
                    }
                );
            });
        }


    });
</script>


<?php
require "footer.php";
?>
