<?php
include ("includes/header.php");
require_once('admin/includes/init.php');
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
        $_SESSION['basket'] = $username;

        redirect ("index.php");
    }else{
        $the_message = 'Your password or username FAILED';
    }
}else{
    $username = "";
    $password = "";
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
                            <div class="col-lg-6">
                                <div class="p-5">


                                    <div class="wrap">
                                        <!-- Invisible SVG -->
                                        <svg viewBox="0 0 600 300" class="svg-defs">
                                            <!-- Symbol wth text -->
                                            <symbol id="s-text">
                                                <text text-anchor="middle" x="50%" y="50%" dy=".35em" class="text">
                                                    BABITA
                                                </text>
                                            </symbol>

                                            <!-- Mask with text -->
                                            <mask id="m-text" maskunits="userSpaceOnUse" maskcontentunits="userSpaceOnUse">
                                                <rect width="100%" height="100%" class="mask__shape">
                                                </rect>
                                                <use xlink:href="#s-text" class="text-mask"></use>
                                            </mask>
                                        </svg>

                                        <div class="box-with-text">
                                            <!-- Content for text -->
                                            <div class="text-fill">
                                                <!-- Element with animated shadows -->
                                                <div class="shadows"></div>
                                            </div>

                                            <!-- SVG to cover text fill -->
                                            <svg viewBox="0 0 600 300" class="svg-inverted-mask">
                                                <!-- Big shape with hole in form of text -->
                                                <rect width="100%" height="100%" mask="url(#m-text)" class="shape--fill" />
                                                <!-- Transparent copy of text to keep patterned text selectable -->
                                                <use xlink:href="#s-text" class="text--transparent"></use>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Related demos -->

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome </h1>
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
                                        if(!isset($_SESSION['user'])){
                                            echo $the_message;}

                                        ?></strong>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="create_account.php">Create an Account!</a>
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