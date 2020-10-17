<?php
require_once 'ProductClass.php';
$product = new \Pharm\Product;
$pr = $product->viewAllProducts();
$total_quantity = 0;
$total_cost = 0;
$total_sales = 0;
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
<div  style="overflow: auto; display:block; height:500px;">
   <input id="gfg" type="text" 
                 placeholder="Search here"> 

    <table class = "products-table"  >
        <thead>
            <tr style="width:100%;">
                <th>S/N</th>
                <th>Name</th>
                <th>Actions</th>
                <th>Description</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Cost Price</th>
                <th>Sold for</th>
                <th>Cost</th>
                <th>Sales</th>
                <th>Profit</th>
                <th>Expiry</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody id="geeks">
        <?php

        for ($i = 0; $i < sizeof($pr); $i++) {
            extract($pr[$i]);
            $expiry = ($exp < 30) ? 'expiring' : '';
            $info = 'expires in '.$exp.' days';
            $cost = $quantity_remaining * $cost_price;
            $sales = $quantity_remaining * $selling_price;
            $profit = $sales - $cost;
            $total_cost += $cost;
            $total_sales += $sales;
            $total_quantity += $quantity_remaining;
            ?>
            <tr class="<?=$expiry?>">
                <td><?=$i+1?></td>
                <td><?= $name ?></td>
                <td>
                    <a href="update_product.php?id=<?= $product_id ?>&action=update&name=<?= $name ?>&description=<?= $description ?>&category=<?= $category ?>&quantity_in=<?= $quantity_in ?>&quantity_out=<?= $quantity_out ?>&quantity_remaining=<?= $quantity_remaining ?>&quantity_damaged=<?= $quantity_damaged ?>&cost_price=<?= $cost_price ?>&selling_price=<?= $selling_price ?>">Edit</a>
                    <a class = "delete" href="update_product.php?id=<?= $product_id ?>&action=delete">Delete</a>
                </td>
                <td><?= $description ?></td>
                <td><?= $category ?></td>
                <td><?= $quantity_remaining ?></td>
                <td>N <?= $cost_price ?></td>
                <td>N <?= $selling_price ?></td>
                <td>N <?= $cost ?></td>
                <td>N <?= $sales ?></td>
                <td>N <?= $profit ?></td>
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
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div>
    <div style="text-align:center; padding:10px">
        <div class="inf">
            <div class="d-title">Total quantity of products in stock</div>
            <div class="d-child" id="tq"><?=$total_quantity?></div>
        </div>
        <div class="inf">
            <div class="d-title">Possible sales </div>
            <div class="d-child" id='ts'>N <?=$total_sales?></div>
        </div>
        <div class="inf">
            <div class="d-title">Possible Cost </div>
            <div class="d-child" id='tc'>N <?=$total_cost?></div>
        </div>
        <div class="inf">
            <div class="d-title">Possible Profit</div>
            <div class="d-child" id='pr'>N <?=$total_sales - $total_cost?></div>
        </div>
    <div>
</div>
<script>
          var tQ= '<?php echo $total_quantity;?>'
          var totalS='<?php echo $total_sales;?>'
           var totalC='<?php echo $total_cost;?>'
             var profit='<?php echo $total_sales - $total_cost;?>'
    //    add comma to thousand values eg 333333 will b 33,3333
            function NC(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}
var  tq= document.getElementById("tq");
 tq.innerHTML= 'N '+ NC(tQ);
  var  ts= document.getElementById("ts");

ts.innerHTML= 'N '+ NC(totalS);
 var  tc= document.getElementById("tc");
 tc.innerHTML= 'N '+ NC(totalC);
 var  pr= document.getElementById("pr");
 pr.innerHTML= 'N '+ NC(profit);
 

            </script>
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
// search implement
 $(document).ready(function() { 
                $("#gfg").on("keyup", function() { 
                    var value = $(this).val().toLowerCase(); 
                    $("#geeks tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                }); 
            }); 
</script>
