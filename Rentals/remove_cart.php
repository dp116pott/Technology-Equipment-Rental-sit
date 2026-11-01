<?php
session_start();

if (isset($_POST['empty']) && $_POST['empty'] === 'true') {
    unset($_SESSION['cart']);
    echo json_encode([
        'status' => 'success',
        'message' => "Cart has been emptied."
    ]);
    exit;
}

if (isset($_POST['index'])) {
    $index = (int) $_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex array
        echo json_encode([
            'status' => 'success',
            'message' => "Item removed from cart."
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Item not found.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No data received.'
    ]);
}
