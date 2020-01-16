
<?php include ('includes/header.php');
if (!$session->is_signed_in()){
    redirect('login.php');
}
/*if (empty($_GET['id'])){
    redirect('orders.php');
}*/

$products = Product::find_the_order_products($_GET['id']);

include ("includes/sidebar.php");
include ("includes/content-top.php");?>

<?php //include ('includes/sidebar.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Products of this Order</h2>
            <td><a class="btn btn-primary rounded-0" href="add_product.php"><i class="fas fa-comment-plus"></i>Add Product</a></td>
            <table class="table table-header">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th> Price</th>
                    <th>Description</th>

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
                                echo count($photos);
                                ?>
                            </a>
                        </td>

                        <td>
                            <a href="delete_product_photo.php.php?id=<?php echo $product->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php  //include ('includes/content.php')?>
<?php include ('includes/footer.php')?>
