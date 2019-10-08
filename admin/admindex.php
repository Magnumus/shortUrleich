<?php  
session_start();
if(!isset($_SESSION["admin_is_here"])){
    header("Location: admin.php");
} else{
    $cn = mysqli_connect("localhost", "root", "", "shorturl") or die("Database error");
    $query = mysqli_query($cn,"SELECT * FROM urls") or die("query error");
    while($result1 = mysqli_fetch_array($query)){
        $id = $result1["id"];
        if($_GET["del$id"]){
            mysqli_query($cn, "DELETE FROM urls WHERE id = $id") or die("err");
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
    $query = mysqli_query($cn,"SELECT * FROM urls") or die("query error");
    while($result = mysqli_fetch_array($query)){
        $f_url = $result["full_url"];
        $new_url = $_SERVER["HTTP_HOST"]."/doShort.php?code=".$result["code"];
        $id = $result["id"];
        echo "  <td>$id</td>
                <td>$f_url</td>
                <td>$new_url</td>
                <td class='butt'><form method='get' action=''><button type='submit' value='w' name='del".$id."'>X</button></form></td></tr>";
    }
    
    ?>
        </table>
</body>
</html>