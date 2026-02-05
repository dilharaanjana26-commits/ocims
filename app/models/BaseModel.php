<?php
class BaseModel
{
    protected $table;

    public function all()
    {
        $stmt = Database::get()->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = Database::get()->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $columns = implode(',', array_keys($data));
        $placeholders = ':' . implode(',:', array_keys($data));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = Database::get()->prepare($sql);
        $stmt->execute($data);
        return Database::get()->lastInsertId();
    }

    public function update($id, $data)
    {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = :{$key}";
        }
        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET " . implode(',', $fields) . " WHERE id = :id";
        $stmt = Database::get()->prepare($sql);
        return $stmt->execute($data);
    }
}
