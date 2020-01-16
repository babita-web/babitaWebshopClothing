<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
if(empty($_GET['id'])){
    redirect ('products.php');
}else{
    $product = Product::find_by_id ($_GET['id']);
    if(isset($_POST['update'])){
        if($product){
            $product->title = $_POST['title'];

            $product->description = $_POST['description'];
            $product->category_id = (int)$_POST['category_id'];
            $product->price = $_POST['price'];
            $product->update();
            if(empty($_FILES['product_image'])){
                $product->save();
            }else{
                $product->set_file($_FILES['product_image']);
                $product->save_product_and_image();

                redirect ("edit_product.php?id={$product->id}");
            }
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to Edit Product Page</h1>
                <form action="edit_product.php?id=<?php echo $product->id; ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $product->title; ?>">
                            </div>
                          <!--  <div class="form-group">
                                <a href="#" class="thumbnail"><img src="<?php /*echo $product->picture_path(); */?>" alt=""></a>
                            </div>-->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" value="<?php echo $product->description; ?>">
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
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $product->price; ?>">
                            </div>

                    <div class="form-group">
                        <img src="<?php echo $product->image_path_and_placeholder(); ?>" alt="" class="img-fluid" width="40" height="40">
                        <label for="file">product image</label>
                        <input type="file" name="product_image" class="form-control">
                    </div>
                            <div class="info-box-delete float-left">
                            <a href="delete_product.php?id=<?php echo  $product->id; ?>" class="btn btn-danger btn-lg">Delete</a>
                        </div>
                        <div class="info-box-update float-right">
                            <input type="submit" name="update" value="update" class="btn btn-primary btn-lg">
                        </div>

                    </div>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
<?php
include("includes/footer.php");
?>
