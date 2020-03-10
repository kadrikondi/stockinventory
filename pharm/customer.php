<?php
session_start();
include 'customerClass.php';
include 'messageClass.php';

use Pharm\Customer;


$customer = new Customer;
$man = $customer->fetch();

extract($_REQUEST);

if (isset($message)) {
    $type = (!isset($error)) ? 0 : 1;
    $msg = new \UserInterface\message;
    $msg->show($message, $type);
}
?>
<h1 style = "margin-bottom: 1em;">Customers</h1>
    <table class = "customer-table">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Location</th>
            </tr>
        </thead>
        <?php
        for ($i = 0; $i < sizeof($man); $i++) {
            extract($man[$i], EXTR_PREFIX_ALL, 'f');
        ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $f_name ?></td>
                <td><?= $f_phone ?></td>
                <td><?= $f_location ?></td>
                <td>
                    <a class = "edit" href="update_customer.php?id=<?= $f_id ?>&action=update&name=<?= $f_name ?>&phone=<?=$f_phone?>&location=<?= $f_location ?>">Edit</a>
                    <!-- <a  class = "delete" href="update_customer.php?id=<?= $f_id ?>&action=delete">Delete</a> -->
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <form class = 'customer-class' action = "add_a_customer.php">
    <div class = "form-head"> Add a customer </div>
    <div class = "form-body">
    <label>Name</label>
    <input type="text" name="user" required><br>
    <label>Phone</label>
    <input type="text" name="phone" required><br>
    <label> Location </label>
    <input type="location" name="location" required><br>
    <input type="submit" name="submit" value="Add Customer">
    </div>
</form>
<script>
$('form.customer-class').on('submit', function (e) {
    e.preventDefault();
    k = $(this)
        .closest('form');
    url = k.attr('action');

    data = {
        'user': k.find('input[name=user]').val(),
        'phone': k.find('input[name=phone]').val(),
        'location': k.find('input[name=location]').val(),
    };

    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            $('input[type=submit]')
            .attr({
                'value': 'Processing...', 
                'disabled': 'disabled'
            });
        },
        success: function (data) {
            $('.form-body')
                .prepend($('<div />')
                .addClass('message')
                .html(data));

            $('input[type=submit]')
                .attr({
                    'value': 'Add Customer', 
                    'enabled': 'enabled'
                });

            // $('.settings-menu')
            //     .trigger('click');
        }
    });   
});
$('.customer-table a').on('click', function(e) {
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
            $('.customer-table a')
                .show();
            k.hide();
            $('.customer-edit-class')
                .remove();
        },
        success: function(data) {
            if(typeof appender !== "undefined"){
                // $('.settings-menu')
                //     .trigger('click');
            } else {
                $('.appended    ')
                    .append(
                        $('<div/>')
                            .addClass('customer-edit-class')
                            .css('display', 'inline-block')
                            .html(data)
                    );
            }
            
        }
    })
});
</script>