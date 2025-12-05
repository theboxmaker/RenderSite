<?php
require_once __DIR__ . '/../config_db.php';
require_once APP_PATH . '/db.php';
require_once APP_PATH . '/models/carModel.php';

public static function add(PDO $pdo, array $data)
{
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


header("Location: " . BASE_URL . "/?page=cars_list");
exit;
