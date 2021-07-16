<?php 
include('db.php');
//products
$sql = "CREATE TABLE IF NOT EXISTS products(
    product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    product_name varchar(255) NOT NULL,
    product_img varchar(255) NOT NULL,
    product_price int(15) NOT NULL,
    product_description varchar(255) NOT NULL,
    brand varchar(255) NOT NULL,
    categories_id INT,
    FOREIGN KEY (categories_id) REFERENCES categories(categories_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table products created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

//categories
$sql = "CREATE TABLE IF NOT EXISTS categories(
    categories_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    categories_name varchar(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table categories created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }
?>