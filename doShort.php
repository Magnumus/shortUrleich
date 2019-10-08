<?php
$db_conn = mysqli_connect("localhost", "root", "", "shorturl") or die("No connection with Database");
    
    if(!empty($_POST)){
        
        $url = $_POST["url"];
        $code = "";
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);    
            
        for($g = 0; $g < 8; $g++){
            $code .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        
        $check_if_we_had_one = mysqli_query($db_conn, "SELECT * FROM urls WHERE full_url = '$url'") or die("error");
        $check_result = mysqli_fetch_array($check_if_we_had_one);
        
        if(mysqli_num_rows($check_if_we_had_one) > 0){
            $new = $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?code=".$check_result["code"];
            $new .= "<input type='text' value='$new' id='hidden'><input onclick='myFunction()' class='btn' type='button' value='Copy!'/>";
            echo $new;
        }
        else{
        
            mysqli_query($db_conn, "INSERT INTO URLs VALUES(null, '$url', '$code')")or die("dg");
            $new = $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?code=".$code;
            $new .= "<input type='text' value='$new' id='hidden'><input onclick='myFunction()' class='btn' type='button' value='Copy!'/>";
        
            echo $new;
            }
    } else if(!empty($_GET["code"])){
            $code = $_GET["code"];
            $location_url = mysqli_query($db_conn, "SELECT full_url FROM urls WHERE code = '$code'") or die("error");
            if(mysqli_num_rows($location_url) > 0){
            $location_url1 = mysqli_fetch_array($location_url);
            $f_url = $location_url1['full_url'];
            header("Location: $f_url");
            } else{
                header("Location: index.php");
            }
        } else header("Location: index.php");

?>