<?php
include('includes/header.php');
require_once('admin/includes/init.php');
/*if(empty($_GET['id'])){
    redirect("index.php");
}*/

$user = User::find_by_id($_GET['id']);


if(isset($_POST['submitorder'])){


    $new_order = Order::create_order($product->id, $_SESSION['user']);
    if($new_order && $new_order->save()){
        redirect("view.php?id={$user->id}");
    }

}

$orders = Order::find_the_orders($product->id);




?>
<div class="container-fluid">

    <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4"><?php echo $user->name; ?></h1>


        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo'admin'.DS.$user->picture_path(); ?>" width="500" height="500" alt="">
        <hr>

    </div>

    <div class="media mb-8">

        <div class="media-body">

            <h5 class="mt-0">Usernane:  <?php  echo $user->username; ?> </h5>
            <p><strong>First Name: </strong> <?php echo $user->first_name; ?></p>
            <p><strong>last name: </strong><?php echo $user->last_name; ?></p>
        </div>

    </div>


</div>


<?php
include('includes/footer.php');
?>
