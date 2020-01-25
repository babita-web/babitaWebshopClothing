<?php



class Product extends Db_object
{
    protected static $db_table = "products";
    protected static $db_table_fields = array('title', 'description', 'category_id', 'order_id', 'price','photo_id');
    public $id;
    public $title;
    public $order_id;
    public $description;
    public $category_id;
    public $price;
    public $photo_id;
    public $filename;
    public $type;
    public $size;
    public $tmp_path;
    public $upload_directory = 'img' . DS . 'products';
    public $image_placeholder = 'http://place-hold.it/400x400&text=image';


    public static function create_product($title,$price, $category_id,$description, $photo_id){
        if (!empty($title)&&!empty($price)&&!empty($category_id)&&!empty($description)&&!empty($photo_id)){
            $product = new Product();
            $product->title=$title;
            $product->price=$price;
            $product->category_id = (int)$category_id;
            $product->description = $description;

            $product->photo_id =(int)$photo_id;
            return $product;
        }else{
            return false;
        }
    }

    public static function find_the_order($order_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE order_id = " . $database->escape_string($order_id);
        $sql .= " ORDER BY order_id ASC";
        return self::find_this_query($sql);

    }

    public static function find_the_products($photo_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";
        return self::find_this_query($sql);
    }


    public static function find_the_product($user_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE user_id = " . $database->escape_string($user_id);
        $sql .= " ORDER BY user_id ASC";
        return self::find_this_query($sql);
    }


    public static function find_the_order_products($order_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE order_id = " . $database->escape_string($order_id);
        $sql .= " ORDER BY order_id ASC";
        return self::find_this_query($sql);
    }

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }



    public function image_path_and_placeholder()
    {
        return empty($this->filename) ? $this->image_placeholder : $this->upload_directory . DS . $this->filename;
    }



    public static function find_by_title($title){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE title  LIKE '%" . $database->escape_string($title) ."%'";
        $sql .= " ORDER BY title ASC";
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
            $this->filename = $file['name'];
            $this->tmp_path = $file['tmp_name'];
            // var_dump($this->user_image);
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }


    public static function find_the_category_products($category_id){
        global $database;
        $sql = "SELECT * FROM ".self::$db_table;
        $sql .= " WHERE category_id = " . $database->escape_string($category_id);
        $sql .= " ORDER BY category_id ASC";
        return self::find_this_query($sql);
    }

    public function save_product_and_image()
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
}

?>