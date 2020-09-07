<?php
use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;

require_once 'messageClass.php';
require_once 'ProductClass.php';
$product = new Product;
extract($_REQUEST);

$search = new Product;

$sch = $search->search($data);
echo json_encode($sch);
?>
