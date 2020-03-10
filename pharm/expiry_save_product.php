<?php
require_once 'ProductClass.php';

use Pharm\Product;

$product = new Product();
extract($_REQUEST);

$product->setExpiry($name, $quantity, $date);
echo true;
?>