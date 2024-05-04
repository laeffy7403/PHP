<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TAR UMT internet club registration page</title>
        <link href="../dft3_p2/css/p2.css" rel="stylesheet" type="text/css"/>
    </head>
    
    <?php 
    include '../Genaral/header.php';
    ?>
    
    <body>
        <h1>TARUMT ILOVE TERWEAKIN</h1>
        
        <form action="clubs_result.php" method="POST">
            <table cellpadding="5" cellspacing="0" border="0" border-radius="20" >
                
                <tr>
                    <td>Gender: </td>
                    <td><input type="radio" name="gender" value="M" /> 😭 Male </td>
                    <td><input type="radio" name="gender" value="F" /> 😘 Female </td>
                    
                </tr>
                
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="txtName" value="" maxlength="300" /></td>
                </tr>
                
                <tr>
                    <td>Mobile Phone:</td>
                    <td><input type="text" name="txtPhone" value="" maxlength="12" /></td>
                </tr>
                
                <tr>
                    <td valign="top">Interest Clubs:</valign></td>
                    <td><small>(Select one to three clubs)</small><br>
                    <input type="checkbox" name="cbClubs[]" value="LD" /> 🚺Ladies Club<br />
                    <input type="checkbox" name="cbClubs[]" value="MN" /> 🚺Man Club<br />
      
                    <input type="checkbox" name="cbClubs[]" value="CD" /> 💻Coding Clubs<br />
                    <input type="checkbox" name="cbClubs[]" value="PH" /> 🗣️Phychology Clubs<br />
                    <input type="checkbox" name="cbClubs[]" value="CM" /> 🌠Cosmic Clubs<br />
                    <input type="checkbox" name="cbClubs[]" value="LT" /> 📕Literature Clubs<br />
                    
                    </td>
                    <!--<br />-->
                    
                    
                </tr>
        <?php
        // put your code here
//        include '';
        ?>
            </table>
            <input type="submit" value="Submit" name="btnSubmit"/>
            <input type="submit" value="Reset" name="btnReset" />
            <script> 
            document.getElementsByName('gender')[0].checked = true;
            </script>
        </form>
    </body>
</html>
