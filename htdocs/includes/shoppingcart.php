<?php
function Add($article, $amount) 
{
  $found = false;

  if(isset($_SESSION["shoppingcart"]))
    foreach ($_SESSION["shoppingcart"] as $key => $value) 
    {
      if ($key == $article)
      {
        $value = $value + $amount;
        $_SESSION["shoppingcart"][$key] = $value;
        $found = true;
      }
    }

  if(!$found) 
  {
    $_SESSION["shoppingcart"][$article] = $amount;
  }
}

function Remove($article)
{
  if(isset($_SESSION["shoppingcart"][$article]))
  {
    unset($_SESSION["shoppingcart"][$article]);
  }
}

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
}

function Buy($info)
{
  if(isset($_SESSION["customerId"]))
  if(isset($_SESSION["shoppingcart"]) && sizeof($_SESSION["shoppingcart"]) > 0)
  {
    require("mysql.php");
    //2015-05-30
    $date = date("Y-m-d");
    $plantermin = date("Y-m-d", strtotime("+12 days"));
    $statement = $pdo -> prepare("INSERT INTO Auftraege (Auftragsdatum, Plantermin, Status, Bemerkungen, KundenNr) VALUES (?,?,?,?,?)");
    $statement-> execute(array($date, $plantermin, "in Bearbeitung", $info, $_SESSION["customerId"]));

    $auftragsNr = $pdo ->lastInsertId();

    foreach($_SESSION["shoppingcart"] as $key => $value)
    {
      $row = getInfoArticle($key);

      $statement = $pdo -> prepare("INSERT INTO Auftragspositionen (AuftragsNr, ArtikelNr, Bestellmenge, Verkaufspreis, PositionsNr) VALUES (?,?,?,?,?)");
      $statement -> execute(array($auftragsNr, $key, $value, $row["Listenpreis"], $row["GruppenNr"]));
    }

    echo "Buy completed!";
  }

  unset($_SESSION["shoppingcart"]);

  
}

function getInfoArticle($article)
{
  require("mysql.php");

  $statement = $pdo -> prepare("SELECT * FROM Artikel WHERE ArtikelNr = ?");
  $statement -> execute(array($article));

  $row = $statement->fetch();

  return $row;
}
?>