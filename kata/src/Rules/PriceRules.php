<?php

namespace src\Rules;


use src\Main\Goods;

abstract class PriceRules
{

    public abstract function calculateTotal(Goods $goods);

    public abstract function parseProductName($productName);
}