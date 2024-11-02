<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $created = isset($_POST['created']) ? $_POST['created'] : date('Y-m-d H:i:s');
    $stmt = $pdo->prepare('INSERT INTO contacts VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone, $title, $created]);
    $msg = 'Created Successfully!';
    header('Location: read.php');
    exit;
}
?>

<?= template_header('Create') ?>

<div class="container mt-4 pb-4">
    <h2 class="border-bottom pb-2 mb-4">Create Contact</h2>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" name="id" placeholder="26" value="auto" id="id">
        </div>
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

<?= template_footer() ?>
