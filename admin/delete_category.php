<?php include ('includes/header.php')?>
<?php
if (!$session->is_signed_in()){
    redirect("login.php");
}
if (empty($_GET['id'])){
    redirect('categories.php');
}
$category = Category::find_by_id($_GET['id']);
if ($category){
    $category->delete();
    redirect('categories.php');
}else{
    redirect('categories.php');
}
?>
<?php include ('includes/content-top.php')?>
<?php //include ('includes/sidebar.php')?>
<?php //include ('includes/content.php')?>
<h1>Welcome to the delete page!</h1>
<?php include ('includes/footer.php')?>






