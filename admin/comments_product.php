<?php
include("includes/header.php");
if(!$session->is_signed_in ()){
    redirect ('login.php');
}
if(empty($_GET['id'])){
    redirect("photos.php");
}

$product = Product::find_by_id($_GET['id']);

if(isset($_POST['submitcomment'])){

    $body = trim($_POST['body']);
    $new_comment = Comment::create_comment($product->id, $_SESSION['user'], $body);
    if($new_comment && $new_comment->save()){
        redirect("photo.php?id={$product->id}");
    }
    else{
        $message =" There are some problems saving";
    }
}
else{
    //  $author = "";
    $body = "";
}
$comments = Comment::find_the_comments($product->id);

$users = User::find_the_users($product->id);
include ("includes/sidebar.php");
include ("includes/content-top.php");?>



    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <h2>COMMENTS FOR THIS PRODUCT</h2>


            <!--    <td><a href="add_comment.php" class="btn btn-primary rounded-0"><i class="fas fa-comments-plus"></i>Add Comment</a></td>-->
                <table class="table table-header">

                    <thead>
                    <tr>
<th>Comment ID</th>
                       <th>Author</th>
                        <th>body</th>
                    <!--    <th>view</th>
                        <th>Edit</th>-->
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                 foreach ($comments as $comment) :
                        ?>
                        <tr>

                            <td><?php echo $comment->id; ?></td>
                            <td><?php echo $comment->author; ?></td>
                            <td><?php echo $comment->body; ?></td>
                            <!--<td><a href="../comment.php?id=<?php /*/*echo $comment->id; */?>" class="btn btn-danger rounded-0"><i class="fas fa-eye"></i></a></td>
                            <td><a href="edit_comment.php?id=<?php /*/*echo $comment->id; */?>" class="btn btn-danger rounded-0"><i class="far fa-edit"></i></a></td>-->
                            <td><a href="delete_comment_photo.php?id=<?php /*echo $comment->id; */?>" class="btn btn-danger rounded-0">
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