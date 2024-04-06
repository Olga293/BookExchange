<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>

<?php
require "header.php";
?>

<?php
require_once 'modules/connect.php';
require_once 'modules/get_book_component.php';

?>
    <div  class='library'>
        <div class="filtr-block">
            <form method="post" class="filtr">
                <label>Год издания</label>
                <input type="text" name="year" placeholder="">

                <label>Автор</label>
                <select name="author" size="1">
                    <option selected></option>
                    <?php
                    for($i=0; $i < count($authors_list); $i++){
                        echo "<option value=".$authors_id_list[$i].">";
                        echo $authors_list[$i];
                        echo "</option>";
                    }
                    ?>
                </select>

                <label>Жанр</label>
                <select name="genre" size="1">
                    <option selected></option>
                    <?php
                    for($i=0; $i < count($genres_list); $i++){
                        echo "<option value=".$genres_id_list[$i].">";
                        echo $genres_list[$i];
                        echo "</option>";
                    }
                    ?>
                </select>
                <button type="submit">Найти</button>
            </form>
        </div>

        <?php
        $year = $_POST['year'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];

        $query = "select * from `books`";
        if($year||$author||$genre){
            $query .= " WHERE ";
            if($year){
                $query .= " year=$year";
            }
            if($year && $author) {
                $query .= " AND ";
            }
            if($author) {
                $query .= " author_id=$author";
            }
            if($author && $genre) {
                $query .= " AND ";
            }
            if($genre) {
                $query .= " genre_id=$genre";
            }
        }

        echo '<div>';
        $check_books= mysqli_query($connect, $query);
        while ($book = mysqli_fetch_assoc($check_books)){
            $title = $book["title"];
            $year = $book["year"];
            $cover = $book["cover"];
            $annotation = $book["annotation"];
            $book_id = $book["id"];


            $author_id = $book["author_id"];
            $genres_id = $book["genre_id"];
            $status_id = $book["status_id"];
            $user_id = $book["user_id"];

            $check_author= mysqli_query($connect,"SELECT author FROM authors WHERE `id`='$author_id'");
            $author = mysqli_fetch_assoc($check_author)['author'];

            $check_genre= mysqli_query($connect,"SELECT genre FROM genres WHERE `id`='$genres_id'");
            $genre = mysqli_fetch_assoc($check_genre)['genre'];

            $check_status= mysqli_query($connect,"SELECT status FROM statuses WHERE `id`='$status_id'");
            $status = mysqli_fetch_assoc($check_status)['status'];

            $check_user= mysqli_query($connect,"SELECT login FROM users WHERE `id`='$user_id'");
            $user = mysqli_fetch_assoc($check_user)['login'];

            // Проверка, чтобы пользователь не мог взять книгу сам у себя
            $check_youself = true;
            if ($user_id == $_SESSION['user']['id']){
                $check_youself = false;
            }

            // Проверка, чтобы пользователь не мог взять книгу которую уже ждут
            $check_wait = true;
            if ($status == 'Ожидание' || $status == 'Чтение'){
                $check_wait = false;
            }




            echo '<div class="card-block">
                            <ul class="products clearfix">
                                <li class="product-wrapper">
                                    <div class="product">';
            echo                    '<img class="cover" src="'.$cover.'"/>';
            echo                    '<h3>'.$title.'</h3>';
            echo                    '<p><span class="book_data">Автор:  </span>'.$author.'</p>';
            echo                    '<p><span class="book_data">Год:  </span>'.$year.' г.</p>';
            echo                    '<p><span class="book_data">Жанр:  </span>'.$genre.'</p>';
            echo                    '<p><span class="book_data">Статус:  </span>'.$status.'</p>';
            if($_SESSION['user']){
                echo                '<p><span class="book_data">Владелец:  </span>'.$user.'</p>';;
            }
            echo                    '<p><span class="book_data">Аннотация:  </span><br>'.$annotation.'</p>';
            if($_SESSION['user']){
                $query = "SELECT * FROM favorites WHERE book_id = '$book_id' AND user_id ='$user_id'";
                $result = mysqli_query($connect, $query);
                $check_favorite = mysqli_fetch_assoc($result)['id'];
                $user_id = $_SESSION['user']['id'];
                if(!$check_favorite){
                    echo '<form action="modules/make_favorite.php" method="post">';
                    echo    '<button type="submit">'.'В избранное'.'</button>';
                    echo    '<input type="hidden" name="book_id" value='.$book_id.'>';
                    echo '</form>';
                }
                else{
                    echo '<form action="modules/remove_favorite.php" method="post">';
                    echo    '<button type="submit">'.'Удалить из избранного'.'</button>';
                    echo    '<input type="hidden" name="book_id" value='.$book_id.'>';
                    echo '</form>';
                }
            }
            echo'               </div>
                                </li>
                            </ul>
                        </div>';
        }
        echo '</div>';
        ?>
    </div>

<?php
require "footer.php";
?>