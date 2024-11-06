<?php

use classes\Template;

require_once __DIR__ . '/../classes/Template.php';

echo Template::header('Home');
?>
    <div class="container mt-4">
        <h2 class="border-bottom pb-2 mb-4">Home</h2>
        <p>Welcome to the home page!</p>
    </div>
<?php
echo Template::footer();
?>