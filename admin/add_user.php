<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$user = new User();
if (isset( $_POST['submit'] )) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->roleID = (int )$_POST['roleID'];
        $user->email = $_POST['email'];
        $user->address = $_POST['address'];
        $user->set_file($_FILES['user_image']);

        $user->save();
        if($user->save_user_and_image()){
            redirect("users.php");
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Welcome to add user page</h1>
                <form action="add_user.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="first name">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last name">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
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
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="address" name="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="file">User image</label>
                                <input type="file" name="user_image" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Add User" class="btn btn-primary">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>