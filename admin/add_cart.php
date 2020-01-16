<?php
include ("includes/header.php");
/*if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}*/


session_start();
if (isset($_GET['id']) & !empty($_GET['id'])) {
    $product = $_GET['id'];
    $_SESSION['cart'] = $product;
    header('location: index.php?status=success');
} else {
    header('location: index.php?status=failed');
}

if(isset($_SESSION['cart']) & !empty($_SESSION['cart'])){
    $product = $_SESSION['cart'];
    $cartproduct = explode(",", $product);
    $product .= "," . $_GET['id'];
    $_SESSION['cart'] = $product;
    header('location: index.php?status=success');
}else{
    $product = $_GET['id'];
    $_SESSION['cart'] = $product;
    header('location: index.php?status=success');
}

$product = $_SESSION['cart'];
$cartproduct = explode(",", $product);
if(in_array($_GET['id'], $cartproduct)){
    header('location: index.php?status=incart');
}else{
    $product .= "," . $_GET['id'];
    $_SESSION['cart'] = $product;
    header('location: index.php?status=success');

}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>


   <?php
include ("includes/footer.php");
?>