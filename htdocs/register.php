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
  </head>
  <body>
  
    <!-- Navigation -->
    <nav>
			<a href="index.php">
				<img src="img/Toymodel_Logo.svg" id="brand">
      </a>
      <section id="burgerMenu">
        <img src="img/menu.png">
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
    
    <main>
<!--      Form for creating an Account -->
      <section class="grid-container">
        <section class="registerPicture">
          <img src="img/locomotive.png" />
        </section>
        <section class="registerForm">
          <section>
              <h1>Register</h1>
              <form method="post" action="?register=1">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" placeholder="Firstname"> <br>

                <label for="surename">Surename:</label>
                <input type="text" name="surename" placeholder="Surename"> <br>

                <label for="company">Company:</label>
                <input type="text" name="company" placeholder="Company" required> <br>

                <label for="adress">Address:</label>
                <input type="text" name="address" placeholder="Address" required> <br>

                <label for="location">Location:</label>
                <input type="text" name="location" placeholder="Location" required> <br>

                <label for="country">Country:</label>
                <input type="text" name="country" placeholder="Country" required> <br>

                <label for="postcode">Postcode:</label>
                <input maxlength="5" name="postcode" placeholder="Postcode" required> <br>
                <br>
                <input type="reset" value="Reset"> 
                <input type="submit" value="Register">
              </form>
          </section>        
        </section>
      </section>
    </main>

    <!-- Footer -->
<?php
  include("includes/footer.html");
?>
  </body>
</html>