<?php
// Initialize the session
include 'databaza.php';
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$a = $_SESSION["username"];
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Blog Page</title>
    <link rel="stylesheet" href="style.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Belgrano&display=swap" rel="stylesheet">
  </head>
  <body>
  
    <div class="navbar">
      <div class="dropdown">
        <button class="dropbtn">MENU 
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="../Maturita/books.html">Books</a>
          <a href="../Maturita/movies.html">Movies</a>
          <a href="../Maturita/sports.html">Sport</a>
        </div>
      </div> 
      
      <div class="stranky_bez_drpdwn">
        <a href="#home">HOME</a>
     </div>
      
      <div class="menu-centered">
        <a  href="index.php">BLOG PAGE - LOGED IN</a>
      </div>
   
      <div class="menu-right">
        <a><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
        <a href="logout.php">LOGOUT</a>
      </div>
    
    
    
    </div>
    
    <div class="container">
      <img src="../Maturita/Photo1.jpg">
      <div class="centered1"><b>CHOOSE</b></div>
      <div class="centered2"><b>YOUR TOPIC</b></div>
      <div class="centered3"><b>&darr;</b></div>
    </div>

    <div class="vyber">
      <a class="fade" href= "../Maturita/books.html"> <img src="../Maturita/knihy2.jfif"></a>
      <a class="fade" href= "../Maturita/movies.html"> <img src="../Maturita/movies.jfif"></a>
      <a class="fade" href="../Maturita/sports.html"> <img src="../Maturita/sports.jfif"></a>
    </div>

    <div class="downbar">
      <br>
      <br><a class="downbar3"><b>Info</b></a>
      <a class="downbar4"><b>Catgories</b></a><br>
      <a class="downbar1" href="../Maturita/books.html">Books</a> <a class="downbar5"><b>Email: </b>admin123@gmail.com</a><br>
      <a class="downbar1" href="../Maturita/movies.html">Movies</a> <a class="downbar2"><b>Phone: </b>+421 940 999 666</a><br>
      <a class="downbar1" href="../Maturita/sports.html">Sport</a>
      <br><br><br>
    </div>
    
  </body>
</html>