<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Category</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
    <?php 
        include('../db/db.php');

        //read
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        
    ?>
    
    <body>
        <div class="container">
            <h3>All Category</h3>
            
            <?php if(isset($_SESSION['message'])){?>
                <div class="msg mb-3">
                    <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php }?>
            
            <div class="mb-3">
                <a href="insert.php" class="btn btn-info">Add Category</a>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()){?>
                    <tr>
                        <td><?php echo $row['categories_id'];?></td>
                        <td><?php echo $row['categories_name'];?></td>
                        <td>
                            <a href="update.php?edit=<?php echo $row['categories_id'];?>" class="btn btn-info">Edit</a>
                            <a href="delete.php?delete=<?php echo $row['categories_id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            
            </table>
        </div>
    </body>
</html>