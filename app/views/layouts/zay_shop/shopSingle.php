<?= $this->view("zay_shop/header", $data); ?>
<?php if ($data['product'] != '') : ?>
    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="<?= ROOT, ($data['product'][0]->image_url) ? $data['product'][0]->image_url : 'uploads/products/blaceholder.jpeg' ?>" alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!-- Start Carousel Wrapper-->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                <?php
                                // Check if there is data to display
                                if (!empty($data['product'][0]->all_images)) {
                                    $imageArray = explode(",", $data['product'][0]->all_images);
                                    // Chunk the data into groups of 3 for each carousel item
                                    $chunkedImages = array_chunk($imageArray, 3);

                                    // Iterate over each chunk
                                    foreach ($chunkedImages as $index => $images) {
                                        // Set the first item as active for the first slide
                                        $activeClass = ($index === 0) ? 'active' : '';
                                ?>
                                        <!-- Carousel Item -->
                                        <div class="carousel-item <?= $activeClass ?>">
                                            <div class="row">
                                                <?php
                                                // Iterate over each item in the chunk
                                                foreach ($images as $image) {
                                                ?>
                                                    <div class="col-4">
                                                        <a href="#">
                                                            <img class="card-img img-fluid" src="<?= ROOT, 'uploads/products/' . $image ?>" alt="<?= $image ?>">
                                                        </a>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!-- /.Carousel Item -->
                                <?php
                                    }
                                } else {
                                    // Display a message if there is no data
                                    echo '<p>No other image available</p>';
                                }
                                ?>
                            </div>
                        </div>

                        <!--End Carousel Wrapper -->
                        <!--Start Controls-->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $commentArray = explode(",", $data['product'][0]->comments);

                            ?>
                            <h1 class="h2"><?= $data['product'][0]->name ?></h1>
                            <p class="h3 py-2">$<?= $data['product'][0]->price ?></p>
                            <p>
                                <span>
                                    <svg style="display:none;">
                                        <defs>
                                            <symbol id="fivestars">
                                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" />
                                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(24)" />
                                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(48)" />
                                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(72)" />
                                                <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(96)" />
                                            </symbol>
                                        </defs>
                                    </svg>
                                    <div class="rating">
                                        <!-- Progress bar with dynamic width based on the average rating -->
                                        <progress class="rating-bg" value="<?= $data['product'][0]->average_rating ?>" max="5"></progress>
                                        <svg>
                                            <use xlink:href="#fivestars" />
                                        </svg>
                                    </div>
                                </span>
                                <span class="list-inline-item text-dark">Rating <?= $data['product'][0]->average_rating ?> | <?= count($commentArray) ?> Comments</span>

                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Brand:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong><?= $data['product'][0]->Brand_name ?></strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p><?= $data['product'][0]->product_description ?></p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Avaliable Color :</h6>
                                </li>
                                <li class="list-inline-item">
                                    <!-- <p class="text-muted"><strong>White / Black</strong></p> -->
                                    <p class="text-muted">
                                        <?php foreach ($data['product'] as $product) {
                                            if (!empty($product->color_name)) {
                                                echo '<strong style="color: ' . $product->color_name . ';font-weight:bold">' . $product->color_name . '</strong> ';
                                            } else {
                                                echo 'Not avilable';
                                            }
                                        } ?>
                                    </p>
                                </li>
                            </ul>

                            <h6>Specification:</h6>
                            <ul class="list-unstyled pb-3">
                                <li>Lorem ipsum dolor sit</li>
                                <li>Amet, consectetur</li>
                                <li>Adipiscing elit,set</li>
                                <li>Duis aute irure</li>
                                <li>Ut enim ad minim</li>
                                <li>Dolore magna aliqua</li>
                                <li>Excepteur sint</li>
                            </ul>

                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Size :
                                                <input type="hidden" name="product-size" id="product-size" value="S">
                                            </li>
                                            <?php foreach ($data['product'] as $product) {
                                                if (!empty($product->size_char)) {
                                                    echo '<li class="list-inline-item"><span class="btn btn-success btn-size">' . $product->size_char . ' </span></li>';
                                                } else {
                                                    echo 'Not Speacial';
                                                }
                                            } ?>


                                        </ul>
                                    </div>

                                </div>
                                <div class="row pb-3">
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        if (!(isInCart($_SESSION['user_id'], $data['product'][0]->product_id))) {
                                            echo '
                                            <div class="col d-grid">
                                            <a class="add-to-cart-btn buy singleShop btn btn-success btn-lg"  data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $product->product_id . '">Buy</a>
                                            
                                            </div>';
                                        }
                                    } else {
                                        echo ' <div class="col d-grid">
                                        <a class=" btn btn-success btn-lg" href="' . ROOT, 'CartController' . '" >Buy</a>
                                        </div>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        if (!(isInCart($_SESSION['user_id'], $data['product'][0]->product_id))) {
                                            echo '
                                        <div class="col d-grid">
                                        <a class="add-to-cart-btn singleShop btn btn-success btn-lg"  data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $product->product_id . '">Add To Cart</a>

                                        </div>';
                                        }
                                    } else {
                                        echo ' <div class="col d-grid d-none"></div>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['user_id'])) {
                                        if (!(isInList($_SESSION['user_id'], $data['product'][0]->product_id))) {
                                            echo '<div class="col d-grid">
                                    <a class="add-to-list-btn singleShop btn btn-success btn-lg"  data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $product->product_id . '">Add To Wishlist</a>
                                    
                                    </div>';
                                        }
                                    } else {
                                        echo ' <div class="col d-grid d-none"></div>';
                                    }
                                    ?>
                                    <!-- <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Wishlist</button> -->

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Related Products</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">
                <?php if (($data['related'] != '')) {
                    foreach ($data['related'] as $item) {
                        // show($item->size_chars);
                        echo ' <div class="p-2 pb-3">
                            <div class="product-wap card rounded-0">
                                <div class="card rounded-0">
                                <a href="' . ROOT, 'shopSingle?id=' . $item->product_id . '" class="h3 text-decoration-none">
                                <img class="card-img rounded-0 img-fluid" src="' . ROOT, ($item->image_url) ? $item->image_url : 'uploads/products/placholder400.png' . '">
                                    
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a href="shop-single.html" class="h3 text-decoration-none">' . $item->name . '</a>
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">';
                        if (!empty($item->size_chars)) {
                            echo '<li class="list-inline-item"><span class="btn btn-success btn-size">' . $item->size_chars . ' </span></li>';
                        }
                        echo '
                            <li class="pt-2">
                                <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                            </li>
                        </ul>';
                        if ($item->average_rating > 0) {
                            printRate($item->average_rating, 'center');
                        } else {
                            echo 'Not Rated Yet!';
                        }
                        echo '
                        <p class="text-center mb-0">$' . $item->price . '</p>
                        </div>
                        </div>
                        </div>';
                    }
                } else {
                    echo "No Related Products: ";
                } ?>
            </div>


        </div>
    </section>
    <!-- End Article -->
<?php endif; ?>
<!-- Start Slider Script -->
<script src="<?= ASSETS ?>zay_shop/js/jquery-1.11.0.min.js"></script>
<script src="<?= ASSETS ?>zay_shop/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?= ASSETS ?>zay_shop/js/slick.min.js"></script>
<script>
    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 3
                }
            }
        ]
    });
</script>
<!-- End Slider Script -->

<?= $this->view("zay_shop/footer", $data); ?>