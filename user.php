<?php
include('includes/header.php');

if(empty($_GET['id'])){
    redirect("index.php");
}

$product = Product::find_by_id($_GET['id']);

/* comment*/
if(isset($_POST['submitcomment'])){

    $body = trim($_POST['body']);
    $new_comment = Comment::create_comment($product->id, $_SESSION['user'], $body);
    if($new_comment && $new_comment->save()){
        redirect("view.php?id={$product->id}");
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



if(isset($_POST['submitorder'])){


    $new_order = Order::create_order($product->id, $_SESSION['user'], $body);
    if($new_order && $new_order->save()){
        redirect("view.php?id={$product->id}");
    }

}

$orders = Order::find_the_orders($product->id);


?>
<div class="container-fluid" xmlns="http://www.w3.org/1999/html">

    <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4"><?php echo $product->title; ?></h1>

        <!-- Author -->

        <hr>
        <!-- Date/Time -->
        <p>   <?php
            $date = date('r');
            echo $date;
            $product->title = $date; ?> </p>


        <hr>
        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo'admin'.DS.$product->picture_path(); ?>" width="500" height="500" alt="">
        <hr>

    </div>

    <div class="media mb-8">

        <div class="media-body">


            <h5 class="mt-0">Price:  <?php  echo $product->price; ?> </h5>
            <p><strong>Product ID: </strong> <?php echo $product->id; ?></p>
            <p><strong>Product Description: </strong><?php echo $product->description; ?></p>


        </div>

        <form method="post" action="product.php?action=add&id=<?php echo $product->id;?>"
        <div class="media-body">

            <label for="tentacles">Select Quantity:</label>
            <div class="media">

                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-minus"></i>
                </div>

                <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1">

                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-plus"></i>
                </div>
            </div>
            <input type="hidden" name="hidden_name" value="<?php echo $product->title; ?>"/>
            <input type="hidden" name="hidden_price" value="<?php echo $product->price; ?>"/>
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="add to cat"/>
        </div>
        </form>
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
