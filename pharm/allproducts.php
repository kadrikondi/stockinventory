<?php
require_once 'ProductClass.php';
$product = new \Pharm\Product;
$pr = $product->viewAllProducts();
?>
<style>
.expiring {
    background-color: #ff7878!important;
}
.notify {
    display: none;
    position: fixed;
    top: 1em;
    right: 1em;
    padding: .5em;
    border-radius: 4px;
    border: 1px solid gainsboro;
    font-size: 20px;
    background: #77ffab;
    width: 10em;
}
</style>
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
            <th>Expiry</th>
            <th>Info</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php

    for ($i = 0; $i < sizeof($pr); $i++) {
        extract($pr[$i]);
        $expiry = ($exp < 30) ? 'expiring' : '';
        $info = 'expires in '.$exp.' days'
        ?>
        <tr class="<?=$expiry?>">
            <td><?= $name ?></td>
            <td><?= $description ?></td>
            <td><?= $category ?></td>
            <td><?= $quantity_remaining ?></td>
            <td>N <?= $cost_price ?></td>
            <td>N <?= $selling_price ?></td>
            <td><?= $expiry_date?></td>
            <td><?php if($expiry === 'expiring'){ echo $info; }?>
            <?php 
            if ($expiry === 'expiring') {
            ?>
            <br>
            <button class = "remove" data='<?=json_encode($pr[$i])?>' style="border: none; background: transparent; cursor:pointer; color: white;">remove from store</button>
            <?php
            }
            ?></td>
            <td>
                <a href="update_product.php?id=<?= $product_id ?>&action=update&name=<?= $name ?>&description=<?= $description ?>&category=<?= $category ?>&quantity_in=<?= $quantity_in ?>&quantity_out=<?= $quantity_out ?>&quantity_remaining=<?= $quantity_remaining ?>&quantity_damaged=<?= $quantity_damaged ?>&cost_price=<?= $cost_price ?>&selling_price=<?= $selling_price ?>">Edit</a>
                <a class = "delete" href="update_product.php?id=<?= $product_id ?>&action=delete">Delete</a>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
<div class = "notify">
    <div>Successful</div>
    <div style="font-size: 10px">Reload to see changes</div>
</div>
<script>
$('button.remove').on('click', function () {
    data = $(this).attr('data')
    $.ajax({
        url: 'remove_expired.php',
        data: JSON.parse(data),
        success: function () {
            $('.notify').css('display', 'block')
            setTimeout(function () {
                $('.notify').css('display', 'none')
            }, 2000)
        }
    })
})

$('.products-table a').on('click', function(e) {
    e.preventDefault()
    k = $(this)
    url = $(this)
        .attr('href')

    if(k.hasClass('delete')) {
        appender = 0
    }

    $.ajax({
        url: url,
        beforeSend: function() {
            $('.products-table a')
                .show()
            k.hide()
            $('.products-edit-class')
                .remove()
        },
        success: function(data) {
            if(typeof appender !== "undefined") {
                $('.settings-menu')
                    .trigger('click')
            } else {
                $('.appended')
                    .append(
                        $('<div/>')
                            .addClass('products-edit-class')
                            .css('display', 'inline-block')
                            .html(data)
                    )
            }
        }
    })
});
</script>
