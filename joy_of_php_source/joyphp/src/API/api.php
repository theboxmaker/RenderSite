<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';

// -------------------------------------------------------
// Helper: JSON response wrapper
// -------------------------------------------------------
function respond($data, $status = 200) {
    http_response_code($status);
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

// -------------------------------------------------------
// GET ALL CARS
// -------------------------------------------------------
function get_cars() {
    global $mysqli;

    $sql = "SELECT VIN, Make, Model, YEAR, ASKING_PRICE FROM inventory ORDER BY Make";
    $result = $mysqli->query($sql);

    if (!$result) {
        respond(["error" => $mysqli->error], 500);
    }

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = [
            "vin"   => $row["VIN"],
            "make"  => $row["Make"],
            "model" => $row["Model"],
            "year"  => intval($row["YEAR"]),
            "price" => floatval($row["ASKING_PRICE"])
        ];
    }

    respond($cars);
}

// -------------------------------------------------------
// GET CAR BY VIN
// -------------------------------------------------------
function get_car_by_vin($vin) {
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT * FROM inventory WHERE VIN = ? LIMIT 1");
    $stmt->bind_param("s", $vin);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        respond(["error" => "Car not found"], 404);
    }

    respond($result->fetch_assoc());
}

// -------------------------------------------------------
// ADD CAR (POST)
// -------------------------------------------------------
function add_car() {
    global $mysqli;

    // Accept raw POST data or form-data
    $VIN   = $_POST["VIN"]   ?? null;
    $Make  = $_POST["Make"]  ?? null;
    $Model = $_POST["Model"] ?? null;
    $Price = $_POST["Price"] ?? null;

    if (!$VIN || !$Make || !$Model || !$Price) {
        respond(["error" => "Missing required fields"], 400);
    }

    $stmt = $mysqli->prepare("
        INSERT INTO inventory (VIN, Make, Model, ASKING_PRICE)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("sssd", $VIN, $Make, $Model, $Price);

    try {
        $stmt->execute();
        respond(["success" => true], 201);
    } catch (mysqli_sql_exception $e) {

        // Duplicate VIN
        if ($e->getCode() == 1062) {
            respond(["error" => "Car with that VIN already exists"], 409);
        }

        respond(["error" => $e->getMessage()], 500);
    }
}

// -------------------------------------------------------
// DELETE CAR
// -------------------------------------------------------
function delete_car($vin) {
    global $mysqli;

    $stmt = $mysqli->prepare("DELETE FROM inventory WHERE VIN = ?");
    $stmt->bind_param("s", $vin);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        respond(["error" => "Car not found"], 404);
    }

    respond(["success" => true]);
}

// -------------------------------------------------------
// ROUTER
// -------------------------------------------------------
$action = $_GET["action"] ?? null;

switch ($action) {

    case "get_cars":
        get_cars();
        break;

    case "get_car_by_vin":
        get_car_by_vin($_GET["VIN"] ?? "");
        break;

    case "add_car":
        add_car();
        break;

    case "delete_car":
        delete_car($_GET["VIN"] ?? "");
        break;

    default:
        respond(["error" => "Invalid or missing action"], 400);
}
?>
