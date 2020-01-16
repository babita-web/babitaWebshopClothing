<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$product = new Product();
if (isset( $_POST['submit'] )) {
    if ($product) {
        $product->id = $_POST['id'];
        $product->title = $_POST['title'];
        //   $product->caption = $_POST['caption'];
        $product->description = $_POST['description'];
        // $product->category_id = (int)$_POST['category_id'];
        // $product->filename = $_POST['filename'];
        $product->set_file($_FILES['product_image']);
        $product->save_product_and_image();
        $product->save();
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
                                <label for="product_id">Product id</label>
                                <input type="text" name="id" class="form-control">
                            </div>


                            <div class="form-group">
                                <select>
                                    <option value="0">none</option>
                                    <option value="1">Tshirt</option>
                                    <option value="2">Shirt</option>
                                    <option value="3">Pant</option>
                                    <option value="4">Skirt</option>
                                    <option value="5">Sweater</option>
                                    <option value="6">Dress</option>
                                    <option value="7">Wedding Dress</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="file">Product image</label>
                                <input type="file" name="product_image" class="form-control">
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