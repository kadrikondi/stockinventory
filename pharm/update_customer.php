<?php
include 'customerClass.php';
use Pharm\Customer;
extract($_REQUEST);
$manager = new Customer;

if(isset($action) && $action == 'delete') {
    $customer->delete($id);
    header('location: manager.php?message=Your last action to delete manager was successful');
}
?>
<form class = "customer-edit-form" action = "delete_customer.php" method = "get">
    <div class = "form-head"> Edit Customer Details </div>
    <div class = "form-body">
        <input type="hidden" name="id" value = <?=$id?>>
        <label>Name</label>
        <input type="text" name="name" value = <?=$name?> required><br>
        <label>Phone</label>
        <input type="text" name="phone" value = <?=$phone?> required><br>
        <label> Location </label>
        <input type="text" name="location" value = <?=$location?> required><br>
        <input type="submit" name="submit" value="Edit Customer Details">
    </div>
</form>
<script>
$('.customer-edit-form').on('submit', function(e) {
    e.preventDefault();

    url = $(this)
        .attr('action');
    
    data = {
        'id': $('.customer-edit-form input[name=id]').val(),
        'name': $('.customer-edit-form input[name=name]').val(),
        'phone': $('.customer-edit-form input[name=phone]').val(),
        'location': $('.customer-edit-form input[name=location]').val(),
    };
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            $('customer-edit-form input[type=submit]')
                .css({
                    'value': 'Saving..', 
                    'disabled': 'disabled'
                });
        },
        success: function () {
            $('customer-edit-form input[type=submit]')
                .css({
                    'value': 'Edit Customer Details', 
                    'enabled': 'enabled'
                })
        }
    }).done(
        function() {
            // $('.settings-menu')
            // .trigger('click');
        }
    );
});
</script>