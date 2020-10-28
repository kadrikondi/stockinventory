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

$loop = array();
for ($i = 0; $i < sizeof($inv); $i++) {
    extract($inv[$i]);
    $loop[$name][] = $inv[$i];
}
?>

<form class = "records-form" action = "view_summary.php">
    <div class = "form-head" >Filter</div>
    <div class = "form-body filter">
        <label style ="width: unset;">Show from </label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="from">
        <label style ="width: unset;"> to</label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="to">
        <input type="submit" name="filter" value="Show Products" style = "margin-left: 0; margin-bottom: 0;">
    </div>
</form>
<div class = "table-import" > 
    <table class = "products-table" style="overflow: auto; display:block; height:300px;">
        <thead>
            <tr>
               
            <th>Product</th>
            <th> Cost Price</th>
            <th> Sales Price </th>
            <th>Total Profit Made</th>
            <th>Total Quantity Sold</th>
            <th>totcost price</th>
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
            <td>N <?=$sales * $quantity?></td>
        </tr>
        <?php
            $totalQuantity += $quantity;
            $totalSales += $sales* $quantity;
            $totalCost += $cost *$quantity;
     
        }
        ?>
    </tbody>
    </table>

    <div style="text-align:center">
        <div class="inf">
            <div class="d-title">Total Quantity of Products Sold</div>
            <div class="d-child"><?=$totalQuantity?></div>
        </div>
        <div class="inf">
            <div class="d-title">Total Sales </div>
            <div class="d-child" id='ts'>  <?=$totalSales?></div>
                  
        </div>
        <div class="inf">
            <div class="d-title">Total Costs </div>
            <div class="d-child" id='tc'>N <?=$totalCost?></div>
         
           
        </div>
        <div class="inf">
            <div class="d-title">Total Profits</div>
            <div class="d-child" id='pr'>N <?=$totalSales - $totalCost?></div>
        </div>
    <div>
</div>
<script>

          var totalS='<?php echo $totalSales;?>'
           var totalC='<?php echo $totalCost;?>'
             var profit='<?php echo $totalSales - $totalCost;?>'
    //    add comma to thousand values eg 333333 will b 33,3333
            function NC(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}
  var  ts= document.getElementById("ts");

ts.innerHTML= 'N '+ NC(totalS);
 var  tc= document.getElementById("tc");
 tc.innerHTML= 'N '+ NC(totalC);
 var  pr= document.getElementById("pr");
 pr.innerHTML= 'N '+ NC(profit);
            </script>
<script>
$('form.records-form').on('submit', function(e) {
    e.preventDefault();
    k = $(this);
    console.log($(this).get(0));
    url = k
        .attr('action');
    holder = $('div.table-import');

    data = {
        'from': k.find('input[name=from]').val(),
        'to': k.find('input[name=to]').val(),
        'customer': k.find('select[name=customer]').val()
    };
    console.log(data);
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            k.find('input[type=submit]')
                .css({
                    'value': 'Checking..', 
                    'disabled': 'disabled'
                });
        },
        success: function (data) {
            k.find('input[type=submit]')
                .css({
                    'value': 'Show Products', 
                    'enabled': 'enabled'
                })
            holder.html('');
            holder.append(data);
        }
    })
}); 
</script>