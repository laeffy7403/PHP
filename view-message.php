<?php 

session_start();


if(isset($_POST["btnDelete"])) {
    session_destroy();
    
    //navigate to another page after the current process completed
    header("Location:add-message.php");
    exit();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>view message</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include '../Genaral/header.php';
        ?>
        
        <h1>View message</h1>
        <?php 
        //check if there is any session?
        if(isset($_SESSION["sessMsg"])) {
            //retreive session
            $allMsg = $_SESSION["sessMsg"]; //array
            
            echo "<ul>";
            foreach($allMsg as $value) {
                echo "<li>$value</li>";
            } 
            echo "</ul>";
        } else {
            echo "<p>No message in the session</p>";
        }
        
        ?>
        <form action="" method="POST">
        <input type="submit" value="delete" name="btnDelete"/>
        <input type="submit" value="add" name="btnAdd" onclick="location='add-message.php'"/>
        </form>
        <?php 
        include '../Genaral/footer.php';
        ?>
    </body>
</html>
