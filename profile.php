<?php
include('includes/header.php');

if(empty($_GET['id'])){
    redirect("index.php");
}

$user = User::find_by_id($_GET['id']);

/* comment*/
if(isset($_POST['submitcomment'])){

    $body = trim($_POST['body']);
    $new_comment = Comment::create_comment($user->id, $_SESSION['user'], $body);
    if($new_comment && $new_comment->save()){
        redirect("view.php?id={$user->id}");
    }
    else{
        $message =" There are some problems saving";
    }
}
else{
    //  $author = "";
    $body = "";
}
$comments = Comment::find_the_comments($user->id);



if(isset($_POST['submitorder'])){


    $new_order = Order::create_order($user->id, $_SESSION['user'], $body);
    if($new_order && $new_order->save()){
        redirect("view.php?id={$user->id}");
    }

}

$orders = Order::find_the_orders($user->id);?>

    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid" xmlns="http://www.w3.org/1999/html">

        <div class=" row">
            <div class="col">
                <img class="img-fluid rounded" src="<?php echo'admin'.DS.$user->picture_path(); ?>" width="500" height="500" alt="">
            </div>
            <div class="col">
                <div class="wrap-table-user">
                    <ul>

                        <li class="column-1">Username : <?php echo $user->username; ?></li>
                        <hr>
                        <li class="column-2">Name : <?php echo $user->first_name; ?></li>
                        <hr>
                        <li class="column-3">Last Name : <?php echo $user->last_name; ?></li>
                        <hr>
                        <li class="column-4">Position :  <?php $role=Role::find_by_id($_GET['id']); echo $role->position; ?></li>
                        <hr>
                        <li class="column-5">Address : <?php echo $user->address; ?></li>
                        <hr>
                        <li class="column-6">Email : <?php echo $user->email; ?></li>
                    </ul>

                </div>
            </div>
        </div>









        <!-- Comments Form -->
        <div class="card my-4">

            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">

                        <h5 class="mt-0">Author </h5>

                        <?php if(isset($_SESSION['user'])){
                            echo $_SESSION['user'];
                        } else{
                            echo "User";
                        }
                        ?>

                    </div>

                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="body"></textarea>
                    </div>


                    <button name="submitcomment" type="submit" class="btn btn-primary">Leave Comment</button>
                </form>
            </div>
        </div>



        <?php foreach($comments as $comment): ?>
            <!-- Single Comment -->


            <div class="col-4">
                <img class="rounded-circle" src="http://placehold.it/20x20" alt="">
                <div class="media-body">
                    <h5 class="mt-0"> <?php  echo $comment->author; ?> </h5>
                    <p><?php echo $comment->body; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



<?php
include('includes/footer.php');
?>
?>