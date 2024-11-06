<?php

use classes\Contact;
use classes\Template;

require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Contact.php';

$contactObj = new Contact();
$id = $_GET['id'] ?? null;

if (!$id) {
    exit('No ID specified!');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactObj->update($id, $_POST);
    header('Location: read.php');
    exit;
}

$contact = $contactObj->getById($id);

if (!$contact) {
    exit('Contact doesn\'t exist with that ID!');
}

echo Template::header('Update');
?>
    <div class="container mt-4 pb-4">
        <h2 class="border-bottom pb-2 mb-4">Update Contact</h2>
        <form action="update.php?id=<?= $contact['id'] ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="John Doe"
                       value="<?= $contact['name'] ?>"
                       id="name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="johndoe@example.com"
                       value="<?= $contact['email'] ?>" id="email">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="2025550143"
                       value="<?= $contact['phone'] ?>" id="phone">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Employee"
                       value="<?= $contact['title'] ?>"
                       id="title">
            </div>
            <div class="form-group">
                <label for="created">Created</label>
                <input type="datetime-local" class="form-control" name="created"
                       value="<?= date('Y-m-d\TH:i', strtotime($contact['created'])) ?>" id="created">
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
<?php
echo Template::footer();
?>