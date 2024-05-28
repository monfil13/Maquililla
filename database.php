<?php
$mysqli = new mysqli('localhost', 'root', '123root', 'maquila');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Create
function createPrenda($nombrePrenda, $colorPrenda, $precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO prendas (nombrePrenda, colorPrenda, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombrePrenda, $colorPrenda, $precio);
    $stmt->execute();
    $stmt->close();
}

// Update
function updatePrenda($id, $nombrePrenda, $colorPrenda, $precio) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE prendas SET nombrePrenda = ?, colorPrenda = ?, precio = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $nombrePrenda, $colorPrenda, $precio, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete
function deletePrenda($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM prendas WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>