<?php 
    include '../db/db.php';

    if(isset($_GET['delete'])){
        $categories_id = $_GET['delete'];
        $sql = "DELETE FROM categories WHERE categories_id=$categories_id";
        $result = $conn->query($sql);

        $_SESSION['message'] = "Category deleted !!!"; 
        header('location: index.php');
    }
?>