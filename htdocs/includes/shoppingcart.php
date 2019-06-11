<script>
  function buy(artNr){
    var amount = document.getElementById(artNr).value;
    
    //Creating AJAX element.
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/toymodels/includes/shoppingcart.php?buy=1');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      alert(artNr + ": " + amount + "x");
    }
    //Send Response
    xhr.send(encodeURI('artNr=' + artNr + '&amount=' + amount));
  }

  function change(artNr){
    var amount = document.getElementsByName(artNr)[0].value;

    //Creating AJAX element.
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/toymodels/includes/shoppingcart.php?buy=2');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
    }
    //Send Respnse
    xhr.send(encodeURI('artNr=' + artNr + '&amount=' + amount));

    //Update Price by OnClick on Change-Button
    let listenpreis = document.getElementById(artNr).getElementsByClassName("singlePrice")[0].innerText;
    document.getElementById(artNr).getElementsByClassName("sumPrice")[0].innerText = listenpreis * amount;

    changeSum();
  }

  function changeSum() 
  {
    //Get all elements with Article-Tag
    var articles = document.getElementsByTagName("article");
    var sum = 0;

    //Itterate through all Article-Elements
    for(var i = 0; i < articles.length; i++) {
      var price = parseFloat(articles[i].getElementsByClassName("sumPrice")[0].innerHTML);
      sum += price;
    }

    //Updates the Total price
    document.getElementById("endPrice").innerHTML = sum;
  }
</script>

<?php
session_start();

//Adds article to Shoppingcart
function Add($article, $amount) 
{
  $found = false;

  //Checks if shoppingcart Allready exists
  if(isset($_SESSION["shoppingcart"]))
    //If yes, itterate through all items.
    foreach ($_SESSION["shoppingcart"] as $key => $value) 
    {
      //If one Article is already in Shoppingcart, update the amount
      if ($key == $article)
      {
        $value = $value + $amount;
        $_SESSION["shoppingcart"][$key] = $value;
        $found = true;
      }
    }

  //If no Shoppingcart is found, create one, and add item.
  if(!$found) 
  {
    $_SESSION["shoppingcart"][$article] = $amount;
  }

  echo "Done";
}

//Removes item from Shoppingcart
function Remove($article)
{
  //If artikle exists, delete
  if(isset($_SESSION["shoppingcart"][$article]))
  {
    unset($_SESSION["shoppingcart"][$article]);
  }
}

//Sets the amount of an Item in shoppingcart
function SetValue($article, $amount)
{
  if(isset($_SESSION["shoppingcart"]))
  foreach ($_SESSION["shoppingcart"] as $key => $value) 
  {
    if ($key == $article)
    {
      $_SESSION["shoppingcart"][$key] = $amount;
    }
  }

  if($amount <= 0) {
    Remove($article);
  }
}

//Checkout for Shoppingcart
function Buy($info)
{
  $auftragsNr = 0;
  $totalSum = 0;
  //Chekcs if user is logged in and items are in Shoppingcart
  if(isset($_SESSION["customerId"]))
  if(isset($_SESSION["shoppingcart"]) && sizeof($_SESSION["shoppingcart"]) > 0)
  {
    require("mysql.php");
    //2015-05-30
    $date = date("Y-m-d");
    //Create Auftraege
    $plantermin = date("Y-m-d", strtotime("+12 days"));
    $statement = $pdo -> prepare("INSERT INTO Auftraege (Auftragsdatum, Plantermin, Status, Bemerkungen, KundenNr) VALUES (?,?,?,?,?)");
    $statement-> execute(array($date, $plantermin, "in Bearbeitung", $info, $_SESSION["customerId"]));

    $auftragsNr = $pdo ->lastInsertId();

    foreach($_SESSION["shoppingcart"] as $key => $value)
    {
      $row = getInfoArticle($key);
      //Create Auftragspositionen
      $statement = $pdo -> prepare("INSERT INTO Auftragspositionen (AuftragsNr, ArtikelNr, Bestellmenge, Verkaufspreis, PositionsNr) VALUES (?,?,?,?,?)");
      $statement -> execute(array($auftragsNr, $key, $value, $row["Listenpreis"], $row["GruppenNr"]));
      
      $totalSum += $row["Listenpreis"] * $value;
      
      //Update bestandsmenge
      $statement = $pdo -> prepare("UPDATE Artikel SET Bestandsmenge = Bestandsmenge - ? WHERE ArtikelNr = ?");
      $statement -> execute(array($value, $key));
    }
  }

  //Delete shoppingcart
  unset($_SESSION["shoppingcart"]);

  $totalSum = number_format($totalSum, 2, ".", "") * 100;

  header("Location: /toymodels/shoppingcart.php?checkout=" . $auftragsNr . "&price=" . $totalSum);  
}

//Gets all infos from ArtikelNr from an Artikel
function getInfoArticle($article)
{
  require("mysql.php");

  $statement = $pdo -> prepare("SELECT * FROM Artikel WHERE ArtikelNr = ?");
  $statement -> execute(array($article));

  $row = $statement->fetch();

  return $row;
}


//Function for AJAX
if(isset($_GET["buy"]) && $_GET["buy"] == 1) 
{
  Add($_POST["artNr"], $_POST["amount"]);
}
if(isset($_GET["buy"]) && $_GET["buy"] == 2) 
{
  SetValue($_POST["artNr"], $_POST["amount"]);
}
?>