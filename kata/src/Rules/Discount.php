<?php

namespace src\Rules;


use src\Main\Goods;
use src\Main\Item;

class Discount extends PriceRules
{
    private $priceTable = [];

    private $specialTable = [];

    function __construct(array $priceList)
    {
        $this->priceTable = $priceList['prices'];
        $this->specialTable = $priceList['rule'][self::class];
    }

    public function calculateTotal(Goods $goods)
    {
        $countGoods = [];
        $totalPrice = 0;

        foreach ($goods->getItems() as $good) {
            if (!isset($countGoods[$good->getName()])) {
                $countGoods[$good->getName()] = 0;
            }

            $countGoods[$good->getName()]++;
            $totalPrice += $good->getPrice();
            if (isset($this->specialTable[$good->getName()]) && $countGoods[$good->getName()] == $this->specialTable[$good->getName()]['count']) {
                $totalPrice -= $this->specialTable[$good->getName()]['count'] * $good->getPrice();
                $totalPrice += $this->specialTable[$good->getName()]['price'];
                $countGoods[$good->getName()] = 0;
            }
        }
        return $totalPrice;
    }

    public function parseProductName($productName)
    {
        return new Item($productName,$this->priceTable[$productName]);
    }
}