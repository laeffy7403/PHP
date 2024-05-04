<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//create function - check program
function validateStudentProgram($program) {
    if($program == null) {
        return "please select your <b>program</b>.";
    } else if (!array_key_exists($program, allProgramme())) {
        return "Invalid <b>program</b>.";
    }
}



//create function - check gender
function validateStudentGender($gender) {
    if($gender == null) {
        return "please select your gender.";
    } else if (!array_key_exists($gender, allGender())) {
        return "Invalid gender.";
    }
}




//create function - check student name
function validateStudentName($name) {
    if($name == null) {
        return "please emter your <b>name</b>.";
    } else if(strlen($name) > 30) {
        return "your <b>name</b> exceeded 30 character.";
//       {30} force to enter 30 char
    } else if(!preg_match("/^[A-Za-z \'@\.]+$/", $name)) {
        return "invalid <b>name</b>.";
    }
}





//declare 4 constant value that needed for database connection
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "p4");





//declare function - return all gender
function allGender() {
    return array(
        "M" => "Male",
        "F" => "Female"
    );
}




// create function - return all the programms full name
function allProgramme() {
    return array(
        "FT" => "Diploma in infomation technology",
        "CS" => "Diploma in computer sceince",
        "IS" => "Diploma in infomation system"
    );
}




function validateStudentID($id) {
    if($id == null) {
        return "please enter ur <b>student ID</b>";
    } else if (!preg_match("/^[0-9]{2}[A-Z]{3}[0-9]{5}$/", $id)) {
        return "invalid <b>student id</b>";
    } else if (validateSameStudentID($id)) {
        return "same student ID detected!";
    }
}




//create function to check same student id (to avoid duplicate)
function validateSameStudentID($id) {
    $found = false;
    // step 1 : connect to DB
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    //step 1.1 clean id, remove special char from id
    $id = $con->real_escape_string($id);
    
    //step 2: sql statement
    //here must follow the table header name based on the database table header name
    $sql = "SELECT * FROM student WHERE studentID = '$id'";
    
    //step 3: ask conenction to help to process sql
    if($result = $con->query($sql)){
    
    if($result->num_rows > 0) {
        //SAME STUDENT ID FOUND 
        $found = true;
    }
    
    $result->free();
    $con->close();
    return $found;
    }
}