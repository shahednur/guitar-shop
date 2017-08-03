<?php 
require('../includes/database.php');
require('../model/category_db.php');
require('../model/product_db.php');
require('../model/category.php');
require('../model/product.php');

if(isset($_POST['action'])){
    $action = $_POST['action'];
}else if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'list_products';
}

if($action == 'list_products'){
    $category_id = $_GET['category_id'];
    if(!isset($category_id)){
        $category_id = 1;
    }
    
    $current_category = CategoryDB::getCategory($category_id);
    $categories = CategoryDB::getCategorys();
    $products = ProductDB::getProductByCategory($category_id);
    include('product_list.php');
    
}else if($action == 'delete_product'){
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    
    ProductDB::deleteProduct($product_id);
    header('location: .?category_id='.$category_id);
}else if($action == 'show_add_form'){
    $categories = CategoryDB::getCategorys();
    include('product_add.php');
}else if($action == 'add_product'){
    $category_id = $_POST['category_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    
    if(empty($code)||empty($name)||empty($price)){
        $error ="Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    }else{
        $category = CategoryDB::getCategory($category_id);
        $product = new Product($category,$code,$name,$price);
        ProductDB::addProduct($product);
        
        header('location: .?category_id='.$category_id);
    }
}
?>