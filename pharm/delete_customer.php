<?php
include 'customerClass.php';
use Pharm\Customer;
extract($_REQUEST);
$customer = new Customer;

if(array_key_exists('error', $customer->update($name, $phone, $location, $id))) {
    echo 'Could not edit manager details last time out!';
}
?>