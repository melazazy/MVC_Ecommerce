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
