<?php
use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;

require_once 'messageClass.php';
require_once 'productClass.php';
$product = new Product;
$cat = $product->viewProductsCategories();
extract($_REQUEST);
if (
    !empty($name) && $quantity_in > 0
    && !empty($NAFDAC)
) {
    $action = new Product(
        $name,
        $desc,
        $category,
        $quantity_in,
        0,
        0,
        $cost_price,
        $selling_price,
        0,
        $NAFDAC
    );
    $act = $action->addProduct();
    extract($act, EXTR_PREFIX_ALL, '_');
}

?>