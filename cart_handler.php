<?php
    require_once 'connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = create_unique_id();
        setcookie('user_id', $user_id, time() + 60*60*24*30, '/');
    }

    if(isset($_POST['add_to_cart'])){

    $id = create_unique_id();
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    
    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");   
    $verify_cart->execute([$user_id, $product_id]);

    $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $max_cart_items->execute([$user_id]);

    if($verify_cart->rowCount() > 0){
        $warning_msg[] = 'Already added to cart!';
    }elseif($max_cart_items->rowCount() == 10){
        $warning_msg[] = 'Cart is full!';
    }else{

        $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
        $select_price->execute([$product_id]);
        $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

        $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
        $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
        $success_msg[] = 'Added to cart!';
    }

    }

    // Update quantity
    if(isset($_POST['update_cart'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_NUMBER_INT);

        $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
        $update_qty->execute([$qty, $cart_id]);
    }

    // Delete item
    if(isset($_POST['delete_item'])){
        $cart_id = $_POST['cart_id'];
        $delete = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
        $delete->execute([$cart_id]);
    }

    // Clear cart
    if(isset($_POST['clear_cart'])){
        $clear = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $clear->execute([$user_id]);
    }

?>
