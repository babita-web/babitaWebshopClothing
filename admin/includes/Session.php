<?php


class Session
{
    private $signed_in = false;
    public $user_id;

    /*automatic start from a session*/
    function __construct()
    {
        session_start();
        $this->visitor_count();
        $this->check_the_login ();
        $this->check_message ();
    }
    public function is_admin($user){
        $this->role_id = $_SESSION['role_id'] = $user->role_id;
        $role= Role::find_by_id($this->role_id);
        //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ($role->position=='administrator'){
            //redirect("index.php");
            redirect($_SESSION['actual_link']);
        }else{
            //redirect("index_limited.php");
            redirect($_SESSION['actual_link']);
        }
    }



    /*check: is the session userid reset*/
    private function check_the_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function is_signed_in(){
        return $this->signed_in;
    }

    public function login($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    public function message($msg=""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }
    }

    private function check_message(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }
    }


    public function visitor_count(){
        if(isset($_SESSION['count'])){
            return $this->count = $_SESSION['count']++;
        } else{
            return $_SESSION['count'] = 1;
        }
    }

}
$session = new Session();
    ?>