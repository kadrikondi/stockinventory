<?php
include 'ManagerClass.php';
use Pharm\Manager;
extract($_REQUEST);
$manager = new Manager;

if(isset($action) && $action == 'delete') {
    $manager->delete($id);
    header('location: manager.php?message=Your last action to delete manager was successful');
}
?>
<form class = "edit-form" action = "delete_manager.php" method = "get">
    <div class = "form-head"> Edit Manager Details </div>
    <div class = "form-body">
        <input type="hidden" name="id" value = <?=$id?>>
        <label>Staff ID </label>
        <input type="text" name="staff_id" value = <?=$staff_id?> required><br>
        <label>Username</label>
        <input type="text" name="username" value = <?=$username?> required><br>
        <label>Password</label>
        <input type="text" name="password" value = <?=$password?> required><br>
        <label> Phone </label>
        <input type="phone" name="phone" value = <?=$phone?> required><br>
        <label> E-mail </label>
        <input type="email" name="email" value = <?=$email?> required><br>
        <label> Address </label>
        <textarea name="address" required><?=$address?></textarea><br>
        <input type="submit" name="submit" value="Edit Manager Details">
    </div>
</form>
<script>
$('.edit-form').on('submit', function(e) {
    e.preventDefault();

    url = $(this)
        .attr('action');
    
    data = {
        'id': $('.edit-form input[name=id]').val(),
        'staff_id': $('.edit-form input[name=staff_id]').val(),
        'username': $('.edit-form input[name=username]').val(),
        'password': $('.edit-form input[name=password]').val(),
        'phone': $('.edit-form input[name=phone]').val(),
        'email': $('.edit-form input[name=email]').val(),
        'address': $('.edit-form textarea[name=address]').val(),
    }
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            $('edit-form input[type=submit]')
                .css({
                    'value': 'Saving..', 
                    'disabled': 'disabled'
                });
        },
        success: function () {
            $('edit-form input[type=submit]')
                .css({
                    'value': 'Edit Manager Details', 
                    'enabled': 'enabled'
                })
        }
    }).done(
        function() {
            $('.settings-menu')
            .trigger('click');
        }
    );
});
</script>