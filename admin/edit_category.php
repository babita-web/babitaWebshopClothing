<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
if (empty($_GET['id'])){
    redirect("categories.php");
}
$category = Category::find_by_id($_GET['id']);
if (isset( $_POST['edit_category'] )) {
    if ($category) {
        $category->name_category = $_POST['name_category'];
        $category->save ();
    }
}


include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1> Edit category </h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_category">Category Name</label>
                                <input type="text" name="name_category" class="form-control" value="<?php echo $category->name_category; ?>">
                            </div>

                            <input type="submit" name="edit_category" value="Edit category" class="btn btn-primary">
                            <a href="delete_category.php?id=<?php echo $category->id; ?>" class="btn btn-danger" >Delete category</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>