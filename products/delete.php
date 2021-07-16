<?php 
    include '../db/db.php';

    if(isset($_GET['delete'])){
        $product_id = $_GET['delete'];
        $sql = "DELETE FROM products WHERE product_id=$product_id";
        $result = $conn->query($sql);

        $_SESSION['message'] = "Product deleted !!!"; 
        header('location: index.php');
    }
?>