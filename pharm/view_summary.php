<?php
include 'invoiceClass.php';
include 'messageClass.php';
include 'customerClass.php';

use Pharm\Invoice;
use Pharm\Customer;

$invoice = new Invoice;
$customer = new Customer;


$cust = $customer->fetch();
extract($_REQUEST);
if (!empty($from) & !empty($to)) {
    $to .= ' 23:59:59';
    $from .= ' 00:00:00';
    $inv = $invoice->viewByParts($from, $to);
} else {    
    $inv = $invoice->viewAll();
}
$loop = array();
for ($i = 0; $i < sizeof($inv); $i++) {
    extract($inv[$i]);
    $loop[$name][] = $inv[$i];
}

if(sizeof($inv) > 0){
?>

<table class = "products-table" style="overflow: auto; display:block; height:200px;">
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
                $quantity += $v[$j]['quantity'];
                $sales += $v[$j]['selling_price'];
                $cost += $v[$j]['cost_price'];
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
<div style="text-align:center; ">
        <div class="inf" style="padding-bottom:20px;">
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
<?php
} else {
    echo "<b>No record found!</b>";
}
?>