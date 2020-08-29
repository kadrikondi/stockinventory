<?php
use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;

require_once 'messageClass.php';
require_once 'productClass.php';
$product = new Product;
extract($_REQUEST);
print_r($_REQUEST);
$product = new Product;

$rmv = $product->removeExpired($exp_id, $product_id, $quantity);
echo json_encode($rmv);
?>