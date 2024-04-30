<?php 

 class cartFormatedProduct {

    public $id;
    public $number;
    public $name;
    public $price;
    public $quantity;
    public $total;

    public function __construct($number, $name, $price, $quantity, $total, $id){
        $this->number = $number;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->total = $total;
        $this->id = $id;    
    }
}

?>