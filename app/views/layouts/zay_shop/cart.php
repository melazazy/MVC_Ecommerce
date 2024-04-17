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
// $totalPrice = calculateTotal();
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
								<?php
								// Loop through the cart items and display them
								if (!isCartEmpty()) {
									// echo (gettype($data['cart'][0]));
									// echo '<form autocomplete="off" action="checkout-charge.php" method="POST">';
									foreach ($data['cart'] as $cartItem) {
										// echo "<div class="product">div"
										echo '<div class="product"><div class="row"><div class="col-md-3"><img class="img-fluid mx-auto d-block image"src="' . ROOT, $cartItem->image_url . '">
										</div>
										<div class="col-md-8">
										<div class="info">
										<div class="row">
										<div class="col-md-5 product-name">
										<div class="product-name">
										<a href="' . ROOT . 'shopsingle?id=' . $cartItem->product_id . '">' . $cartItem->name . '</a>
										
										</div>
										</div>
										<div class="col-md-4 quantity">
										<label for="quantity">Quantity:</label>
										<input class="quantity-input" id="quantity-input" data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $cartItem->product_id . '" type="number" value=' . $cartItem->quantity . ' 
										class="form-control quantity-input">
										</div>
										<div class="col-md-2 price">
										<span>$' . $cartItem->price . ' </span>
										</div>
										<div class="col-md-1 remove">
											<ul class="list-inline m-0">
												<li class="list-inline-item">
													<button class="remove-item btn btn-danger btn-sm rounded-0" data-user-id="' . $_SESSION['user_id'] . '" data-product-id="' . $cartItem->product_id . '"  type="button" data-toggle="tooltip" data-placement="top" title="Delete">
														<i class="fa fa-trash"></i>
													</button>
												</li>
											</ul>
										</div>
										</div>
										<div class="info">
											<div class="row">
												<p>' . $cartItem->description . '</p>
											</div>
										</div>
													</div></div></div></div>';
									}
									// echo '</form>';
								} else {
									echo "<h1>EMPTY</h1>";
								}
								?>
							</div>
						</div>
						<div class="col-md-12 col-lg-4">
							<div class="summary">
								<div class="summary-item">
									<div id="addressList">
										<?php
										if (($data['addresses']) != 'No Adress') {
											echo "<select>";
											echo "<option value=''>Select a shipping address</option>";
											foreach ($data['addresses'] as $address) {
												echo '<option value="' . $address->address_id . '">' . $address->country . ',' . $address->city . '</option>';
											}
											echo "</select>";
										} else {
											echo 'Enter new Adress';
										}
										?>
									</div>
									<!-- Button to show the form -->
									<br>
									<button id="add-address" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#form-container">Add Address</button>

									<!-- Form container with Bootstrap collapse class -->
									<div id="form-container" class="collapse">

										<div id="addressForm">
											<form id="addformaddress" action="<?= ROOT, 'CartController/Address' ?>" method="post">
												<!-- Recipient Name -->
												<div class="mb-3">
													<label for="recipientName" class="form-label">Recipient Name:</label>
													<input type="text" class="form-control" id="recipientName" name="recipient_name" required>
												</div>
												<!-- Country (Select List) -->
												<div class="mb-3">
													<label for="country" class="form-label">Country:</label>
													<select class="form-select" id="country" name="country" required></select>
												</div>
												<div class="mb-3">
													<label for="city" class="form-label">City:</label>
													<select class="form-select" id="city" name="city" required></select>
												</div>
												<!-- State -->
												<div class="mb-3">
													<label for="state" class="form-label">State:</label>
													<input type="text" class="form-control" id="state" name="state" required>
												</div>
												<!-- Postal Code -->
												<div class="mb-3">
													<label for="postalCode" class="form-label">Postal Code:</label>
													<input type="text" class="form-control" id="postalCode" name="postal_code" required>
												</div>
												<!-- Address Line 1 -->
												<div class="mb-3">
													<label for="addressLine1" class="form-label">Address Line 1:</label>
													<input type="text" class="form-control" id="addressLine1" name="address_line1" required>
												</div>

												<!-- Address Line 2 -->
												<div class="mb-3">
													<label for="addressLine2" class="form-label">Address Line 2:</label>
													<input type="text" class="form-control" id="addressLine2" name="address_line2">
												</div>
												<button type="submit" class="btn btn-primary">Add New Address</button>
											</form>
										</div>
									</div>
									<h3>Summary</h3>
									<div class="summary-item"><span class="text">Subtotal</span><span id="subtotal" class="price">$<?= $data['subtotal'] ?></span></div>
									<div class="summary-item"><span class="text">Discount</span><span id="discount" class="price">$<?= $data['discount'] ?></span></div>
									<div class="summary-item"><span class="text">Shipping</span><span id="shipping" class="price">$<?= $data['shipping'] ?></span></div>
									<div class="summary-item"><span class="text">Total</span><span id="total" class="price">$<?= $data['total'] ?></span>
									</div>
									<input type="hidden" id="paymentIntentId" value="<?= $paymentIntentId ?>">
									<!-- <button id="checkout-button" class="btn btn-primary btn-lg btn-block"> -->
									<script src="https://checkout.stripe.com/checkout.js" id="stripe-button" class="stripe-button btn-primary " data-key="<?= STRIPE_PUBLISHABLE_KEY ?>" data-amount=<?= $data['pay'] * 100 ?> data-currency="usd" data-locale="auto" data-payment-intent-id="<?= $data['paymentIntentId'] ?>">
									</script>
									<!-- </button> -->
									<!-- <a type="button" class="btn btn-primary btn-lg btn-block" href="payment">Checkout</a> -->
									<script>
										let stripe = Stripe('<?= STRIPE_PUBLISHABLE_KEY ?>');
										let paymentIntentId = document.getElementById('paymentIntentId').value;

										let checkoutButton = document.getElementById('checkout-button');
										checkoutButton.addEventListener('click', function() {
											stripe.confirmCardPayment(paymentIntentId, {
												success: function(result) {
													// Handle successful payment
													console.log(result);
												},
												error: function(error) {
													// Handle payment error
												}
											});
										});
									</script>
									</script>
								</div>
							</div>

						</div>
					</div>

				</div>
		</section>
	</main>
</body>
<?= $this->view("zay_shop/footer", $data); ?>
<script src="<?= ASSETS ?>zay_shop/js/cart.js"></script>