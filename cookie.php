<?php
//retreive cookie
if(isset($_COOKIE["cooTask"])) {
    //explode = string -> array 
    $arrTask = explode("|",$_COOKIE["cooTask"]);
} else {
    $arrTask = null;
}

//handle delete action
if(isset($_POST["hdTask"])) {
//    echo $index;
    //retreive
    $index = $_POST["hdTask"];
    
    //delete
    unset($arrTask[$index]);
    
    //update cookie
    setcookie("cooTask", implode("|", $arrTask), time() + 365 * 24 * 60* 60);
}

?>



<?php
//check if the user anything into the textbox
if(isset($_POST["txtTask"])) {
    //retrieve textbox value
    $task = trim($_POST["txtTask"]);
    
    if($task != null) {
        //convert those special sysbol to become html compatible code
        //eg: copyright icon -> &COPY
        //we take the task and keep it as an array
        $arrTask[] = htmlspecialchars($task);
        
        //keep it into the cookie
        //NOTE: cookie - client side state management method
        //store inside the client computer
        //a txt file, 4kb, cookie only allowed PRIMITIVE DATA VALUE e.g string, char, int, double, bool
        //NOT recommeded for sensitive data
        //Web feature(function) that apply cookie:
        //1: login, remember me
        //2: langauge preference
        //3: webside theme, dark mode, light mode
        //conclusion: user specific infomation
        
        //convert array - string
        //seperator = task 1 | task 2 | task 3
        setcookie("cooTask", implode("|", $arrTask), time() + 365 * 24 * 60* 60);
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <title>todo list</title>
    </head>
    <body>
        <?php
       
        include '../Genaral/header.php';
        ?>
        
        <h1>my TO-DO list</h1>
        
        
        <?php
        if(empty($arrTask)) {
            //array is empty, nothing from session
            echo "<p>you do not have any pending task</p>";
        } else {
            //count() - array
            //strlen() - string char
            printf("<p>you have %d pending task(s):</p>", count($arrTask));
            
            echo "<table>";

            foreach($arrTask as $key => $value) {
                echo "<form action='' method='POST'>";
                printf("<tr><td>
                    <input type='submit' name='btnX' value='X'>
                    <input type='hidden' name='hdTask' value='%d' />
                    
                    <td>%d</td>
                    <td>%s</td>
                        </td></tr>", $key, $key + 1, $value);
                echo "</form>";
            }

            echo "</table>";
        }
        ?>
        
        
        <form action="" method="POST">
                       
        <input type="text" name="txtTask" value="" maxlength ="60" size="60" />
        
        <input type="submit" value="btnAdd" name="btnAdd" />
        
 
        </form>

        <?php 
        
        include '../Genaral/footer.php';
        ?>
    </body>
</html>
