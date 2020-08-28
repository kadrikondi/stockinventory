<?php

use Pharm\Product;
use UserInterface\GeneralDocInterface;
use UserInterface\Product as UserInterfaceProduct;
use Pharm\Customer as Customer;

require_once 'messageClass.php';
require_once 'productClass.php';

require_once 'customerClass.php';
$customer = new Customer;
$cust = $customer->fetch();

$product = new Product;
$cat = $product->viewProductsCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Product</title>
</head>

<body>
    <div>
        <form action="generate_reciept.php" class="reciept" type="post">

            <div class="form-head">Sell Products</div>
            <div class = "form-body">
                <div class = "search-div">
                    <input class = "search" placeholder = "Search Product..." type = "search">
                </div>
                <div class = "results">
                    Products you search will show up here.
                </div>
            </div>
        </form>
        <form action="gen_reciept.php" class="products-rec" type="post">
            <div class="form-head">Reciept</div>
            <div class="form-body"></div>
            <div>
            <select name="customer">
            <?php
            for ($k = 0; $k < sizeof($cust); $k++) {
                extract($cust[$k], EXTR_PREFIX_ALL, 'm');
            ?>
                <option><?= $m_name ?></option>
            <?php
            }
            ?>
            </select>
            <label class = "total"></label>
            <input type="submit" name="reciept" value="Generate Reciept"></div>
        </form>
    </div>
    <script>
        // Searching Products
        
        $('.search').on('keyup', function() {
            console.log('hi');
            results = $('.results');
            str = $(this).val();
            var returned;
            $.ajax({
                url: 'search.php',
                data: {
                    'data': str
                },
                beforeSend: () => {
                    results.html('');
                },
                success: (data) => {
                    returned = data;
                }
            }).done(() => {
                results.html(returned);
            });
        });

        $('form.products-rec').on('submit', function(e) {
            e.preventDefault();
            var this_data;
            var data = [];
            k = $(this);
            var url = k.attr('action');
            listed = k.find('div.product-search');
            var run = true;
            $.each(listed, function(k, v) {
                v = $(v);
                if(v.find('label.quantity').html() == 0) {
                    run = false;
                    v.find('label.quantity').css('background-color', 'red');
                }
            });
            if(run){
                $.each(listed, function(k, v){
                    v = $(v);
                    this_data = {
                        'id': v.find('label.id').html(),
                        'number': v.find('label.quantity').html(),
                        'amount': v.find('label.price').html().slice(1),
                    }
                    data.push(this_data);
                });
                customer = k.find('select[name=customer]').val();
                $.ajax({
                    url: url,
                    data: $.param({customer: customer})+'&'+$.param({data: data}),
                    beforeSend: function () {
                        k.find('input[type=submit]').hide();
                        k.find('a.remove_from_products, a.add_to_product').hide();
                    },
                    success: function () {

                    }
                });

                $('body .container').hide();
                $('body').append(
                    $('<a />').on('click', function(e) {
                        e.preventDefault();
                        window.location = 'index.php';
                    }).html('Close'),
                k);
                window.print();

            }
            else {
                x = $('form.products-rec .form-body')
                    .css('background-color', 'rgba(255,0,0,.07');
                $('form.products-rec .form-body')
                x.prepend(
                    $('<div />')
                    .addClass('error')
                    .append('Some inputs have no quantity!')
                );
                setTimeout(function() {
                    x.css('background-color', '#fff');
                    x.find('.error').remove();
                }, 5000);
            }
        });
    </script>
</body>
<?php
    GeneralDocInterface::footer();
?>

</html>