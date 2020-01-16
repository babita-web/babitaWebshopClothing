<?php


class Basket extends Db_object
{
    protected static $db_table = "baskets";
    protected static $db_table_fields = array( 'product_id', 'author', 'body');
    public $id;
    public $product_id;
    public $author;
    public $body;

    public static function create_basket($product_id, $author, $body){
        if(!empty($product_id) && !empty($author) && !empty($body)){
            $basket = new Basket();
            $basket->product_id =$product_id;
            $basket->author = $author;
            $basket->body = $body;
            return $basket;
        }else{
            return false;
        }
    }

    public static function find_the_baskets($product_id){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE product_id = " . $database->escape_string ($product_id);
        $sql .= " ORDER BY product_id ASC";
        return self::find_this_query ($sql);
    }
}