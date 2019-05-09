<?php
  include("includes/mysql.php");

  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Toymodels GmbH - Shoppingcart</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="css/mobile.css" type="text/css" media="(max-width: 1024px)" />
  <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  <link rel="shortcut icon" href="favicon.ico">
  <script src="js/script.js"></script>
</head>

<body>

  <!-- Navigation -->
  <nav>
    <a href="index.php">
      <img src="img/Toymodel_Logo.svg" id="brand">
    </a>
    <section id="burgerMenu">
      <img src="img/menu.png" onClick="toggleNav()">
    </section>
    <ul>
      <li><a href="index.php" alt="Home">Home</a></li>
<?php
  if(!isset($_SESSION["customerId"])){
?>
      <li>|</li>
      <li><a href="register.php" alt="Register">Register</a></li>
<?php
  }
?>
      <li>|</li>
      <li><a href="#" alt="Shoppingcart" class="active">Shoppingcart</a></li>
      <li>|</li>
      <li><a href="impressum.php" alt="Impressum">Impressum</a></li>
<?php
  if(isset($_SESSION["customerId"])){
?>
      <li>|</li>
      <li><a href="index.php?login=1" alt="Logout">Logout</a></li>
<?php
  }
?>
    </ul>
  </nav>
  <section id="mobileNavigation">
  <ul>
      <li><a href="index.php" alt="Home" class="active">Home</a></li>
      <li><a href="register.php" alt="Register">Register</a></li>
      <li><a href="shoppingcart.php" alt="Shoppingcart">Shoppingcart</a></li>
      <li><a href="impressum.php" alt="Impressum">Impressum</a></li>
<?php
  if(isset($_SESSION["customerId"])){
?>
      <li><a href="index.php?login=1" alt="Logout">Logout</a></li>
<?php
  }
?>
    </ul>  
  </section>
  <main>
    <h2>Shopping Cart</h2>
    <section id="shoppingcartElement">
      <p>Your Shopping Cart is empty.</p>
    </section>

    <section id="checkout">
        <!--    Form for submitting Buy action -->
        <form method="post" action="buy.html">
          <input type="submit" class="button" value="Proceed to checkout">
       </form>
      </section>

  </main>

  <!-- Footer -->
<?php
  include("includes/footer.html");
?>
</body>

</html>