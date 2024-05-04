<?php


$header = array( 
//DB Table column name   // HTML Table header
    "StudentID" => "Student ID",
    "StudentName" => "Student Name",
    "Gender" => "Student Gender",
    "Program" => "Student Program"
);


//retrieve sort parameter from URL
if(isset($_GET["sort"])) {
    $sort = $_GET["sort"];
} else {
    $sort =  "StudentID";  // default
}


// retieve order
if(isset($_GET["order"])) {
    $order = $_GET["order"];
} else {
    $order = "ASC";
}


//retreive program 
if(isset($_GET["program"])) {
    $program = $_GET["program"];
} else {
    //default
    $program = "%"; //retreive everything
    //SELECT * FROM Student WHERE Program LIKE "FT"
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>List student</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <?php
        include '../Genaral/header.php';
        require_once './secret/helper.php';
        ?>
         
        <h1>List of student</h1>

        
        <?php 
        // check if the delete function is click?
        if(isset($_POST["btnDelete"])) {
//            echo "test 1"
            // retreive checkbox delete
            if(isset($_POST["arrDelete"])) {
                //User selctecd checkbox to delete
                $checked = $_POST["arrDelete"];
            }  else {
                $checked = null;
            }
            
            if(!empty($checked)) {
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                
                $escaped = array();
                
                foreach ($checked as $value) {
                    $escaped[] = $con -> real_escape_string($value);
                }
                
                //DELETE FROM Student WHERE StudentID IN ('23PMD00001', '23PMD00001')
                //array -> string = implode
//                print_r($escaped);
                
                $sql = "DELETE FROM Student WHERE StudentID IN ('". implode("','",$escaped) . "')";
                echo $sql;
                if($con->query($sql)) {
                    printf("<div class='info'>
                        <b>%d</b> records has been delete
                        </div>", $con ->affected_rows);
                }
                $con->close();
            }
        }
        ?>
        
        
        <p>Filter:
            <?php 
            printf("<a href='?sort=%s&order=%s'>ALL PROGRAMME</a>", $sort, $order);
            foreach(allProgramme() as $key => $value) {
                printf("| <a href='?sort=%s&order=%s&program=%s'>%s</a>",
                        $sort,
                        $order,
                        $key,
                        $key);
            }
            ?>
        </p>
 
        <form action="" method="POST">
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th></th>
                
                <?php 
                foreach($header as $key => $value) {
                    if($key == $sort) {
                        //User can click on the column for sorting purpose
                        printf("<th>
                                <a href='?sort=%s&order=%s&program=%s'>%s %s</a></th>", $key,
                                $order == 'ASC' ? 'DESC' : 'ASC',
                                $program,
                                $value,
                             
                                $order == 'ACS' ? '⬇️️' : '⬆️');
                        
                    } else {
                        //User never click anything
                        //Default
                        printf("<th>
                                <a href='?sort=%s&order=ASC&program=%s'>%s</a></th>", $key, $program ,$value);
                        
                    }
                }       
                ?>
                <th></th>
            </tr>
            
            
            <?php 
            //step 1 : create database connection
            //NOTE: sequence of the input in mysqli is important
            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            //$con = new mysqli("localhost", "root", "", "p4");
            
            
            if($con -> connect_error) {
                //with error
                die("connection error: ". $con->connect_error);
                
            } else {
                // no error
                // step 2 : declare SQL
               
                
                //SEELCT * FROM Student ORDER BY Student
                $sql = "SELECT * FROM Student
                        WHERE Program LIKE '$program' ORDER BY $sort $order";
                 

                // step 3 ask conncetion to process sqlID ASC
                $result = $con -> query($sql); // object - a list of student records
                
                //NOTE : for database, we use "->"
                //NOTE : for associative array, we use "=>"
                
                if($result->num_rows > 0) {
                    //record found
                    while($row = $result->fetch_object()){
                        
                        printf('<tr>
                            <td><input type="checkbox" name="arrDelete[]" value="%s" /></td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td><a href="update.php?id=%s">edit</a> | <a href="delete.php?id=%s">delete</a></td>
                                </tr>', $row->studentID, $row->studentID, $row->studentName, allGender()[$row->gender]
                                ,$row->program . " - " . allProgramme()[$row->program],
                                $row->studentID, $row->studentID);
                    }
                    
                }
                
                
                printf("<tr>
                    <td colspan='6'>
                    <b>%d</b> records returned
                    <a href='insert.php'>Insert student</a>
                    </td>
                    </tr>", $result->num_rows);
                
                $con -> close();
                $result -> free();
            }
            ?>
            
        </table>
       
        <br />
        <input type="submit" name="btnDelete" value="Multiple Delete" 
               onclick="return confirm('This will delelet all record. \nAre you sure?')">
        </form>
        <?php 
        include '../Genaral/footer.php';
        ?>
        
    </body>
</html>
