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
    <style>
    *, *:after, *:before {
        font-size: 14px;
        font-family: Tahoma;
        margin: 0;
        user-select: none;
    }
    body{
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 1.625;
        color: #666;
        -webkit-font-smoothing: antialiased;
        transition: all 0.3s ease;
    }
    .logo {
        margin-top:8em;
        height: 10em;
    }
    .container {
        position: relative;
    }
    .left-container,
    .right-container {
        display:block;
    }
    .left-container {
        border-right: 2px solid gainsboro;   
        height: 100%;
        width: 20em;
        position: fixed;
    }
    .right-container {
        background-color: #d4d4d4;
        position: fixed;
        right:0;
        top:0;
        bottom:0;
        left: 20em;
        overflow: auto;
    }
    .menu-item {
        padding: 1em 3em;
        cursor:pointer;
        width: 12em;
    }
    .menu-item:hover {
        color: rebeccapurple;
    }
    .topbar {
        background: white;
        box-shadow: 11px 1px 12px #8e8b8b;
        position: fixed;
        left: 20em;
        right: 0;
        text-align: right;
    }
    .manager {
        padding: 20px;
        font-size: 16px;
        font-weight: 800;
        display: inline-block;
    }
    .content {
        margin-top:1em;
        text-align: center;
    }
    .card {
        background: white;
        border-radius: 8px;
        border: 1px solid #a59f9f;
        display: inline-block;
        padding: 3em 3em;
        margin: 2em;
        cursor: pointer;
        width: 10em;
        height: 4.5em;
        transition: all .15s ease-in-out;
    }
    .card:hover {
        background-color: #f1f1f1;
        box-shadow: 0px 0px 4px grey;
        color: #576f9c;
    }
    h1, h2, h3, h4, h5, h6 {
        color: #333333;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }
    .card-main {
        text-align: center;
        color: #333333;
        font-weight: 700;
        margin: 0;
        font-size: 18px;
        transition: all .5s ease-in-out;
    }
    .card:hover .card-main {
        color:#576f9c;
    }
    .card-dets {
        font-size: 15px;
    }
    .card.small {
        background: white;
        border-radius: 8px;
        border: 1px solid #a59f9f;
        display: inline-block;
        padding: .4em 0em;
        margin: 4px;
        cursor: pointer;
        width: 10em;
        height: 1.5em;
        transition: all .15s ease-in-out;
    }
    .card.small .card-main {
        font-size: 14px;
        transition: all .25s ease-in-out;
    }
    .card.small .card-dets {
        display:none;
    }
    a {
        text-decoration: none;
        color: #007480;
        background-color:white;
        padding: 4px;
        border-radius: 4px;
        font-size: 13px;
        border: 1px solid #007480;
        vertical-align:super;
    }
    .menu-item a {
        color: inherit;
        background-color: initial;
        padding: unset;
        font-size: initial;
        border: none;
        vertical-align: unset;
        border-radius: unset;
    }
    .menu-item, .menu-item a {
        font-size: 14px;
    }
    .menu-item a:hover {
        background-color: unset;
        color: inherit
    }
    a:hover {
        background-color: #007480;
        color: #fff;
    }
    a.delete {
        background-color: rgba(255, 0, 0, .55);
        color: white;
        overflow:hidden;
    }
    a.delete:hover {
        background-color: rgba(255, 0, 0, .75);
    }
    table, td, th {
        font-family: calibri;
        border-collapse: collapse;
        font-size: 14px;
        text-align: left;
    }
    tr td:nth-of-type(1) {
        border-right: 1px solid grey;
    }
    thead tr:nth-of-type(1) {
        border-bottom: 1px solid grey;
    }
    table {
        margin: 4px 4em;
        border: 1px solid #a59f9f;
        display: inline-block;
    }
    thead {
        background-color: white;
    }
    thead th {
        padding: 10px;
    }
    tbody {
        background-color: #eaeaea;
    }
    tbody tr:hover {
        background-color: white;
        transition: .15s ease-in-out;
    }
    td {
        padding: 8px;
        max-width: 18em;
    }
    td:nth-of-type(1){
        background: white;
    }
    tr:nth-child(even) {
        background: #f9f9f9;
    }
    .link {
        margin-right: 0;
    }

    input, select, textarea, option {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid grey;
        outline:none;
        display: inline-block;
        margin: 4px;
        font-family: calibri;
        outline: none;
    }
    textarea {
        resize: none;
    }
    form {
        margin: 4px;
        width: 24em;
        text-align: start;
        background-color: white;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #a59f9f;
        display: inline-block;
    }
    form.reciept, form.products-rec {
        margin: 1em 3em;
        display: inline-block;
        width: 24rem;
        vertical-align: top
    }
    form.reciept .form-body, 
    form.products-rec .form-body {
        max-height: 25em;
        overflow: auto;
    }
    .form-body {
        padding: .8em;
    }
    .form-head {
        text-align: center;
        color: #555555;
        font-weight: 700;
        background: #f1f1f1;
        padding: 0.8em;
        /* border-radius: .5em; */
        margin-bottom: 1em;
        border-bottom: 1px solid grey;
    }
    input[type=submit]{
        color: white;
        background-color: #007bfa;
        cursor:pointer;
        margin-left: 6em;
        margin-bottom: 2em;
        box-shadow: 0px 3px 4px gainsboro;
    }
    input[type=submit]:hover {
        background-color: #005bfa;
        box-shadow: 0px 5px 7px gainsboro;
    }
    form label {
        width: 8em;
        overflow: hidden;
        display: inline-block;
        margin-left: 0em;
    }
    
    form .details,
    form .quantity,
    form .prices {
        border-bottom: 1px solid gainsboro;
        padding: 8px;
        cursor: pointer;
    }

    form .details-body,
    form .quantity-body,
    form .prices-body {
        display: none;
        margin-top:8px;
        padding-left: 1em;
    }

    img {
        padding-top: 3em;
        padding-left: 1em;
        height: 70px;
    }
    input.search {
        margin-bottom: 1em;
        width: 100%;
    }
    .rem, .set {
        margin-right: unset;
        font-family: san-serif*;
        font-size: 12px;
        background: white;
        margin: 5px 2.5px;
        background: blue;
        color: white;
        padding: 2px 4px;
        border-radius: 4px;
        font-weight: bolder;
        width: auto;
        vertical-align: sub;
    }
    .add-subtract {
        background-color: red;
        cursor:pointer;
        font-family:'Segoe UI'; 
        font-weight: 900;
        width:10px;
        text-align:center;
        display: none;
    }
    .add-subtract.adder {
        background-color: #439643;
    }
    .add-subtract.adder:hover {
        background-color: #43a743;
    }
    .add-subtract.subtracter {
        background-color: #b95b5b;
    }
    .add-subtract.subracter:hover {
        background-color: #6f5b56;
    }
    a.add_to_product, a.remove_from_products {
        float: right;
        margin-top:2px;
        margin-bottom: 2px;
    }
    a.remove_from_products {
        border: 1px solid red;
        color: red;
        font-weight: 800;
    }
    a.remove_from_products:hover {
        background: #ff00009e;
        color: white;
    }
    .product-search:nth-child(odd) {
        background-color: gainsboro;
    }
    .error {
        color: red;
    }
    .loading {
        position: absolute;
        display: block;
        right: 0;
        top: 1rem;
        text-align: center;
        left: 0;
        font-family: Calibri;
    }
    .notification-body {
        overflow:hidden;
    }
    form.expiry {
        width: unset;
        border: none;
    }
    form.expiry input {
        width: 155px;
        margin: 4px;
    }
    form.expiry .form-head {
        background: white;
        padding: 4px;
        font-size: 13px;
        margin-bottom: 0;
    }

    </style>
</head>
<body>
    <div class = "container">
        <!-- side menu -->
        <div class = "left-container">
            <div class = "logo">
                <img src = "Capture111.png">
            </div>
            <div class = "menu-container">
                <span style = "margin-left: 3em;">Logged in:</span> <div class="manager"><?=$name?></div>
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
            <div class = "notification" style = "position:absolute; bottom: 2em;width: 15em;right:0;margin: 8px;background: white; border: 1px solid grey; border-radius: 4px;">
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
                success: function(data){
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