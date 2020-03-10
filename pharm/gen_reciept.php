<?php
session_start();
extract($_SESSION);

include 'ProductClass.php';
include 'ManagerClass.php';
include 'messageClass.php';
require_once 'customerClass.php';
include 'invoiceClass.php';

extract($_REQUEST);

use Pharm\Customer;
$custom = new Customer;

use Pharm\Manager;
use Pharm\Product;

$manager = new Manager;
$id = $manager->fetchId($name);

$cust_id = $custom->fetchId($customer);
$product = new Product;

use Pharm\Invoice;
$invoice = new Invoice;
foreach($data as $k => $v) {
    $invoice->create($cust_id, $id, $v['id'], $v['number']);
    $product->removeAccordingly($v['id'], $v['number']);
}
?>