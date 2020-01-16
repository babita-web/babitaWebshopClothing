<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}

if(empty($_GET['id'])){
    redirect ('users.php');
}else{
$user = User::find_by_id ($_GET['id']);
if (isset( $_POST['update'] )) {
    //var_dump ($user->id);
    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->roleID = $_POST['roleID'];
        $user->set_file($_FILES['user_image']);
        $user->update();
        if($user->save_user_and_image()){
            redirect("users.php");
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
                <form action="edit_user.php?id=<?php echo $user->id; ?>" method="post">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label for="username">ID</label>
                                <input type="text" readonly name="id" class="form-control" value="<?php echo $user->id; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="first name">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="last name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>
                            <div class="form-group">
                                <label for="roleID">Role</label>
                                <select class="form-control" name="roleID">
                                    <?php  $roles= Role::find_all(); foreach ($roles as $role):?>
                                        <option value="<?= $role->id; ?>"><?= $role->position; ?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <img src="<?php echo $user->image_path_and_placeholder(); ?>" alt="" class="img-fluid" width="40" height="40">
                                <label for="file">User image</label>
                                <input type="file" name="user_image" class="form-control">
                            </div>
                    <div class="col-12 col-md-4">


                                    <div class="info-box-delete float-left">
                                        <a href="delete_user.php?id=<?php echo  $user->id; ?>" class="btn btn-danger btn-lg">Delete</a>
                                    </div>
                                    <div class="info-box-update float-right">
                                        <input type="submit" name="update" value="update" class="btn btn-primary btn-lg"><?php echo "<script type='text/javascript'>alert('the user id is edited');</script>";?>
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
