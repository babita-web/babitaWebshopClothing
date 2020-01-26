<?php
include ("includes/header.php");
$session->logout ();
redirect ('login.php');

session_destroy();

?>
<?php

include ("includes/footer.php"); ?>
