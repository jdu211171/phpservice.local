<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form>
    <input type="number" name="age" placeholder="Enter your age:">
    <input type="submit" value="Submit">
</form>
<?php
    if (isset($_GET['age']) and !empty($_GET['age'])) {
        $age = $_GET['age'];
        if ($age < 18) {
            echo "You are not allowed to drink";
        } else {
            echo "You are an adult";
        }
    }
?>
</body>
</html>

