<?php


class Shopping_cart  extends Db_object
{

    public $items = array();
    public $quantities = array();

    private $total;
    private $deleted;


    public function addItem($obj,$qnt,$key = null) {
        if ($key == null) {
            $this->deleted=false;
            $this->items[] = $obj;
            $this->quantities[]=$qnt;
            $this->total+=$obj->price*$qnt;
        }
        else {
            if (isset($this->items[$key])) {
                throw new KeyHasUseException("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
                $this->quantities[$key] = $qnt;
            }
        }
    }

    public function deleteItem($key) {
        if (isset($this->items[$key])) {
            $this->deleted=true;
            $this->subtotal-=$this->items[$key]->product_price*$this->quantities[$key];
            if ($this->items[$key]->discount>0){
                $this->discount-=($this->items[$key]->product_price*$this->items[$key]->discount*$this->quantities[$key])/100;
            }
            unset($this->items[$key]);
            unset($this->quantities[$key]);
        }
        else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }


    public function length() {
        return count($this->items);
    }

    public function getItem($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new KeyInvalidException("Invalid key $key.");
        }
    }

    // Return an array key's  used in shopping cart, the array can be used by external code
    public function keys() {
        return array_keys($this->items);
    }

    // Because getItem() and deleteItem() can throw an exception if an invalid key is passed
    public function keyExists($key) {
        return isset($this->items[$key]);
    }


    public  function get_total(){
        return  $this->total;
    }





}