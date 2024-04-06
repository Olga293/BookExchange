<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>
<?php
require "header1.php";
?>

<h2>Регистрация</h2>
<div class="form-block">
    <form action="modules/sign_up.php" method="post" class="d-flex flex-column">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column" style="margin-right: 50px">
                <label>Имя</label>
                <?php
                if ($_SESSION['e_name']){
                    echo '<label class="error">'.$_SESSION['e_name'].'</label>';
                    unset($_SESSION['e_name']);
                }
                ?>
                <input type="text" name="name" placeholder="">
                <label>Фамилия</label>
                <?php
                if ($_SESSION['e_surname']){
                    echo '<label class="error">'.$_SESSION['e_surname'].'</label>';
                    unset($_SESSION['e_surname']);
                }
                ?>
                <input type="text" name="surname" placeholder="">
                <label>Отчество</label>
                <?php
                if ($_SESSION['e_middle_name']){
                    echo '<label class="error">'.$_SESSION['e_middle_name'].'</label>';
                    unset($_SESSION['e_middle_name']);
                }
                ?>
                <input type="text" name="middle_name" placeholder="">
                <label>Адрес</label>
                <?php
                if ($_SESSION['e_address']){
                    echo '<label class="error">'.$_SESSION['e_address'].'</label>';
                    unset($_SESSION['e_address']);
                }
                ?>
                <input id="address" type="text" name="address" placeholder="">
                <label>Почтовый индекс</label>
                <?php
                if ($_SESSION['e_post_index']){
                    echo '<label class="error">'.$_SESSION['e_post_index'].'</label>';
                    unset($_SESSION['e_post_index']);
                }
                ?>
                <input id="postal_code" type="text" name="post_index" placeholder="">
            </div>
            <div class="d-flex flex-column">
                <label>Электронная почта</label>
                <?php
                if ($_SESSION['e_email']){
                    echo '<label class="error">'.$_SESSION['e_email'].'</label>';
                    unset($_SESSION['e_email']);
                }
                ?>
                <input type="text" name="email" placeholder="">

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
                <label>Подтверждение пароля</label>
                <?php
                if ($_SESSION['e_password_confirm']){
                    echo '<label class="error">'.$_SESSION['e_password_confirm'].'</label>';
                    unset($_SESSION['e_password_confirm']);
                }
                ?>
                <input type="password" name="password_confirm" placeholder="">
            </div>
        </div>
        <button type="submit">Зарегистрироваться</button>
        <p>
            У вас уже есть аккаунт? - <a href="signin_page.php">Авторизируйтесь!</a>
        </p>
    </form>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
<script src="js/hints.js"></script>




