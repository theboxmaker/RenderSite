<?php

class CarModel
{
    public static function add(PDO $pdo, array $data)
    {
        // Ensure expected keys exist
        if (
            empty($data['vin']) ||
            empty($data['make']) ||
            empty($data['model']) ||
            empty($data['year']) ||
            empty($data['price'])
        ) {
            throw new Exception("Missing required fields.");
        }

        $sql = "INSERT INTO inventory (VIN, Make, Model, YEAR, ASKING_PRICE)
                VALUES (:vin, :make, :model, :year, :price)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':vin'   => $data['vin'],
            ':make'  => $data['make'],
            ':model' => $data['model'],
            ':year'  => $data['year'],
            ':price' => $data['price']
        ]);
    }
}
