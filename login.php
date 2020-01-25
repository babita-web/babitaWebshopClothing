<?php
require_once ("includes/header.php");
?>

<?php
$the_message = '';
if($session->is_signed_in ()){
    redirect ("index.php");
}

if(isset($_POST['submit'])){
    $username = trim ($_POST['username']);
    $password = trim ($_POST['password']);

    /*Methode check de db of de user bestaat*/
    $user_found = User::verify_user($username, $password);

    if($user_found){
        $session->login ($user_found);
        $_SESSION['user'] = $username;
        redirect ("index.php");
    }else{
        $the_message = "Your password or username FAILED";
    }
}else{
    $username = "";
    $password = "";
}
?>



<br><br><br>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <h2 class="bg-danger"><?php /*echo $the_message; */?></h2>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control form-control-user" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter username..." value="<?php echo htmlentities ($username) ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control form-control-user"  name="password" id="password" placeholder="Password" value="<?php echo htmlentities ($password) ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="submit" value="submit" class="btn btn-primary btn-user btn-block">
                                        </div>
                                    </form>

                                    <strong>  <?php
                                        if(isset($_SESSION['user'])){
                                            echo $the_message;}

                                        ?></strong>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php require_once("includes/footer.php");?>