<?php  
session_start();
require_once "../connect.php";
if(!isset($_SESSION["admin_is_here"])){
    header("Location: admin.php");
} else{
    //$query = mysqli_query($cn,"SELECT * FROM urls") or die("query error");
    $query = $pdo->query("SELECT * FROM urls");
    while($result = $query->fetch($pdfl)){
        $id = $result["id"];
        if($_GET["del$id"]){
            //mysqli_query($cn, "DELETE FROM urls WHERE id = $id") or die("err");
            $del = $pdo->prepare("DELETE FROM urls WHERE id = :id");
            $del->execute(array($id));
        }
    }

}
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin-panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1 align="center">Adminka</h1>
    <table border='1' style='width: 100%;'><tr>
                <th>ID</th>
                <th>Оригинальная ссылка</th>
                <th>Новая ссылка</th>
                <th>Удалить</th></tr>
                <tr>
    <?php
                    
    //$query = mysqli_query($cn,"SELECT * FROM urls") or die("query error");
    $all = $pdo->query("SELECT * FROM urls");
                    $count = 0;
    while($result = $all->fetch($pdfl)){
        $f_url = $result["full_url"];
        $new_url = $_SERVER["HTTP_HOST"]."/doShort.php?code=".$result["code"];
        $id = $result["id"];
        echo "  <td>".++$count."</td>
                <td>$f_url</td>
                <td>$new_url</td>
                <td class='butt'><form method='get' action=''><button type='submit' value='w' name='del".$id."'>X</button></form></td></tr>";
    }
    
    ?>
        </table>
</body>
</html>