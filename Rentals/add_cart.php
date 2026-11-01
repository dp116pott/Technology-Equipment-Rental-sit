<?php
session_start();

if (empty($_POST)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'No data received.'
    ]);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][] = [
    'product_name' => $_POST['product_name'] ?? '',
    'collection_time' => $_POST['collection_t'] ?? '',
    'pickup_time' => $_POST['dropoff_t'] ?? '',
    'collection_date' => $_POST['collection_d'] ?? '',
    'pickup_date' => $_POST['dropoff_d'] ?? '',
    'total_price' => $_POST['total_price'] ?? '',
    'product_img' => $_POST['product_img'] ?? '',
];

echo json_encode([
    'status' => 'success',
    'message' => "Added to cart."
]);

?>
