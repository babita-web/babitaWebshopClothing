<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$products = Product::find_all ();
include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>PRODUCTS</h2>
                <td><a href="add_product.php" class="btn btn-primary rounded-0"><i class="fas fa-tshirt"></i>Add New Product</a></td>
                <table class="table table-header">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category Name</th>
                        <th>Price</th>

                        <th>Comments</th>
                        <th>View</th>
                        <th>Edit?</th>
                        <th>Delete?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($products as $product) :
                        ?>
                        <tr>
                            <td><?php echo $product->id; ?></td>
                            <td><img src="<?php echo $product->image_path_and_placeholder();?>" height="40" width="40" alt=""></td>

                            <td><?php echo $product->title; ?></td>
                            <td><?php echo $product->description; ?></td>
                            <td><?php
                                $category=Category::find_by_id($product->category_id);
                                echo $category->name_category; ?></td>

                            <td><?php echo $product->price; ?></td>

                            <td>
                                <a href="comments_product.php?id=<?php echo $product->id; ?>">
                                    <?php
                                    $comments = Comment::find_the_comments ($product->id);
                                    echo count($comments);
                                    ?>
                                </a>
                            </td>
                            <td><a href="../view.php?id=<?php echo $product->id; ?>" class="btn btn-danger rounded-0"><i class="fas fa-eye"></i></a></td>
                            <td><a href="edit_product.php?id=<?php echo $product->id; ?>" class="btn btn-danger rounded-0"><i class="far fa-edit"></i></a></td>
                            <td><a href="delete_product.php?id=<?php echo $product->id; ?>" class="btn btn-danger rounded-0">
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