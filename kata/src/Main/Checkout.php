<?php

namespace src\Main;


use src\Interfaces\CheckoutInterface;
use src\Rules\PriceRules;

class Checkout implements CheckoutInterface
{

    private $goods;

    private $priceRule;

    function __construct(PriceRules $priceListAndRule)
    {
        $this->priceRule = $priceListAndRule;
        $this->total = 0;
        $this->goods = new Goods();
    }

    public function scan($productName)
    {
        $item = $this->priceRule->parseProductName($productName);
        $this->goods->addItem($item);
    }

    public function price()
    {
        $priceWithoutRule = 0;
        foreach ($this->goods->getItems() as $good) {
            $priceWithoutRule += $good->getPrice();
        }
        return $priceWithoutRule;
    }

    public function total()
    {
        return $this->priceRule->calculateTotal($this->goods);
    }
}