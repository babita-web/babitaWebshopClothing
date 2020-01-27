
<?php

include('includes/header.php');

$products = Product::find_all ();


$user = User::find_all();

/*if(isset($_POST['submitorder'])){

    $new_order = Order::create_order($product->id, $_SESSION['user'],$user->id);
    if($new_order && $new_order->save()){
        redirect("product.php?id={$user->id}");
    }
    else{
        $message =" There are some problems saving";
    }
}*/

?>

<br>
<br>
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
				Shoping Cart
			</span>
    </div>
</div>


<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product name</th>
                                <th class="column-2">product</th>
                                <th class="column-3">Price in €</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6">Action</th>
                            </tr>
                            <?php
                            if(!empty($_SESSION["shopping_cart"])) {
                            $total=0;
                            foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                            ?>

                            <tr>
                                <td class="column-1"><?php echo $values["item_name"]; ?></td>
                                <td>

                                    <a href="view.php?id=<?php echo $values['item_id']; ?>">
                                        <img src="admin/img/products/<?php echo $values['item_id']; ?>" width="40px" height="40px">
                                    </a></td>
                                <td class="column-3"><?php echo $values["item_price"]; ?></td>
                                <td class="column-4"><?php echo $values["item_quantity"]; ?></td>
                                <td class="column-5"> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                                <td class="column-6">
                                    <a href="shoping-cart.php?action=delete&id=<?php echo $values["item_id"]; ?>">
                                        <span class="text-danger">Remove</span></a></td>
                            </tr>
                            <?php $tellen=$tellen+$values["item_quantity"];
                             $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                } ?>
                            <tr>
                            <td colspan="4" align="right"> total</td>
                            <td align="right"> € <?php echo number_format($total,2);  ?></td>
                            <td></td>
                            </tr>

                            <?php } ?>
                        </table>
                    </div>
                        <br>
                        <br>

                    <div class="row">
                        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                            <div class="m-l-25 m-r--38 m-lr-0-xl">
                                <h3 class="mtext-103 cl2 p-b-30">Total : <?php echo number_format($total,2);?>  €<br>Total items:  <?php echo $tellen;?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">Cart Totals:   <br><?php echo number_format($total,2);?>  €</h4>
                        <div class="flex-w">
                            <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                <input type="submit" name="add_to_cart" class="btn btn-success" value="  Update Totals">
                            </div>
                        </div>
                    </div>
                </div>
        </div><a href="checkout.php" button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Proceed to Checkout</button></a>
    </div>
</form>

<br>

<?php include ("includes/footer.php");?>