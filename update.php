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
        <?php
        include '../Genaral/header.php';
        require_once './secret/helper.php'
                
        ?>
        
        <h1>Update Student</h1>
        <?php 
        
        if($_SERVER["REQUEST_METHOD"] == "GET") {
            //GET method - retireve existing record and display before delete
            //retreive id form the URL 
            $id = strtoupper(trim($_GET["id"])); 
            
            
            //retrieve record from database based on the ID
            //step 1: connect db
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            
            //Step 2: sql statement
            $sql = "SELECT * FROM student WHERE studentID = '$id'";
            
            
            //step 2.1 clean id - remove special character
            $id = $con->real_escape_string($id);
                        
            
            //step 3: process sql
            $result = $con->query($sql);
            
            if($row = $result->fetch_object()) {
//                $id = $row->studentID;
                $name = $row->studentName;
                $gender = $row->gender;
                $program = $row->program;
            } else {
                //unable to fetch record from database

                echo "<div class='error'>unable retreive record. [<a href='database.php'>back to list</a>]
                </div>";}
        } else {
            
        
        
//        $con -> close();
//        $result -> free();
        
          
        if(empty($_POST)) {
            //user never click of perform anything
        } else {
            //yes, user click or interact with the programme
            //1.1 receive input from student form 'insert.php'
                        $id = strtoupper(trim($_POST["hdID"]));
            $name = trim($_POST["txtStudentName"]);
            
            if(isset($_POST["rbGender"])) {
            $gender = trim($_POST["rbGender"]);
            } else {
                $gender = null;
            }            
            $program = trim($_POST["ddlProgramme"]);
            
            //1.2 validate / verify / check input
//            $error["id"] = validateStudentID($id);
            $error["name"] = validateStudentName($name);
            $error["gender"] = validateStudentGender($gender);
            $error["program"] = validateStudentProgram($program);
            
            
            //filter out empty error
            $error = array_filter($error);
       
            
             //check of $error contain value
            if(empty($error)) {
                // OH NO, WITH ERROR
                 //goood, no error
                //INSERT RECORD INTO DB
                //Step 1: create connection
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                //step 2: sql
                $sql = "UPDATE Student SET StudentName =?, Gender =?, Program=? WHERE StudentId = ?";
                
                //step 3: process sql 
                //NOTE: $con->query() - when there is no "?" parameter in the sql
                //NOTE: $con->prepare() - when there ARE "?" parameter in sql
                
                $stmt = $con->prepare($sql);
                
                //Step 3.1 pass in parameter into SQL
                //NOTE: string (s),int (i), double (d), blob - binary file(b)
                $stmt->bind_param("ssss", $name, $gender, $program, $id);
                
                
                //step 3.2 execute sql
                
                $stmt->execute();
                if($stmt->affected_rows > 0) {
                    //inserted succesfully
                    printf("<div class='info'>
                            student <b>%s</b> has been updated.
                            [<a href='database.php'>Back to list</a>]
                      </div>", $name);
                } else {
                    // unable to update
                    echo "<div class='error'>Unable to update <a href='database.php'>Tyr again</a></div>";
                }
                
                $stmt->close();
                $con->close();
            
            } else {
                  echo "<ul class='error'>";
                foreach ($error as $value){
                    echo "<li>$value</li>";
                }
                echo "</ul>";
            }
            
        }
        }
        ?>
        
        
        
        
        
         <form action="" method="POST">
            <table>
            <tr>
                <td>Student id</td>
                <td><input type="hidden" name="hdID" value="<?php echo (isset($id))? $id : ' '; ?>" />
                <?php echo isset($id)? $id : ""; ?> </td>
                
            </tr>
            <tr>
                <td>Student Name</td>
                <td> <input type="text" name="txtStudentName" value="<?php 
                echo isset($name)?$name : "";
                ?>" /></td>
            </tr>
            <tr>
                <td>Student Gender</td>
                <td><input type="radio" name="rbGender" value="M"
                 <?php echo (isset($gender) && $gender == "M")? "checked" : ""; ?> />Male 
                <input type="radio" name="rbGender" value="F" 
                       <?php echo (isset($gender) && $gender == "F")? "checked" : ""; ?>/>Female
                </td>
            </tr>
            
            <tr>
                <td>Programme:</td>
                <td> <select name="ddlProgramme">
                        <?php
                        foreach(allProgramme() as $key => $value) {
                            
                            if(isset($program) && $program == $key) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            
                            echo "<option value='$key' $selected >$value</option>";
                        }
                        ?>
                    </select> </td>
            </tr>
            </table>
            <input type="submit" value="insert" name="btnUpdate" />
            <input type="button" value="cancel" name="btnCancel" onclick="location='database.php'"/>
            
            <?php 
            include '../Genaral/footer.php'
            ?>
        </form>
    </body>
</html>
