<?php require_once("includes/header.php");

//THE SOLUTION IS NOT OPTIMAL SINCE THE LINK REMAIN VALID AFTER THE RESET
// NEXT : CREATE A CLASS TO TRACK AND DELETE TOKENS AFTER EACH RESET OR ON CONDITION (TIME OF SUBMIT NEW PASSWORD > TIME OF LINK SENT + EXPIRE DURATION)!

$selector = $_GET['selector'];
$validator = $_GET['validator'];
$id = $_GET['usr'];
$is_reset = false;


if (isset($_POST['submit'])) {
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = trim($_POST['pwd']);
    $passwordRepeat = trim($_POST['pwd-repeat']);
    if (!empty($id)){
        if (empty($selector) || empty($passwordRepeat)) {
            redirect(" login.php");
            exit();
        } elseif ($password != $passwordRepeat) {
            $username = "";
            $passwordRepeat = "";
            exit();
        }else{
            $user=User::find_by_id($id);
            if ($user->reset_password==false){
                $user->password=$passwordRepeat;
                //Kill the link
                $user->reset_password=true;
                $user->update();
                $is_reset=true;
                $message =' Great!   Log With Your New Password Has Been Set';
            }else{
                $message_fail ="  Expired link! ";
                //redirect("forgot-password.php");
            }

        }
    }
}


?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-55">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Your Password!</h1>
                                </div>
                                <h4 class="bg-gray-200"><?php if ($is_reset==true){ echo "Reset Successful " . "   <a href=\"login.php\">Click to log with new password</a> " ;}
                                    elseif($is_reset==false AND isset($_POST['submit'])){ echo  "Link Expired! " . "   <a href=\"forgot-password.php\">Click here to get a new link</a> "  ; } ?>
                                </h4>
                                <?php if (empty($selector) || empty($validator)){
                                    echo "Could not validate your request!";
                                }else{
                                    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                                        ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="selector" value="<?php echo $selector;?>">
                                            <input type="hidden" name="validator" value="<?php echo $validator;?>">

                                            <div class="form-group">
                                                <label for="password"></label>
                                                <input type="password" class="form-control" name="pwd" placeholder="Enter a new password ...">
                                            </div>
                                            <div class="form-group">
                                                <label for="password"></label>
                                                <input type="password" class="form-control" name="pwd-repeat" placeholder="Repeat your new password ...">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="reset-pwd" class="btn btn-info">Reset Password</button>
                                            </div>
                                        </form>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
