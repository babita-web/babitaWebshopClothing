<?php
include ("includes/header.php");
$session->logout ();
redirect ('login.php');



?>
<br>
<br>
<br>
<section id="checkout-banner">
    <div class="container py-5 text-center">
        <div class="container py-5 text-center">

              <h2>Thank you for visiting Babita's Website</h2>



            <input type="hidden" name="rm" value="xocPP7RRmugQZvSWIqUy8JkCxPu76Kbsj6fDffMiVjGy2wwxsm58QZUTh5S">
        </div>

    </div>
</section>


<?php
include ("includes/babita.php");
include ("includes/footer.php"); ?>
