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

    if (
        isset($customer)
        && $customer != 'All'
    ) {
        $inv = $invoice->viewByParts($from, $to, $customer);
    } else
        $inv = $invoice->viewByParts($from, $to);
} else {
    if ($customer != 'All') {
        $inv = $invoice->viewByCustomer($customer);
    }else {
        $inv = $invoice->viewAll();
    }
}

if(sizeof($inv) > 0){
?>

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
            <th>NAFDAC</th>
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
            <td><?= $f_NAFDAC ?></td>
            <td><?= $f_username ?></td>
            <td><del>N</del> <?= $f_selling_price * $f_quantity ?></td>
            <td><?= $f_date ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<?php
} else {
    echo "<b>No record found!</b>";
}
?>