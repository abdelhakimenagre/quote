<?php include("logincheck.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <style>
    /* quote */
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro&display=swap');
body{
    margin: 0;
}
    section{
       height: 500px;

    }

    .quote {
        font-family: 'Crimson Pro', serif;
        font-size: 20px;
        line-height: 1.5;
        font-style: italic;
        font-weight: normal;
        padding: 50px;
        text-align: center;
        background-color: #f5f5f5;
    }

    .quote-attribution {
        font-family: 'Crimson Pro', serif;
        font-style: normal;
        font-size: 16px;
        font-weight: bold;
        color: red;
    }

    /* search */
    .search {

        border-radius: 30px;


        padding: 20px;

        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;

    }

   
    .search-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        flex-wrap: wrap;
    }


    .search-form input[type="text"] {
        width: 300px;
        padding: 12px;
        margin: 0px;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    
    .search-form input[type="submit"] {
        width: 200px;
        height: 50px;
        padding: 12px 20px;
        background-color: #3498db;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        margin-left: 10px;
      
    }

   
    .search-form input[type="submit"]:hover {
        background-color: #2980b9;
    }

  
    .order-by {
        display: flex;
        align-items: center;
        margin-top: 10px;
       
    }

   
    .order-by label {
        margin-right: 10px;
       
    }

    
    .search-form select {
        width: 200px;
        padding: 12px;
        margin: 0;
        border: none;
        border-radius: 5px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        appearance: none;
       
        background-color: #fff;
     
       
     
        background-repeat: no-repeat;
        background-position: right 10px center;
    }

   
    .search-form select:hover {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    
    .search-form select:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body>
    <?php include('header.php') ?>
    <section>
        <div class="quote">
            <p>
                <?php
            try{
            
            $conn = new PDO("mysql:host=localhost:3000;dbname=citation", "root", "");
            $query="Select * from citaion ";
            $result= $conn->query($query);
            
            $max=$result->rowCount()-1;
            $id=random_int(0,$max);

            $query = "SELECT citaion.text, autors.nom FROM citaion INNER JOIN autors ON autors.Id = citaion.idauto WHERE citaion.idcit = $id;";
            $result = $conn->query($query);
            $row= $result->fetch(PDO::FETCH_ASSOC);
            echo $row['text'];}catch(PDOException $e){
              echo 'A white has no superiority over a black nor a black has any superiority over white except by piety and good actions.';
            }
            
           
             ?>
            </p><br>
            <span class="quote-attribution">—
                <?php try{echo $row['nom']; $conn=null;}catch(Execption){echo 'Prophet Muhammad (peace be upon him)';}  ?></span>

        </div>
        <div class="search">
            <form class="search-form" action="affiche.php" method="post">
                <table>
                    <tr>
                        <td><input type="text" placeholder="Search..." name="quote"></td>
                        <td><label for="autors"></label>
                            <select name="autor" id="autors">
                                <option value="">Auter</option>
                                <?php
                    $conn = new PDO("mysql:host=localhost:3000;dbname=citation", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "SELECT id,nom ,prenom FROM autors";
                    $result = $conn->query($query);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["nom"] . "'>" . $row["nom"] .' '. $row["prenom"] . "</option>";
                    }
                    $conn = null;
                    ?>
                            </select>
                        </td>
                        <td>Ou siècle:
                        <select name="siecle" id="siecle">
                                
                                <?php
                    $conn = new PDO("mysql:host=localhost:3000;dbname=citation", "root", "");
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "SELECT DISTINCT siecle FROM autors";
                    $result = $conn->query($query);

                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["siecle"] . "'>" . $row["siecle"] .'th'. "</option>";
                    }
                    $conn = null;
                    ?>
                          </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="order-by">
                                Order by:
                                <label for="author">
                                    <input type="radio" name="order" id="author" value="nom" checked> Author
                                </label><br>
                                <label for="date">
                                    <input type="radio" name="order" id="date" value="siecle"> Siècle
                                </label>


                            </div>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <input type="submit" value="Search">





            </form>
        </div>
    </section>
    <?php include("footer.php");?>
</body>

</html>