<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlOGENAGRE</title>
    
    <style>
        .header{
    margin-top:0 ;
    box-sizing: border-box;
    
}
nav{
    height: 50px;
    width: 100%;
    display: flex;
   justify-content: space-between;
    
   align-items: center;
    background: linear-gradient(to left, #D9C9EB,#380E65, #D9C9EB); ;
    border-bottom: 1px solid grey;
}
.nava{
    text-decoration: none;
    display: block;
    height: 100%;
   
    color:white; 
    text-align: center;
    

}

nav ul li{
   
    width: 100px;
    list-style: none;
    margin:auto 10px auto 10px ;
}
nav ul{
    display: flex;
   
    
    
}
.nava:hover {
    /* background-color: #DED8D7; 
    color: #fff;  */
}
.buttonnav {
display: inline-block;
padding: 10px 20px;
height: 20px;
width: 50px;
font-size: 16px;
color: #fff;
background-color: #93b9e1;
text-align: center;
text-decoration: none;
border-radius: 30px;
}

.buttonnav:hover {
background-color: #0056b3;
}
    </style>
</head>
<body class="header">
    <nav>
       <h1 style="color: midnightblue;">ENAGREBLOG</h1>
       <ul>
            <li ><a class="nava" href="index.php"> Home</a>   </li>
            <li ><a class="nava" href="Insert.php">Insersion</a>    </li>
            <li ><a class="nava" href="contact.php">Contact</a>    </li>

        </ul>
        <ul>
            <?php @session_start();
            if($_SESSION['login']){
            ?>
            <a  href="logout.php" class="nava buttonnav">Logout</a> 

            <?php }else{?>
           <a  href="login.php" class="nava buttonnav ">Login</a>   
           <?php }?>
        </ul>
    </nav>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>