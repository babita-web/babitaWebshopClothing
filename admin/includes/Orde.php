<?php


class Orde extends Db_object
{
    protected static $db_table = "orde";
    protected static $db_table_fields = array('id', 'total', 'date_order');
    public $id;
    public $total;


    public static function create_order( $total, $date_order)
    {
        if (!empty($total) && !empty($date_order)) {
            $order = new Order();
            $order->price = $total;
            $order->date_order = $date_order;
            return $order;
        } else {
            return false;
        }
    }
}