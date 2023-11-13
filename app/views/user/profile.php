<link rel="stylesheet" href="<?= ASSETS ?>zay_shop/profile/style.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"> -->
<script>
    var initialAverageRating = 2;
</script>
<?php
$orderStatus = $data['orders'][0]->status;  // Replace this with the actual order status

$averageRating = 3.5;
$statusIcons = [
    'Placed' => 'fas fa-gift',
    'Accepted' => 'fas fa-box-open',
    'Packed' => 'fas fa-box',
    'Shipped' => 'fas fa-check',
    'Delivered' => 'fas fa-truck',
];

$orderStatuses = ['Placed', 'Accepted', 'Packed', 'Shipped',  'Delivered'];


// Check if the order status exists in the mapping
if (array_key_exists($orderStatus, $statusIcons)) {
    $statusClass = 'text-muted green';
    $statusIcon = $statusIcons[$orderStatus];
}
?>

<?= $this->view("zay_shop/header", $data); ?>



<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 my-lg-0 my-md-1">
            <div id="sidebar" class="bg-purple">
                <div class="h4 text-white">Account</div>
                <ul>
                    <li class="active">
                        <a href="#" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Account</div>
                                <div class="link-desc">View & Manage orders and returns</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-box-open pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Orders</div>
                                <div class="link-desc">View & Manage orders and returns</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none d-flex align-items-start">
                            <div class="far fa-address-book pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">Address Book</div>
                                <div class="link-desc">View & Manage Addresses</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none d-flex align-items-start">
                            <div class="far fa-user pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">My Profile</div>
                                <div class="link-desc">Change your profile details & password</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none d-flex align-items-start">
                            <div class="fas fa-headset pt-2 me-3"></div>
                            <div class="d-flex flex-column">
                                <div class="link">Help & Support</div>
                                <div class="link-desc">Contact Us for help and support</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9 my-lg-0 my-1">
            <div id="main-content" class="bg-white border">
                <div class="d-flex flex-column">
                    <div class="h5">Hello <?= $data['user'][0]->first_name ?>,</div>
                    <div>Logged in as: <?= $data['user'][0]->email ?></div>
                </div>
                <div class="d-flex my-4 flex-wrap">
                    <div class="box me-4 my-1 bg-light">
                        <img src="https://www.freepnglogos.com/uploads/box-png/cardboard-box-brown-vector-graphic-pixabay-2.png" alt="">
                        <div class="d-flex align-items-center mt-2">
                            <div class="tag">Orders placed</div>
                            <div class="ms-auto number"><?= $data['orderscount'] ?></div>
                        </div>
                    </div>
                    <div class="box me-4 my-1 bg-light">
                        <img src="https://www.freepnglogos.com/uploads/shopping-cart-png/shopping-cart-campus-recreation-university-nebraska-lincoln-30.png" alt="">
                        <div class="d-flex align-items-center mt-2">
                            <div class="tag">Items in Cart</div>
                            <div class="ms-auto number"><?= $data['cartcount'] ?></div>
                        </div>
                    </div>
                    <div class="box me-4 my-1 bg-light">
                        <img src="https://www.freepnglogos.com/uploads/love-png/love-png-heart-symbol-wikipedia-11.png" alt="">
                        <div class="d-flex align-items-center mt-2">
                            <div class="tag">Wishlist</div>
                            <div class="ms-auto number"><?= $data['wishcount'] ?></div>
                        </div>
                    </div>
                </div>
                <div class="text-uppercase">My recent orders</div>
                <?php foreach ($data['orders'] as  $order) : ?>

                    <div class="order my-3 bg-light">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex flex-column justify-content-between order-summary">
                                    <div class="d-flex align-items-center">
                                        <div class="text-uppercase">Order #fur<?= $order->order_id ?></div>
                                        <div class="blue-label ms-auto text-uppercase"> <?= $order->PayType ?></div>
                                    </div>
                                    <div class="fs-8">Products #<?= $order->product_count ?></div>
                                    <div class="fs-8"><?= $order->order_date ?></div>
                                    <div class="rating d-flex align-items-center pt-1">
                                        <img src="https://www.freepnglogos.com/uploads/like-png/like-png-hand-thumb-sign-vector-graphic-pixabay-39.png" alt=""><span class="px-2">Rating:</span>

                                    </div>
                                    <?php
                                    // Example average rating (replace this with your actual variable)
                                    // $averageRating = 3.5;
                                    ?>

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
                                            <progress class="rating-bg" value="<?= $averageRating ?>" max="5"></progress>
                                            <svg>
                                                <use xlink:href="#fivestars" />
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="d-sm-flex align-items-sm-start justify-content-sm-between">
                                    <div class="status">Status : <?= $order->status ?></div>
                                    <div class="btn btn-primary text-uppercase">order info</div>
                                </div>
                                <?php

                                $orderStatus = $order->status;  // Replace this with the actual order status

                                ?>


                                <div class="progressbar-track">
                                    <ul class="progressbar">

                                        <?php foreach ($orderStatuses as $index => $status) : ?>
                                            <?php
                                            // Find the index of the current order status
                                            $currentStatusIndex = array_search($orderStatus, $orderStatuses);
                                            // Set the class and icon for each status
                                            $statusClass = 'text-muted';
                                            $id = $index + 1;

                                            if ($index < $currentStatusIndex) {
                                                // Previous status
                                                $statusClass .= ' green';
                                            } elseif ($index === $currentStatusIndex) {
                                                // Current status
                                                $statusClass .= ' green';
                                            } else {
                                                // Next status
                                                $statusClass .= ' gray';
                                            }
                                            $statusIcon = $statusIcons[$status];
                                            ?>
                                            <li id="step-<?= $id ?>" class="<?= $statusClass; ?>">
                                                <span class="<?= $statusIcon; ?>"></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div id="tracker"></div>
                                    <h3>Set rating</h3>
                                    <div id="">Average Rating:</div>
                                    <!-- Add this code where you want to display the rating stars -->
                                    <span id="stars">
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
                                        <div class="rating" id="ratingContainer">
                                            <!-- Progress bar with dynamic width based on the average rating -->
                                            <progress class="rating-bg" id="ratingProgress" value="$averageRating" max="5"></progress>
                                            <svg id="ratingStars">
                                                <use xlink:href="#fivestars" />
                                            </svg>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- <script>
        // Get the rating container and progress bar elements
        const ratingContainer = document.getElementById('ratingContainer');
        const progressBar = ratingContainer.querySelector('.rating-bg');
        console.log(progressBar);

        // Add a mouseover event listener to the rating container
        ratingContainer.addEventListener('mouseover', function(event) {
            // Calculate the hovered star based on the mouse position
            const boundingBox = ratingContainer.getBoundingClientRect();
            const starWidth = boundingBox.width / 5; // Assuming 5 stars
            const hoveredStar = Math.floor((event.clientX - boundingBox.left) / starWidth) + 1;

            // Update the progress bar value to the hovered star
            progressBar.value = hoveredStar;

            // Optionally, you can send an AJAX request to update the rating in the database
            // Example: You can use the Fetch API or an XMLHttpRequest to send the data to the server
        });

        // Add a mouseout event listener to reset the progress bar to the average rating
        ratingContainer.addEventListener('mouseout', function() {
            progressBar.value = <?= $averageRating ?>;
        });
    </script> -->


</div>


<?= $this->view("zay_shop/footer", $data); ?>