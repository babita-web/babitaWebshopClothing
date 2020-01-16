<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$orders = Order::find_all();


include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>ORDER</h2>

                <table class="table table-header">
                    <thead>
                    <tr>
                        <th>Id</th>

                        <th>Total price</th>
                        <th>date of order</th>
                        <th>details</th>
                        <th>edit</th>
                        <th>delete</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($orders as $order) :
                        ?>
                        <tr>
                            <td><?php echo $order->id; ?></td>

                            <td><?php echo $order->total_price; ?></td>
                            <td><?php echo $order->date_order; ?></td>


                            <td><?php $products = Product::find_the_order_products($order->id); ?>
                                <div class="container">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Order Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="myTable table table-header">
                                                        <thead>
                                                        <tr>
                                                            <th>Product ID</th>
                                                            <th>Title</th>
                                                            <th>Price</th>
                                                            <th>Description</th>
                                                            <th>Photos</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        foreach ($products as $product) :
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $product->id; ?></td>
                                                                <td><?php echo $product->title; ?></td>
                                                                <td><?php echo $product->price; ?></td>
                                                                <td><?php echo $product->description; ?></td>
                                                                <td>
                                                                   <a href="photos.php?id=<?php echo $product->id; ?><!--">

                                                                            <img src="<?php echo $photo->picture_path(); ?>" >
                                                                                 width="70px" height="70px">
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    <a href="delete_product.php?id=<?php echo $product->id; ?>"
                                                                       class="btn btn-danger rounded-0">
                                                                        <i class="fa-trash"></i>
                                                                    </a>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            </div>
        </div>
        </td>
<!--        <td><a href="edit_user.php?id=--><?php //$user = User::find_by_id($order->user_id); echo $user->id; ?><!--">--><?php //echo $user->username; ?><!--</a></td>-->

        <td>
            <a href="edit_order.php?id=<?php echo $order->id; ?>" class="btn btn-danger rounded-0">
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <a href="delete_order.php?id=<?php echo $order->id; ?>" class="btn btn-danger rounded-0">
                <i class="fas fa-trash"></i>
            </a>
        </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
</div>


<?php include('includes/footer.php'); ?>









