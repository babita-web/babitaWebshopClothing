<?php
include ("includes/header.php");
$session->logout ();
redirect ('login.php');

session_destroy();

?>
<br>
<br>
<br>
<section id="checkout-banner">
    <div class="container py-5 text-center">

        <h2>Thank you for visiting Babita's Website</h2>

    </div>
</section>


<?php
include ("includes/babita.php");
include ("includes/footer.php"); ?>
