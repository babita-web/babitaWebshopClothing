<?php
include('includes/header.php');
require_once('admin/includes/init.php');
/*if(empty($_GET['id'])){
    redirect("index.php");
}*/

$product = Product::find_by_id($_GET['id']);
/* comment*/
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

$user = User::find_by_id($_GET['id']);
/* comment*/
if(isset($_POST['submitorder'])){

   //$body = trim($_POST['body']);

    $new_order = Order::create_order($product->id, $_SESSION['user'],$user->id);
    if($new_order && $new_order->save()){
        redirect("photo.php?id={$user->id}");
    }
    else{
        $message =" There are some problems saving";
    }
}
else{
    //  $author = "";
   // $body = "";
}
$orders = Order::find_the_orders($user->id);


?>
<div class="container-fluid">

    <div class="col-lg-8">
    <!-- Title -->
    <h1 class="mt-4"><?php echo $product->title; ?></h1>
    <a href="basket.php?id=<?php echo $_SESSION['user_id']; ?>" title="go to cart">Go to cart</a>
    <!-- Author -->

    <hr>
    <!-- Date/Time -->
    <p>   <?php
        $date = date('r');
        echo $date;
        $product->title = $date; ?> </p>


    <hr>
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?php echo'admin'.DS.$product->picture_path(); ?>" width="50" height="50" alt="">
    <hr>

</div>

    <div class="media mb-8">

                    <div class="media-body">

                        <h5 class="mt-0">Price:  <?php  echo $product->price; ?> </h5>
                        <p><strong>Product ID: </strong> <?php echo $product->id; ?></p>
                        <p><strong>Product Description: </strong><?php echo $product->description; ?></p>
                    </div>

    </div>
    <!-- Order Form -->
    <div class="card my-4">

        <h5 class="card-header">Add to cart:</h5>
        <div class="card-body">
            <form method="post">
                <div class="form-group">

                    <?php if(isset($_SESSION['user'])){
                        echo $_SESSION['user'];
                    } else{
                        echo "User";
                    }
                    ?>

                </div>

                <button name="submitorder" type="submit" class="btn btn-primary">add to cart</button>
            </form>
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


</div>

<?php
include('includes/footer.php');
?>
