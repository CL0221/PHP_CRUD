<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Add Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <?php 
        include '../db/db.php';
        
        session_start();

        if(isset($_POST['save']) && isset($_FILES['product_img'])){
            echo "<pre>";
            print_r($_FILES['product_img']);
            echo "</pre>";
            
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_description = $_POST['product_description'];
            $brand = $_POST['brand'];
            $categories_id = $_POST['categories_id'];

            $img_name = $_FILES['product_img']['name'];
            $img_size = $_FILES['product_img']['size'];
            $tmp_name = $_FILES['product_img']['tmp_name'];
            $error = $_FILES['product_img']['error'];
            if($error === 0){
                if($img_size > 125000){
                    $em = "Too large.";
                }else{
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if(in_array($img_ex_lc, $allowed_exs)){
                        $product_img = uniqid("IMG-", true). '.' .$img_ex_lc;
                        $img_upload_path = '../img/' . $product_img;
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }else{
                        $em = "can't upload";
                    }
                }
            }else{
                $em = "Unknown";
            }

            $sql = "INSERT INTO products (product_name, product_img, product_price, product_description, brand, categories_id) VALUES ('$product_name', '$product_img', '$product_price', '$product_description', '$brand', '$categories_id')";
            $result = $conn->query($sql);

            $_SESSION['message'] = "Product saved!!!";
            header('location: index.php');
        }
    ?>
    <body>
        <div class="container">
            <h3>Add Products</h3>
            <form action="insert.php" method="post" class="form-control" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="">Product Name: </label>
                    <input type="text" name="product_name" id="product_name">
                </div>
                <div class="mb-3">
                    <label for="">Product IMG: </label>
                    <input type="file" name="product_img" id="product_img">
                </div>
                <div class="mb-3">
                    <label for="">Product Price: </label>
                    <input type="text" name="product_price" id="product_price">
                </div>
                <div class="mb-3">
                    <label for="">Product Description: </label>
                    <input type="text" name="product_description" id="product_description">
                </div>
                <div class="mb-3">
                    <label for="">Brand: </label>
                    <input type="text" name="brand" id="brand">
                </div>
                <div class="mb-3">
                    <label for="">Categories ID: </label>
                    <?php 
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);
                    ?>
                    <select name="categories_id" id="categories_id">
                        <option value="">Select a category</option>
                        <?php while($row = $result->fetch_assoc()){?>
                        <option value="<?php echo $row['categories_id'];?>"><?php echo $row['categories_name'];?></option>
                        <?php }?>
                    </select>
                </div>
                <input type="submit" value="Save" name="save" class="btn btn-info">
            </form>
        </div>
    </body>
</html>