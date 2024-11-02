<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
            header('Location: read.php');
            exit;
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?= template_header('Delete') ?>

<div class="container mt-4">
    <h2 class="border-bottom pb-2 mb-4">Delete Contact</h2>
    <p>Are you sure you want to delete contact #<?= $contact['id'] ?>?</p>
    <div class="d-flex">
        <a href="delete.php?id=<?= $contact['id'] ?>&confirm=yes" class="btn btn-danger mr-2">Yes</a>
        <a href="delete.php?id=<?= $contact['id'] ?>&confirm=no" class="btn btn-secondary">No</a>
    </div>
</div>

<?= template_footer() ?>
