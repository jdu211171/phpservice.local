<?php

require_once __DIR__ . '/../classes/Template.php';
require_once __DIR__ . '/../classes/Contact.php';

use classes\Contact;
use classes\Template;

$contactObj = new Contact();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$start = ($page - 1) * $records_per_page;

$contacts = $contactObj->read($start, $records_per_page);
$total_contacts = $contactObj->getCount();

echo Template::header('Read');
?>
<div class="container mt-4">
    <h2 class="border-bottom pb-2 mb-4">Read Contacts</h2>
    <a href="create.php" class="btn btn-success mb-3">Create Contact</a>
    <table class="table table-striped">
        <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Total Work Time</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact['id'] ?></td>
                <td><?php echo $contact['name'] ?></td>
                <td><?php echo $contact['total_work_time'] ?></td>
                <td class="actions">
                    <a href="update.php?id=<?= $contact['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?= $contact['id'] ?>" class="trash" style="color:red"><i
                                class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="<?php if ($page > 1) echo 'read.php?page=' . ($page - 1); ?>"
                   tabindex="-1" aria-disabled="<?php if ($page <= 1) echo 'true'; ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= ceil($total_contacts / $records_per_page); $i++): ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link"
                                                                                  href="read.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page * $records_per_page >= $total_contacts) echo 'disabled'; ?>">
                <a class="page-link"
                   href="<?php if ($page * $records_per_page < $total_contacts) echo 'read.php?page=' . ($page + 1); ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<?php
echo Template::footer();
?>
