<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Update Page</title>
    <link rel="stylesheet" href="updateProduct.css">
    <style>
        /* CSS for uniform input */
        input[type="text"],
        select,
        textarea {
            width: calc(100% - 30px); /* Adjust for padding */
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        .form-element-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
            padding: 8px 0;
        }
        .form-element-container label {
            width: 150px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    
    <div class="product-update-container">
        <h2>Product Info Update Form</h2>
        <form method="POST" action="updateProductlogic.php" enctype="multipart/form-data">

            <input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">
            <div class="form-element-container">
                <label for="product_name">Product:</label>
                <input type="text" name="product_name" id="product_name">
            </div>
            <div class="form-element-container">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price">
            </div>
            <div class="form-element-container">
                <label for="category">Category:</label>
                <select name="category" id="category">
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
                <label for="description">Description:</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="form-element-container">
                <label for="quantity">Quantity:</label>
                <input type="text" name="quantity" id="quantity">
            </div>
            <div class="form-element-container">
                <label for="product_image">Image:</label>
                <input type="file" name="product_image" id="product_image">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
