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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciept</title>
    <style>
        del {
            text-decoration: none;
            position: relative;
        }
        del:after {
            content: ' ';
            font-size: inherit;
            display: block;
            position: absolute;
            right: 0;
            left: 0;
            top: 40%;
            bottom: 40%;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        .form-body.filter{
            font-size: 13px;
        }
    </style>
</head>

<body>        
    <form class = "records-form" action = "view_reciept_table.php">
    <div class = "form-head" >Filter</div>
    <div class = "form-body filter">
        <label style ="width: unset;">Show from </label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="from">
        <label style ="width: unset;"> to</label>
        <input style = "padding:5px; vertical-align:super;" type="date" name="to">
        <label style ="width: unset;">Customer</label>
        <select style = "padding:5px; vertical-align:super;" name="customer">
            <option>All</option>
            <?php
            for ($k = 0; $k < sizeof($cust); $k++) {
                extract($cust[$k], EXTR_PREFIX_ALL, 'm');
            ?>
                <option><?= $m_name ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" name="filter" value="Show Products" style = "margin-left: 0; margin-bottom: 0;">
    </form>
    </div>
    <div class = "table-import"> 
        <h1>Existing Invoices</h1>
        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Customer</th>
                        <th>Drug</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Sold for</th>
                        <th>Staff</th>
                        <th>Total</th>
                        <th>Entry Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < sizeof($inv); $i++) {
                    extract($inv[$i], EXTR_PREFIX_ALL, 'f');
                ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $f_customer_name ?></td>
                        <td><?= $f_name ?></td>
                        <td><?= $f_description ?></td>
                        <td><?= $f_category ?></td>
                        <td><?= $f_quantity ?></td>
                        <td><del>N</del> <?= $f_selling_price ?></td>
                        <td><?= $f_username ?></td>
                        <td><del>N</del> <?= $f_selling_price * $f_quantity ?></td>
                        <td><?= $f_date ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
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