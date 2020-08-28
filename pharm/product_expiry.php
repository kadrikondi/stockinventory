<form class = "expiry" action = "expiry_save_product.php"> 
    <div class = " form-head">Product Expiry</div>
    <div class = "form-body">
        <input type= "text" placeholder = "Name" name = "name"> 
        <input type= "number" Placeholder = "Quantity" min=0 name = "quantity">
        <input type= "date" name = "date" Placeholder = "Expiry date">
        <input type = "submit" value="Add Product">
    </div>
</form>

<script>
$('form.expiry').on('submit', function(e) {
    e.preventDefault()
    k = $(this)
    data = {
        name: k.find('input[name=name]').val(),
        quantity: k.find('input[name=quantity]').val(),
        date: k.find('input[name=date]').val(),
    }
    url = 'expiry_save_product.php';
    n = $('.notification-body');
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            n.html('');
            n.append(
                $('<div />')
                    .addClass('loading')
                    .html('Adding product...')
            )
        }, 
        success: function (data) {
            if(data) {
                $('.notification-inner').trigger('click');
                $('.notification-inner').trigger('click');
            }
            
        }
    });
    
});
</script>