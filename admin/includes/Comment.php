<?php


class Comment extends Db_object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = array( 'product_id', 'author', 'body');
    public $id;
    public $product_id;
    public $author;
    public $body;

    public static function create_comment($product_id, $author, $body){
        if(!empty($product_id) && !empty($author) && !empty($body)){
            $comment = new Comment();
            $comment->product_id =$product_id;
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
        }else{
            return false;
        }
    }

    public static function find_the_comments($product_id){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE product_id = " . $database->escape_string ($product_id);
        $sql .= " ORDER BY product_id ASC";
        return self::find_this_query ($sql);
    }
}