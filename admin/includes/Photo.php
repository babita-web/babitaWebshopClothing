<?php


class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title',  'filename','description');
    public $id;
    public $title;
    public $description;

    public $filename;
    public $price;
    public $photo_image;
    public $alternate_text;
    public $type;
    public $date;
    public $tmp_path;
    public $upload_directory = 'img' . DS . 'photos';
    public $image_placeholder = 'http://place-hold.it/400x400&text=image';

   public static function find_the_product_photos($product_id)
    {
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE product_id = " . $database->escape_string($product_id);
        $sql .= " ORDER BY product_id ASC";
        return self::find_this_query($sql);
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            //var_dump($this->filename);

        }
    }

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }



    public function image_path_and_placeholder()
    {
        return empty($this->filename) ? $this->image_placeholder : $this->upload_directory . DS . $this->filename;
    }

    public function save_photo_and_image()
    {
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->filename;
        if ($this->id) {
            move_uploaded_file($this->tmp_path, $target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        } else {
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "File is not available";
                return false;
            }

            if (file_exists($target_path)) {
                $this->errors[] = "File {$this->filename} exists!";
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
    public function delete_photo(){
        if($this->delete ()){
            $target_path = SITE_ROOT.DS. 'admin' .DS. $this->picture_path ();
            return unlink ($target_path) ? true : false;
        }else{
            return false;
        }
    }
}