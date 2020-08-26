<?php

use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;

require_once 'messageClass.php';
require_once 'productClass.php';
$product = new Product;
$cat = $product->viewProductsCategories();
extract($_REQUEST);
if (
    isset($submit) && !empty($name) && $quantity_in > 0
    && !empty($NAFDAC)
) {
    $action = new Product(
        $name,
        $desc,
        $category,
        $quantity_in,
        0,
        0,
        $cost_price,
        $selling_price,
        0,
        $NAFDAC
    );
    $act = $action->addProduct();
    extract($act, EXTR_PREFIX_ALL, '_');
}

if (!isset($__error) && isset($__message)) {
    header("location: addproducts.php?message=$__message");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<?php
if (isset($__message)) {
    $type = (!isset($_error)) ? 0 : 1;
    $msg = new \UserInterface\message;
    $msg->show($__message, $type);
}
?>
<div>
<form class = "add-product-form" action = "add_new_product.php">
    <div class = "form-head">Add New Product</div>
    <div class = "form-body">
        <label>Product Name</label>
        <input type="text" name="name" Placeholder = "Drug Name"><br>
        <label>Description</label>
            <textarea type="text" name="desc" placeholder = "Short description..."></textarea><br>
        <label>Category</label>
        <select name="category">
            <?php
            $intface = new UserInterfaceProduct;
            $intface->new($cat);
            ?>
        </select><br />
        <label>Quantity In</label>
        <input type=number name = "quantity_in" placeholder = "Quantity" min = 0><br>
        <label> Cost </label>
        <input type="text" name = "cost_price" placeholder = "Cost Price of Product"><br>
        <label> Sold For</label>
        <input type="text" name = "selling_price" Placeholder = "Sale price of Product"><br>
        <label> NAFDAC </label>
        <input type="text" name = "NAFDAC" maxLength=15><br>
        <input type="submit" name = "submit" value="Add Product">
        </form>
        </div>
</div>
<script>
$('form.add-product-form').on('submit', function(e) {
    e.preventDefault();
    url = $(this).attr('action');
    data = {
        name: $('form.add-product-form input[name=name]').val(),
        desc: $('form.add-product-form textarea[name=desc]').val(),
        category: $('form.add-product-form select[name=category]').val(),
        quantity_in: $('form.add-product-form input[name=quantity_in]').val(),
        cost_price: $('form.add-product-form input[name=cost_price]').val(),
        selling_price: $('form.add-product-form input[name=selling_price]').val(),
        NAFDAC: $('form.add-product-form input[name=NAFDAC]').val(),
    };
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            $('form.add-product-form input[type=submit]')
                .css({
                    'value': 'Adding Product..', 
                    'disabled': 'disabled'
                });
        },
        success: function () {
            $('form.add-product-form input[type=submit]')
                .css({
                    'value': 'Add Product', 
                    'enabled': 'enabled'
                })
        }
    }).done(
        function() {
            $('form.add-product-form input:not([type=submit]), form.add-product-form textarea').val('');
        }
    );
});
</script>
<?php
GeneralDocInterface::footer();
?>

</html>