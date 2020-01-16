<?php


class Order_details extends Db_object
{
    /**PROPERTIES**/
    public $id;
    public $order_id;
    public $product_id;
    public $title;
    public $total_price;
    public $quantity;

    /**DATA TABLES**/
    protected static $db_table = "order_details";
    protected static $db_table_field = array('id','order_id','product_id','product_name','product_price','quantity');

    /**Methods**/
    public static function create_order($order_id,$product_id, $product_name,$product_price,$quantity){
        if (!empty($order_id)&&!empty($product_id)&&!empty($title)&&!empty($total_price)&&!empty($quantity)){
            $order_details = new Order_details();
            $order_details->order_id=(int)$order_id;
            $order_details->product_id=$product_id;
            $order_details->title = $title;
            $order_details->total_price = $total_price;
            $order_details->quantity = $quantity;
            return $order_details;
        }else{
            return false;
        }
    }

}