
<?php include ('includes/header.php');
if (!$session->is_signed_in()){
    redirect('login.php');
}
if (empty($_GET['id'])){
    redirect('roles.php');
}

$users = User::find_the_role_users($_GET['id']);
?>
<?php include ('includes/sidebar.php')?>
<?php include ('includes/content-top.php')?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <h1>Role Users Page</h1>

            </div>
            <hr>
            <h4>Role User :  <?php $role=Role::find_by_id($_GET['id']); echo $role->position; ?></h4>
            <td><a class="btn btn-primary rounded-0" href="add_user.php"><i class="fas fa-comment-plus"></i>Add user</a></td>
            <table class="table table-header">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Description</th>
                    <th>Product Image</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $user) :
                    ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td>
                            <a img href="img/users/<?php echo $user->user_image; ?>">
                                <?php
                                $photos = Photo::find_the_user_photos($user->id);?>
                                 <img src="<?php echo $user->image_path_and_placeholder();?>" height="40" width="40" alt="">

                            </a>
                        </td>

                        <td>
                            <a href="delete_category_product.php?id=<?php echo $user->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include ('includes/footer.php')?>
