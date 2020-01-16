<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
if(empty($_GET['id'])){
    redirect ('photos.php');
}else{
    $photo = Photo::find_by_id ($_GET['id']);
    if(isset($_POST['update'])){
        if($photo) {
            $photo->title = $_POST['title'];

            $photo->description = $_POST['description'];
            $photo->filename = $_POST['filename'];

            $photo->update();
             if(empty($_FILES['filename'])){
                 $photo->save();
             }else{
                 $photo->set_file($_FILES['filename']);
                 $photo->save();
            $photo->save_photo_and_image();
            redirect ("photos.php");
        }
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to Edit Page</h1>
                <form action="edit_photo.php?id=<?php echo $photo->id; ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                            </div>
                            <div class="form-group">
                                <a href="#" class="thumbnail"><img src="<?php echo $photo->picture_path(); ?>" alt=""></a>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="10"><?php echo $photo->description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <img src="<?php echo $photo->image_path_and_placeholder(); ?>" alt="" class="img-fluid" width="40" height="40">
                                <label for="file">product image</label>
                                <input type="file" name="filename" class="form-control">
                            </div>



                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="photo-info-box">


                                <div class="info-box-footer">
                                    <div class="info-box-delete float-left">
                                        <a href="delete_photo.php?id=<?php echo  $photo->id; ?>" class="btn btn-danger btn-lg">Delete</a>
                                    </div>
                                    <div class="info-box-update float-right">
                                        <input type="submit" name="update" value="update photo" class="btn btn-primary btn-lg">
                                    </div>
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