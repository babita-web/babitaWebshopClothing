<?php
include ("includes/header.php");
$session->logout ();
redirect ('login.php');

session_destroy();

?>
<br>

<br>

<br>
<?php
include ("includes/babita.php");
include ("includes/footer.php"); ?>
