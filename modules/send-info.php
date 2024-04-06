<?php
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
    require_once 'connect.php';

    $book_id = $_POST['book_id'];
    $user_id_to = $_POST['user_id'];
    $user_id_from = $_SESSION['user']['id'];

    mysqli_query($connect, "INSERT INTO `sending`(`id`, `book_id`, `from_user_id`, `to_user_id`, `post_number`, `finished`)
            VALUES (NULL, '$book_id', '$user_id_from', '$user_id_to', NULL, false)");

    mysqli_query($connect, "DELETE FROM `waiting_list` WHERE `user_id`= '$user_id_to' AND `book_id`= '$book_id'");

    $sending_id_query = mysqli_query($connect, "SELECT * FROM `sending` WHERE  `book_id`= '$book_id' AND `from_user_id`= '$user_id_from'");
    $sending_id = mysqli_fetch_assoc($sending_id_query);
    $sending_id = $sending_id['id'];

    $user_to_query = mysqli_query($connect, "SELECT * FROM `users` WHERE  `id`= '$user_id_to'");
    $user_to = mysqli_fetch_assoc($user_to_query);
    $user_to_name = $user_to['name'];
    $user_to_surname = $user_to['surname'];
    $user_to_middle_name = $user_to['middle_name'];
    $user_to_address = $user_to['address'];
    $user_to_postcode = $user_to['postcode'];

    $user_from_query = mysqli_query($connect, "SELECT * FROM `users` WHERE  `id`= '$user_id_from'");
    $user_from = mysqli_fetch_assoc($user_from_query);
    $user_from_name = $user_from['name'];
    $user_from_surname = $user_from['surname'];
    $user_from_middle_name = $user_from['middle_name'];
    $user_from_address = $user_from['address'];
    $user_from_postcode = $user_from['postcode'];

    $result = '<div class="book-page-title">
                    <h3 class="col-9">Данные для отправки книги</h3>
                </div>
                <div class="d-flex flex-row send-info-user">
                    <div class="d-flex flex-column col-6">
                        <h6>Отправитель</h6>
                        <p>';
    $result .= $user_from_surname.' '.$user_from_name.' '.$user_from_middle_name.'<br>';
    $result .= $user_from_address.'<br>';
    $result .= $user_from_postcode;
    $result .= '</p>
                </div>
                <div class="d-flex flex-column col-6">
                    <h6>Получатель</h6>
                    <p>';
    $result .= $user_to_surname.' '.$user_to_name.' '.$user_to_middle_name.'<br>';
    $result .= $user_to_address.'<br>';
    $result .= $user_to_postcode;
    $result .= '</p></div></div>
                <form class="sending mx-5 px-3">
                    <input class="col-9 post-number" type="text" name="post_number" data-sending="'.$sending_id.'" placeholder="Введите почтовый идентификатор">
                    <input type="button" class="col-2 sending-btn" id="btn-send-approve" value="Подтвердить">
                </form>';
    echo $result;
?>
<script>
    $("#btn-send-approve").bind("click", function (){
        let post_number = $('input.post-number').val();
        let sending_id = $('input.post-number').data('sending');
        console.log(post_number);
        console.log(sending_id);

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
</script>