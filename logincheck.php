<?php

session_start();
    if(isset($_SESSION['login']) )
    {
        if($_SESSION['login']){
        echo "<Span style='color:green'>Welcom </span>";
        }else
        {
        header("location:login.php");
        }
    }else{
        header("location:login.php");
    }

?>