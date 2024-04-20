<?= $this->view("zay_shop/header", $data); ?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php
        // Loop through the cart items and display them
        if (count($data['banner']) > 0) {
            // echo (gettype($data['cart'][0]));
            foreach ($data['banner'] as  $key => $banner) {
                echo
                '<div class="carousel-item ' . ($retVal = ($key == 0) ? "active" : "") . ' ">
                    <div class="container">
                        <div class="row p-5">
                            <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                                <img class="img-fluid" src="' . ROOT, $banner->image_url . '" alt="">
                            </div>
                            <div class="col-lg-6 mb-0 d-flex align-items-center">
                                <div class="text-align-left align-self-center">
                                <a href="' . ROOT, "shopSingle?id=", $banner->product_id . '" class="nav-link" target=""><h1 class="h1 text-success">' . $banner->header . '</h1></a>
                                <h3 class="h2">' . $banner->title . '</h3>
                                <p>
                                    ' . $banner->description . '
                                </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        ?>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categories of The Month</h1>
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
        <?php
        // Loop through the cart items and display them
        if (count($data['cats']) > 0) {
            // echo (gettype($data['cart'][0]));
            foreach ($data['cats'] as  $key => $cat) {
                echo '
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="' . ROOT . 'shop?cat=' . $cat->category_id  . '"><img src="' . ROOT, $cat->image . '" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">' . $cat->name . '</h5>
            <p class="text-center"><a href="' . ROOT . 'shop?cat=' . $cat->category_id  . '" class="btn btn-success">Go Shop</a></p>
        </div>';
            }
        }
        ?>

    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Product</h1>
                <p>
                    Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>
        <div class="row">
            <?php
            // Loop through the cart items and display them
            if (isset($data['products'])) {
                if (count($data['products']) > 0) {
                    // echo (gettype($data['cart'][0]));
                    foreach ($data['products'] as  $key => $product) {
                        echo '
                    <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                    <a href="' . ROOT, "shopSingle?id=", $product->product_id . '">
                    <img src="' . ROOT, $product->image_url . '" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">';
                        printRate($product->average_rating, 'between', $product->price);
                        echo '
                        <a href="' . ROOT, "shopSingle?id=", $product->product_id . '" class="h2 text-decoration-none text-dark">' . $product->name . '</a>
                        <p class="card-text">
                        ' . $product->description . '
                        </p>
                        <p class="text-muted">Reviews (' . $product->review_count . ')</p>
                    </div>
                </div>
            </div>';
                    }
                }
            }
            ?>

        </div>
    </div>
</section>
<!-- End Featured Product -->

<?= $this->view("zay_shop/footer", $data); ?>