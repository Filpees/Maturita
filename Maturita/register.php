<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $hesloErr = $heslo2Err = "";
$name = $email = $gender = $comment = $website = $heslo = $heslo2 =    "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Zadajte meno!";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Iba písmena a medzery sú dovolene!";
    }
  }
  if (empty($_POST["heslo"])) {
    $hesloErr = "Zadajte heslo!";
  } else {
    $heslo = test_input($_POST["heslo"]);
  }
  if (empty($_POST["heslo2"])) {
    $heslo2Err = "Zadajte heslo!";
  } else {
    $heslo2 = test_input($_POST["heslo2"]);
  }if ($heslo2 != $heslo){
    $heslo2Err = "Nesprávne heslo ";

  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Zadajte email!";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Nesprávný formát!";
    }
  }


  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Potrebujet vybrať pohlavie";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Blog Page</title>
    <link rel="stylesheet" href="style-register.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Belgrano&display=swap" rel="stylesheet">
  </head>
    <body>
  
        <div class="navbar">        
          <div class="stranky_bez_drpdwn">
                <a href="./index.html">HOME</a>
         </div>
          
          <div class="menu-centered">
                <a >BLOG PAGE</a>
          </div>
        </div>

        <div class="register">
        <b>Username</b><br>
        <input type="text" name="name" placeholder="Enter Username" required><br>
        <br>
        <b>Password<b><br>
        <input type="password" name="heslo" placeholder="Enter Password" required><br>
        <br>
        <b>Password Check</b><br>
        <input type="password" placeholder="Enter Password Again" required><br>
        <br>
        <input type="submit" name="submit" value="Register"></input>
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
    </html>
  </body>
</html>

<?php 
require_once "databaza.php";
// Initialize the session
session_start();


if(isset($_POST['submit']  )){
  if( $heslo != $heslo2){
    echo "ERROR: Nezmenili hodnoty v databaze";
  }else{


    // Attempt insert query execution
    $name = $_POST['name'];
    $heslo = $_POST['heslo'];

    $sql = "INSERT INTO users(meno, heslo) VALUES ('" .$name. "','" .$heslo. "')";
        if(mysqli_query($link, $sql)){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

    header('location: index.html');


  }
  
    
}



?>