<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root{
    --back:aqua;
}
body{
    box-sizing: border-box;
  overflow-x: auto;
   font-weight: 100;
}
h1{
    font-size: xx-large;
}
section{
    display: flex;
    width: 80vw;
    height: 90vh;
    margin-left: auto;
    margin-right: auto;
    margin-top: auto;
    margin-bottom: auto;
   
box-shadow: 0px 5px 5px 0px rgb(91, 88, 88);
}
.part1{

    width: 50%;
    height: 100%;
    background-color: antiquewhite;
    display: flex;

}
.part2{
   
 width: 50%;
 padding-top: 10em;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
    
}
form{
   
    margin: 40vh;
    margin-top: auto;
}
input,button{
    display: block;
}
input{
    
width: 300px;
padding: 10px;
margin-top: 20px;
border: 1px solid #ccc;
border-radius: 5px;
box-sizing: border-box;

}
button{
    display: inline-block;
padding: 12px 20px;
font-size: 16px;
font-weight: bold;
color: white;
background-color: #007bff; /* Primary color */
border: none;
border-radius: 5px;
cursor: pointer;
transition: background-color 0.3s, transform 0.2s;
text-align: center;
text-decoration: none;
margin: 20px 0px 20px 110px;

}
.part1 img{
    width:300px ;
   
    justify-self: center;
    align-self: center;
    margin-left: auto;
    margin-right: auto;
}
@media screen and (max-width:800px)  {
    body{
        margin: 0;
        padding: 0;
        margin-right:0 ;
        overflow: hidden;
    }
    section{
        width: 100%;
        flex-direction: column;
        margin: 0;
        padding: 0;
        box-shadow: none;
        background-color:var(--back);
        
    }
    input{
        width: 200px;
        padding: 10px;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box; 
    }
    .part1{

        width: 100%;
        height: 40%;
        background-color:var(--back);
        display: flex;
       
    }
    .part1 img{
        width:200px ;
        justify-self: center;
        align-self: center;
        margin-left: auto;
        margin-right: auto;
    }
    .part2{
        height: 100%;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
background-color: #007bff;
        width:100%;
       align-content: center;
       margin-bottom: 0;
       padding-top: 20px;
       
           
          
           
           
       }
       button{
        margin: 10px 0 10px 55px;
        background-color: chartreuse;
       }
}

    </style>
  
</head>
<body>
    <?php
if((isset($_POST['password']) && !empty($_POST['username']))){
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    $conn=new PDO('mysql:host=localhost:3000;dbname=citation', "root","");
    $query="SELECT email,password FROM users WHERE email=:name and password =:password";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":name", $username) ;
    $stmt->bindParam(":password", $password);
    $stmt->execute();
   
    if($stmt->rowCount()> 0){
        
        $_SESSION["login"] =True;
        
        $conn=null;
        header("location:index.php");
    }else
    {
        $conn=null;
        $_SESSION["login"] =false;
    header("location:login.php");
    
    }
    } ?>
    <section>
        <div class="part1">
            <img src="login.png" alt="login">
        </div>
        <div class="part2">
            <p>WELCOME</p>
            <p>Lorem Ipsum has been the industry's standard dummy.</p>
            <form action="login.php" method="post">
                <input type="email" name="username" placeholder="Your email" >
                <input type="password" name="password" id="pass" placeholder="Password" >
                <button type="submit">Login</button> <br>
                <span>Don't have an account? <a href="register.php">Register</a></span>
            </form>
        </div>
    </section>
</body>
</html>