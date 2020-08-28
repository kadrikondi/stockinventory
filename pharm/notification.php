<?php
require_once 'ProductClass.php';

use Pharm\Product;

$product = new Product();
extract($_REQUEST);

$notification = $product->notify();
$notif_exp = $product->expired();
?>
<style>
.notify-inner {
    font-family: Calibri;
    padding: 5px;
    margin: 4px;
    border: 1px solid gainsboro;
    background-color: rgba(220,220,220, 0.5);
    border-radius: 4px;
}
.overflow {
    overflow: auto;
}
.small-info {
    font-size: 12px;
    font-familly: Calibri;
    padding: 4px;
}
.notify-inner:hover {
    background-color: rgba(255, 0,0, 0.25);
    border: 1px solid red;
}
</style>
<div class = "small-info">Click Expired product to remove.</div>
<?php
foreach($notification as $k => $v) {
    extract($v);
?>
    <div class="notify">
        <div class = "notify-inner">
            <div style = "font-weight: 600;display: inline-block;font-family: Calibri;"><?=$name?> (<?= $quantity?>)</div><div style = "font-size:11px; float:right;font-family: Calibri;">Expires soon</div></div>
    </div>
    <?php
}

if (is_array($notif_exp)) {
    foreach($notif_exp as $k=>$v) {
        extract($v);
    ?>
        <div class="notify expired" data-id = "<?=$id?>">
            <div class = "notify-inner" style = "cursor:pointer;"><div style = "font-weight: 600;display: inline-block;font-family: Calibri;"><?=$name?> (<?= $quantity?>)</div><div style = "font-size:11px; float:right;font-family: Calibri;">Expired</div></div>
        </div>
    <?php
    }
} else {
?>
    <div>No expired products</div>
<?php
}
?>
<script>
$('.notify.expired').on('click', function() {
    k = $(this);
    url = "delete_expired.php";
    data = {
        id: k.attr('data-id')
    }
    $.ajax({
        url: url,
        data: data,
        beforeSend: function () {
            k.remove();
            console.log(data);
        }
    });
});
</script>