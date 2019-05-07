﻿<!DOCTYPE html>
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
      <li><a href="index.html" alt="Home">Home</a></li>
<?php
  if(!isset($_SESSION["customerId"])){
?>
      <li>|</li>
      <li><a href="register.php" alt="Register">Register</a></li>
<?php
  }
?>
      <li>|</li>
      <li><a href="shoppingcart.html" alt="Shoppingcart">Shoppingcart</a></li>
      <li>|</li>
      <li><a href="impressum.html" alt="Impressum">Impressum</a></li>
    </ul>
  </nav>
    <main>
      <img src="./img/img1.jpg">
      <section id="buy">
          <form method="post" action="shoppingcart_oldcar.html">
              <input type="submit" class="button" value="Add to shoppingcart">
          </form>
      </section>

      <section class="text">
          <h2>Old Bus</h2>
          <p>Price: 200$</p>
          <p>out of stock</p>
          <p>available in probably 2 days</p>
          <section class="description">
              <h2>Description</h2>
              <p class="twogrid">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
                sed diam nonumy eirmod tempor invidunt ut labore et dolore magna 
                aliquyam erat, sed diam voluptua. At vero eos et accusam et 
                justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea 
                takimata sanctus est Lorem ipsum dolor sit amet. 
              </p>
          </section>
      </section>
    </main>
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