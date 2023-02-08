

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
    
if (isset($_SESSION['username'])){
?>
    <section class="account">
        <h2>Profile</h2>
        <a style="font-weight:bold">User Name: </a>
            <a><?php echo $_SESSION['username'];?><br></a>
        <a style="font-weight:bold">Email: </a>
            <a><?php echo $_SESSION['email'];?><br></a>

            <a style="font-weight:bold">Date created: </a>
            <a><?php echo $_SESSION['date_created'];?><br></a>
            <a style="font-weight:bold">Total post: </a>
            <a><?php echo $_SESSION['total_post'];?><br></a>
        <a href="logout.php" style="color: darkblue;">Logout</a>

        <form  action="doaccount.php" method="post">
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
            <?php } elseif (isset ($_SESSION['changepass'])) {
                   echo $_SESSION['changepass'];
                   unset($_SESSION['changepass']);?>
            
                <?php }?> 
              
            <label for="psw"><b>Current Password: </b></label>
            <input type="password" placeholder="Enter Password" name="currentPassword" id="currInput" required>
            

            
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
      var x = document.getElementById("currInput");
      var y = document.getElementById("newInput1");
      var z = document.getElementById("newInput2");

      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    
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
    
    
<?php } else{?>
    <div style="text-align: center">
        <a style="font-weight: bold">You Have Not Login In Yet</a><br>
        Go back to home page<br>
        <a class="pointer" href = "index.php">Home Page</a>
    </div>
<?php }?> 
</body>
</html>

