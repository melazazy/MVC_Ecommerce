<?= $this->view("zay_shop/header", $data); ?>
<script src="https://js.stripe.com/v3/"></script>
<script src="<?= ASSETS ?>zay_shop/js/payment.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= ASSETS ?>zay_shop/css/payment.css">

<main class="page payment-page">
  <section class="payment-form dark">
    <div class="container">
      <div class="block-heading">
        <h2>Payment</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
      </div>
      <form action="stripe/charge.php" method="post">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?= STRIPE_PUBLISHABLE_KEY ?>" data-amount=<?php echo str_replace(",", "", $_GET["price"]) * 100 ?> data-name="<?php echo $_GET["item_name"] ?>" data-description="<?php echo $_GET["item_name"] ?>" data-image="<?php echo $_GET["image"] ?>" data-currency="inr" data-locale="auto">
        </script>
      </form>
    </div>
  </section>
</main>
<?= $this->view("zay_shop/footer", $data); ?>