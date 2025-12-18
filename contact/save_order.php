<?php
// Database connection
$host = 'localhost';
$dbname = 'bu_emp';
$username = 'bracuitsm';
$password = 'BracUItsm20231971#@';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['status' => 'error', 'message' => "Could not connect to the database $dbname :" . $e->getMessage()]));
}

// Get the order array from the POST request
$order = $_POST['order'];

try {
    $pdo->beginTransaction();
    
    foreach ($order as $item) {
        $id = $item['id'];
        $position = $item['position'];
        $stmt = $pdo->prepare("UPDATE tblusers SET position = :position WHERE id = :id");
        $stmt->execute([':position' => $position, ':id' => $id]);
    }

    $pdo->commit();
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
