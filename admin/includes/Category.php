<?php


class Category extends Db_object
{
    protected static $db_table = "categories";
    protected static $db_table_fields = array('name_category');
    public $id;
    public $product_id;
    public $name_category;



}

?>