<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';

// ------------------------------
// JSON helper
// ------------------------------
function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// ------------------------------
// Get all cars
// ------------------------------
function get_cars() {
    global $mysqli;

    $result = $mysqli->query("
        SELECT VIN, Make, Model, ASKING_PRICE
        FROM inventory
        ORDER BY Make, Model
    ");

    if (!$result) {
        respond(["error" => $mysqli->error], 500);
    }

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    respond($cars);
}

// ------------------------------
// Get car by VIN
// ------------------------------
function get_car_by_vin($vin) {
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM inventory WHERE VIN = ?");
    $stmt->bind_param("s", $vin);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        respond(["error" => "Car not found"], 404);
    }

    respond($result->fetch_assoc());
}

// ------------------------------
// ROUTER
// ------------------------------
$action = $_GET["action"] ?? null;

switch ($action) {
    case "get_cars":
        get_cars();
        break;

    case "get_car_by_vin":
        get_car_by_vin($_GET["VIN"] ?? "");
        break;

    default:
        respond(["error" => "Invalid or missing action"], 400);
}
?>
