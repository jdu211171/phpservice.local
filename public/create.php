<?php

require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Contact.php';

use classes\Contact;
use classes\Template;

$contact = new Contact();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact->create($_POST);
    header('Location: read.php');
    exit;
}

echo Template::header('Create');
?>
    <div class="container mt-4 pb-4">
        <h2 class="border-bottom pb-2 mb-4">Create Contact</h2>
        <form action="create.php" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="John Doe" id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="johndoe@example.com" id="email">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="2025550143" id="phone">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Employee" id="title">
            </div>
            <div class="form-group">
                <label for="created">Created</label>
                <input type="datetime-local" class="form-control" name="created" value="<?= date('Y-m-d\TH:i') ?>"
                       id="created">
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
<?php
echo Template::footer();
?>