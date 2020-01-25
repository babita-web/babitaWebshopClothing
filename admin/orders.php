<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$orders = Order::find_all();
/*if (!count(debug_backtrace()))
{
    GetOrder::getOrder('REPLACE-WITH-ORDER-ID', true);
}*/


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
                        <th>username</th>
                        <th>address</th>
                        <th>date of order</th>
                        <th>details</th>
                        <th>order by</th>
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
                            <td><?php echo $order->username; ?></td>
                            <td><?php echo $order->address; ?></td>
                            <td><?php echo $order->date_order; ?></td>
                            <td><?php $products = Product::find_the_order_products($order->id); ?>
                                <div class="container">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#order<?php echo $order->id; ?>">Show Details
                                    </button>
                                    <div id="order<?php echo $order->id; ?>" class="modal">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Order Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="myTable table table-header">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Product Name</th>
                                                            <th>Product Price</th>
                                                            <th>Description</th>
                                                            <th>Product Photos</th>
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
                                                                    <a href="product_photos.php?id=<?php echo $product->id; ?>">
                                                                        <?php
                                                                        $photos = Photo::find_the_product_photos($product->id);
                                                                        //echo count($photos);
                                                                        foreach ($photos as $photo): ?>
                                                                            <img src="<?php echo $photo->picture_path(); ?>" ;
                                                                                 width="70px" height="70px">
                                                                        <?php endforeach;
                                                                        ?>
                                                                    </a>
                                                                </td>

                                                                <td>
                                                                    <a href="delete_product_photo.php.php?id=<?php echo $product->id; ?>"
                                                                       class="btn btn-danger rounded-0">
                                                                        <i class="far fa-trash-alt"></i>
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









