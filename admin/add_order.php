<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$order = new Order();
if (isset( $_POST['submit'] )) {
    if ($order) {

        $order->product_id = (int)$_POST['product_id'];
        $order->description = $_POST['description'];

        $order->order_by = $_POST['order_by'];



        $order->set_file($_FILES['filename']);
       $order->save_order_and_image();
        $order->save();
    }
}


include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>


   <?php
include ("includes/footer.php");
?>