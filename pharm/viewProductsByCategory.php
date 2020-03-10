<?php
require_once 'ProductClass.php';

$product = new \Pharm\Product;
if(!isset($_REQUEST['id'])) {
    header('location: categories.php');
}
extract($_REQUEST);
$cat = $product->viewProductsByCategories($category);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$category?> Category</title>
</head>
<body>
<table>
    <th>
        <tr>
        <td>Drug Name</td>
        <td>Description</td>
        <td>Category</td>
        <td>Quantity In </td>
        <td>Quantity Sold</td>
        <td>Quantity damaged</td>
        <td>Quantity Left</td>
        <td>Cost Price </td>
        <td>Selling Price </td>
        <td>NAFDAC Reg. No. </td>
        <td>Action </td>
        </tr>
    </th>
    <?php
    $i = 0;
    for($i = 0;$i < sizeof($cat); $i++) {
        extract($cat[$i]);
    ?>
    <tr>
        <td><?=$name?></td>
        <td><?=$description?></td>
        <td><?=$category?></td>
        <td><?=$quantity_in?></td>
        <td><?=$quantity_out?></td>
        <td><?=$quantity_damaged?></td>
        <td><?=$quantity_remaining?></td>
        <td><?=$cost_price?></td>
        <td><?=$selling_price?></td>
        <td><?=$NAFDAC?></td>
        <td>
            <a 
            href = "update_product.php?id=<?=$id?>&action=update&name=<?=$name?>&description=<?=$description?>&category=<?=$category?>&quantity_in=<?=$quantity_in?>&quantity_out=<?=$quantity_out?>&quantity_remaining=<?=$quantity_remaining?>&quantity_damaged=<?=$quantity_damaged?>&cost_price=<?=$cost_price?>&selling_price=<?=$selling_price?>&NAFDAC=<?=$NAFDAC?>">Update</a> 
            <a href = "update_product.php?id=<?=$id?>&action=delete">Delete</a>
    </td>
    </tr>
    <?php
    $i++;
    }
    ?>
    </table>
</body>
</html>