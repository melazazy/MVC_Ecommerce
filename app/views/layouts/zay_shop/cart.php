<?php


// Add a product to the cart (example)

use function PHPSTORM_META\type;

if (isset($_POST['add_to_cart'])) {
	$productId = $_POST['product_id'];
	$productName = $_POST['product_name'];
	$productPrice = $_POST['product_price'];
	addToCart($productId, $productName, $productPrice);
}

// Remove a product from the cart (example)
if (isset($_GET['remove_from_cart'])) {
	$productId = $_GET['remove_from_cart'];
	removeFromCart($productId);
}

// Calculate the total price
$totalPrice = calculateTotal();
?>


<?= $this->view("zay_shop/header", $data); ?>
<link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/cart.css">

<body>
	<main class="page">
		<section class="shopping-cart dark">
			<div class="container">
				<div class="block-heading">
					<h2>Shopping Cart</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
						mattis vitae leo.</p>
				</div>
				<div class="content">
					<div class="row">
						<div class="col-md-12 col-lg-8">
							<div class="items">
								<!-- <div class="product-info">
									<div>Display: <span class="value">5 inch</span></div>
									<div>RAM: <span class="value">4GB</span></div>
									<div>Memory: <span class="value">32GB</span></div>
								</div> -->
								<?php
								// Loop through the cart items and display them
								if (!isCartEmpty()) {
									// echo (gettype($data['cart'][0]));
									foreach ($data['cart'] as $cartItem) {
										// echo "<div class="product">div"
										echo '<div class="product"><div class="row"><div class="col-md-3"><img class="img-fluid mx-auto d-block image"src="' . ROOT, $cartItem->image_url . '">
													</div>
													<div class="col-md-8">
														<div class="info">
															<div class="row">
																<div class="col-md-5 product-name">
																	<div class="product-name">
																		<a href="#">' . $cartItem->name . '</a>

																	</div>
																</div>
																<div class="col-md-4 quantity">
																	<label for="quantity">Quantity:</label>
																	<input id="quantity" type="number" value=' . $cartItem->quantity . ' 
																		class="form-control quantity-input">
																</div>
																<div class="col-md-3 price">
																	<span>$' . $cartItem->price . ' </span>
																</div>
													</div></div></div></div></div>';
									}
								} else {
									echo "<h1>EMPTY</h1>";
								}
								?>
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="summary">
								<h3>Summary</h3>
								<div class="summary-item"><span class="text">Subtotal</span><span class="price">$<?= calculateTotal() ?></span></div>
								<div class="summary-item"><span class="text">Discount</span><span class="price">$0</span></div>
								<div class="summary-item"><span class="text">Shipping</span><span class="price">$0</span></div>
								<div class="summary-item"><span class="text">Total</span><span class="price">$360</span>
								</div>
								<a type="button" class="btn btn-primary btn-lg btn-block" href="payment">Checkout</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
	</main>
</body>

<?= $this->view("zay_shop/footer", $data); ?>