<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete student</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        include '../Genaral/header.php';
        require_once './secret/helper.php';
        ?>
        
        <h1>Delete Student</h1>
        <?php 
        if($_SERVER["REQUEST_METHOD"] == "GET") {
            //GET method - retireve existing record and display before delete
            //retreive id form the URL 
            $id = strtoupper(trim($_GET["id"])); 
            
            //retrieve record from database based on the ID
            //step 1: connect db
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //Step 2: sql statement
            $sql = "SELECT * FROM Student WHERE StudentID = '$id'";
            
            //step 2.1 clean id - remove special character
            
            $id = $con->real_escape_string($id);
                        
            //step 3: process sql
            
            $result = $con->query($sql);
            
            if($row = $result->fetch_object()) {
                $id = $row->studentID;
                $name = $row->studentName;
                $gender = $row->gender;
                $program = $row->program;
                
                printf("<p>are you sure you want to delete the following student?
                       <table border='1' cellpadding='5'>
                       <tr>
                       <td>student id:</td>
                       <td>%s</td>
                       </tr>
                       <tr>
                       <td>student name:</td>
                       <td>%s</td>
                       </tr>
                       <tr>
                       <td>gender:</td>
                       <td>%s</td>
                       </tr>
                       <tr>
                       <td>program:</td>
                       <td>%s</td>
                       </tr>
                       </table>
                       <form action='' method='POST'>
                       
                       //curi-curi
                       <input type='hidden' name='hdID' value='%s' />
                       <input type='hidden' name='hdname' value='%s' />
                       
                       <input type='submit' name='btnYes' value='Yes'/>
                       <input type='button' name='btnCancel' value='Cancel' onclick='location=\"database.php\"' />
                       </form>
                        </p>", $id, $name, allGender()[$gender], allProgramme()[$program], $id, $name);
            }
            $con -> close();
            $result -> free();
            
        } else {
            // POST method - to performance delete fucntion when the user click the yes button
            //yes button
            
            //retreive student id from hidden field
            $id = strtoupper(trim($_POST["hdID"]));
            $name = trim($_POST["hdname"]);
            
            //step 1: sql
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //ste 2: sql (pamaterised query)
            $sql = "DELETE FROM student WHERE studentID = ?";
            
            //step 2.1 pass in value into sql parameter
            //NOTE: $con->query() - when swl has no "?" (no parameter)
            //NOTE:$con->prepare()- sql contains "?" (with parameter)            
            $stmt = $con->prepare($sql);
            
            //step 2.2 bind value into the sql
            //NOTE:indicate date type of the value
          
            //s - string, i - integer, d - double, b - blob
            $stmt->bind_param("s", $id);
         
            //step 3: execute (run) the sql
            $stmt->execute();
            
            if($stmt->affected_rows > 0) {
                //successfully deleted
                printf("<div class='info'>student <b>%s</b> has been deleted.
                    [<a href='database.php'>back to list</a>]
                        </div>", $name);
            } else {
                //unale to delete
                echo "<div class='error'>unable to delete. [<a href='database.php'>back to list</a>]
                </div>";
            }
        }
        $con -> close();
        $stmt -> close();
        
        ?>
        
        <?php
        include '../Genaral/footer.php';
        ?>
    </body>
</html>
