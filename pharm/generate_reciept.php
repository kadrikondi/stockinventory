<?php
require_once 'ProductClass.php';
use Pharm\Product;

$product = new Product();
$i = 0;
$overallTotal = 0;
foreach ($_REQUEST as $key => $value) {
    if(strpos($key, 'quantity') === false) {
        $details[$i] = $product->viewProductsById($value);
        $details[$i]['squantity'] = $value;
        $i++;
        $overallTotal += ($product->viewProductsById($value)['selling_price'] * $value);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciept</title>
</head>
<body>
    <h2>Reciept</h2>

    <table>
    <th>
        <tr>
        <td>Drug Name</td>
        <td>Description</td>
        <td>Category</td>
        <td>Quantity</td>
        <td>Selling Price </td>
        <td>Total</td>
        </tr>
    </th>
    <tr>
        <?php
    for ($i = 0; $i < sizeof($details); $i++) {
            extract($details[$i]);
        ?>
            <tr>
                <td><?= $name ?></td>
                <td><?= $description ?></td>
                <td><?= $category ?></td>
                <td><?= $squantity ?></td>
                <td><?= $selling_price ?></td>
                <td><?= $squantity * $selling_price?></td>
            </tr>
        <?php
        }
        ?>
    </tr>
    </table>
    Total amount bought: N <?=$overallTotal?>
</body>
</html>