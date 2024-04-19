-- Create Users table
CREATE TABLE Users (
    user_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Products table
CREATE TABLE Products (
    product_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    stock INT NOT NULL
);

-- Create Orders table
CREATE TABLE Orders (
    order_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Order_Items table
CREATE TABLE Order_Items (
    order_item_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT,
    product_id BIGINT,
    quantity INT,
    subtotal DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
-- Create Categories table
CREATE TABLE Categories (
    category_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Create Reviews table
CREATE TABLE Reviews (
    review_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    product_id BIGINT,
    user_id BIGINT,
    rating INT,
    comment TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create Cart table
CREATE TABLE Cart (
    cart_id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT,
    product_id BIGINT,
    quantity INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
-- Products
INSERT INTO products (product_id, category_id, name, description, price, featured, image_url, stock)
VALUES 
(101, 1, 'Silk Blend Designer Dress', 'Experience pure elegance in this flowing silk blend dress. Perfect for special occasions or a statement look.', 249.99, 1, 'uploads/products/luxury_dress.jpg', 50),
(102, 1, 'Performance Running T-Shirt', 'Stay cool and comfortable during your workouts with this moisture-wicking, breathable t-shirt.', 39.99, 0, 'uploads/products/sport_wear_tshirt.jpg', 120),
(103, 1, 'Floral Maxi Dress', 'A versatile and trendy maxi dress perfect for spring and summer. Features a flattering silhouette and vibrant floral print.', 59.99, 1, 'uploads/products/popular_dress.jpg', 80),
(104, 2, 'Water Bottle with Built-in Shaker', 'Stay hydrated during your workouts with this convenient water bottle that has a built-in shaker for protein mixes.', 19.99, 0, 'uploads/products/gym_accessories_water_bottle.jpg', 75);
;


INSERT INTO ProductTags (product_id, tag_name) VALUES
(101, 'Luxury'),
(101, 'Clothing'),
(102, 'Sport Wear'),
(102, 'Clothing'),
(103, 'Popular Dress'),
(103, 'Clothing'),
(104, 'Gym Accessories'),
(104, 'Accessories');

this is my products table COLUMNs : product_id	category_id	name	description	price	featured	image_url	stock . give products sample for all this tags i provide and my category table is : 
1
Clothing
A wide range of stylish clothing options for all s...
uploads/categories/category_img_01.jpeg
 
2
Accessories
Fashionable accessories that complement your outfi...
uploads/categories/category_img_02.jpeg
 
3
Shoes
Versatile and durable footwear for various activit...
uploads/categories/category_img_03.jpeg
 
4
Footwear
Comfortable and trendy footwear for men, women, an...
 
5
Jewelry
Elegant and exquisite jewelry pieces to enhance yo...
 
6
Fashion Accessories
Trendy add-ons like scarves, belts, and hats to co...
 
7
Watches
Precision timepieces that combine style and functi...
 
8
Electronics
Cutting-edge electronic gadgets and devices for te...
 
9
General 
For General Products