<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product'])) {
    $productName = $_POST['product'];

    //COME BACK TO THIS AND ALLOW USERS TO UNLIKE 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/TER PAGE/connection/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/TER PAGE/connection/connect.php';
    $connection_instance = connect($config);

    // Get current likes
    $stmt = $connection_instance->prepare("SELECT Likes FROM product_details WHERE Product_name = :name");
    $stmt->bindParam(":name", $productName);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $newLikes = $result['Likes'] + 1;

        // Update likes
        $update = $connection_instance->prepare("UPDATE product_details SET Likes = :likes WHERE Product_name = :name");
        $update->bindParam(":likes", $newLikes);
        $update->bindParam(":name", $productName);
        $update->execute();

        echo json_encode(['success' => true, 'newLikes' => $newLikes]);
        exit;
    }
}
echo json_encode(['success' => false]);
