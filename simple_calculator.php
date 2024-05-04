<?php 
function errorDetector() {
    global $value1, $value2;
    
    $error = array();
    
    if($value1 == null) {
        $error["num1"] = "number 1 is empty";
        
    } else if (!preg_match("/^[+-]?\d+$/", $value1)) {
        $error["num1"] = "invalid number";
//        \d - any number is accepted
    } else if ($value1 < (-PHP_INT_MAX - 1) && $value1 > PHP_INT_MAX){
        $error["num1"] = "number out of range";
    } 
    
    
    
    if($value2 == null) {
        $error["num2"] = "number 2 is empty";
        
    }else if (!preg_match("/^[+-]?\d+$/", $value1)) {
        $error["num2"] = "invalid number";
        
    } else if ($value2 < (-PHP_INT_MAX - 1) && $value2 > PHP_INT_MAX){
        $error["num2"] = "number out of range";
        
    } else if (isset($_POST["btnDivide"]) && (int)$value2 == 0) {
        $error["value2"] = "cannot divide by zero";
    }
    
    return $error;
    
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="../DFTP3/css/style.css" rel="stylesheet" type="text/css"/>
        <!--<link href="../DFTP3/css/style.css" rel="stylesheet" type="text/css"/>-->
        <title></title>
    </head>
    <body>
        <?php 
        if(!empty($_POST)) {
            $value1 = trim($_POST["num1"]);
            $value2 = trim($_POST["num2"]);
//            trim() = remove space in the txt
            
            $validation = errorDetector();
            
            if(empty($validation)) {
                $answer1 = (int)$value1;
                $answer2 = (int)$value2;
                
                if(isset($_POST["btnAdd"])) {
                    $action = "add";
                    $symbol = " + ";
                    $sumAnswer = $answer1 + $answer2;
                    
                } else if(isset($_POST["btnMinus"])) {
                    $action = "minus";
                    $symbol = " - ";
                    $sumAnswer = $answer1 - $answer2;
                    
                } else if(isset($_POST["btnMultiply"])) {
                    $action = "multiply";
                    $symbol = " * ";
                    $sumAnswer = $answer1 * $answer2;
                    
                } else if(isset($_POST["btnDivide"])) {
                    $action = "divide";
                    $symbol = " / ";
                    $sumAnswer = $answer1 / $answer2;
                } else {
                    $action = "divide";
                    $symbol = " / ";
                    $sumAnswer = $answer1 / $answer2;
                }
                
                printf(' 
                    <div class="info">%s : %d %s %d = %s</div>
                        ',$action, $answer1, $symbol, $answer2, $sumAnswer);
                
                
            } else {
                printf('<ul class="error">   
                    <li>%s</li>
                  
                        </ul>', implode("</li><li>", $validation));
            }   
        }
        
        ?>
        <form action="" method="POST">
            <h1>Simple Calculator</h1>        
            
            <table>
                <tr>
                    <td>number 1:</td>
                    <td><input type="text" name="num1" value="<?php echo (isset($value1))? $answer:"";
//                    echo $answer1 ?>" width="12px"/></td>
                    
                </tr>
                
                <tr>
                    <td>number 2:</td>
                    <td><input type="text" name="num2" value="<?php echo (isset($value2))? $answer:"";
//                    echo $answer2 ?>" width="12px"/></td>
                </tr>

            </table>
                <input type="submit" value="add" name="btnAdd" />
                    
                <input type="submit" value="minus" name="btnMinus" />
                
                <input type="submit" value="multiply" name="btnMultiply" />
                
                <input type="submit" value="divide" name="btnDivide" />
                
                <input type="button" value="reset" name="btnReset" onclick="location='simple_calculator.php'"/>
            
        </form>
       
    </body>
</html>
