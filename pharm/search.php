<?php
use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;
use Pharm\Customer as Customer;

require_once 'messageClass.php';

require_once 'productClass.php';

$product = new Product;
$search = $product->search($_REQUEST['data']);


if (is_array($search)) {
    $i = 0;
    while ($i < sizeof($search)) {
        extract($search[$i]);
    ?>
    <div class = "product-search <?=$name.$id?>">
        <!-- <input type="checkbox" name="buy<?=$id?>" id="buy<?=$id?>" value=$id> -->
        <label class = "rem"><?=$quantity_remaining?></label>
        <label class = "name" style ="font-weight: bolder; margin-left: 2px; width: 8em;" for = "buy<?=$id?>}"><?=$name?></label>
        <label class = "price" style = "margin-left: 2px; display: none; width: 4em;">N <?=$selling_price?></label>
        <input 
            class = "quantity" 
            style = "display: none; vertical-align: bottom; padding: 5px;border: 1px solid; margin-left: 5px; width: 50px;" 
            min=1
            value = 0
            max=<?=$quantity_remaining?>
            type="number"
            name="quantity<?=$id?>" id="quantity<?=$id?>">
        <!-- <label class = "set add-subtract adder"> + </label> -->
        <!-- <label class = "set add-subtract substracter"> - </label> -->
        <label class = "id" style = "display:none"><?=$id?></label>
        <a href ="" class ="add_to_product"> Pick </a>
        <a href ="" class = "remove_from_products" style= "display:none;"> &times; </a>
    </div>
    <?php
        $i++;
    }
} else {
    echo 'No product found';
}
?>
<script>

const validateQuantity = (data) => {
    const max = parseInt(data.target.max)
    const min = parseInt(data.target.min)
    const value = parseInt(data.target.value)
    if (data.type === 'onchange'|| data.type === "keyup") {
        if (value > max) {
            data.target.value = max
        }
        if (value < min) {
            data.target.value = min
        }
    }
    if (data.type === 'focusout') {
        console.log(value)
        if (isNaN(value)) {
            data.target.value = 1
        }
    }
}

$('.add_to_product').on('click', function(e) {
    e.preventDefault();
    l = $('form.products-rec').find('.product-search');
    en = $(this);
    goAhead = true;
    $.each(l, function (k, v) {
        v = $(v);
        if(v.find('label.name').html() == en.siblings('.name').html())
        {
            goAhead = false;
            v.find('label.set.adder').trigger('click');
        }
    });

    if(goAhead) {   
        clone = $(this).closest('.product-search').clone();
        clone.find('.add_to_product').hide();
        clone.find('.set')
        .css('display', 'inline-block')
            .on('click', function() {
                th = $(this).siblings('label[type=number]');
                if($(this).hasClass('adder')) {
                    if(Number(th.text()) < Number(th.siblings('label.rem').text())) {
                        th.html(Number(th.text()) + 1);
                    }
                }else {
                    if(Number(th.text()) >= 1){
                        th.html(Number(th.text()) - 1);
                    }
                }
                th.css('background-color', 'unset');

                //
                total = 0;
                prds = $('.product-search');
                $.each(prds, function(k, v) {
                    v = $(v);
                    current = Number(v.find('label.quantity').text()) * Number(v.find('label.price').text().slice(1));
                    total += current;
                });
                $('.total').html('Total: N'+total);
            });
        clone.find('.rem').hide();
        clone.find('.price').show();
        clone
            .find('input[type=number]').show()
            .on('keyup change focusout', (e) => {
                validateQuantity(e)
            })
        ;
        clone
            .find('.remove_from_products')
            .css('display', 'inline-block')
            .on('click', function(e) {
                e.preventDefault();
                $(this).closest('.product-search').remove();
            });
        $('form.products-rec .form-body').prepend(clone);
    }
});
</script>