    <script async>
        function subscribe() {
            // Get the email input value
            let email = document.getElementById('subscribeEmail').value;
            let URL = ROOT + 'subscribe';
            //Initialize Toastr:
            toastr.options = {
                "closeButton": true,
                "positionClass": "toast-top-right",
                "timeOut": 500,
            }

            // Validate the email (you can add more sophisticated validation)
            if (!email || !isValidEmail(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            if (isValidEmail(email)) {
                // Perform AJAX request
                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: {
                        email: email
                    },
                    success: function(response) {
                        // Handle the response from the server
                        console.log(response);
                        toastr.success('Subscription successful!', 'Success');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            } else {
                // Handle invalid email
                alert('Please enter a valid email address.');
            }
            // });

        }

        function isValidEmail(email) {
            // Add your email validation logic here
            // This is a simple example, you can use regex or other methods for validation
            return /\S+@\S+\.\S+/.test(email);
        }
    </script>
    <script src="<?= ASSETS ?>zay_shop/js/custom.js"></script>

    <link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/toastr.min.css">
    <?php
    $tags = $this->loadmodel('Tag');
    $footer['tags'] = $tags->getAllTags();
    ?>
    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <!-- Start Address -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            123 Consectetur at ligula 10660
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                </div>
                <!-- End Address -->
                <!-- Start Tags -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php foreach ($footer['tags'] as  $tag) {
                            echo '<li><a class="text-decoration-none" href="' . ROOT, 'shop?tag=' . $tag->tag_name . '">' . $tag->tag_name . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <!-- End Tags -->
                <!-- Start Links -->
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="<?= ROOT ?>index">Home</a></li>
                        <li><a class="text-decoration-none" href="<?= ROOT ?>about">About Us</a></li>
                        <li><a class="text-decoration-none" href="<?= ROOT ?>location">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="<?= ROOT ?>faq">FAQs</a></li>
                        <li><a class="text-decoration-none" href="<?= ROOT ?>contact">Contact</a></li>
                    </ul>
                </div>
                <!-- End Links -->
            </div>
            <!--  Social and Subscribe -->
            <!-- Start Social -->
            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- end Social -->
                <!-- Start Subscribe -->
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="email" name="email" class="form-control bg-dark border-light text-white" id="subscribeEmail" placeholder="Email address">
                        <button type="button" class="btn btn-success text-light" onclick="subscribe()">Subscribe</button>
                    </div>
                </div>
                <!-- end Subscribe -->

            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Company Name
                            | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="<?= ASSETS ?>zay_shop/js/jquery-1.11.0.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ASSETS ?>zay_shop/js/templatemo.js"></script>
    <script src="<?= ASSETS ?>zay_shop/js/custom.js"></script>
    <script src="<?= ASSETS ?>zay_shop/js/toastr.min.js"></script>
    <!-- End Script -->

    </body>

    </html>