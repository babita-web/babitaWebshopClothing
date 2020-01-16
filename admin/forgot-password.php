<?php include ('includes/header.php');
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/* Include the Composer generated autoload.php file. */
require 'C:\wamp64\www\vendor\composer\autoload_files.php';
/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);
$is_send=false;

if(isset($_POST['submit'])) {

    $email = trim($_POST['emailAddress']);
    if (!empty($email)){
        $user_found = User::verify_email($email);
        if ($user_found){
            //Make the link available
            $user_found->reset_password=false;
            $user_found->update();
            //Set Link
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            //$expires = date("U") + 1800;
            $id = $user_found->id;
            // for home laptop port :8080
            //$url ="http://localhost:8080/webshop/admin/create_new_password.php?selector=" . $selector .
            // "&validator=" . bin2hex($token).'&usr='.$id ;
            // for school, no port 8080 , use the url bellow
            $url ="http://localhost:/webshop/admin/create_new_password.php?selector=" . $selector . "&validator=" . bin2hex($token).'&usr='.$id ;
            //please entert email info bellow
            $mail->SMTPDebug = false;
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "@gmail.com";
            $mail->Password = "";
            //If SMTP requires TLS encryption then set it
            //$mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            $mail->Port = 587;
            //please entry your info bellow
            $mail->From = "@gmail.com";
            $mail->FromName = "";

            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );

            $mail->addAddress($email, $user_found->username);

            $mail->isHTML(true);

            $mail->Subject = "Reset Password Link";
            $message = '<p>We heard that you lost your password. Sorry about that!
                But no worries! You can use the following link to reset your password:
                <br>';
            $message .= '<a href="'.$url .'">'.$url.'</a></p>';

            $mail->Body = $message;
            $mail->AltBody = "Reset Password Link";
            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else
            {
                $is_send=true;
                $message="Message has been sent successfully, please check your email";
            }
        }else{
            $message= "This account does not exist!";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>
                                <form class="user" action="" method="post">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="emailAddress"  placeholder="Enter Email Address...">
                                    </div>
                                    <div><?php if ($is_send){ echo $message;} ?></div>
                                    <input type="submit" name="submit" value="Send Link" class="btn btn-primary">
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register.html">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
