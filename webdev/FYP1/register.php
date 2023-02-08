<?php
session_start();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
    <link href="CSSfiles/register.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
</head>


<body class="content">
<header>
        <div id="logo">
                <h2>One RP&nbsp;&nbsp;</h2>
        </div>    
</header>

    <img src="pics/1.-Republic-Polytechnic-Singapore_1_edited.jpg" height="152" alt=""/>
        <div class="pointer navbar">
    <ul>
        <li><a  href = "index.php" title="Home">Home</a></li>
        <li class="dropdown">
            <a  href="index.php" title="Categories">Categories</a>
        <ul>
            <li><a href="topics.php?category_id=4">Introductions</a></li>
            <li><a href="topics.php?category_id=1">IT Support</a></li>
            <li><a href="topics.php?category_id=2">Confessions</a></li>
            <li><a href="topics.php?category_id=3">Studies</a></li>
        </ul>
        </li>
        <li><a href="index.php" title="Link">About&nbsp;</a></li>

      </ul>
</div>
    

    <form method="post" action="doregister.php">
      <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <!--Display errors -->
              	<?php  
             
            if(isset($_SESSION['errors'])):
            $errors = $_SESSION['errors'];
             ?>
              <div class="error">
                    <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
              <?php endforeach ?>
            <?php  unset($_SESSION['errors']); 
            endif ?>
            </div>


        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username" required>


        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password_1" id="password_1" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_2" id="password_2" required>
        <input type="checkbox" onclick="myFunction()">Show Password

        <hr>

        <button type="submit" class="registerbtn" name="reg_user">Register</button>

      </div>
       </form>
    <script>
    function myFunction() {
      var y = document.getElementById("password_1");
      var z = document.getElementById("password_2");
      
    if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    
    if (z.type === "password") {
        z.type = "text";
      } else {
        z.type = "password";
      }
    }
    </script>
      <div class="container signin">
        <p>Already have an account?</p>  
          
    <!-- for the login form -->
          <nav id="login" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><a class="pointer">Login</a></nav>
          <div id="id01" class="modal">
        
      <form class="modal-content animate login" action="doLogin.php" method="post">

        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>

          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            <span class="psw">Forgot <a href="#">password?</a></span>
            <br>
                <?php
                if(isset($_SESSION['errormsg'])){
                    echo $_SESSION['errormsg'];
                    session_destroy();
                    unset($_SESSION['username']);

                }
                ?>
          </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <span class="register">Not a Member yet? <a href="#"> Register Now </a></span>
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

      </div>

    
</body>
</html>

