<?php
require_once 'ProductClass.php';

use Pharm\Product;

$product = new Product();
extract($_REQUEST);
print_r($_REQUEST);
$delete = $product->delete($id);
?>