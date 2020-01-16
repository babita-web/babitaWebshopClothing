<?php


class Role extends Db_object
{

    protected static $db_table = "roles";
    protected static $db_table_field = array('position');
    public $id;
    public $position;





}