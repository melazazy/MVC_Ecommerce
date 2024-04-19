# Zay Shop: MVC E-commerce Project

## Introduction

Zay Shop is a full-fledged MVC (Model-View-Controller) e-commerce application built with PHP and MySQL. It offers a user-friendly shopping experience with functionalities for browsing products, managing accounts, and processing orders.

## Core Functions

- **User Management:** Secure registration, login, and personalized dashboards.
- **Product Management:** Extensive product listings with search, filtering, and category/brand organization.
- **Shopping Cart:** Add, remove, and manage products before checkout.
- **Wishlist:** Save favorite items for future purchase.
- **Order Processing:** Secure checkout with discounts, coupons, and (optional) order history tracking.

## Security

Zay Shop prioritizes security with features like:

- SQL Injection Prevention
- Password Hashing
- User Input Validation

## Getting Started

### Prerequisites

- A web server with PHP support (e.g., Apache, Nginx)
- MySQL database server

### Clone the Repository

```bash
git clone https://github.com/melazazy/MVC_Ecommerce.git
```

### Configure Database

- Create a MySQL database.
- Edit the application configuration (config.php) to specify database connection details (host, username, password, database name).

### Upload to Server

- Upload the project directory to your web server document root.

### Set Permissions

- Ensure appropriate file permissions for application files and directories, especially for writable directories like uploads (if applicable).

### Usage

- Access your application in your web browser using the URL for your website or web server.
- Create an account or log in if you have an existing one.
- Explore products, add them to your cart and wishlist, and proceed to checkout securely.

### Folder Structure

- **models:** Contains PHP classes representing data entities (products, categories, users, etc.).
- **views:** Holds HTML template files for the user interface.
- **controllers:** Includes PHP classes that handle user requests and interact with the model and view.
- **public:** Includes assets folder which include template layoutand uploads folder.

### Customization

- Design and style your application using CSS and JavaScript.
- Populate your database with product data and categories.
- Implement additional functionalities based on your project requirements.

### Deployment Considerations

- Choose a suitable web hosting provider that supports PHP and MySQL.
- Configure your application for the chosen hosting environment (e.g., database connection details, file paths).
- Implement security measures for user data and transactions.

### License

This project is licensed under the MIT License. [View License](https://opensource.org/licenses/MIT)

### Contact

Mustafa Elazazy - <mustafaelazazy52@gmail.com>

### Project Link

<https://github.com/melazazy/MVC_Ecommerce>
