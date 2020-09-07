<?php

use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;

require_once 'messageClass.php';
require_once 'ProductClass.php';
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

<style>
    .product-searched {
        position: absolute;
        top: 100%;
        right: 0;
        left: 6em;
        background-color: white;
    }
    .product-name {
        line-height: 30px;
        border: 2px solid transparent;
        cursor: pointer;
        padding-left: .5em;
    }
    .product-name:hover {
        border: 2px solid;
        font-weight: 700;
    }
</style>
<div>
<form class = "add-product-form" action = "add_new_product.php">
    <div class = "form-head">Add New Product</div>
    <div class = "form-body">
        <div class="info"></div>
        <div style="position: relative">
            <label>Product Name</label>
            <input type="search" autocomplete="off" name="name" Placeholder = "Drug Name"><br>
            <div class="product-searched">
                
            </div>
        </div>
        <label id = "desc">Description</label>
            <textarea type="text" name="desc" placeholder = "Short description..."></textarea><br>
        <label id = "cat">Category</label>
        <select name="category">
            <?php
            $intface = new UserInterfaceProduct;
            $intface->new($cat);
            ?>
        </select>
        <a href="#new">New category</a>
        <br />
        <div>
            <label>Quantity In</label>
            <input type=number name = "quantity_in" placeholder = "Quantity" min = 0><br>
        </div>
        <div>
            <label id = "cost"> Cost </label>
            <input type="text" name = "cost_price" placeholder = "Cost Price of Product"><br>
        </div>
        <div>
            <label id = "sold"> Sold For</label>
            <input type="text" name = "selling_price" Placeholder = "Sale price of Product"><br>
        </div>
        <div>
            <label> Expiry date </label>
            <input type= "date" name = "date" Placeholder = "Expiry date"><br>
        </div>
        <input type="submit" name = "submit" value="Add Product">
        </form>
        </div>
</div>
<script>
var existing = false
var storedId = ""

const autoUpdateDOM = (existing) => {
    existing 
        ? $('input[name=cost_price], label#cost').hide()
        : $(' input[name=cost_price], label#cost').show()

    existing 
        ? $(' textarea[name=desc],  label#desc').hide()
        : $(' textarea[name=desc],  label#desc').show()
    existing 
        ? $(' select[name=category],  label#cat').hide()
        : $(' select[name=category],  label#cat').show()
    existing 
        ? $(' input[name=selling_price],  label#sold').hide()
        : $(' input[name=selling_price],  label#sold').show()
    form = $('form.add-product-form .form-body')
    form.find('.info').html('')
    existing 
        ? form.find('.info').append(
            $('<div />').html('Adding to an existing product!')
        )
        : form.find('.info').append(
            $('<div />').html('Creating a new product!')
        )
}

$("a[href='#new']").on('click', function(e) {
    e.preventDefault()
    $(this).hide();
    newCategory = $('<input />')
        .attr({
            'class': 'category',
            'name': 'category',
            'placeholder': 'Type a new Category here',
            'type': 'text'
        })
    selectCategory = $(this).siblings('[name=category]').remove();
    
    $(this).before(
        newCategory
    )
})

var existing = false;
$('form.add-product-form input[name=name]').on('keyup', function () {
    data = $(this).val()
    c = $(this)
    autoUpdateDOM(existing)
    storedId = ""
    url = 'search_product_name.php'
    if(data.trim() === '') {
        $('.product-searched')
            .html('')
            .attr('style', 'border: 1px solid transparent')        
    }else{
        $.ajax({
            url: url,
            data: {data},
            beforeSend: function () {
                $('.product-searched').html('')
            },
            success: function(data) {
                if (data) {
                    $('.product-searched')
                        .html('')
                        .attr('style', 'border: 1px solid gainsboro')
                }
                $.each(JSON.parse(data), function(k, v) {
                    search = $('.product-searched')
                    .append(
                        $('<div />')
                            .addClass('product-name')
                            .html(v.name)
                            .on('click', function() {
                                c.val(v.name)
                                storedId = v.id
                                $(this).closest('.product-searched').html('')
                                existing = true
                                autoUpdateDOM(existing)
                            })
                    )
                })
            }
        })
    }
})

$('div:not([class=product-searched])').on('click', function() {
    $('.product-searched').html('')
        .attr('style', 'border: 1px solid transparent')
})

$('form.add-product-form').on('submit', function(e) {
    e.preventDefault();
    url = $(this).attr('action');
    data = {
        name: $('form.add-product-form input[name=name]').val(),
        desc: $('form.add-product-form textarea[name=desc]').val(),
        category: $('form.add-product-form [name=category]').val(),
        quantity_in: $('form.add-product-form input[name=quantity_in]').val(),
        cost_price: $('form.add-product-form input[name=cost_price]').val(),
        selling_price: $('form.add-product-form input[name=selling_price]').val(),
        date: $('form.add-product-form input[name=date]').val(),
        id: storedId ? storedId : '',
        existing: existing
    };
    console.log(data)
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
            location.reload()
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
