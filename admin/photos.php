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
                            <th>File Name</th>


                            <th>Comments</th>
                            <th>Edit?</th>
                            <th>Delete?</th>
                            <th>View?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($photos as $photo) :
                        ?>
                        <tr>
                            <td><img src="<?php echo $photo->image_path_and_placeholder();?>" height="40" width="40" alt=""></td>
                            <td class="d-flex align-self-stretch"><?php echo $photo->id; ?> </td>
                            <td><?php echo $photo->title; ?></td>

                            <td><?php echo $photo->filename; ?></td>

                            <td>
                                <a href="comments_product.php?id=<?php echo $photo->id; ?>">
                                    <?php
                                    $comments = Comment::find_the_comments ($photo->id);
                                    echo count($comments);
                                    ?>
                                </a>
                            </td>
                            <td><a href="edit_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger rounded-0"><i class="far fa-edit"></i></a></td>
                            <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger rounded-0">
                                    <i class="far fa-trash-alt"></i>
                                </a></td>
                            <td><a href="../photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger rounded-0"><i class="fas fa-eye"></i></a></td>
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