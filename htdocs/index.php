<?php
  include("mysql.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Toymodels GmbH</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="css/mobile.css" type="text/css" media="(max-width: 1024px)" />
  <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
  <link rel="shortcut icon" href="favicon.ico">
</head>

<body>

  <!-- Navigation -->
  <nav>
    <a href="#">
      <img src="img/Toymodel_Logo.svg" id="brand">
    </a>
    <section id="burgerMenu">
      <img src="img/menu.png">
    </section>
    <ul>
      <li><a href="#" alt="Home" class="active">Home</a></li>
      <li>|</li>
      <li><a href="register.html" alt="Register">Register</a></li>
      <li>|</li>
      <li><a href="shoppingcart.html" alt="Shoppingcart">Shoppingcart</a></li>
      <li>|</li>
      <li><a href="impressum.html" alt="Impressum">Impressum</a></li>
    </ul>
  </nav>

  <header>
    <section>
      <h1>Welcome to Toymodels!</h1>
      <a href="#login" class="button">Login</a>
    </section>
  </header>

  <!-- Form for Login, redirects to login.html    -->
  <section id="login">
    <form action="login.html" method="post">
      <input type="text" name="customerId" placeholder="Customer ID">
      <input type="submit" value="Login" class="button">
    </form>
  </section>

  <section id="searchfilter">
    <!-- Form for Filters, if selected, it will only show Articels in its section -->
    <form method="get">
      <input type="search" name="search" placeholder="Search...">
      <select name="filter">
        <option value="" selected disabled>Please Select...</option>
        <option value="-1">All</option>
<?php
  $sql = "SELECT * FROM Warengruppen";

  foreach ($pdo -> query($sql) as $row) {
    echo '<option value="' . $row['GruppenNr'] . '">' . $row['GruppenName'] . '</option>';
  }
?>
      </select>
      <input type="submit" value="search" class="button">
    </form>
  </section>
  <main id="articleMain">
    <!-- Placeholder for Articles      -->
  
<?php
  if (isset($_GET['search'], $_GET['filter'])) {
    $statement = $pdo -> prepare("SELECT * FROM Artikel WHERE GruppenNr = ? AND ArtikelName LIKE ?");
    $statement -> execute(array($_GET['filter'], '%' . $_GET['search'] . '%'));
  }
  if (isset($_GET['search']) && (!isset($_GET['filter']) || $_GET['filter'] == "-1")) {
    $statement = $pdo -> prepare("SELECT * FROM Artikel WHERE ArtikelName LIKE ?");
    $statement -> execute(array('%' . $_GET['search'] . '%'));
  }
  else {
    $statement = $pdo -> prepare("SELECT * FROM Artikel");
    $statement -> execute();
  }

  if($statement->rowCount() > 0){
    while($row = $statement->fetch()) {
?>
    <article>
      <section class="img">
        <img class="img" src="./img/img1.jpg">
      </section>

      <section class="text">
        <a href="oldbus.html">
          <h2><?php echo $row['ArtikelName'] ?></h2>
          <p>Price: <?php echo $row['Listenpreis'] ?>$</p>
          <p>Size: <?php echo $row['Massstab'] ?></p>
          <p>Art-Num: <?php echo $row['ArtikelNr'] ?></p>
        </a>
      </section>
    </article>
<?php
    }
  }else {
    echo "<h2>Nothing found!</h2>";
  }
?>
  </main>

  <!-- Footer -->
  <footer>
    <section class="flexbox">
      <section id="about">
        <h3>About</h3>
        <ul>
          <li>Address:</li>
          <li>Toymodels GmbH</li>
          <li>Joachimstaler Str. 52</li>
          <li>97234 Reichenberg</li>
        </ul>
        <ul>
          <li>Telefon:</li>
          <li>+49 6771 62 55 99</li>
        </ul>
      </section>
      <section id="links">
        <h3>Links</h3>
        <ul>
          <li><a href="index.html" alt="Home">Home</a></li>
          <li><a href="register.html" alt="Register">Register</a></li>
          <li><a href="shoppingcart.html" alt="Shoppingcart">Shoppingcart</a></li>
          <li><a href="impressum.html" alt="Impressum">Impressum</a></li>
        </ul>
      </section>
      <section id="impressum">
        <h3>Impressum</h3>
        <ul>
          <li><a href="impressum.html" alt="Impressum">Impressum</a></li>
        </ul>
      </section>
    </section>
  </footer>
</body>

</html>