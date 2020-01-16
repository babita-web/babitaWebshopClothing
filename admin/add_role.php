<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$role = new Role();
if (isset( $_POST['submit'] )) {
    if ($role) {
        $role->position = $_POST['position'];
        if($role->save ()){
             redirect("roles.php");
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Welcome add role page</h1>
                <form action="add_role.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="position">Position Name</label>
                                <input type="text" name="position" class="form-control">
                            </div>

                            <input type="submit" name="submit" value="Add Role" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>