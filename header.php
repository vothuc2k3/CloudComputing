<?php
include_once './connect.php/connect.php';
session_start();
ob_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toys Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link rel="icon" href="../img/bmw-icon-png-24.jpg">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>
<style>
    .search .searchbox {
        float: right;
        display: flex;
    }
</style>

<body>
    <nav class="navbar navbar-expand-md" style="background-color:#34568B; border-bottom: solid 1px black;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand" onclick="document.location='index.php'">
                <h1 style="padding-right: 15px;">Toys Center</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <div class="navbar-nav">

                    <a href="product.php" class="nav-link header-function"><b>PRODUCT</b></a>
                    <div class="dropdown header-function">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><b>CATEGORY</b></a>
                        <div class="dropdown-menu">
                            <?php
                            $query = "SELECT DISTINCT c.cat_id, c.cat_name FROM 002_category c INNER JOIN 001_prod p
                            ON c.cat_id = p.cat_id";
                            $conn = new Connect();
                            $dblink = $conn->connectToMySQL();
                            $re = $dblink->query($query);

                            while ($row = $re->fetch_assoc()) :
                            ?>
                                <a class="dropdown-item" href="category.php?cat_id=<?= $row['cat_id'] ?>"><?= $row['cat_name'] ?> Toys</a>
                            <?php
                            endwhile;
                            ?>
                            <a class="dropdown-item" href="allcat.php"> <b>All Categories</b> </a>
                        </div>
                    </div>
                    <div class="dropdown header-function">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><b>MANAGEMENT</b></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addcat.php"> <b>Add category</b> </a>
                            <a class="dropdown-item" href="addprod.php"> <b>Add product</b> </a>
                        </div>
                    </div>

                    <a href="cart.php" class="nav-link header-function"><b>MY CART</b></a>
                </div>
                <div class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['email'])) :
                    ?>
                        <p href="#" class="nav-item nav-link"><i class="fa-solid fa-check"></i> <b>WELCOME ,<?= $_SESSION['email'] ?></b></p>
                        <a href="logout.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket"></i> <b>LOGOUT</b></a>
                    <?php
                    else :
                    ?>
                        <a href="login.php" class="nav-item nav-link"><i class="fa-solid fa-user"></i> <b>LOGIN</b></a>
                        <a href="register.php" class="nav-item nav-link"><i class="fa-solid fa-user-plus"></i> <b>REGISTER</b> </a>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </nav>