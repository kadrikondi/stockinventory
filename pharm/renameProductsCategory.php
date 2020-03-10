<?php
require_once 'ProductClass.php';

$product = new \Pharm\Product;
// $cat = $product->viewProductsCategories();
switch (isset($_REQUEST['submit']) && !empty($_REQUEST['newName'])) {
    case false:
        extract($_REQUEST, EXTR_PREFIX_ALL, 'r');
        break;
    case true:
        echo $product->renameProductsCategory($_REQUEST['newName'], $_REQUEST['id'])['message'];
        extract($_REQUEST, EXTR_PREFIX_ALL, 'r');
        break;
    default:
        header('location: categories.php?message=we could not complete your last request! Try that again');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rename <?= $r_category ?></title>
</head>

<body>
    <form>
        <input type="text" name="newName" value="<?= $r_category ?>">
        <input type="submit" name="submit" value="Rename <?= $r_category ?>">
        <input type="hidden" name="id" value="<?= $r_id ?>">
        <input type="hidden" name="category" value="<?= $r_category ?>">
    </form>
    <a href="addProductsCategory.php">add new category</a><br>
    <a href="categories.php"> View all categories</a>
</body>

</html>