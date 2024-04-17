<?php

/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 5.2.0
 */

/**
 * Database `INFORMATION_SCHEMA`
 */

/* `INFORMATION_SCHEMA`.`COLUMNS` */
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 5.2.0
 */

/**
 * Database `INFORMATION_SCHEMA`
 */

/* `INFORMATION_SCHEMA`.`COLUMNS` */
$data = array(
    array('TABLE_NAME' => 'banner_products', 'COLUMN_NAME' => 'banner_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'banner_products', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'banner_products', 'COLUMN_NAME' => 'header', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'banner_products', 'COLUMN_NAME' => 'title', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'brands', 'COLUMN_NAME' => 'brand_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'brands', 'COLUMN_NAME' => 'name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'brands', 'COLUMN_NAME' => 'logo', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'brands', 'COLUMN_NAME' => 'image', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'brands', 'COLUMN_NAME' => 'description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Cart', 'COLUMN_NAME' => 'cart_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Cart', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Cart', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Cart', 'COLUMN_NAME' => 'quantity', 'DATA_TYPE' => 'int'),
    array('TABLE_NAME' => 'Categories', 'COLUMN_NAME' => 'category_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Categories', 'COLUMN_NAME' => 'name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Categories', 'COLUMN_NAME' => 'description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Categories', 'COLUMN_NAME' => 'image', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'colors', 'COLUMN_NAME' => 'color_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'colors', 'COLUMN_NAME' => 'color_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'discounted_products', 'COLUMN_NAME' => 'discounted_product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'discounted_products', 'COLUMN_NAME' => 'discount_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'discounted_products', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'discount_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'code', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'discount_type', 'DATA_TYPE' => 'enum'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'discount_value', 'DATA_TYPE' => 'decimal'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'start_date', 'DATA_TYPE' => 'date'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'end_date', 'DATA_TYPE' => 'date'),
    array('TABLE_NAME' => 'discounts', 'COLUMN_NAME' => 'description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Logs', 'COLUMN_NAME' => 'log_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Logs', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Logs', 'COLUMN_NAME' => 'activity_type', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Logs', 'COLUMN_NAME' => 'activity_details', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Logs', 'COLUMN_NAME' => 'created_at', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'Orders', 'COLUMN_NAME' => 'order_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Orders', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Orders', 'COLUMN_NAME' => 'order_date', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'Orders', 'COLUMN_NAME' => 'status', 'DATA_TYPE' => 'enum'),
    array('TABLE_NAME' => 'Order_Items', 'COLUMN_NAME' => 'order_item_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Order_Items', 'COLUMN_NAME' => 'order_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Order_Items', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Order_Items', 'COLUMN_NAME' => 'quantity', 'DATA_TYPE' => 'int'),
    array('TABLE_NAME' => 'Order_Items', 'COLUMN_NAME' => 'price', 'DATA_TYPE' => 'decimal'),
    array('TABLE_NAME' => 'PaymentMethods', 'COLUMN_NAME' => 'method_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'PaymentMethods', 'COLUMN_NAME' => 'name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'PaymentMethods', 'COLUMN_NAME' => 'description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'PaymentMethods', 'COLUMN_NAME' => 'created_at', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'payment_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'order_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'method_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'transaction_id', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'amount', 'DATA_TYPE' => 'decimal'),
    array('TABLE_NAME' => 'Payments', 'COLUMN_NAME' => 'payment_date', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'ProductImages', 'COLUMN_NAME' => 'image_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductImages', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductImages', 'COLUMN_NAME' => 'image_url', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'ProductImages', 'COLUMN_NAME' => 'is_primary', 'DATA_TYPE' => 'tinyint'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'rating_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'rating', 'DATA_TYPE' => 'float'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'review', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'ProductRatings', 'COLUMN_NAME' => 'created_at', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'category_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'price', 'DATA_TYPE' => 'decimal'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'image_url', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'stock', 'DATA_TYPE' => 'int'),
    array('TABLE_NAME' => 'Products', 'COLUMN_NAME' => 'featured', 'DATA_TYPE' => 'tinyint'),
    array('TABLE_NAME' => 'ProductTags', 'COLUMN_NAME' => 'tag_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductTags', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'ProductTags', 'COLUMN_NAME' => 'tag_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'product_detail_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'size_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'color_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'brand_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'product_details', 'COLUMN_NAME' => 'gender', 'DATA_TYPE' => 'enum'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'review_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'rating', 'DATA_TYPE' => 'int'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'comment', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Reviews', 'COLUMN_NAME' => 'review_date', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'address_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'recipient_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'address_line1', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'address_line2', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'city', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'state', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'postal_code', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_addresses', 'COLUMN_NAME' => 'country', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_options', 'COLUMN_NAME' => 'shipping_option_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'shipping_options', 'COLUMN_NAME' => 'option_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'shipping_options', 'COLUMN_NAME' => 'option_description', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'shipping_options', 'COLUMN_NAME' => 'shipping_cost', 'DATA_TYPE' => 'decimal'),
    array('TABLE_NAME' => 'sizes', 'COLUMN_NAME' => 'size_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'sizes', 'COLUMN_NAME' => 'size_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'sizes', 'COLUMN_NAME' => 'size_char', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'username', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'email', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'password', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'url_address', 'DATA_TYPE' => 'text'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'first_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'last_name', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'created_at', 'DATA_TYPE' => 'timestamp'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'role', 'DATA_TYPE' => 'enum'),
    array('TABLE_NAME' => 'Users', 'COLUMN_NAME' => 'image_url', 'DATA_TYPE' => 'varchar'),
    array('TABLE_NAME' => 'wishlist', 'COLUMN_NAME' => 'id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'wishlist', 'COLUMN_NAME' => 'user_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'wishlist', 'COLUMN_NAME' => 'product_id', 'DATA_TYPE' => 'bigint'),
    array('TABLE_NAME' => 'wishlist', 'COLUMN_NAME' => 'created_at', 'DATA_TYPE' => 'timestamp')
);

$tables = [];

foreach ($data as $row) {
    $tableName = $row['TABLE_NAME'];
    $columnName = $row['COLUMN_NAME'];
    $type = $row['DATA_TYPE'];

    if (!isset($tables[$tableName])) {
        $tables[$tableName] = [];
    }

    $tables[$tableName][] = "$columnName => $type";
}

foreach ($tables as $tableName => $columns) {
    echo "$tableName table (" . implode(', ', $columns) . ")\n";
}
