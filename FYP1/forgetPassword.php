
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>trying</title>
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <style>
        .registered{
            text-align: center;
        }
        
    </style>

</head>

<?php include './header.php'; ?>

    <section class="registered">
        <form action="doForgetPass.php" method="post">

        Enter email:<input type="text" placeholder="Enter email" name="forgotEmail" required>
        <?php 
        if (isset ($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            
        }
        ?>
        
        <button type="submit">Enter</button>
    </form>
        
    </section>



</body>
</html>



