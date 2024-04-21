<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method="POST" action="updateProductlogic.php" enctype="multipart/form-data">

        <input type="hidden" name="product_id" value="<?php echo $_POST['product_id']; ?>">
        Product name: <input type="text" name="product_name"><br>
        Price: <input type="text" name="price"><br>
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
        </select><br>
        Description: <input type="text" name="description"><br>
        Quantity: <input type="text" name="quantity"><br>
        Image: <input type="file" name="product_image"><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
