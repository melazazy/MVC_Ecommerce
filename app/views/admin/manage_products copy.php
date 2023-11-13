<!-- app/views/admin/manage_products.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>
    <!-- Product management content -->
    <form action="add_product.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url" required>
        
        <label for="stock">Stock Quantity:</label>
        <input type="number" id="stock" name="stock" required>
        
        <button type="submit">Add Product</button>
    </form>

</body>
</html>
