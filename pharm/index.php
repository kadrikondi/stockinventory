<?php
session_start();
if(!isset($_SESSION['name'])) {
    header('location: logout.php');
}
extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinny Pharmaceuticals</title>
    <link rel="stylesheet" href="font-awesome-5/css/fontawesome-all.min.css">
    <link href="font-face.css" rel="stylesheet" media="all">

    <!-- <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all"> -->
    <!-- <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all"> -->
    <link rel = "stylesheet" href="public/css/style.css" />
</head>
<body>
    <div class = "container">
        <!-- side menu -->
        <div class = "left-container">
            <div class = "logo">
               <a href="index.php"> <img src = "Capture111.png"></a>
            </div>
            <div class = "menu-container">
                <span style = "margin-left: 3em;">Logged in:</span> <div class="manager"><?=$name?></div>
               <div><ul style="list-style-type:none "><li><a href="index.php" style="padding:5px; background-color:#007480;color: white;">Home</a></li></ul> </div> 
                <?php
                if(isset($admin)){
                ?>
                <div class = "menu-item settings-menu">Settings</div>
                <?php
                }
                ?>
                <div class = "menu-item"><a href = "logout.php">Logout</logout></a></div>
            </div>
        </div>
        <div class = "right-container" style = "">
            <div class = "topbar">
                
            </div>
            <div class = "notification">
                <div class = "notification-body" style = "height: 15em;">

                </div>
                <div class = "notification-inner" style = "position: relative;">
                    <div class = "notification-message" style = "padding:4px; font-size: 12px; cursor:pointer;font-weight: bolder;font-family: Calibri">
                        Add a product
                    </div>
                </div>

                <div class = "notification-real" style = "position: relative;">
                    <div class = "notification-message" style = "padding:4px; font-size: 12px; cursor:pointer;font-weight: bolder;font-family: Calibri;padding:2px; background-color:red">
                       <span style="color:white"> Check For Expired Product</span>
                    </div>
                </div>
                
            </div>
            <div class = "content">
                <div class = "huge-card">
                    <div class = "card products-card">
                        <div class = "card-main">Products</div>
                        <div class = "card-dets">Products in store</div>
                    </div>

                    <div class = "card customer-card">
                        <div class = "card-main">Customers</div>
                        <div class = "card-dets">View customer list</div>
                    </div>

                    <div class = "card addproducts-card">
                        <div class = "card-main">Add product</div>
                        <div class = "card-dets">Add to products</div>
                    </div>

                    <div class = "card records-card">
                        <div class = "card-main">Records</div>
                        <div class = "card-dets">View previous sales</div>
                    </div>

                    <div class = "card sellproduct-card">
                        <div class = "card-main">Sell Product</div>
                        <div class = "card-dets">to customer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        var content = $('.content');
        var products = 0;
        var check;
        $('.card').on('click', function() {
            e = $(this);
            if($(this).hasClass('products-card')) {
                url = 'allproducts.php';
            } else if ($(this).hasClass('customer-card')) {
                url = 'customer.php';
            } else if ($(this).hasClass('addproducts-card')) {
                url = "addproducts.php";
            } else if ($(this).hasClass('records-card')){
                url = "reciepts.php";
            } else if ($(this).hasClass('sellproduct-card')) {
                url = "buyproduct.php";
            }
            if(typeof check != "undefined") {
                if(e.get(0) === check.get(0)) {
                    shrinker ();
                    return;
                }
            }
            
            
            
                
            $.ajax({
                url: url,
                beforeSend: function() {
                    $('.card').addClass('small');
                },
                success: function(data) {
                    $('.appended').remove();
                    content.append($('<div />').addClass('appended').append(data));
                }
            });
            check = $(this);
        });
        shrinker = function () {
            $('.card').removeClass('small');
            $('.appended').remove();
            check = undefined;
        }
        //side Menus
        $('menu-item').on('click', function() {
            if($(this).hasClass('dash-menu')) {
                shrinker();
            }
            if($(this).hasClass('products-menu')) {
                $('.products-card').trigger('click');
            }
        });

        $('.settings-menu').on('click', function() {
            
            $.ajax({
                url: 'manager.php',
                beforeSend: () => {
                    $('.content').html('');    
                },
                success: (data) => {
                    $('.content').html(data)
                }
            });
        });

        $('.notification-inner').on('click', function() {
            url = 'product_expiry.php';
            n = $(this).siblings('.notification-body');
            $.ajax({
                url: url,
                beforeSend: function () {
                    n.append(
                        $('<div />')
                            .addClass('loading')
                            .append('loading...')
                    );
                    n.removeClass('overflow')
                },
                success: function(data) {
                    n.html(data)
                }
            });

        });
        $('.notification-real').on('click', function() {
            url = 'notification.php';
            n = $(this).siblings('.notification-body')
            n.toggle();
            $.ajax({
                url: url,
                beforeSend: function () {
                    n.append(
                        $('<div />')
                            .addClass('loading')
                            .append('loading...')
                    );
                    n.addClass('overflow');
                },
                success: function(data) {
                    n.html(data)
                }
            });
        });
    </script>
</body>
</html>