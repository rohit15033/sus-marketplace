<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update Page</title>
    <link rel="stylesheet" href="updateProduct.css">
</head>
<body>
    
    <div class="product-update-container">
    <h2>Product Info Update Form</h2>
    <form method="POST" action="updateProductlogic.php" enctype="multipart/form-data">

        <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
        <div class="form-element-container">
        Product name: <input type="text" name="product_name">
        </div>
        <div class="form-element-container">
        Price: <input type="text" name="price">
        </div>
        <div class="form-element-container">
        Category: 
        <select name="category">
            <option value="electronics">Electronics</option>
            <option value="clothing">Clothing</option>
            <option value="books">Books</option>
            <option value="home_appliances">Home Appliances</option>
            <option value="sports">Sports</option>
            <option value="toys">Toys</option>
            <option value="beauty">Beauty</option>
            <option value="health">Health</option>
            <option value="food">Food</option>
            <option value="furniture">Furniture</option>
            <option value="jewelry">Jewelry</option>
            <option value="tools">Tools</option>
            <option value="pet_supplies">Pet Supplies</option>
            <option value="office_supplies">Office Supplies</option>
            <option value="automotive">Automotive</option>
            <option value="baby">Baby</option>
            <option value="music">Music</option>
            <option value="movies">Movies</option>
            <option value="games">Games</option>
        </select>
        </div>
        <div class="form-element-container">
        Description: <input type="text" name="description">
        </div>
        <div class="form-element-container">
        Quantity: <input type="text" name="quantity">
        </div>
        <div class="form-element-container">
        Image: <input type="file" name="product_image">
        </div>

        <button type="submit">Submit</button>
    </form>
    </div>
</body>
</html>
