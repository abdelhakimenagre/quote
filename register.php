<?php  
try {
    if (isset($_POST["pass"])) {
        $pass = $_POST["pass"];
        $prenom = $_POST['prenom'];
        $nom = $_POST["nom"];
        $mail = $_POST["email"];

        $db = new PDO("mysql:host=localhost:3000;dbname=citation", 'root', '');
        $stmt = $db->prepare("SELECT * FROM users WHERE email=:mail");
        $stmt->bindParam(":mail", $mail);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<span style='color:red'>This email already exists</span>";
        } else {
            $stmt = $db->prepare("INSERT INTO users (name, prenom, email, password) VALUES (:nom, :prenom, :mail, :password)");
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":mail", $mail);
            $stmt->bindParam(":password", $pass);
            
            $stmt->execute();
            header("Location: login.php");
        }
    }
} catch (Exception $e) {
    echo "<span style='color:red'>A problem has occurred</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body{
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        section {
            width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            width: auto;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type='submit'] {
            background-color: aquamarine;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type='submit']:hover {
            background-color: #90ee90;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('header.php') ?>
    <div class="body">
    <section>
        <form action="register.php" method="post">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="text" name="prenom" placeholder="Votre prenom" required>
            <input type="password" name="pass" id="pass" placeholder="Mot de passe" required>
            <input type="password" name="pass2" id="pass2" placeholder="Confirmez votre mot de passe" required>
            <input type="email" name="email" id="email" placeholder="Votre Email" required>
            <input type="submit" value="Inscription">
        </form>
    </section>
    <script>
        document.getElementById("pass2").addEventListener("input", function () {
            var pass1 = document.getElementById("pass").value;
            var pass2 = document.getElementById("pass2").value;
            var submitButton = document.querySelector("input[type='submit']");

            if (pass1 === pass2) {
                document.getElementById("pass2").style.backgroundColor = "rgba(0, 255, 0, 0.2)";
                submitButton.disabled = false;
            } else {
                document.getElementById("pass2").style.backgroundColor = "rgba(255, 0, 0, 0.2)";
                submitButton.disabled = true;
            }
        });
    </script></div>
    <?php include("footer.php");?>
</body>
</html>
