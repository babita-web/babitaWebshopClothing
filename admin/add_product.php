<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$product = new Product();
if (isset( $_POST['submit'] )) {
    if ($product) {

        $product->title = $_POST['title'];
        $product->description = $_POST['description'];
     $product->category_id = (int) $_POST['category_id'];
        $product->price = $_POST['price'];
      //  $product->photo_id= (int) $_GET['photo_id'];
        $product->set_file($_FILES['filename']);
        $product->save();
        if($product->save_product_and_image()){
            redirect("products.php");
        }

    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Add New Product</h1>
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">


                            <div class="form-group">
                                <label for="title">Product title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="category_id">category</label>
                                <select class="form-control" name="category_id">
                                    <?php  $categories= Category::find_all(); foreach ($categories as $category):?>
                                        <option value="<?= $category->id; ?>"><?= $category->name_category; ?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="text" name="price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="file">Product image</label>
                                <input type="file" name="filename" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Add Product" class="btn btn-primary">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>