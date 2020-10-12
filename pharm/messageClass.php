<?php

namespace UserInterface {

    use Pharm\Product as PharmProduct;

    class message
    {
        public function show($message, $type = 0)
        {
            $class = ($type == 0) ? 'success' : 'error';
            echo '<div class = "' . $class . '">' . $message . '</div>';
        }
    }

    class Product
    {
        public function buy($cat)
        {
            $product = new PharmProduct;
            for ($i = 0; $i < sizeof($cat); $i++) {
                echo "<h4 style = \"padding-bottom:8px; padding-left: 1em; color: #555;\">" . $cat[$i]['category'] . "</h4><hr style = \"background-color: gainsboro;\"></hr>";
                $n_cat = $product->viewProductsByCategories($cat[$i]['category']);
                for ($j = 0; $j < sizeof($n_cat); $j++) {
                    extract($n_cat[$j]);
                ?>
                <div class = "products-list">
                <label class ="rem"><?=$quantity_remaining?></label>
                <label style ="font-weight: bolder; margin-left: 2px; width: 10em;" for = "buy<?=$id?>}"><?=$name?></label>
                <label class="price" style = "margin-left: 2px; display: none; width: 3em;">N <?=$selling_price?></label>
                <input style = "vertical-align: initial; padding: 8px; font-size: 12px; width: 28px; display:none;" type="number" name="quantity<?=$id?>" value=1 id="quantity<?=$id?>" max=<?=$quantity_remaining?> min=0>
                <a href ="" class ="add_to_product"> + add</a>
                </div>
<a href ="" class = "remove_from_products" style= "display:none;"> - remove </a>
            <?php
                }
            }
        }
        public function new($cat)
        {
            for ($i = 0; $i < sizeof($cat); $i++) {
                echo "<option value = \"".$cat[$i]['category']."\">".$cat[$i]['category']."</option>";
            }
        }
    }

    class GeneralDocInterface
    {
        public static function footer()
        {
            echo "&copy; 2020 KondiPress Team!";
        }
    }
}
