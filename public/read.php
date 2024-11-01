<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :record_per_page OFFSET :current_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
?>
<?php echo template_header('Read') ?>

    <div class="content read">
        <h2>Read Contacts</h2>
        <a href="create.php" class="create-contact">Create Contact</a>
        <table>
            <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Title</td>
                <td>Created</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?php echo $contact['id'] ?></td>
                    <td><?php echo $contact['name'] ?></td>
                    <td><?php echo $contact['email'] ?></td>
                    <td><?php echo $contact['phone'] ?></td>
                    <td><?php echo $contact['title'] ?></td>
                    <td><?php echo $contact['created'] ?></td>
                    <td class="actions">
                        <a href="update.php?id=<?php echo $contact['id'] ?>" class="edit"><i
                                    class="fas fa-pen fa-xs"></i></a>
                        <a href="delete.php?id=<?php echo $contact['id'] ?>" class="trash"><i
                                    class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="read.php?page=<?php echo $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_contacts): ?>
                <a href="read.php?page=<?php echo $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>

<?php echo template_footer() ?>