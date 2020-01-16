<?php include ("includes/header.php"); ?>
<?php
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
if(empty($_GET['id'])){
    redirect ('orders.php');
}

$order = Order::find_by_id ($_GET['id']);
if($order){
    $order->delete();
    redirect ("order_photo.php?id={$order->photo_id}");
}else{
    redirect ("order_photo.php?id={$order->photo_id}");
}
?>
<?php include ("includes/sidebar.php.php"); ?>
<?php include ("includes/content-top.php.php"); ?>
<h1>Welkom delete pagina</h1>
<?php include ("includes/footer.php.php"); ?>
