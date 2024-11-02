<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE contacts SET id = ?, name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone, $title, $created, $_GET['id']]);
        $msg = 'Updated Successfully!';
        header('Location: read.php');
        exit;

    }
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?= template_header('Read') ?>

<div class="container mt-4 pb-4">
    <h2 class="border-bottom pb-2 mb-4">Update Contact</h2>
    <form action="update.php?id=<?= $contact['id'] ?>" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" name="id" placeholder="1" value="<?= $contact['id'] ?>" id="id">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="John Doe" value="<?= $contact['name'] ?>"
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
            <input type="text" class="form-control" name="title" placeholder="Employee" value="<?= $contact['title'] ?>"
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

<?= template_footer() ?>
