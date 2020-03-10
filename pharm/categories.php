<?php
require_once 'ProductClass.php';
require_once 'messageClass.php';

$product = new \Pharm\Product;

$cat = $product->viewProductsCategories();

if (
    isset($_REQUEST['addNewCategory'])
    && !empty($_REQUEST['newCategory'])
) {
    $product->addProductsCategory($_REQUEST['newCategory']);
    header('location: categories.php?message=Category was added last time out!');
}
extract($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Categories</title>
</head>

<body>
    <!-- Error Message(s) -->
    <?php
    if(isset($message)) {
        $type = (!isset($error)) ? 0 : 1;
        $msg = new \UserInterface\message;
        $msg->show($message, $type);
    }
    ?>
    <!-- End of Error message(s) -->
    <table>
        <th>
            <tr>
                <td>s/n</td>
                <td>Category</td>
                <td>Action</td>
            </tr>
        </th>
        <?php
        $i = 0;
        for ($i = 0; $i < sizeof($cat); $i++) {
            extract($cat[$i]);
        ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $category ?></td>
                <td>
                    <a href="renameProductsCategory.php?id=<?= $id ?>&category=<?= $category ?>">Rename</a>
                    <a href="viewProductsByCategory.php?id=<?= $id ?>&category=<?= $category ?>">View all</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <h2>Add a Category</h2>
        <form action="" method="post">
            <input type="text" name="newCategory">
            <input type="hidden" name="addNewCategory" value = 1>
            <input type="submit" name="submit" value="Add new category">
        </form>
    </div>
</body>

</html>