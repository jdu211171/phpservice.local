<?php

namespace classes;

use PDO;

require_once __DIR__ . '/Database.php';

class Contact
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function create($data): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO contacts (name, email, phone, title, created) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['title'],
            $data['created'] ?? date('Y-m-d H:i:s')
        ]);
    }

    public function read($start, $limit): false|array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :limit OFFSET :start');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount()
    {
        return $this->pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
    }

    public function getById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contacts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data): void
    {
        $stmt = $this->pdo->prepare('UPDATE contacts SET name = ?, email = ?, phone = ?, title = ?, created = ? WHERE id = ?');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['title'],
            $data['created'],
            $id
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM contacts WHERE id = ?');
        $stmt->execute([$id]);
    }
}