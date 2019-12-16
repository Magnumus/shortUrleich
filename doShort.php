<?php
//$db_conn = mysqli_connect("localhost", "root", "", "shorturl") or die("No connection with Database");
    require_once "connect.php";
    
    if(!empty($_POST)){
        
        $url = $_POST["url"];
        $code = "";
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars); 
            
        for($g = 0; $g < 8; $g++){
            $code .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        $stmt = $pdo->prepare("SELECT * FROM urls WHERE full_url = :f_url");
        $stmt->execute(array('f_url' => $url));
        $row_count = $stmt->rowCount();
        //$check_if_we_had_one = mysqli_query($db_conn, "SELECT * FROM urls WHERE full_url = '$url'") or die("error");
        //$check_result = mysqli_fetch_array($check_if_we_had_one);
        
        if($row_count > 0){
        foreach($stmt as $row){
            $new = $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?code=".$row["code"];
            $new .= "<input type='text' value='$new' id='hidden'><input onclick='myFunction()' class='btn' type='button' value='Copy!'/>";
            echo $new;
        }}
        else{
            $insert = $pdo->prepare("INSERT INTO URLs VALUES(null, :url, :code)");
            $insert->execute(array('url'=>$url, 'code'=>$code));
            //mysqli_query($db_conn, "INSERT INTO URLs VALUES(null, '$url', '$code')")or die("dg");
            $new = $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."?code=".$code;
            $new .= "<input type='text' value='$new' id='hidden'><input onclick='myFunction()' class='btn' type='button' value='Copy!'/>";
            echo $new;
            }
    } else if(!empty($_GET["code"])){
            $code = $_GET["code"];
            $location_url =$pdo->prepare("SELECT full_url FROM urls WHERE code = :code");
            $location_url->execute(array('code' => $code));
            $row_count = $location_url->rowCount();
            //$location_url = mysqli_query($db_conn, "SELECT full_url FROM urls WHERE code = '$code'") or die("error");
            
            if($row_count > 0){
            $location_url1 = $location_url->fetch($pdfl);
            $f_url = $location_url1["full_url"];
            
            header("Location: $f_url");
            } else{
                header("Location: index");
            }
        } else header("Location: index");

?>