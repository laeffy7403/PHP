
<?php

//no matter to set / access session, we mustadd in the following function
session_start();

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
         <?php
       
        include '../Genaral/header.php';
        ?>
        
        <h1>Add message</h1>
        <?php 
        //check if they is a message in the textbox
        if(isset($_POST["txtMsg"])) {
            //retreive msg
            $msg = trim($_POST["txtMsg"]);
            if($msg != null) {
                //convert special sysbol into html compatible 
                htmlspecialchars($msg);
                
                //keep $msg into a session
                //NOTE: SESSION ALLOWED COMPLEX DATA eg:
                //array and object 
                $_SESSION["sessMsg"][] = $msg;
                
                echo "<p>message added to seesion.</p>"; 
            }
        }
        ?>
        
        
        <form action="" method="POST">
        <input type="text" name="txtMsg" value="" maxlength="60"/>
        <input type="submit" value="Add" />
        <input type="submit" value="View" onclick="location='view-message.php'"/>
        </form>
        <?php 
        
        include '../Genaral/footer.php';
        ?>
    </body>
</html>
