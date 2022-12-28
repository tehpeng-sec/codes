
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>trying</title>
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    
</head>

<?php
    include './header.php';
    ?>
<section>
    <form  action="doChangePass.php" method="post">
            <?php if($_GET['email']){
                 

                $_SESSION['email'] = mysqli_real_escape_string($db, $_GET['email']);
            }
            ?>
            <div class="container">
            <h3>Change password</h3>

            <?php if(isset($_SESSION['changeError'])){
            $errors = $_SESSION['changeError'];
            
             ?>
              <div class="error">
                    <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
              <?php endforeach ?>
            <?php  unset($_SESSION['changeError']); ?>
            </div>
            <?php } ?> 
                   
            <label for="psw"><b>New Password: </b></label>
            <input type="password" placeholder="Enter Password" name="NewPassword1" id="newInput1" required>
            

            
            <label for="psw"><b>Confirm New Password: </b></label>
            <input type="password" placeholder="Enter Password" name="NewPassword2" id="newInput2" required>
            <input type="checkbox" onclick="myFunction()">Show Password
          <button type="submit">Change</button>
            </div>
        </form>
        <script>
    function myFunction() {
      var y = document.getElementById("newInput1");
      var z = document.getElementById("newInput2");
    
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
    </section>
</body>
</html>


