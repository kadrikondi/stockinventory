<?php
require_once 'productClass.php';
$product = new \Pharm\Product;
$pr = $product->viewAllProducts();
?>
    <!-- <div style = "text-align: right; margin-right: 7em;"><a href = "buyProduct.php" class = "link">Buy product</a></div> -->
<table class = "products-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Sold for</th>
            <th>NAFDAC</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < sizeof($pr); $i++) {
        extract($pr[$i]);
    ?>
        <tr>
            <td><?= $name ?></td>
            <td><?= $description ?></td>
            <td><?= $category ?></td>
            <td><?= $quantity_remaining ?></td>
            <td>N <?= $cost_price ?></td>
            <td>N <?= $selling_price ?></td>
            <td><?= $NAFDAC ?></td>
            <td>
                <a href="update_product.php?id=<?= $id ?>&action=update&name=<?= $name ?>&description=<?= $description ?>&category=<?= $category ?>&quantity_in=<?= $quantity_in ?>&quantity_out=<?= $quantity_out ?>&quantity_remaining=<?= $quantity_remaining ?>&quantity_damaged=<?= $quantity_damaged ?>&cost_price=<?= $cost_price ?>&selling_price=<?= $selling_price ?>&NAFDAC=<?= $NAFDAC ?>">Edit</a>
                <a class = "delete" href="update_product.php?id=<?= $id ?>&action=delete">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<script>
$('.products-table a').on('click', function(e) {
    e.preventDefault();
    k = $(this);
    url = $(this)
        .attr('href');
    if(k.hasClass('delete')) {
        appender = 0;
    }
    $.ajax({
        url: url,
        beforeSend: function() {
            $('.products-table a')
                .show();
            k.hide();
            $('.products-edit-class')
                .remove();
        },
        success: function(data) {
            if(typeof appender !== "undefined"){
                $('.settings-menu')
                    .trigger('click');
            } else {
                $('.appended')
                    .append(
                        $('<div/>')
                            .addClass('products-edit-class')
                            .css('display', 'inline-block')
                            .html(data)
                    );
            }
            
        }
    })
});
</script>