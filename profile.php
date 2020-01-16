<?php
include('includes/header.php');
require_once('admin/includes/init.php');
/*if(empty($_GET['id'])){
    redirect("index.php");
}*/


$profiles = Photo::find_by_id($_GET['id']);



$products = Product::find_the_products($photo->id);


?>


<!-- Page Content -->
<!--div class="container">
    <div class="row">
        <!-- Post Content Column -->
<div class="col-lg-8">
    <!-- Title -->
    <h1 class="mt-4"><?php echo $photo->title; ?></h1>
    <!-- Author -->

    <hr>
    <!-- Date/Time -->
    <p>   <?php
        $date = date('r');
        echo $date;
        $photo->title = $date; ?> </p>


    <hr>
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?php echo'admin'.DS.$photo->picture_path(); ?>" width="50" height="50" alt="">
    <hr>

    <div class="container">
        <nav class="navbar">
            <!-- Site logo -->

            <?php foreach($products as $product): ?>

                <div class="media mb-4">

                    <div class="media-body">

                        <h5 class="mt-0">Price:  <?php  echo $product->price; ?> </h5>
                        <p><strong>Product ID: </strong> <?php echo $product->id; ?></p>
                        <p><strong>Product Description: </strong><?php echo $product->description; ?></p>

                        <?php endforeach; ?>

                        <div class="card my-4">
                           <td><a href="order.php?id=<?php echo $photo->id; ?>" class= "btn btn-primary">Add to the Cart<i class="fas fa-first-order-plus"></i></a></td>
                            </div>
                        </div>


    </div>
</div>
</div>



</nav>
</div>
</div>

</div>



<?php
include('includes/footer.php');
?>
