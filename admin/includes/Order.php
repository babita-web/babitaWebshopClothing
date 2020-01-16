<?php


class Order extends Db_object
{
    protected static $db_table = "orders";
    protected static $db_table_fields = array('id','user_id','total_price','date_order');
    public $id;
    public $total_price;
    public $user_id;
    public $date_order;

    public static function create_order($user_id, $total_price, $date_order){
        if(!empty($user_id) && !empty($total_price)&& !empty($date_order)){
            $order = new Order();
            $order->user_id = (int)$user_id;
            $order->price = $total_price;
            $order->date_order = $date_order;
            return $order;
        }else{
            return false;
        }
    }

    public static function find_the_orders($user_id){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE user_id = " . $database->escape_string ($user_id);
        $sql .= " ORDER BY user_id ASC";
        return self::find_this_query ($sql);
    }
}