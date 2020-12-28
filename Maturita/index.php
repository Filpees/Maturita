<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: test.php");
  exit;
}

// Include config file
require_once "databaza.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, meno, heslo FROM formular WHERE meno = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: test.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
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
        <a href="index.php">BLOG PAGE</a>
      </div>
   
      <div class="menu-right">
        <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">LOGIN</a>
        <a href="../Maturita/register.php">REGISTER</a>
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



    <div id="id01" class="modal">
      <form class="modal-content animate" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
        <div class="login">
          <label for="uname" name="username" ><b>Username</b></label>
       
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  
         
          <label for="psw"><b>Password</b></label>
          <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

        </div> 
      </form>
    </div>


    
    




    
    <script>
    // Get the modal
    var modal = document.getElementById('id01');
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>
    
  </body>
</html>