<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
if (empty($_GET['id'])){
    redirect("roles.php");
}
$role = Role::find_by_id($_GET['id']);
if (isset( $_POST['edit_role'] )) {
    if ($role) {
        $role->position = $_POST['position'];
        $role->save ();
    }
}


include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1> Edit role </h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="position"> Position Name</label>
                                <input type="text" name="position" class="form-control" value="<?php echo $role->position; ?>">
                            </div>

                            <input type="submit" name="edit_role" value="Edit role" class="btn btn-primary">
                            <a href="delete_role.php?id=<?php echo $role->id; ?>" class="btn btn-danger" >Delete role</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>