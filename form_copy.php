<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $hesloErr = $heslo2Err = "";
$name = $email = $gender = $comment = $website = $heslo = $heslo2 =    "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Zadajte meno!";
  } else {
    $name = test_input($_POST["name"]);
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
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["pohlavie"])) {
    $genderErr = "Potrebujet vybrať pohlavie";
  } else {
    $gender = test_input($_POST["pohlavie"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>




<link rel="stylesheet" href="style.css">

<h2>  Zadanie č.2    - Vytvorte formulár na vkladanie osobných údajov  </h2> 
<form  name="form" method="post">   
  <fieldset style="width: 370px"> 
    <legend> Prihlasovacie údaje </legend>        
    Meno <input type="text" size="15" name="name" ><br><br> 
    Heslo <input type="password" size="20" name="heslo"><br><br> 
    Potvrdenie hesla <input type="password" size="20" name="heslo2"><br> 
  </fieldset> 
  <fieldset style="width: 370px"> 
    <legend> Osobne udaje </legend> 
    Pohlavie: <br> 
      <input type="radio" name="gender" value="male"/> Muž <br>
      <input type="radio" name="gender" value="female" /> Žena <br><br> 
      <textarea rows="5" cols="50" placeholder="Napíš niečo o sebe"  name="info"></textarea><br> 
  </fieldset>     
            <input type="reset" value="Vymazať"> 
            <input type="submit" value="Odoslať"  name="submit">                   
</form>   





<?php 
require_once "databaza.php";
// Initialize the session
session_start();
if(isset($_POST['submit']  )){
    // Attempt insert query execution
    if( $heslo != $heslo2){
      echo "ERROR: Nezmenili hodnoty v databaze";
    }else{
    $name = $_POST['name'];
    $heslo = $_POST['heslo'];
    $gender = $_POST['gender'];
    $sql = "INSERT INTO users(meno, heslo,pohlavie, email) VALUES ('" .$name. "','" .$heslo. "','" .$gender. "','" .$email. "')";
        if(mysqli_query($link, $sql)){ 
            echo "Records added successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        } 
      }  
}
?>   

