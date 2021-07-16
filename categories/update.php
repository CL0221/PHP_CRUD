<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Edit Category</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <?php 
        include '../db/db.php';

        if(isset($_GET['edit'])){
            $categories_id = $_GET['edit'];
            $sql = "SELECT * FROM categories WHERE categories_id=$categories_id";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)){
                $row = $result->fetch_array();
                $categories_name = $row['categories_name'];
            }
        }

        if (isset($_POST['update'])) {
            $categories_id = $_POST['categories_id'];
            $categories_name = $_POST['categories_name'];
        
            mysqli_query($conn, "UPDATE categories SET categories_name='$categories_name' WHERE categories_id=$categories_id");
            $_SESSION['message'] = "Category updated!"; 
            header('location: index.php');
        }
    ?>

    <body>
        <div class="container">
            <h3>Edit</h3>
            
            <form action="update.php" method="post" class="form-control">
                <div class="mb-3">
                    <label for="">ID</label>
                    <input type="text" name="categories_id" value="<?php echo $categories_id; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="">Category: </label>
                    <input type="text" name="categories_name" id="categories_name" value="<?php echo $categories_name;?>">
                </div>
                <input type="submit" value="Update" name="update" class="btn btn-primary">
            </form>
        </div>
    </body>
</html>