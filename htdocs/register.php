<?php
  include("includes/mysql.php");

  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
		<title>Toymodels GmbH - Register</title>

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/mobile.css" type="text/css" media="(max-width: 1024px)"/>
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
<!--      Form for creating an Account -->
      <section class="grid-container">
        <section class="registerPicture">
          <img src="img/locomotive.png" />
        </section>
        <section class="registerForm">
<?php
  if(!isset($_GET["register"]))
  {
?>
              <h1>Register</h1>
              <form method="post" action="?register=0">
                <label for="firstname">Firstname:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="firstname" placeholder="Firstname"> <br>

                <label for="surename">Surename:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="surename" placeholder="Surename"> <br>

                <label for="telefon">Telefon:</label>
                <input onfocusout="checkIsNumber(this)" onkeypress="updateButton()" type="text" name="telefon" placeholder="Telefon"> <br>

                <label for="company">Company:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="company" placeholder="Company"> <br>

                <label for="address">Address:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="address" placeholder="Address"> <br>

                <label for="location">Location:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="location" placeholder="Location"> <br>

                <label for="country">Country:</label>
                <input onfocusout="checkNotEmpty(this)" onkeypress="updateButton()" type="text" name="country" placeholder="Country"> <br>

                <label for="postcode">Postcode:</label>
                <input onfocusout="checkIsNumber(this)" onkeypress="updateButton()" maxlength="5" name="postcode" placeholder="Postcode"> <br>
                <br>
                <input type="reset" value="Reset"> 
                <input type="submit" value="Register" name="submitRegister" disabled>
              </form>
<?php
  }else
  {
    if($_GET["register"] == 0)
    {
      $firstname = trim($_POST["firstname"]);
      $surename = trim($_POST["surename"]);
      $telefon = trim($_POST["telefon"]);
      $company = trim($_POST["company"]);
      $address = trim($_POST["address"]);
      $location = trim($_POST["location"]);
      $country = trim($_POST["country"]);
      $postcode = trim($_POST["postcode"]);

      if($firstname != "" && $surename != "" && $telefon != "" && $company != "" && $address != "" && $location != "" && $country != "" && $postcode != "")
      {
        //GET RANDOM VORGESETZEN
        $statement = $pdo->prepare("SELECT PersonalNr FROM Mitarbeiter ORDER BY RAND() LIMIT 1");
        $statement -> execute();

        $PersonalNr = $statement->fetch()["PersonalNr"];

        $statement = $pdo->prepare("INSERT INTO Kunden (Firma, Nachname, Vorname, Telefon, Strasse, Ort, PLZ, Land, Kundenbetreuer) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement -> execute(array($company, $surename, $firstname, $telefon, $address, $location, $postcode, $country, $PersonalNr));

        $newID = $pdo->lastInsertId();
        $_SESSION["customerId"] = $newID;
        $_SESSION["username"] = $firstname . " " . $surename;
        echo "<h1>Registration Successfull! Your ID: " . $newID . ". <a href='index.php'>Main</a></h1>";
      }
      else 
      {
        echo "<h1>Error, please try again! <a href='register.php'>HERE</a></h1>";
      }
    }
  }
?>
        </section>
      </section>
    </main>

    <!-- Footer -->
<?php
  include("includes/footer.html");
?>
  </body>
</html>