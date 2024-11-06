<?php

namespace classes;

class Template
{
    public static function header($title): string
    {
        return <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$title} - Contact Manager</title>
    <!-- Include Bootstrap CSS and other resources -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #3f69a8;">
    <div class="container">
        <a class="navbar-brand" href="#">Contact Manager</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="read.php"><i class="fas fa-address-book"></i> Contacts</a></li>
            </ul>
        </div>
    </div>
</nav>
EOT;
    }

    public static function footer(): string
    {
        return <<<EOT
</body>
</html>
EOT;
    }
}