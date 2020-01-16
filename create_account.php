<?php
include ("includes/header.php");
/*if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}*/


$user = new User();
if (isset( $_POST['submit'] )) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        $user->roleID = (int )$_POST['roleID'];

        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();
        $user->save();
    }
}

 ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <h1>Welcome to Create new account page</h1>
                <form action="create_account.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
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
                                <label for="product_id">Role id</label>


                                <select name="roleID">

                                    <option value="0">none</option>
                                    <option value=1>Customer</option>
                                    <option value=2>Sales Staff</option>
                                    <option value=3>Manager</option>
                                    <option value=4>Assistant Manager</option>
                                    <option value=5>Buyer</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file">User image</label>
                                <input type="file" name="user_image" class="form-control">
                            </div>
                            <input type="submit" name="submit" value="Create Account" class="btn btn-primary"><a href="index_user.php?id=<?php echo $user->id; ?>"</a>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>