<?php
if(!isset($_REQUEST['action']) && !isset($_REQUEST['submit'])){
    header('location: allproducts.php');
}

require_once 'ProductClass.php';

extract($_REQUEST);
if(isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $product = new \Pharm\Product;
    $return = $product->updateProducts(
        $uname, $udescription, $ucategory, $quantity_in, 
        $uquantity_out, $uquantity_damaged,
        $uquantity_remaining, $ucost_price, 
        $uselling_price, $id
    );
    switch(array_key_exists('error', $return)){
        case true:
            echo $return['error']['message'];
        break;
        case false:
            header('location: allproducts.php?mesage=Last update was successful&type=successful');
    }
}
switch($action) {
    case 'update': 
?>
<form class = "edit-product" action = "pr_product.php" method="post" style = "width: 50em;">
    <div class = "form-head">Edit</div>
    <div class = "form-body">
        <div class = "details" style = "font-weight:600;">Details</div>
        <div class = "details-body">
            <label>name</label>
            <input type="text" name="uname" maxlength="30" value="<?=$name?>">

            <label>Description</label>
            <input type="text" name="udescription" maxlength="100" value="<?=$description?>">

            <label>Category</label>
            <input type="text" name="ucategory" maxlength="100" value="<?=$category?>">
            
            <label>NAFDAC</label>
            <input type="text" name="uNAFDAC" maxlength="20" value="<?=$NAFDAC?>">
        </div>

        <div class = "quantity" style = "font-weight:600;">Quantity</div>
        <div class = "quantity-body">
            <label>In</label>
            <input type="number" name="uquantity_in" maxlength="2" value="<?=$quantity_in?>">

            <label>Out</label>
            <input type="number" name="uquantity_out" maxlength="2" value="<?=$quantity_out?>">

            <label>Damaged</label>
            <input type="number" name="uquantity_damaged" maxlength="2" value="<?=$quantity_damaged?>">

            <label>Remaining</label>
            <input type="number" name="uquantity_remaining" maxlength="2" value="<?=$quantity_remaining?>">
        </div>

        <div class = "prices" style = "font-weight:600;">Prices</div>
        <div class = "prices-body">
            <label>Cost</label>
            <input type="text" name="ucost_price" maxlength="5" value="<?=$cost_price?>">

            <label>Sale</label>
            <input type="text" name="uselling_price" maxlength="5" value="<?=$selling_price?>">

           
        </div>
            <input type = "hidden" name = "id" value = "<?=$id?>">
        <div>
            <input type="submit" name = "submit" value = "Update">
        </div>
    </div>
</form>
<script>
$('.details').on('click', function() {
    $('.details-body').toggle();
    $('.quantity-body').hide();
    $('.prices-body').hide();
});

$('.quantity').on('click', function() {
    $('.quantity-body').toggle();
    $('.details-body').hide();
    $('.prices-body').hide();
});

$('.prices').on('click', function() {
    $('.prices-body').toggle();
    $('.quantity-body').hide();
    $('.details-body').hide();
});

$('form.edit-product').on('submit', function(e) {
    e.preventDefault();
    url = $(this).attr('action');
    data = {
        'id':$('form.edit-product input[name=id]').val(),
        'uname': $('form.edit-product input[name=uname]').val(),
        'udescription': $('form.edit-product input[name=udescription]').val(),
        'ucategory': $('form.edit-product input[name=ucategory]').val(),
        'ucost_price': $('form.edit-product input[name=ucost_price]').val(),
        'uNAFDAC': $('form.edit-product input[name=uNAFDAC]').val(),
        'uselling_price': $('form.edit-product input[name=uselling_price]').val(),
        'uquantity_in': $('form.edit-product input[name=uquantity_in]').val(),
        'uquantity_out': $('form.edit-product input[name=uquantity_out]').val(),
        'uquantity_damaged': $('form.edit-product input[name=uquantity_damaged]').val(),
        'uquantity_remaining': $('form.edit-product input[name=uquantity_remaining]').val()
    };

    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            $('edit-product input[type=submit]')
                .css({
                    'value': 'Saving..', 
                    'disabled': 'disabled'
                });
        },
        success: function () {
            $('edit-product input[type=submit]')
                .css({
                    'value': 'Update', 
                    'enabled': 'enabled'
                })
        }
    }).done(
        function() {
            $('.products-card')
                .trigger('click');
            $('.products.card')
                .trigger('click');
        }
    );
});
</script>
<?php
    break;
    case 'delete':
        echo 'last delete was not successful"&category=error';
    break;
    default:
        //

}
