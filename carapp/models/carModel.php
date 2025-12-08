<?php

class CarModel
{
    /* -------------------------------
       ADD VEHICLE
    --------------------------------*/
    public static function add(PDO $pdo, array $data): bool
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
            throw new Exception("A vehicle with this VIN already exists.");
        }

        // Insert new row
        $sql = "INSERT INTO inventory (VIN, Make, Model, YEAR, ASKING_PRICE)
                VALUES (:vin, :make, :model, :year, :price)";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':vin'   => $vin,
            ':make'  => trim($data['make']),
            ':model' => trim($data['model']),
            ':year'  => (int)$data['year'],
            ':price' => (float)$data['price'],
        ]);
    }

    /* -------------------------------
       GET ALL VEHICLES
    --------------------------------*/
    public static function getAll(PDO $pdo): array
    {
        $sql = "SELECT VIN, Make, Model, YEAR, ASKING_PRICE
                FROM inventory
                ORDER BY Make, Model, YEAR";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    /* -------------------------------
       FIND ONE VEHICLE BY VIN
    --------------------------------*/
    public static function find(PDO $pdo, string $vin): ?array
    {
        $sql = "SELECT * FROM inventory WHERE VIN = :vin LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':vin' => $vin]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

public static function update(PDO $pdo, string $vin, array $data)
{
    $sql = "UPDATE inventory
            SET YEAR = :year,
                Make = :make,
                Model = :model,
                ASKING_PRICE = :price
            WHERE VIN = :vin";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':year'  => $data['YEAR'],
        ':make'  => $data['Make'],
        ':model' => $data['Model'],
        ':price' => $data['ASKING_PRICE'],
        ':vin'   => $vin
    ]);
}

public static function delete(PDO $pdo, string $vin)
{
    $stmt = $pdo->prepare("DELETE FROM inventory WHERE VIN = ?");
    $stmt->execute([$vin]);
}

    /* -------------------------------
       IMAGES: GET IMAGES FOR VIN
    --------------------------------*/
    public static function getImages(PDO $pdo, string $vin): array
    {
        $sql = "SELECT ID, VIN, ImageFile AS filename
                FROM images
                WHERE VIN = :vin
                ORDER BY ID DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':vin' => $vin]);
        return $stmt->fetchAll();
    }

    /* -------------------------------
       IMAGES: ADD ONE IMAGE
    --------------------------------*/
    public static function addImage(PDO $pdo, string $vin, string $filename): bool
    {
        $sql = "INSERT INTO images (VIN, ImageFile)
                VALUES (:vin, :file)";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':vin'  => $vin,
            ':file' => $filename,
        ]);
    }
}
