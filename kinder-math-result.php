<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <title>kindergarden-math-ques</title>
    </head>
    <body>
        <h1>Your Result</h1>
        <?php
        
        //make sure user clikc the submit button
        //and the kinder-maht-ques contain answer
        //from the user
        
       if(isset($_POST['btnSubmit'])) {
           //yes user clicked and submit the form
           //
           //variable to keep track how many question user
           //answer correcly
           
           $count = 0;
           
           
          //retreive num1 num2 and the ans array form
           $allNum1 = $_POST['num1']; // array
           $allNum2 = $_POST['num2']; // array
           $allAns = $_POST['ans']; // array
           
           echo "<table cellspacing ='0' cellpadding='10' >";
           
           for($i=0; $i< count($allAns); $i++) {
               
               //checking answer
               if((int)$allNum1[$i] + (int)$allNum2[$i] == (int)$allAns[$i]) {
                   //corrent answer
                   $color = "corrent";
                   $image = "image/correct-big.png";
                   $comment = "Correct";
                   $count++;
               } else {
                   //wrong answer
                   $color = "wrong";
                   $image = "image/wrong-big.png";
                   $comment = "It Should be <b>" .((int)$allNum1[$i] + (int)$allNum2[$i]) . "<br>";
               }
               printf('
                   <tr class="%s">
                   <td>Q%d.</td>
                   <td>%d + %d = %s</td>
                   <td><img src="%s" /></td>
                   
                   <td>%s</td>
                   
                   </tr>
                       ',$color, $i+1, $allNum1[$i], $allNum2[$i], $allAns[$i], $image, $comment);
               
           }
           
           echo "</table>";
           
           printf(' 
                   you get <b>%d</b> correct out of %d
                  <a href="kinder-math-ques.php">Click Here To Retry</a> ', $count, count($allAns));
       } else {
           // user never click anything
           echo "<h1>You must complete the quesiton first</h1>
             <a href='kinder-math-ques.php'>Click here to question page</a>";
       }
        ?>
    </body>
</html>
