<?php


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image','roleID');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $filename;
    public $comments;
    public $roleID;
    public $type;
    public $size;
    public $photo_id;
    public $tmp_path;
    public $upload_directory = 'img' . DS . 'users';
    public $image_placeholder = 'http://place-hold.it/400x400&text=image';



    public static function find_the_role_users($roleID){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE roleID = " . $database->escape_string($roleID);
        $sql .= " ORDER BY roleID ASC";
        return self::find_this_query($sql);
    }

    public function picture_path(){
        return $this->upload_directory.DS.$this->user_image;
    }

    public static function find_the_users($photo_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";
        return self::find_this_query($sql);
    }



    public static function verify_user($user, $pass)
    {
        global $database;
        $username = $database->escape_string($user);
        $password = $database->escape_string($pass);
        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }

    public function set_file($file)
    {
        $date = date('Y-m-d_H-i-s');

        echo $date;
        /*        echo($file);*/
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "No file uploaded";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->user_image = $file['name'];
            $this->tmp_path = $file['tmp_name'];
           // var_dump($this->user_image);
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save_user_and_image()
    {
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->user_image;
        if ($this->id) {
            move_uploaded_file($this->tmp_path, $target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        } else {
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)) {
                $this->errors[] = "File is not available";
                return false;
            }

            if (file_exists($target_path)) {
                $this->errors[] = "File {$this->user_image} exists!";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "This folder has no write rights!";
                return false;
            }

        }

    }
}