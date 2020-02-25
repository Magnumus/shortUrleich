<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ShortURLeich</title>
    <link rel="stylesheet" href="styles/style.css">
    <script>
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="js/ajax.js" type="application/x-javascript"></script>
</head>
<body>
    <h1>shortURLeich</h1>
    <form action="doShort.php" method="post">
        <input type="url" name="url" id="d" placeholder="Enter your URl">
        <input type="submit" name="submit" value="Short!">
    </form>
    <div>
    <p>Ваша новая ссылка:</p>
    <span class="shortUrl"></span>
    </div>
    
    <script>
        function myFunction() { 
            $("#hidden").select();
            document.execCommand("copy");
            alert("Ссылка успешно скопирована");
}
    </script>
</body>
</html>
