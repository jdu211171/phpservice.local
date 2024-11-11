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
        $stmt = $this->pdo->prepare('INSERT INTO contacts (name, email, phone, title, created, default_work_hours) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['title'],
            $data['created'] ?? date('Y-m-d H:i:s'),
            $data['default_work_hours'] ?? 8
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
        $stmt = $this->pdo->prepare('UPDATE contacts SET name = ?, email = ?, phone = ?, title = ?, created = ?, started_at = ?, ended_at = ?, total_work_time = ?, required_work_time = ?, default_work_hours = ? WHERE id = ?');
        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['title'],
            $data['created'],
            $data['started_at'],
            $data['ended_at'],
            $data['total_work_time'],
            $data['required_work_time'],
            $data['default_work_hours'],
            $id
        ]);
    }

    public function delete($id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM contacts WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function updateWorkTime($id, $started_at, $ended_at): void
    {
        $contact = $this->getById($id);
        $work_time = (strtotime($ended_at) - strtotime($started_at)) / 3600; // Convert seconds to hours
        $total_work_time = $contact['total_work_time'];
        $required_work_time = $contact['required_work_time'];

        if ($required_work_time > 0) {
            if ($work_time >= $required_work_time) {
                $work_time -= $required_work_time;
                $required_work_time = 0;
            } else {
                $required_work_time -= $work_time;
                $work_time = 0;
            }
        }

        $total_work_time += $work_time;

        $stmt = $this->pdo->prepare('UPDATE contacts SET total_work_time = ?, required_work_time = ?, started_at = ?, ended_at = ? WHERE id = ?');
        $stmt->execute([$total_work_time, $required_work_time, $started_at, $ended_at, $id]);
    }

    public function updateRequiredWorkTime($id): void
    {
        $contact = $this->getById($id);
        $required_work_time = $contact['required_work_time'] + $contact['default_work_hours'];

        $stmt = $this->pdo->prepare('UPDATE contacts SET required_work_time = ? WHERE id = ?');
        $stmt->execute([$required_work_time, $id]);
    }
}