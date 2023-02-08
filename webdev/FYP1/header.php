<?php
session_start();
include 'rolecheck.php';
?>

<body class="content">
<header>
        <div id="logo">
                <h2>One RP&nbsp;&nbsp;</h2>
        </div>
<?php
if (isset($_SESSION['username'])){
?>
    <nav><a class="pointer" href = "account.php"><?php echo $_SESSION['username'];?></a></nav>
<?php }
else{?>
        <?php
        if(isset($_SESSION['errorPopUp'])){
            echo $_SESSION['errorPopUp'];
            unset($_SESSION['errorPopUp']);
        }
        ?>

    <nav id="login" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><a class="pointer">Login</a></nav>

    <div id="id01" class="modal">
      <!-- for the login form -->
      <form class="modal-content animate" action="doLogin.php" method="post">

        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" required>

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="passInput" required>
            <input type="checkbox" onclick="myFunction()">Show Password

          <button type="submit">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            <span class="psw">Forgot <a href="forgetPassword.php">password?</a></span>
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
          <span class="register">Not a Member yet? <a href="register.php"> Register Now </a></span>
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
    function myFunction() {
        var x = document.getElementById("passInput");
        if (x.type === "password") {
        x.type = "text";
        } else {
        x.type = "password";
        }
    }
    </script>

<?php } ?>

</header>

    <img src="./pics/1.-Republic-Polytechnic-Singapore_1_edited.jpg" height="152" alt=""/>
        <div class="pointer navbar">
    <ul>


      <?php
        if( $_SESSION['userrole'] == "Admin" OR $_SESSION['userrole'] == "Superuser" )  {
        ?>
        <li><a  href = "adminaccess.php" title="Topic Access">Topic Access</a></li>
      <?php }  ?>


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
