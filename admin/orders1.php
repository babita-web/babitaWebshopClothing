<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$orders = Order::find_all ();
include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>ORDER</h2>
                <td><a href="add_order.php" class="btn btn-primary rounded-0"><i class="fas fa-first-order-plus"></i>Add to Cart</a></td>
                <table class="table table-header">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Product_id</th>
                        <th>Order by</th>

                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($orders as $order) :
                        ?>
                        <tr>
                            <td><?php echo $order->id; ?></td>
                            <td><?php echo $order->photo_id; ?></td>
                            <td><?php echo $order->order_by; ?></td>
                            <td><?php echo $order->description; ?></td>

                            <td><a href="delete_order.php?id=<?php echo $order->id; ?>" class="btn btn-danger rounded-0">
                                    <i class="far fa-trash-alt"></i>
                                </a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
include("includes/footer.php");
?>