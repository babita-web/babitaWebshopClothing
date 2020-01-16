<?php
include ("includes/header.php");
if (!$session->is_signed_in ()) {
    redirect ( 'login.php' );
}
$category = new Category();
if (isset( $_POST['submit'] )) {
    if ($category) {
        $category->name_category = $_POST['name_category'];
        if($category->save ()){
             redirect("categories.php");
        }
    }
}

include ("includes/sidebar.php");
include ("includes/content-top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Welkom Add Category pagina</h1>
                <form action="add_category.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_category">Category Name</label>
                                <input type="text" name="name_category" class="form-control">
                            </div>

                            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include ("includes/footer.php");
?>