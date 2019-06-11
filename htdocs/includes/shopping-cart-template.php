<template id="shopping-cart">
    <style>

    .container {
        width: 200px;
        line-height: 18px;
        background: #333;
        position: absolute; 
        left: -120px; 
        top: 25px;
        z-index: 999;
        padding: 10px 20px;
        color: #fff;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover + .container {
        display: unset;
    }

    .hidden {
        display: none;
    }
    </style>
    <script>
        function changeThings(elem, visible) {

            var root = elem.parentNode.querySelector(".container"); 
            
            if(!visible) {
                root.className += " hidden";
            }
            else
            {
                root.className = "container"
            }
        }
        </script>

<a href="shoppingcart.php" onmouseover="changeThings(this, true)" onmouseout="changeThings(this, false)"></a>

<section style="position: relative; width: 0; height: 0; display: inline-block;">
    <section class="container hidden">
        <?php
            if(isset($_SESSION["shoppingcart"]) && sizeof($_SESSION["shoppingcart"]) > 0)
             {
                foreach($_SESSION["shoppingcart"] as $article => $value) {
                    echo $article . ": " . $value . "x <br>";   
                }
             }
             else
                echo "Shoppingcart is empty";
            
        ?>
    </section>
</section>
</template>