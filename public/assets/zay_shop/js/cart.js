// JavaScript for shopping cart functionality
document.addEventListener('DOMContentLoaded', function () {
    const cartIcon = document.getElementById('cart-icon');
    const cartModal = document.getElementById('cart-modal');
    const closeBtn = document.querySelector('.close');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    // Sample product data (to be fetched from a backend)
    const products = [
        { id: 1, name: 'Product 1', price: 19.99 },
        { id: 2, name: 'Product 2', price: 24.99 },
        // Add more products here
    ];

    // Initialize cart
    let cart = [];

    // Function to update the cart modal
    function updateCart () {
        cartItems.innerHTML = '';
        let total = 0;

        for (const item of cart) {
            const product = products.find(p => p.id === item.id);
            const cartItem = document.createElement('li');
            cartItem.innerHTML = `${product.name} - $${product.price}`;
            cartItems.appendChild(cartItem);
            total += product.price;
        }

        cartTotal.textContent = total.toFixed(2);
    }

    // Add product to cart
    function addToCart (productId) {
        const product = products.find(p => p.id === productId);
        cart.push({ id: product.id });
        updateCart();
    }

    // Show cart modal
    cartIcon.addEventListener('click', () => {
        cartModal.style.display = 'block';
        updateCart();
    });

    // Handle adding products to cart (you can add event listeners to product buttons)
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = parseInt(button.getAttribute('data-product-id'));
            addToCart(productId);
        });
    });

    // Handle checkout (link to a checkout page or implement payment)
    // const checkoutBtn = document.querySelector('.checkout-btn');
    // checkoutBtn.addEventListener('click', () => {
    //     alert('Redirecting to checkout page...'); // Replace with actual checkout logic
    // });
    
});
