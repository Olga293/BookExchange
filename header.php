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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- My Styles -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<!-- Start your project here-->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg ">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0 nav-logo" href="index_old.php">
                <img src="img/logo.svg" height="36" alt="BE Logo" loading="lazy"/>
                <div class="d-flex flex-column title">
                    <small>Book</small>
                    <small>Exchange</small>
                </div>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav mb-2 mb-lg-0 nav-tab-right">
                <li class="nav-item">
                    <a class="nav-link n-lin" href="library.php">Книги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addrequest_page.php">Заявки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addrequest_page.php">Поиск</a>
                </li>
            </ul>


            <!-- Left links -->
            
            <div class=" position-relative">
                <!--<form class="d-flex input-group w-auto flex-row">
                    <input
                            type="search"
                            class="form-control rounded mb-0"
                            placeholder="Поиск"
                            aria-label="Search"
                            aria-describedby="search-addon"
                            onkeyup="showHint(this.value)"
                            name="search"
                            id="searchInput"
                    />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
                <div id="Search" class="position-absolute" style="max-width: 220px; display: none;" >
                    <table id="SearchTable" style="max-width: inherit; overflow: hidden; table-layout: fixed; position: relative; z-index: 1; background: #ffffff">
                        <tbody id="txtHint">

                        </tbody>
                    </table>
                </div>-->

            </div>
        </div>

        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">

            <!-- Icon -->


            <!-- Notifications -->
<!--            <div class="dropdown">-->
<!--                <a-->
<!--                    class="text-reset me-3 dropdown-toggle hidden-arrow"-->
<!--                    href="#"-->
<!--                    id="navbarDropdownMenuLink"-->
<!--                    role="button"-->
<!--                    data-mdb-toggle="dropdown"-->
<!--                    aria-expanded="false"-->
<!--                >-->
<!--                    <i class="fas fa-bell"></i>-->
<!--                    <span class="badge rounded-pill badge-notification bg-danger">1</span>-->
<!--                </a>-->
<!--                <ul-->
<!--                    class="dropdown-menu dropdown-menu-end"-->
<!--                    aria-labelledby="navbarDropdownMenuLink"-->
<!--                >-->
<!--                    <li>-->
<!--                        <a class="dropdown-item" href="#">Some news</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a class="dropdown-item" href="#">Another news</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a class="dropdown-item" href="#">Something else here</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
            <!-- Avatar -->
            <div class="dropdown">
                <a
                    class="dropdown-toggle d-flex align-items-center hidden-arrow"
                    href="#"
                    id="navbarDropdownMenuAvatar"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                >
                    <img
                        src="img/avatar.png"
                        class="rounded-circle"
                        height="25"
                        alt="Black and White Portrait of a Man"
                        loading="lazy"
                    />
                </a>
                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuAvatar"
                >
                    <li>
                        <a class="dropdown-item" href="personal_page.php">Мой профиль</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Настройки</a>
                    </li>
                    <li>
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
<!--                        <a class="dropdown-item" href="#">Выход</a>-->
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->

<!-- End your project here-->

<!--<script>
            // $('#searchInput').blur(function(){
            //     $('#txtHint').css('display','none');
            // });
            function showHint(str) {
                Search.style.display = "block";
                if (str.length == 0) {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                    xmlhttp.open("GET", "modules/search.php?q=" + str);
                    xmlhttp.send();
                }
            }
        </script>-->


