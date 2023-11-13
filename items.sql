-- INSERT INTO users (username, email, password) VALUES
--     ('john_doe', 'john@example.com', 'hashed_password'),
--     ('jane_smith', 'jane@example.com', 'hashed_password');
-- INSERT INTO users (username, email, password) VALUES
--     ('alice_smith', 'alice@example.com', 'hashed_password'),
--     ('bob_jones', 'bob@example.com', 'hashed_password'),
--     ('carol_davis', 'carol@example.com', 'hashed_password');

INSERT INTO categories (name, description) VALUES
    ('Clothing', 'A wide range of stylish clothing options for all seasons and occasions.'),
    ('Accessories', 'Fashionable accessories that complement your outfit and style.'),
    ('Electronics', 'Cutting-edge electronic gadgets and devices for tech enthusiasts.'),
    ('Footwear', 'Comfortable and trendy footwear for men, women, and children.'),
    ('Jewelry', 'Elegant and exquisite jewelry pieces to enhance your beauty.'),
    ('Fashion Accessories', 'Trendy add-ons like scarves, belts, and hats to complete your look.'),
    ('Watches', 'Precision timepieces that combine style and functionality.'),
    ('Shoes', 'Versatile and durable footwear for various activities and lifestyles.');

INSERT INTO products (name, description, price, category_id) VALUES
    ('Cotton T-shirt', 'Comfortable cotton t-shirt', 19.99, 1),
    ('Leather Wallet', 'Genuine leather wallet', 39.99, 2),
    ('Wireless Headphones', 'High-quality wireless headphones', 79.99, 3);
INSERT INTO products (name, description, price, category_id) VALUES
    ('Sneakers', 'Sporty and stylish sneakers', 49.99, 8),
    ('Smartphone', 'High-end smartphone with advanced features', 599.99, 3),
    ('Necklace', 'Elegant silver necklace with pendant', 79.99, 2),
    ('Laptop', 'Powerful laptop for work and gaming', 999.99, 3);
INSERT INTO products (name, description, price, category_id) VALUES
    ('Running Shoes', 'Lightweight running shoes for athletes', 79.99, 8),
    ('Gold Bracelet', 'Elegant gold bracelet with intricate design', 129.99, 2),
    ('Smartwatch', 'Feature-rich smartwatch with health tracking', 149.99, 7),
    ('Sunglasses', 'Polarized sunglasses for UV protection', 29.99, 6);





INSERT INTO reviews (product_id, user_id, rating, comment) VALUES
    (1, 1, 4, 'Great product! Fits perfectly.'),
    (1, 2, 5, 'Excellent quality and comfort.'),
    (2, 1, 4, 'Nice wallet, good value for money.');

INSERT INTO reviews (product_id, user_id, rating, comment) VALUES
    (1, 1, 4, 'Love these sneakers, very comfortable.'),
    (1, 2, 5, 'Great value for the price.'),
    (3, 3, 4, 'Beautiful necklace, exactly as described.'),
    (4, 1, 5, 'The laptop exceeded my expectations.');
INSERT INTO reviews (product_id, user_id, rating, comment) VALUES
    (5, 2, 5, 'Best running shoes I ever owned.'),
    (6, 3, 4, 'Beautiful and unique bracelet design.'),
    (7, 1, 5, 'Smartwatch has a great battery life.'),
    (8, 2, 4, 'Good value for stylish sunglasses.');



INSERT INTO cart (user_id, product_id, quantity) VALUES
    (14, 1, 2),
    (14, 2, 1),
    (14, 1, 1),
    (14, 3, 2),
    (14, 5, 1),
    (2, 1, 1,
    (2, 4, 1),
    (3, 2, 1),
    (2, 6, 1),
    (2, 7, 1),
    (3, 8, 2);