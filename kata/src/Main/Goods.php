<?php

namespace src\Main;

class Goods
{
    private $items;

    function __construct()
    {
        $this->items = [];
    }

    public function getItems()
    {
        return $this->items;
    }


    public function setItems($items)
    {
        $this->items = $items;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }
}