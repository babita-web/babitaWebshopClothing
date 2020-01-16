
<?php include ('includes/header.php');
if (!$session->is_signed_in()){
    redirect('login.php');
}
if (empty($_GET['id'])){
    redirect('categories.php');
}

$products = Product::find_the_category_products($_GET['id']);
?>
<?php include ('includes/sidebar.php')?>
<?php include ('includes/content-top.php')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h1>Category Products Page</h1>

            </div>
            <hr>
            <h4>Products Category :  <?php $category=Category::find_by_id($_GET['id']); echo $category->name_category; ?></h4>
            <td><a class="btn btn-primary rounded-0" href="add_product.php"><i class="fas fa-comment-plus"></i>Add Product</a></td>
            <table class="table table-header">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Description</th>
                    <th>Product Image</th>
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
                            <a img href="img/products/<?php echo $product->filename; ?>">
                                <?php
                                $photos = Photo::find_the_product_photos($product->id);?>
                                 <img src="<?php echo $product->image_path_and_placeholder();?>" height="40" width="40" alt="">

                            </a>
                        </td>

                        <td>
                            <a href="delete_category_product.php?id=<?php echo $product->id; ?>" class="btn btn-danger rounded-0" >
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


<?php include ('includes/footer.php')?>
