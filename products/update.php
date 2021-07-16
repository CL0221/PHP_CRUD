<!DOCTYPE html>
<html>
    <head>
        <meta class="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Edit</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <?php 
        include '../db/db.php';

        if(isset($_GET['edit'])){
            $product_id = $_GET['edit'];
            $sql = "SELECT * FROM products WHERE product_id=$product_id";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)){
                $row = $result->fetch_array();
                $product_name = $row['product_name'];
                $product_img = $row['product_img'];
                $product_price = $row['product_price'];
                $product_description = $row['product_description'];
                $brand = $row['brand'];
                $categories_id = $row['categories_id'];
            }
        }

        if(isset($_POST['update'])){
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_description = $_POST['product_description'];
            $brand = $_POST['brand'];

            $sql = "UPDATE products SET product_name='$product_name', product_price='$product_price', product_description='$product_description', brand='$brand' WHERE 'product_id'=$product_id";
            $query = $conn->query($sql);
            $_SESSION['message'] = "Product updated!";
            //header('location: index.php');
        }
    ?>

    <body>
    <div class="container">
            <h3>Add Products</h3>
            <form action="update.php" method="post" class="form-control" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="">Product ID: </label>
                    <input type="text" name="product_id" id="product_id" value="<?php echo $product_id;?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="">Product Name: </label>
                    <input type="text" name="product_name" id="product_name" value="<?php echo $product_name;?>">
                </div>
                <div class="mb-3">
                    <label for="">Product IMG: </label>
                    <input type="text" name="product_img" id="product_img" value="<?php echo $product_img;?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="">Product Price: </label>
                    <input type="text" name="product_price" id="product_price" value="<?php echo $product_price;?>">
                </div>
                <div class="mb-3">
                    <label for="">Product Description: </label>
                    <input type="text" name="product_description" id="product_description" value="<?php echo $product_description;?>">
                </div>
                <div class="mb-3">
                    <label for="">Brand: </label>
                    <input type="text" name="brand" id="brand" value="<?php echo $brand;?>">
                </div>
                <div class="mb-3">
                    <label for="">Categories ID: </label>
                    <input type="text" name="categories_id" id="categories_id" value="<?php echo $row['categories_id'];?>" disabled>
                </div>
                <input type="submit" value="Update" name="update" class="btn btn-info">
            </form>
        </div>
    </body>
</html>