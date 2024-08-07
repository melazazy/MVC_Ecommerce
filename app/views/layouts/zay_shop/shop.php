<?= $this->view("zay_shop/header", $data); ?>

<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Product
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php
                        foreach ($data['categories'] as $key => $cat) {
                            echo '<li><a class="text-decoration-none" href="' . ROOT, "shop?cat=", $cat->category_id  . '">' . $cat->name . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Tag's
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <?php
                        foreach ($data['tags'] as $tag) {
                            echo '<li><a class="text-decoration-none" href="' . ROOT, "shop?tag=", $tag->tag_name  . '">' . $tag->tag_name . '</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="<?= ROOT . 'shop' ?>">All</a>
                        </li>
                        <?php
                        $currentURL = $_SERVER['REQUEST_URI'];
                        $urlParts = parse_url($currentURL);
                        $strval = isset($urlParts['query']) ? parse_str($urlParts['query'], $queryParameters) : ')';
                        // Define the parameters you want to check
                        $paramToCheck = "cat";
                        // Check if the parameter exists in the URL
                        if (strpos($currentURL, $paramToCheck . "=") !== false) {
                            // The parameter exists; add "&gender="
                            $menURL = ROOT . "shop?cat=" . $queryParameters['cat'] . "&gender=Male"; // Replace "value" with the desired value
                            echo '<li class="list-inline-item">';
                            echo '<a class="h3 text-dark text-decoration-none mr-3" href="' . $menURL . '">Men\'s</a>';
                            echo '</li>';
                            $womenURL = ROOT . "shop?cat=" . $queryParameters['cat'] . "&gender=Female"; // Replace "value" with the desired value
                            echo '<li class="list-inline-item">';
                            echo '<a class="h3 text-dark text-decoration-none mr-3" href="' . $womenURL . '">Women\'s</a>';
                            echo '</li>';
                        } else {
                            $menURL = ROOT . "shop?gender=Male"; // Replace "value" with the desired value
                            echo '<li class="list-inline-item">';
                            echo '<a class="h3 text-dark text-decoration-none mr-3" href="' . $menURL . '">Men\'s</a>';
                            echo '</li>';
                            $womenURL = ROOT . "shop?gender=Female"; // Replace "value" with the desired value
                            echo '<li class="list-inline-item">';
                            echo '<a class="h3 text-dark text-decoration-none mr-3" href="' . $womenURL . '">Women\'s</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <?php
                if (!empty($data['products'])) {

                    foreach ($data['products'] as $key => $product) {
                        $colors = [];
                        if (!isArrayOfEmptyElements($product->color_names)) {
                            foreach ($product->color_names as $color) {
                                $colors[] = $color;
                            }
                        }
                        echo '<div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="' . ($retVal = ($product->image_url != '') ? ROOT . $product->image_url : ROOT . "uploads/products/blaceholder.jpeg") . '">                    
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">';
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 'guest') {
                            echo '
                                    <li><a class="add-to-cart-btn btn btn-success text-white" data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $product->product_id . '"><i class="fa fa-cart-arrow-down"></i></a></li>
                                    <li><a class="add-to-list-btn btn btn-success text-white mt-2"  data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $product->product_id . '"><i class="far fa-heart"></i></a></li>
                                    ';
                        } else {
                            echo '
                                    <li><a class="add-to-cart-btn btn btn-success text-white" data-user-id="guest" data-product-id="' . $product->product_id . '"><i class="fa fa-cart-arrow-down"></i></a></li>
                                    <li><a class="add-to-list-btn btn btn-success text-white mt-2"  data-user-id="guest" data-product-id="' . $product->product_id . '"><i class="far fa-heart"></i></a></li>
                                    ';
                        }
                        echo '
                                <li><a class="btn btn-success text-white mt-2" href="shopsingle?id=' . $product->product_id . '"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="shopsingle?id=' . $product->product_id . '" class="h3 text-decoration-none">' . $product->name . '</a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li> Size: ' . $product->size_chars . '</li>
                                
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                            <li>';

                        if (!isArrayOfEmptyElements($colors)) {
                            echo 'Colors:';
                            foreach ($product->color_names as $color) {
                                echo '<button class="btn" style="background: ' . $color . ';font-weight:bold;width:30px;height: 20px;padding: 5px;"></button>';
                            }
                        } else {
                            echo 'No Colors Available';
                        }
                        echo '</li></ul>';

                        if ($product->average_rating > 0) {
                            printRate($product->average_rating, 'center');
                        } else {
                            echo '<br>';
                        }
                        echo '<p class="text-center mb-0">$' . $product->price . '</p>
                        </div>
                    </div>
                </div>';
                    }
                } else {
                    echo "No Product in this category";
                }

                ?>
            </div>


        </div>
    </div>
    <!-- End Content -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Our Brands</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">
                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <?php
                                            foreach ($data['brands'] as $key => $brand) {
                                                echo
                                                '<div class="col-3 p-md-5">
                                                    <a href="#"><img class="img-fluid brand-img" src="' . $brand->image . '" alt="Brand Logo"></a>
                                                </div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!--End First slide-->
                                </div>
                                <!--End Slides-->
                            </div>
                        </div>
                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->


    <?= $this->view("zay_shop/footer", $data); ?>