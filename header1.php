<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Book Exchange</title>
    <link rel="icon" href="img/logo.svg" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- Bootsrtap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">-->
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- My Styles -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--    select-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>

<!-- MENU -->
<nav class="navbar navbar-expand-md justify-content-between px-3 px-lg-5 py-1">
    <a class="navbar-brand mt-2 mt-lg-0 nav-logo" href="index.php">
        <img src="img/logo.svg" height="36" alt="BE Logo" loading="lazy"/>
        <div class="d-flex flex-column title">
            <small>Book</small>
            <small>Exchange</small>
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="library.php">Книги<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="request_page.php">Заявки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search_page.php">Поиск</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Аккаунт
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if ($_SESSION['user']){
                    echo '<a class="dropdown-item" href="personal_page.php">Личный кабинет</a>';
                    }
                    ?>
                    <div class="dropdown-divider"></div>
                    <?php
                    if ($_SESSION['user']){
                        $output = "<a class='dropdown-item' href='modules/logout.php'>Выход</a>";
                        echo $output;
                        //session_destroy(); на клик как
                    } else{
                        $output = "<a class='dropdown-item' href='signin_page.php'>";
                        $output = $output.'Вход</a>';
                        echo $output;
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>