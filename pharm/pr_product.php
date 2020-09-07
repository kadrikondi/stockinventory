<?php

require_once 'ProductClass.php';

extract($_REQUEST);
$product = new \Pharm\Product;
$return = $product->updateProducts(
    $uname, $udescription, $ucategory,  $ucost_price, 
    $uselling_price, $id
);
switch(array_key_exists('error', $return)){
    case true:
        echo $return['error']['message'];
    break;
    case false:
        echo "Last update was successful";
}
?>