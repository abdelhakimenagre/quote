<?php
if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["siecle"]) && !empty($_POST["citation"])) 
{
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $siecle = trim($_POST["siecle"]);
    $citation = trim($_POST["citation"]);

        try {
            $conn = new PDO('mysql:host=localhost:3000;dbname=citation', 'root', '');
            $query="Select * from citaion ";
            $result= $conn->query($query);
            
            $idcit=$result->rowCount();
            
            $result=$conn->prepare("SELECT id from autors where nom=:nom and prenom=:prenom and siecle=:siecle");
            $result->bindParam(':nom', $nom);
            $result->bindParam(':prenom', $prenom);
            $result->bindParam(':siecle', $siecle);
            $result->execute();
           
            if($result->rowCount() == 0) {
                $query="Select * from autors ";
                $last= $conn->query($query);
                $authorId = $last->rowCount();
            $stmt = $conn->prepare("INSERT INTO autors (id,nom, prenom,siecle) VALUES (:id,:nom, :prenom,:siecle)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':siecle', $siecle);
            $stmt->bindParam(':id', $authorId);
            $stmt->execute();
            

           
            $stmt = $conn->prepare("INSERT INTO citaion (text,idcit,idauto) VALUES (:citation, :idcit, :idauto)");
            $stmt->bindParam(':citation', $citation);
            $stmt->bindParam(':idcit', $idcit);
            $stmt->bindParam(':idauto', $authorId);
            $stmt->execute();

            echo "New citation inserted successfully!";
        }
            else
             {
                $row=$result->fetch(PDO::FETCH_ASSOC);
                $authorId=$row["id"];
                $stmt = $conn->prepare("INSERT INTO citaion (text,idcit,idauto) VALUES (:citation, :idcit, :idauto)");
                $stmt->bindParam(':citation', $citation);
                $stmt->bindParam(':idcit', $idcit);
                $stmt->bindParam(':idauto', $authorId);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    } else {
        echo "All fields are required!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include("logincheck.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Display</title>
    <style>
        body{
            margin: 0;
           
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
            height: 100px;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-actions button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }
        .form-actions button[type="reset"] {
            background-color: #f44336;
            color: white;
        }
    </style>
    </style>
</head>

<body>
<?php include('header.php') ?>


    <div class="form-container">
        <h2>Insert a New Citation</h2>
        <form action="insert.php" method="post">
            <div class="form-group">
                <label for="nom">Last Name</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">First Name</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="siecle">Century</label>
                <select id="siecle" name="siecle" required>
                    <option value="">Select Century</option>
                    <option value="15">15th Century</option>
                    <option value="16">16th Century</option>
                    <option value="17">17th Century</option>
                    <option value="18">18th Century</option>
                    <option value="19">19th Century</option>
                    <option value="20">20th Century</option>
                    <option value="21">21st Century</option>
                </select>
            </div>
            <div class="form-group">
                <label for="citation">Quote Text</label>
                <textarea id="citation" name="citation" required></textarea>
            </div>
            <div class="form-actions">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>
        </form>
    </div>

        
    
    



<?php include("footer.php");?>
</body>



</html>
