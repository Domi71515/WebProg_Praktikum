<?php include("mysql.php"); ?>
<?php
    header("Content-Type: application/json");

    if(isset($_GET['search'], $_GET['filter'])){
        if($_GET['filter'] == '-1'){
            $statement = $pdo -> prepare("SELECT ArtikelName FROM Artikel WHERE Artikel.ArtikelName LIKE ? LIMIT 5");
            $statement -> execute(array('%' . $_GET['search'] . '%'));
        }
        else
        {
            $statement = $pdo->prepare("SELECT ArtikelName FROM Artikel WHERE Artikel.GruppenNr = ? AND Artikel.ArtikelName LIKE ? LIMIT 5");
            $statement->execute(array($_GET['filter'], '%' . $_GET['search'] . '%'));
        }
        
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);

        echo $json;
    }
?>