<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zay Shop | <?= $data['title'] ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?= ASSETS ?>zay_shop/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= ASSETS ?>zay_shop/img/favicon.ico">

    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/templatemo.css">
    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/custom.css">
    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/profile/style.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/fontawesome.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>zay_shop/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>zay_shop/css/slick-theme.css">
    <!-- Define ROOT variable -->
    <script>
        const ROOT = "<?php echo ROOT; ?>";
    </script>

    <!-- <script src="<?= ASSETS ?>zay_shop/js/cart.js"></script> -->
    <!--
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@zayshop.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">+2010-9456-9809</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="<?= ROOT ?>index">
                Zay
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>shop">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex" id="navbar-btns">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none " href="<?= ROOT ?>CartController">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1 " id="cart-icon"></i>
                        <?php
                        // echo cartItems();
                        if (isset($_SESSION['user_id'])) {
                            $cartcount = getCartQuantity($_SESSION['user_id']);
                            if ($cartcount > 0) {
                                echo '<span id="cartcount" class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">';
                                echo $cartcount;
                            } else {
                                echo '<span id="cartcount" class="d-none position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark ">';
                            }
                        }
                        ?>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none " id="wishlist" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_list">
                        <i class="fa fa-heart text-dark mr-1 " id="list-icoun"></i>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo '<span id="listcount" class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">';
                            echo (getListQuantity($_SESSION['user_id']));
                        }
                        ?>
                    </a>
                    <?php if (isset($_SESSION['user_name'])) : ?>
                        Hi <?= $_SESSION['user_name'] ?>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php if ($_SESSION['image_url']) : ?>
                                    <img src="<?= ROOT . $_SESSION['image_url'] ?>" alt="" width="30">
                                <?php else : ?>
                                    <i class="fa fa-fw fa-user text-success mr-3"></i>
                                <?php endif; ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
                                    <li><a class="dropdown-item" href="<?= ROOT ?>AdminController/dashboard">Dashboard</a></li>
                                <?php else : ?>
                                    <li><a class="dropdown-item" href="<?= ROOT ?>UserController/profile">Profile</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT ?>AuthController/logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?= ROOT ?>AuthController/login">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="search" method="GET" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="searchInput" name="query" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light" id="searchButton">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- Modal -->
    <!-- Wishlist Modal  -->
    <div class="modal fade bg-white" id="templatemo_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            ?>
            <div class="col-md-12 col-lg-8">
                <div class="items">
                    <?php
                    $list = getList($_SESSION['user_id']);
                    // Loop through the cart items and display them
                    if (!empty($list)) {
                        // echo (gettype($data['cart'][0]));
                        foreach ($list as $item) {
                            // echo "<div class="product">div"
                            echo '<div class="product modal-content ">
                            <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid mx-auto d-block image"src="' . ROOT, $item->image_url . '">
							</div>
							<div class="col-md-8">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-md-5 product-name">
                                            <div class="product-name">
                                                <a class="product-link" href="' . ROOT . 'shopsingle?id=' . $item->product_id . '">' . $item->name . '</a>

                                            </div>
                                        </div>
																
									</div></div></div></div></div>';
                        }
                    } else {
                        echo "<h1>EMPTY</h1>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>