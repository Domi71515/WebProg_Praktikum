<?php
  include("includes/mysql.php");
  include("includes/shoppingcart.php");
  include("includes/sessionHandler.php");
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
<?php
  if(!isset($_GET["checkout"])){

?>
    <h2>Shopping Cart</h2>
    <section id="shoppingcartElement">
<?php
  if(isset($_SESSION["shoppingcart"]) && sizeof($_SESSION["shoppingcart"]) > 0) 
  {
    $gesamtPreis = 0;

    //unset($_SESSION["shoppingcart"]);
    foreach($_SESSION["shoppingcart"] as $article => $value) {
      $statement = $pdo -> prepare("SELECT * FROM Artikel WHERE ArtikelNr = ?");
      $statement -> execute(array($article));

      $row = $statement->fetch();

      $gesamtPreis += $row["Listenpreis"] * $value;
?>
  <article id="<?php echo $article; ?>">
    <section class="img">
      <img class="img" src="./img/img1.jpg">
    </section>

    <section class="text">
      <h3><?php echo $row["ArtikelName"]; ?></h3>
    </section>
    <section class="quantity">
      Amount: <input type="number" min="0" name="<?php echo $article; ?>" value="<?php echo $value; ?>" /><br><br>
      <button class="button" onClick="change('<?php echo $article; ?>')">Change</button>
    </section>
    <section class="price">
      <p style="display: none" class="singlePrice"><?php echo $row["Listenpreis"]; ?></p>
      Preis: <p class="sumPrice"><?php echo $row["Listenpreis"] * $value; ?></p>€
    </section>
  </article>
<?php
    }
?>
  <section>
  <p>Gesamtpreis: <p id="endPrice"><?php echo $gesamtPreis; ?></p></p>
  </section>
    </section>
<?php
  if (isset($_SESSION["customerId"])){
?>
    <section id="checkout">
        <!--    Form for submitting Buy action -->
        
        <form method="post" action="?checkout=-1">
          <textarea name="comment" placeholder="Comment"></textarea><br>
          <input type="submit" class="button" value="Proceed to checkout">
       </form>
      </section>
<?php
    }
  }
  else
  {
?>
    <section id="shoppingcartElement">
      <p>Your Shopping Cart is empty.</p>
    </section>
    <?php
  }
  //unset($_SESSION["shoppingcart"]);
  }
  else{
    if($_GET["checkout"] == -1)
    {
      Buy($_POST["comment"]);
    }else {
      $statement = $pdo -> prepare("SELECT * FROM Auftraege WHERE AuftragsNr = ?");
      $statement -> execute(array($_GET["checkout"]));

      $row = $statement->fetch();
?>
  <h3>Ihre Auftrags Nummer: <?php echo $row["AuftragsNr"]; ?></h3>
  <p>Geplanter Liefertermin: <?php echo $row["Plantermin"]; ?></p>
  <p>Gesamter Preis: <?php echo number_format($_GET["price"] / 100, 2); ?></p>
<?php
    }
  }
    ?>
  </main>

  <!-- Footer -->
<?php
  include("includes/footer.html");
?>
</body>

</html>