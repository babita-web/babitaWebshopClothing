<?php
include("includes/header.php");
?>
<?php
/*if(!$session->is_signed_in()){
    redirect ('login.php');
}*/

$aantalUsers =  User::find_all ();
$aantalProduct = Product::find_all ();
$aantalComments = Comment::find_all ();
?>
<?php
include ("includes/sidebar.php");
include ("includes/content-top.php");
include("includes/content.php");
include("includes/footer.php");
?>

