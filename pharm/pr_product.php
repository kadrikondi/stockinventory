<?php

require_once 'ProductClass.php';

extract($_REQUEST);
$product = new \Pharm\Product;
$return = $product->updateProducts(
    $uname, $udescription, $ucategory, $uquantity_in, 
    $uquantity_out, $uquantity_damaged,
    $uquantity_remaining, $ucost_price, 
    $uselling_price, $uNAFDAC, $id
);
switch(array_key_exists('error', $return)){
    case true:
        echo $return['error']['message'];
    break;
    case false:
        echo "Last update was successful";
}
?>