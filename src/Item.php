<?php

namespace Dashed\ReceiptPrinter;

class Item
{
    private $paper_size;
    private $name;
    private $qty;
    private $price;
    private $currency = '€';

    public function __construct($name, $qty, $price)
    {
        $this->name = $name;
        $this->qty = $qty;
        $this->price = $price;
        $this->paper_size = '80mm';
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function setPaperSize($paper_size)
    {
        $this->paper_size = $paper_size;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function __toString()
    {
        switch ($this->paper_size) {
            case '80mm':
                $right_cols = 15;
                $left_cols = 35;

                break;
            default:
                $right_cols = 10;
                $left_cols = 22;

                break;
        }

        $item_price = $this->currency . number_format($this->price, 2, ',', '.');
        $item_subtotal = $this->currency . number_format($this->price * $this->qty, 2, ',', '.');

        $print_name = str_pad($this->name, 16) ;
        $print_priceqty = str_pad($this->qty . ' x ' . $item_price, $left_cols);
        $print_subtotal = str_pad($item_subtotal, $right_cols, ' ', STR_PAD_LEFT);

        return "$print_name\n$print_priceqty$print_subtotal\n";
    }
}
