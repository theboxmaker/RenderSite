<?php

class CarModel {

    public static function all(PDO $pdo) {
        $stmt = $pdo->query("SELECT * FROM inventory ORDER BY Make, Model");
        return $stmt->fetchAll();
    }

    public static function find(PDO $pdo, $vin) {
        $stmt = $pdo->prepare("SELECT * FROM inventory WHERE VIN = ?");
        $stmt->execute([$vin]);
        return $stmt->fetch();
    }

    public static function add(PDO $pdo, $data) {
        $stmt = $pdo->prepare("
            INSERT INTO inventory (VIN, YEAR, Make, Model, ASKING_PRICE)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['VIN'],
            $data['YEAR'],
            $data['Make'],
            $data['Model'],
            $data['ASKING_PRICE']
        ]);
    }

    public static function update(PDO $pdo, $vin, $data) {
        $stmt = $pdo->prepare("
            UPDATE inventory
            SET YEAR=?, Make=?, Model=?, ASKING_PRICE=?
            WHERE VIN=?
        ");
        return $stmt->execute([
            $data['YEAR'],
            $data['Make'],
            $data['Model'],
            $data['ASKING_PRICE'],
            $vin
        ]);
    }

    public static function delete(PDO $pdo, $vin) {
        $stmt = $pdo->prepare("DELETE FROM inventory WHERE VIN = ?");
        return $stmt->execute([$vin]);
    }
    public static function getImages(PDO $pdo, $vin) {
    $stmt = $pdo->prepare("SELECT filename FROM car_images WHERE VIN = ?");
    $stmt->execute([$vin]);
    return $stmt->fetchAll();
}

public static function addImage(PDO $pdo, $vin, $filename) {
    $stmt = $pdo->prepare("
        INSERT INTO car_images (VIN, filename)
        VALUES (?, ?)
    ");
    return $stmt->execute([$vin, $filename]);
}
}
