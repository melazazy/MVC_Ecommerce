// JavaScript for shopping cart functionality
document.addEventListener('DOMContentLoaded', function () {
    const cartIcon = document.getElementById('cart-icon');
    const cartModal = document.getElementById('cart-modal');
    const closeBtn = document.querySelector('.close');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    // Initialize cart
    let cart = [];
    $('[data-toggle="tooltip"]').tooltip();
    // Add an event listener for changes in quantity
    $('.quantity-input').on('change', function () {
        // Call an AJAX function to update the cart on the server
        quantityChange($(this));
    });

    // Add an event listener for removing items
    $('.remove-item').on('click', function () {
        // Call an AJAX function to update the cart on the server
        productRemove($(this));

    });
    $('#add-address').on('click', function () {
        getcountry();

    });
    $('#country').on('change', function () {
        getCity();
    });
    $('#addressForm').on('submit', function (e) {
        e.preventDefault();  // Prevent the default form submission
        // let formData = $('#addformaddress').serialize();
        let recipientName = $('#recipientName').val();
        // let country = $('#country').val();
        // let city = $('#city').val();
        let country = $('#country option:selected').val();
        let city = $('#city option:selected').val();
        let state = $('#state').val();
        let postalCode = $('#postalCode').val();
        let addressLine1 = $('#addressLine1').val();
        let addressLine2 = $('#addressLine2').val();
        // Implement AJAX logic to submit the form data
        $.ajax({
            url: 'http://localhost/MVC_Ecommerce/public/CartController/address',
            method: 'POST',
            data: {
                recipientName: recipientName,
                country: country,
                city: city,
                state: state,
                postalCode: postalCode,
                addressLine1: addressLine1,
                addressLine2: addressLine2
            },
            success: function (response) {
                console.log('Add Address Success:', response);

                // Check the response for success
                var responseData = JSON.parse(response);
                if (responseData.success) {
                    console.log('Address added successfully');
                    // Hide the form div after successful submission
                    $('#form-container').collapse('hide');
                    getAddresses();
                    // Scroll up to the addresses list div
                    $('html, body').animate({
                        scrollTop: $('#addressList').offset().top
                    }, 200);
                } else {
                    console.error('Failed to add address:', responseData.message);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                // Log details of the AJAX error
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    });

    // Function to update the cart on the server and refresh the UI
    function quantityChange (input) {
        const user_id = input.data('user-id');
        const product_id = input.data('product-id');
        const newQuantity = input.val();
        // console.log(input + '//', user_id, product_id, newQuantity);

        $.ajax({
            type: 'GET',
            url: 'http://localhost/MVC_Ecommerce/public/CartController/updateCartOnchange',
            data: { user_id: user_id, product_id: product_id, newQuantity: newQuantity },
            success: function (response) {
                console.log(response);
                console.log($('#stripe-button').data('amount'));
                // Update UI elements with the new values
                $('#subtotal').text(response.subtotal);
                $('#discount').text(response.discount);
                $('#shipping').text(response.shipping);
                $('#total').text(response.total);
                // $('#stripe-button').data('amount') = (response.pay);
                let stripeButton = $('#stripe-button');
                stripeButton.attr('data-amount', response.pay * 100);
                // console.log('count changed.');
                // Destroy the existing Stripe button
                StripeCheckout.configure().close();

                // Recreate the Stripe button
                var stripeKey = stripeButton.attr('data-key');
                var stripeAmount = stripeButton.attr('data-amount');
                var stripeCurrency = parseInt(stripeButton.attr('data-currency'));
                var stripeLocale = stripeButton.attr('data-locale');

                var handler = StripeCheckout.configure({
                    key: stripeKey,
                    amount: stripeAmount,
                    currency: stripeCurrency,
                    locale: stripeLocale,
                    token: function (token) {
                        // Handle the token (e.g., send it to your server)
                    }
                });

                // Bind the new click event to the recreated Stripe button
                stripeButton.off('click').on('click', function () {
                    handler.open();
                });
            },
            error: function (error) {
                console.error('Error updating cart:', error);
            }
        });
    }
    function productRemove (input) {
        const user_id = input.data('user-id');
        const product_id = input.data('product-id');
        $.ajax({
            type: 'GET',
            url: 'http://localhost/MVC_Ecommerce/public/CartController/updateCartOnremove',
            data: { user_id: user_id, product_id: product_id },
            success: function (response) {
                // console.log(response);
                // Update UI elements with the new values
                $('#subtotal').text(response.subtotal);
                $('#discount').text(response.discount);
                $('#shipping').text(response.shipping);
                $('#total').text(response.total);
                $(input).closest('.product').remove();
                $('#cartcount').text(response.CartQuantity);
                $('.stripe-button').data('amount') = (response.pay);

                // console.log('item Removed.');
            },
            error: function (error) {
                console.error('Error updating cart:', error);
            }
        });
    }
    function getcountry () {
        $.ajax({
            url: 'https://restcountries.com/v2/all',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                // Populate the select list with countries
                var select = $('#country');
                response.forEach(function (country) {
                    select.append('<option value="' + country.name + '">' + country.name + '</option>');
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching countries:', textStatus, errorThrown);
            }
        });
    }
    function getCity () {
        const selectedCountry = $('#country').val();
        const citySelect = $('#city');
        console.log(selectedCountry);
        console.log(citySelect);
        // Fetch cities for the selected country
        $.ajax({
            url: 'https://countriesnow.space/api/v0.1/countries/cities',
            method: 'POST',
            dataType: 'json',
            data: {
                country: selectedCountry
            },
            success: function (response) {
                // Clear the existing options
                citySelect.empty();

                // Populate the select list with cities
                response.data.forEach(function (city) {
                    citySelect.append('<option value="' + city + '">' + city + '</option>');
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching cities:', textStatus, errorThrown);
            }
        });
    }
    function getAddresses () {
        $.ajax({
            type: 'GET',
            url: 'http://localhost/MVC_Ecommerce/public/CartController/getAddresses',
            data: { user_id: user_id },
            success: function (response) {
                // Clear the existing options
                console.log('Moved to Get address');
                $('#addressList').empty();
                $('#addressList').html(response);
                console.log('End Moved to End Get address');

            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching cities:', textStatus, errorThrown);
            }
        });
    }

});
