<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>
<?php
require "header1.php";
?>


<h2>Авторизация</h2>
<div class="form-block">
    <form action="modules/sign_in.php" method="post" class="d-flex flex-column">
        <label>Логин</label>
        <?php
        if ($_SESSION['e_login']){
            echo '<label class="error">'.$_SESSION['e_login'].'</label>';
            unset($_SESSION['e_login']);
        }
        ?>
        <input type="text" name="login" placeholder="">
        <label>Пароль</label>
        <?php
        if ($_SESSION['e_password']){
            echo '<label class="error">'.$_SESSION['e_password'].'</label>';
            unset($_SESSION['e_password']);
        }
        ?>
        <input type="password" name="password" placeholder="">
        <?php
        if ($_SESSION['error']){
            echo '<label class="error">'.$_SESSION['error'].'</label>';
            unset($_SESSION['error']);
        }
        ?>
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="signup_page.php">Зарегистрируйтесь!</a>
        </p>
    </form>
</div>
<?php
require "footer.php";
?>
