<?php

namespace src\Interfaces;

interface CheckoutInterface
{

    public function scan($productName);

    public function total();

    public function price();
}