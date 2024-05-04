<?php 
//function that return all clubs as array
function  getClubs() {
    return array(
        "LD" => "Ladies Club",
        "MN" => "Man Club",
        "CD" => "Coding Clubs",
        "PH" => "️Phychology Clubs",
        "CM" => "Cosmic Clubs",
        "LT" => "Literature Clubs"
    ); 
}



//function to perform validation
function detectError(){
    
    //check gender
//    to access all variable retrived 
    global $gender, $name, $phone, $clubs;
    
    //array to keep all error messages
    $error = array();
    
    if($gender == null) {
        // empty
        $error['gender'] = "Please select <b>gender</b>";
    } else if (!preg_match('/^[MF]$/', $gender) ) {
        // only allow M/F
        $error['gender'] = "Invalid <b>gender</b>!";
    }
    
    if ($name == null) {
            $error['name'] = "Please enter your <b>NAME</b>";
            
            //NOTE: count() is for array
            //NOTE: strlen() is to count string char
        } else if (strlen($name) > 30) {
            $error['name'] = "Your <b>NAME</b> exceeded 30 characters!";
        }else if (!preg_match("/^[A-Za-z @,\'\.\-\/]+$/", $name)) {
            $error['name'] = "Invalid <b>NAME</b>";
        }
        
        
        
        if ($phone == null) {
            $error['phone'] = "Please enter your <b>phone number</b>";
        } else if (!preg_match("/^01[0-9]-\d{7,8}$/", $phone)) {
            $error['phone'] = "Invalid <b>Phone number</b>";
        }
        
        
        
//        /check clubs
        if($clubs == null) {
            $error['clubs'] = "Please select at least One";
        } else if (count($clubs) > 3) {
            $error['clubs'] = "you can only select up to 3 clubs";
        } else if (array_diff($clubs, array_keys(getClubs())) != null){
          $error['clubs'] = "invalid <b>clubs</b> enterd";
        }
        
        // check gender + club
        if($gender != null && $clubs != null) {
            if($gender == 'M' && in_array('LD', $clubs)) {
                $error['gender-clubs'] = "Male is NOT allowed to join Ladies Club";
            }
            else if ($gender == 'F' && in_array('MN', $clubs)) {
                $error['gender-clubs'] = "Female is NOT allowed to join gentlemen club";
            }
        }
        
        return $error;
}
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>TAR UMT Interest Club Result Page</h1>
        <?php
        // put your code here
        if(isset($_POST["btnSubmit"])) {
            //YES, user clicked
            //retrieve all user input
            $gender = $_POST['gender'];
            $name = trim($_POST['txtName']);
            $phone = trim($_POST['txtPhone']);
            $clubs = $_POST['cbClubs'];  // array
            
            if(isset($_POST["cbClubs"])) {
                $clubs = $_POST["cbClubs"];
            } else {
                $clubs = null;
            }
            
//            (isset($_POST["cbClubs"]: $clubs= null))?
//                    $clubs = $_POST["cbClubs"]: $clubs = null;
            
            
            //error checking (validation)
            $error = detectError(); //array
            
            if(empty($error)) {
                //NO ERROR
                printf('<h1>thx for joining</h1>
                    <p> 
                    <b>%s %s</b>
                    You Have joined the following clubs
                    </p>
                        ',($gender == 'M') ? 'Mr.' : 'Ms.', $name);
                
                $allClubs = getClubs();
                echo "<ul>";
                foreach ($clubs as $value) { //$club - index
                    echo "<li> $allClubs[$value] ($value)</li>";
                }
                echo "</ul>";
            } else {
                //WITH ERROR
                printf('
                    <h1>OPPS There are input error</h1>
                    <ul style="color:red">
                    <li>%s</li>
                    </ul>
                        ', implode("</li><li>",$error));
            }
             
        } else {
            //NO, user never clicked
            //security purpose, redirect user back to club-join
            echo '
                <script>location="clubs_join.php"</script>';
        }
        
        
//        if ($name == null) {
//            $error['name'] = "Please enter your <b>NAME</b>";
//            
//            //NOTE: count() is for array
//            //NOTE: strlen() is to count string char
//        } else if (strlen($name) > 30) {
//            $error['name'] = "Your <b>NAME</b> exceeded 30 characters!";
//        }else if (!preg_match("/^[A-Za-z @,\'\.\-\/]+$/", $name)) {
//            $error['name'] = "Invalid <b>NAME</b>";
//        }
//        
//        
//        
//        if ($phone == null) {
//            $error['phone'] = "Please enter your <b>phone number</b>";
//        } else if (!preg_match("/^01[0-9]-\d{7,8}$/", $phone)) {
//            $error['phone'] = "Invalid <b>Phone number</b>";
//        }
//        
//        
//        
////        /check clubs
//        if($clubs == null) {
//            $error['clubs'] = "Please select at least One";
//        } else if (count($clubs) > 3) {
//            $error['clubs'] = "you can only select up to 3 clubs";
//        } else if (array_diff($clubs, array_keys(getClubs())) != null){
//          $error['clubs'] = "invalid <b>clubs</b> enterd";
//        }
//        
//        // check gender + club
//        if($gender != null && $clubs != null) {
//            if($gender == 'M' && in_array('LD', $clubs)) {
//                $error['gender-clubs'] = "Male is NOT allowed to join Ladies Club";
//            }
//            else if ($gender == 'F' && array('GT',$clubs)) {
//                $error['gender-clubs'] = "Female is allowed to join gentlemen club";
//            }
//        }
//        
//        return $error;
        ?>
    </body>
</html>
