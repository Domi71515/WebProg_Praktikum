<?php
  include("includes/mysql.php");
  include("includes/shoppingcart.php");
  include("includes/sessionHandler.php");
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
  <script src="js/script.js"></script>
</head>

<body>

  <!-- Navigation -->
  <nav>
    <a href="#">
      <img src="img/Toymodel_Logo.svg" id="brand">
    </a>
    <section id="burgerMenu">
      <img src="img/menu.png" onClick="toggleNav()">
    </section>
    <ul>
      <li><a href="#" alt="Home" class="active">Home</a></li>
<?php
  if(!isset($_SESSION["customerId"])){
?>
      <li>|</li>
      <li><a href="register.php" alt="Register">Register</a></li>
<?php
  }
?>
      <li>|</li>
      <li><a href="shoppingcart.php" alt="Shoppingcart">Shoppingcart</a></li>
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

  <header>
    <section>
      <h1>Welcome to Toymodels!</h1>
      <a href="#login" class="button">Login</a>
    </section>
  </header>
  
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


  <!-- Form for Login, redirects to login.html    -->
  <section id="login">
<?php
  if(!isset($_SESSION['customerId']))
  {
?>
    <form action="?login=0#login" method="post">
      <input type="text" name="customerId" placeholder="Customer ID">
      <input type="submit" value="Login" class="button">
    </form>
<?php
  }
  else 
  {
    $statement = $pdo -> prepare("SELECT * FROM Kunden Where KundenNr = ?");
    $statement -> execute(array($_SESSION['customerId']));

    $row = $statement->fetch();

?>
    <h2>Hello, <?php echo trim($row['Vorname']) . " " . trim($row["Nachname"]); ?>!</h2>
<?php
  }

  if(isset($_GET["login"]) && $_GET["login"] == 1 && isset($_SESSION["customerId"])) {
    unset($_SESSION["customerId"]);

    header('Location: /toymodels');
  }

  if(isset($_GET["login"]) && $_GET["login"] == 0 && isset($_POST['customerId'])) {
    $statement = $pdo -> prepare("SELECT * FROM Kunden Where KundenNr = ?");
    $statement -> execute(array($_POST['customerId']));

    if($statement->rowCount() != 0) {
      $row = $statement->fetch();
      //$_SESSION["username"] = trim($row['Vorname']) . " " . trim($row["Nachname"]);
      $_SESSION["customerId"] = $row["KundenNr"];

      header('Location: /toymodels#login');
    }
    else
    {
?>
    <p class="errorMsgLogin">
      Could not find User! Please Try again!
    </p>
<?php
    }
  }
?>
  </section>

  <section id="searchfilter">
    <!-- Form for Filters, if selected, it will only show Articels in its section -->
    <form method="get" action="#searchfilter">
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
    if($_GET["search"] == "" && $_GET["filter"] != "-1") 
    {
      $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr WHERE Artikel.GruppenNr = ?");
      $statement -> execute(array($_GET['filter']));
    }
    
    if($_GET["search"] != "" && $_GET["filter"] != "-1") 
    {
      $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr WHERE Artikel.GruppenNr = ? AND Artikel.ArtikelName LIKE ?");
      $statement -> execute(array($_GET["filter"], '%' . $_GET['search'] . '%'));
    }
    if($_GET["search"] == "" && $_GET["filter"] == "-1")
    {
      $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr");
      $statement -> execute();
    } 
  }
  else {
    if(isset($_GET["search"])){
      $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr WHERE Artikel.ArtikelName LIKE ?");
      $statement -> execute(array('%' . $_GET['search'] . '%'));
    }
    else 
    {
      $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr");
      $statement -> execute();
    }
  }

  if($statement->rowCount() > 0){
    while($row = $statement->fetch()) {
?>
    <article>

    <section class="article-grid">
        <section class="img">
          <img class="img" src="./img/img1.jpg">
        </section>
        <section class="text" onClick="showDetail(<?php echo $row['ArtikelNr'] ?>_description)">
            <h2><?php echo $row['ArtikelName'] ?></h2>
            <p>Price: <?php echo $row['Listenpreis'] ?>$</p>
            <p>Size: <?php echo $row['Massstab'] ?></p>
            <p>Art-Num: <?php echo $row['ArtikelNr'] ?> - <?php echo $row["GruppenName"] ?></p>
        </section>
    </section>

      <section id="<?php echo $row['ArtikelNr'] ?>_description" class="description" >
        <section class="textDescription">
            <h2>Description</h2>
            <p><?php echo $row['Beschreibung'] ?></p>
        </section>
        <section id="buy">
          <h2>Quantity: <?php echo $row['Bestandsmenge']; ?></h2>
        
          <input type="number" id="<?php echo $row['ArtikelNr'] ?>" value="1"/>
          <input type="submit" class="button" value="Add to shoppingcart" onClick="buy('<?php echo $row['ArtikelNr'] ?>')">
          
        </section>
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
<?php
  include("includes/footer.html");
?>
</body>

</html>