<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'invoiceClass.php';
include 'messageClass.php';
include 'customerClass.php';

use Pharm\Invoice;
use Pharm\Customer;

$invoice = new Invoice;
$customer = new Customer;


$cust = $customer->fetch();
extract($_REQUEST);
if (isset($filter) && !empty($from) & !empty($to)) {
    $to .= ' 23:59:59';
    $from .= ' 00:00:00';

    if (
        isset($customer)
        && $customer != 'All'
    ) {
        $inv = $invoice->viewByParts($from, $to, $customer);
    } else
        $inv = $invoice->viewByParts($from, $to);
} else {
    $inv = $invoice->viewAll();
}
?>
<?php
$loop = array();
for ($i = 0; $i < sizeof($inv); $i++) {
    extract($inv[$i]);
    $loop[$name][] = $inv[$i];
}
?>


<table class = "products-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Total Cost Price</th>
            <th>Total Sales </th>
            <th>Total Profit Made</th>
            <th>Total Quantity Sold</th>
        </tr>
    </thead>
<tbody>
    <?php
    $totalQuantity = 0;
    $totalSales = 0;
    $totalCost = 0;
    foreach ($loop as $k => $v) {
        $quantity = 0;
        $sales = 0;
        $cost = 0;
        for($j = 0; $j < sizeof($v); $j++) {
            $quantity += $v[$j]["quantity"];
            $sales += $v[$j]["selling_price"];
            $cost += $v[$j]["cost_price"];
        }
    ?>
    <tr class="<?=$k?>">
        <td><?=$k?></td>
        <td>N <?=$cost?></td>
        <td>N <?=$sales?></td>
        <td>N <?=$sales - $cost?> </td>
        <td><?=$quantity?></td>
    </tr>
    <?php
        $totalQuantity += $quantity;
        $totalSales += $sales;
        $totalCost += $cost;
    }
    ?>
</tbody>
</table>
<style>
.d-title {
    font-size: 18px;
    font-weight: bolder;
}
.inf {
    margin-right: 20px;
    display: inline-block;
}
.d-child {
    font-size: 20px;
}
</style>
<div style="text-align:center">
    <div class="inf">
        <div class="d-title">Total Quantity of Products Sold</div>
        <div class="d-child"><?=$totalQuantity?></div>
    </div>
    <div class="inf">
        <div class="d-title">Total Sales </div>
        <div class="d-child">N <?=$totalSales?></div>
    </div>
    <div class="inf">
        <div class="d-title">Total Costs </div>
        <div class="d-child">N <?=$totalCost?></div>
    </div>
    <div class="inf">
        <div class="d-title">Total Profits</div>
        <div class="d-child">N <?=$totalSales - $totalCost?></div>
    </div>
<div>