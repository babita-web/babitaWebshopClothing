<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$photo = new Photo();
if (isset( $_POST['submit'] )) {
    if ($photo) {

        $photo->title = $_POST['title'];
        $photo->description = $_POST['description'];
        $photo->product_id =(int)$_POST['product_id'];
       // $photo->price = $_POST['price'];


        // $product->filename = $_POST['filename'];
        $photo->set_file($_FILES['filename']);
        $photo->save();
        if($photo->save_photo_and_image()){
            redirect("photos.php");
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Add New Photo</h1>
                <form action="add_photo.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">


                                                      <div class="form-group">
                                <label for="title">Photo title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
<!--
                            <div class="form-group">
                                <label for="product_id">product id</label>
                                <input type="id" name="product_id" class="form-control">
                            </div>
-->


                            <div class="form-group">
                                <label for="file">filename</label>
                                <input type="file" name="filename" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Add Photo" class="btn btn-primary">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>