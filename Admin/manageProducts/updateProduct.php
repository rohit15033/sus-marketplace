<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="updateProduct.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        input[type="text"], select, input[type="file"], button {
            margin-bottom: 10px;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('down-arrow.png') no-repeat right #fff;
            background-size: 20px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="POST" action="updateProductlogic.php" enctype="multipart/form-data">

        <input type="hidden" name="product_id" value="<?php echo $_POST['product_id']; ?>">
        <input type="hidden" name="seller_id" value="<?php echo $_POST['seller_id']; ?>">
        <label for="product_name">Product name:</label><br>
        <input type="text" id="product_name" name="product_name"><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>
        <label for="category">Category:</label><br>
        <select id="category" name="category">
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
        </select><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description"><br>
        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity"><br>
        <label for="product_image">Image:</label><br>
        <input type="file" id="product_image" name="product_image"><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
