<?php include("logincheck.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quote Display</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            justify-content: space-around;
            margin: 0;
            width: 100%;
            background-color: #f5f5f5;
        }
       section{
            height: fit-content;
           
            z-index: 22;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            
            background-color: #f5f5f5;
            margin: 0;
        }
        .card1 {
            align-items: center;
            display: flex;
            
            flex-direction: column;
            justify-content: center;
            height: 400px;
            padding-top:10px ;
            background-color: #fff;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }
        .quote-text {
            font-size: 24px;
            font-style: italic;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }
        .quote-author {
            font-size: 18px;
            color: red;
            
            text-align: center;
        }
    
       
    </style>
</head>

<body>
<?php include('header.php') ?>
<section>
<?php 
try {
    if (!empty($_POST["quote"]) && !empty($_POST["autor"]) && !empty($_POST["siecle"])) {
        $quote = "%" . $_POST["quote"] . "%";
        $autor = $_POST["autor"];
        $siecle = $_POST["siecle"];
        $order = $_POST["order"];

        

        $conn = new PDO('mysql:host=localhost:3000;dbname=citation', "root", "");
        $query = "SELECT text, nom, prenom, siecle 
                  FROM citaion 
                  INNER JOIN autors ON autors.Id = citaion.idauto 
                  WHERE autors.nom = :name 
                  AND siecle = :siecle 
                  AND text LIKE :quote 
                  ORDER BY $order;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $autor);
        $stmt->bindParam(":quote", $quote);
        $stmt->bindParam(":siecle", $siecle);
        $stmt->execute();
    } elseif (!empty($_POST["quote"]) && !empty($_POST["autor"])) {
        $quote = "%" . $_POST["quote"] . "%";
        $autor = $_POST["autor"];
        $order = $_POST["order"];

    
        $conn = new PDO('mysql:host=localhost:3000;dbname=citation', "root", "");
        $query = "SELECT text, nom, prenom, siecle 
                  FROM citaion 
                  INNER JOIN autors ON autors.Id = citaion.idauto 
                  WHERE autors.nom = :name 
                  AND text LIKE :quote 
                  ORDER BY $order;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $autor);
        $stmt->bindParam(":quote", $quote);
        $stmt->execute();
    } elseif (!empty($_POST["quote"])) {
        $quote = "%" . $_POST["quote"] . "%";
        $order = $_POST["order"];

        
       

        $conn = new PDO('mysql:host=localhost:3000;dbname=citation', "root", "");
        $query = "SELECT text, nom, prenom, siecle 
                  FROM citaion 
                  INNER JOIN autors ON autors.Id = citaion.idauto 
                  WHERE text LIKE :quote 
                  ORDER BY $order;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":quote", $quote);
        $stmt->execute();
    } 
    elseif(!empty($_POST["autor"])){
        $autor = $_POST["autor"];
        $order = $_POST["order"];
        $conn = new PDO('mysql:host=localhost:3000;dbname=citation', "root", "");
        $query = "SELECT text, nom, prenom, siecle 
                  FROM citaion 
                  INNER JOIN autors ON autors.Id = citaion.idauto 
                  WHERE nom=:autor 
                  ORDER BY $order;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":autor", $autor);
        $stmt->execute();
    }
    elseif(!empty($_POST["siecle"])){
        $siecle = $_POST["siecle"];

        $order = $_POST["order"];
        $conn = new PDO('mysql:host=localhost:3000;dbname=citation', "root", "");
        $query = "SELECT text, nom, prenom, siecle 
                  FROM citaion 
                  INNER JOIN autors ON autors.Id = citaion.idauto 
                  WHERE siecle=:siecle
                  ORDER BY $order;";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":siecle", $siecle);
        $stmt->execute();
    }
    else {
        throw new Exception("NO QUOTE HAS BEEN FOUND");
    }

    if ($stmt->rowCount() == 0) {
        throw new Exception("NO QUOTE HAS BEEN FOUND");
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $autor = $row["nom"] . " " . $row["prenom"];
            $text = $row["text"];
            $siecle = $row['siecle'];

            echo "<div class='card1'>
                    <div class='quote-text'>\"$text\"</div>
                    <div class='quote-author'>- $autor $siecle siecle</div>
                  </div>";
        }
    }
} catch (Exception $e) {
    echo "<div class='card1'>
            <div class='quote-text'>\"" . $e->getMessage() . "\"</div>
            <div class='quote-author'>- ABDELHAKIM ENAGRE </div>
          </div>";
}
    ?>
    
    

</section>


</body>
</html>
