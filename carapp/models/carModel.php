<?php

class CarModel
{
    public static function add(PDO $pdo, array $data)
    {
        $required = ['vin', 'make', 'model', 'year', 'price'];

        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // VIN must be uppercase
        $vin = strtoupper(trim($data['vin']));

        // Check VIN format: 17 chars
        if (strlen($vin) !== 17) {
            throw new Exception("VIN must be exactly 17 characters.");
        }

        // Check if VIN already exists
        $stmt = $pdo->prepare("SELECT VIN FROM inventory WHERE VIN = ?");
        $stmt->execute([$vin]);

        if ($stmt->fetch()) {
            throw new Exception("A vehicle with this VIN already exists.");
        }

        // Insert new vehicle
        $sql = "INSERT INTO inventory (VIN, Make, Model, YEAR, ASKING_PRICE)
                VALUES (:vin, :make, :model, :year, :price)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':vin'   => $vin,
            ':make'  => trim($data['make']),
            ':model' => trim($data['model']),
            ':year'  => intval($data['year']),
            ':price' => floatval($data['price'])
        ]);
    }
}
