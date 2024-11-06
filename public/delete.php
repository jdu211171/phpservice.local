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

$contact = $contactObj->getById($id);

if (!$contact) {
    exit('Contact doesn\'t exist with that ID!');
}

if (isset($_GET['confirm'])) {
    if ($_GET['confirm'] === 'yes') {
        $contactObj->delete($id);
    }
    header('Location: read.php');
    exit;
}

echo Template::header('Delete');
?>
    <div class="container mt-4">
        <h2 class="border-bottom pb-2 mb-4">Delete Contact</h2>
        <p>Are you sure you want to delete contact #<?= htmlspecialchars($contact['id']) ?>?</p>
        <div class="d-flex">
            <a href="delete.php?id=<?= $contact['id'] ?>&confirm=yes" class="btn btn-danger mr-2">Yes</a>
            <a href="delete.php?id=<?= $contact['id'] ?>&confirm=no" class="btn btn-secondary">No</a>
        </div>
    </div>
<?php
echo Template::footer();
?>