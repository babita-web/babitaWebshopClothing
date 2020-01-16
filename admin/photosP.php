<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
$photos = Photo::find_all ();
include ("includes/sidebar.php");
include ("includes/content-top.php");?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>PHOTOS</h2>
                <table class="table table-header">
                    <td><a href="add_photo.php" class="btn btn-primary rounded-0"><i class="fas fa-user-plus"></i>Add Photo</a></td>
                    <table class="table table-header">
                        <thead>

                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category ID</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Comments</th>
                            <th>Edit?</th>
                            <th>Delete?</th>
                            <th>View?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($photosP as $photoP) :
                        ?>
                        <tr>
                            <td><img src="<?php echo $photoP->picture_path();?>" height="40" width="40" alt=""></td>

                            <td class="d-flex align-self-stretch"><?php echo $photoP->id; ?> </td>
                            <td><?php echo $photoP->title; ?></td>
                            <td><?php echo $photoP->description; ?></td>
                            <td><?php echo $photoP->category_id; ?></td>
                            <td><?php echo $photoP->price; ?></td>
                            <td><?php echo $photo->size; ?></td>
                            <td>
                                <a href="comments_product.php?id=<?php echo $photoP->id; ?>">
                                    <?php
                                    $comments = Comment::find_the_comments ($photoP->id);
                                    echo count($comments);
                                    ?>
                                </a>
                            </td>
                            <td><a href="edit_photoP.php?id=<?php echo $photoP->id; ?>" class="btn btn-danger rounded-0"><i class="far fa-edit"></i></a></td>
                            <td><a href="delete_photoP.php?id=<?php echo $photoP->id; ?>" class="btn btn-danger rounded-0">
                                    <i class="far fa-trash-alt"></i>
                                </a></td>
                            <td><a href="../photoP.php?id=<?php echo $photoP->id; ?>" class="btn btn-danger rounded-0"><i class="fas fa-eye"></i></a></td>
                        <tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<?php
include("includes/footer.php");
?>