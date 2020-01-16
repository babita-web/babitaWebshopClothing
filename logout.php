<?php
include ("includes/header.php");
require_once('admin/includes/init.php');
redirect ('index.php');
?>

<?php
$session->logout ();
session_destroy();

?>
<?php

include ("includes/footer.php"); ?>
