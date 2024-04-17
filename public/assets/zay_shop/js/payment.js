document.addEventListener('DOMContentLoaded', function () {

    const stripe = Stripe('pk_test_51OG8HtF26LVJlyTRyc7RB4e4kOCeRW6qge37xNurpJ79lIn6ByEaf4StkcShEDmm0NWXnm73CqcVznRJC4bweh6r00fu2B3oF3');
    const elements = stripe.elements();
    let card = elements.create('card');
    card.mount('#card-element');
    let form = document.getElementById('payment-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Handle errors (e.g., show an error message)
                console.error(result.error.message);
            } else {
                // Send the token to your server for further processing
                let token = result.token;
                $.ajax({
                    url: 'http://localhost/MVC_Ecommerce/public/payment/setbay',
                    method: 'POST',
                    data: { stripeToken: token.id },
                    dataType: 'json',
                    success: function (response) {
                        // Handle the server response
                        console.log(response);
                        if (response.success) {
                            // Payment successful, redirect or show a success message
                            alert('Payment successful! Order ID: ' + response.order_id);
                        } else {
                            // Payment failed, show an error message
                            alert('Payment failed: ' + response.message);
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                    }
                });
                // Call your server-side endpoint to handle the payment
                // e.g., send the token to your PHP server
                // handlePayment(token);
            }
        });
    });
});