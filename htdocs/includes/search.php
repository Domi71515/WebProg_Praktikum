<?php include("mysql.php"); ?>
<?php
    if(isset($_GET['search'], $_GET['filter'])){
        if($_GET['filter'] == '-1'){
            $statement = $pdo -> prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr WHERE Artikel.ArtikelName LIKE ?");
            $statement -> execute(array('%' . $_GET['search'] . '%'));
        }
        else
        {
            $statement = $pdo->prepare("SELECT * FROM Artikel LEFT JOIN Warengruppen on Artikel.GruppenNr=Warengruppen.GruppenNr WHERE Artikel.GruppenNr = ? AND Artikel.ArtikelName LIKE ?");
            $statement->execute(array($_GET['filter'], '%' . $_GET['search'] . '%'));
        }
        
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);

        echo $json;
    }
?>