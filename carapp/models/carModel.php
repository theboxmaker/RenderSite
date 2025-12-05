<?php

class CarModel
{
    /* -------------------------------------------------------
       ADD VEHICLE
    ------------------------------------------------------- */
    public static function add(PDO $pdo, array $data)
    {
        $required = ['vin', 'make', 'model', 'year', 'price'];

        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing required field: $field");
            }
        }

        // Normalize VIN
        $vin = strtoupper(trim($data['vin']));

        // VIN must be 17 characters
        if (strlen($vin) !== 17) {
            throw new Exception("VIN must be exactly 17 characters.");
        }

        // Check duplicate VIN
        $stmt = $pdo->prepare("SELECT VIN FROM inventory WHERE VIN = ?");
        $stmt->execute([$vin]);

        if ($stmt->fetch()) {
            return false;
        }

        // Insert new row
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

        return true;
    }

    /* -------------------------------------------------------
       GET ALL VEHICLES
    ------------------------------------------------------- */
    public static function getAll(PDO $pdo)
    {
        $sql = "SELECT VIN, Make, Model, YEAR, ASKING_PRICE
                FROM inventory
                ORDER BY Make, Model, YEAR";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
