
<?php include ('includes/header.php');
if (!$session->is_signed_in()){
    redirect('login.php');
}
$categories = Category::find_all();
?>

<?php include ('includes/sidebar.php')?>
<?php include ('includes/content-top.php')?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-around">
                <h2>Welcome To Categories Page</h2>

            </div>

            <a class="btn btn-primary rounded-0" href="add_category.php"><i class="fas fa-user-plus"></i>Add Product Category</a>
            <table class="myTable table table-header">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Total Products<br> in this Category</th>
                    <th>Edit Category</th>
                    <th>Delete Category</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($categories as $category) :
                    ?>
                    <tr>
                        <td class="d-flex align-self-stretch"><?php echo $category->id; ?></td>
                        <td><?php echo $category->name_category; ?></td>

                        <td>
                            <a href="category_products.php?id=<?php echo $category->id; ?>">
                                <?php
                                $products = Product::find_the_category_products($category->id);
                                echo count($products);
                                ?>
                            </a>
                        </td>

                        <td>
                            <a href="edit_category.php?id=<?php echo $category->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete_category.php?id=<?php echo $category->id; ?>" class="btn btn-danger rounded-0" >
                                <i class="fas fa-trash"></i>
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









