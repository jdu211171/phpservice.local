<?php
function pdo_connect_mysql()
{
    $DATABASE_HOST = 'MySQL-8.2';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'contact_manager';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}

function template_header($title)
{
    return <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="bg-white">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3f69a8;">
    <div class="container">
        <a class="navbar-brand" href="#">Website Title</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read.php"><i class="fas fa-address-book"></i> Contacts</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
EOT;
}

function template_footer()
{
    return <<<EOT
    </body>
</html>
EOT;
}
