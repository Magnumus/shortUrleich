<?php session_start();
        if(isset($_POST["log"])){
            $login = htmlspecialchars($_POST["login"]);
            $pass = htmlspecialchars($_POST["password"]);
            $cn = mysqli_connect("localhost", "root", "", "shorturl") or die("database error");
            $admin_check = mysqli_query($cn,"SELECT password FROM admin WHERE login = '$login'") or die("query error");
            $uc = mysqli_fetch_array($admin_check);
            if($uc['password'] == $pass) {
                    $_SESSION["admin_is_here"] = true;
                    header("Location: admindex.php");
            }
            
        }  else{
            $_SESSION["admin_is_here"] = false;
        }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
   <h1 align="center">Adminka</h1>
    <div class="login-page">
  <div class="form">

    <form class="login-form" method="post" action="">
      <input name="login" type="text" placeholder="username"/>
      <input name="password" type="password" placeholder="password"/>
      <button type="submit" name="log">login</button>
    </form>
  </div>
</div>
</body>
</html>