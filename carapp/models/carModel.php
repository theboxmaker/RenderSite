<?php

class CarModel
{
    public static function add(PDO $pdo, array $data)
    {
        $sql = "INSERT INTO inventory (Make, Model, YEAR, ASKING_PRICE)
                VALUES (:make, :model, :year, :price)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':make'  => $data['make'],
            ':model' => $data['model'],
            ':year'  => $data['year'],
            ':price' => $data['price']
        ]);
    }

    public static function getAll(PDO $pdo)
    {
        return $pdo->query("SELECT * FROM inventory ORDER BY Make")->fetchAll();
    }
}
