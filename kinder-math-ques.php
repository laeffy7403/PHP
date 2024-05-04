<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kindergarden math ques</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include '../Genaral/header.php' ?>
        <h1>Kindergarden math ques</h1>
        <!--//action means where to go-->
        <form action="kinder-math-result.php" method="POST"> 
            <table border='0' cellspacing='0' cellspadding='10'>
        <?php
        define('NUM_OF_QUES', 5);
        define('MAX', 9);
        define('MIN', 1);
        
        for($i = 1; $i <= NUM_OF_QUES; $i++) {
            $n1 = rand(MIN, MAX);
            $n2 = rand(MIN, MAX);
            
            $ans[$i] = $n1 + $n2;
            
            printf('
                <tr class=".question">
                <td>Q%d.</td> 
                <td> %d + %d =</td>
                <td><input type="text" name="ans[]" value="" style="width:2.0em" />
                
                <input type="hidden" name="num1[]" value="%d" />
                <input type="hidden" name="num2[]" value="%d" />
</td>
                
                </tr>
                    ', $i, $n1, $n2, $n1, $n2);
        }
        ?>
            </table>
            <br>
            <input type="submit" value="Submit Ans" name="btnSubmit" />
            <input type="button" value="Re-Generate Queation" name="btnRegenerate" 
                   onclick="location='<?php echo $_SERVER['PHP_SELF'] ?>'"/>
        </form>
    </body>
    
    <script>
        document.getElementsByName("ans[]")[0].focus();
//    javascript: set pointer/ cursor to the FIRST textbox

        
    <?php include '../Genaral/footer.php' ?>
    </script>
</html>
