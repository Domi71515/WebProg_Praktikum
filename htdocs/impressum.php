﻿<?php
  include("includes/mysql.php");

  session_start();
  include("includes/sessionHandler.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Toymodels GmbH - Impressum</title>
  
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css" type="text/css" />
      <link rel="stylesheet" href="css/mobile.css" type="text/css" media="(max-width: 1024px)"/>
      <link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
      <link rel="shortcut icon" href="favicon.ico">
      <script src="js/script.js"></script>
      <script src="includes/shopping-cart-template.js"></script>
    </head>
    <body>
      <?php include("includes/shopping-cart-template.php"); ?>
      
    <!-- Navigation -->
    <nav>
			<a href="index.php">
				<img src="img/Toymodel_Logo.svg" id="brand">
      </a>
      <section id="burgerMenu">
        <img src="img/menu.png" onClick="toggleNav()">
      </section>
      <ul>
				<li><a href="index.php" alt="Home" >Home</a></li>
<?php
  if(!isset($_SESSION["customerId"])){
?>
      <li>|</li>
      <li><a href="register.php" alt="Register">Register</a></li>
<?php
  }
?>
				<li>|</li>
        <li><shopping-cart></shopping-cart></li>
				<li>|</li>
        <li><a href="#" alt="Impressum" class="active">Impressum</a></li>
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
      <section class="flexbox">
        <!-- Placeholder for Infos about Company -->
        <section id="impressum">
            <section id="Infos">
                <h2>Infos</h2>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
              </section>
      
              <!-- Placeholder for Impressum -->
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
        </section>
        
        <section id="headquarters">
            <img src="./img/impressum.jpg" alt="company headquarters">
          </section>
      </section>

    <!--Disclaimer-->
    <section id="Disclaimer">
      <h2>Disclaimer</h2>
      <h3>Limitation of liability for internal content</h3>
      <p class="twogrid">The content of our website has been compiled with meticulous care and to the best of our knowledge.
          However, we cannot assume any liability for the up-to-dateness, completeness or accuracy of any of
          the pages.<br>
          Pursuant to section 7, para. 1 of the TMG (Telemediengesetz – Tele Media Act by German law), we as
          service providers are liable for our own content on these pages in accordance with general laws.
          However, pursuant to sections 8 to 10 of the TMG, we as service providers are not under obligation to
          monitor external information provided or stored on our website. Once we have become aware of a
          specific infringement of the law, we will immediately remove the content in question. Any liability
          concerning this matter can only be assumed from the point in time at which the infringement becomes
          known to us.
        </p>

        <h3>Limitation of liability for external links</h3>
        <p class="twogrid">Our website contains links to the websites of third parties (“external links”). As the content of these
            websites is not under our control, we cannot assume any liability for such external content. In all cases,
            the provider of information of the linked websites is liable for the content and accuracy of the
            information provided. At the point in time when the links were placed, no infringements of the law were
            recognisable to us. As soon as an infringement of the law becomes known to us, we will immediately
            remove the link in question.
          </p>

          <h3>Copyright</h3>
          <p class="twogrid">The content and works published on this website are governed by the copyright laws of Germany. Any
              duplication, processing, distribution or any form of utilisation beyond the scope of copyright law shall
              require the prior written consent of the author or authors in question.
          </p>

          <h3>Data protection</h3>
          <p class="twogrid">A visit to our website can result in the storage on our server of information about the access (date, time,
              page accessed). This does not represent any analysis of personal data (e.g., name, address or e-mail
              address). If personal data are collected, this only occurs – to the extent possible – with the prior
              consent of the user of the website. Any forwarding of the data to third parties without the express
              consent of the user shall not take place.<br>
              We would like to expressly point out that the transmission of data via the Internet (e.g., by e-mail) can
              offer security vulnerabilities. It is therefore impossible to safeguard the data completely against access
              by third parties. We cannot assume any liability for damages arising as a result of such security
              vulnerabilities.<br>
              The use by third parties of all published contact details for the purpose of advertising is expressly
              excluded. We reserve the right to take legal steps in the case of the unsolicited sending of advertising
              information; e.g., by means of spam mail.
          </p>

      </section>
    </main>

<?php
  include("includes/footer.html");
?>
  </body>
</html>