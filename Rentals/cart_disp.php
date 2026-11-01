<?php
session_start();
include_once 'C:\xampp\htdocs\TER PAGE\connection\config.php';
include_once 'C:\xampp\htdocs\TER PAGE\connection\connect.php';
$connection_instance = connect($config);
include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
$cart = $_SESSION['cart'] ?? [];
$collection_dates = array_column($cart, 'collection_date');
$pickup_dates = array_column($cart, 'pickup_date');

$min_collection_date = !empty($collection_dates) ? min($collection_dates) : null;
$max_pickup_date = !empty($pickup_dates) ? max($pickup_dates) : null;
$final_total = 0;
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>My Cart</title>
    <link rel="icon" href="../images/icon.png" type="image/gif" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Files -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../css/plugins.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/coloring.css" rel="stylesheet">
    <link id="colors" href="../css/colors/scheme-01.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php'; ?>
        <section id="section-cart" class="bg-gray-100">
            <div class="container">
                <div class="row">
                    <div class="card padding30 rounded-5 mb25">
                        <h4>Your Cart</h4>
                        <table class="table de-table">
                            <thead>
                                <tr>
                                    <th><span class="fs-12 text-gray">Image</span></th>
                                    <th><span class="fs-12 text-gray">Product</span></th>
                                    <th><span class="fs-12 text-gray">Total Price</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $index => $item): ?>
                                    <tr class="cart-row" data-index="<?= $index ?>">
                                        <td>
                                            <img src="/TER Page/images/<?= htmlspecialchars($item['product_img']) ?>"
                                                width="100" height="70" alt="Product Image">
                                        </td>
                                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                                        <td>$<?= htmlspecialchars($item['total_price']) ?></td>
                                        <td>
                                            <button class="delete-btn btn btn-danger"
                                                data-index="<?= $index ?>">Remove</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $final_total = $final_total + $item['total_price'];
                                endforeach; ?>
                                <?php if (empty($cart)): ?>
                                    <tr>
                                        <td colspan="4">Your cart is empty.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button id="show" class="btn btn-primary">Checkout</button>
                            <div style="flex: 1; text-align: center;">
                                <p style="margin-left: 270px;">Final total: $<?= $final_total ?></p>
                            </div>
                            <button id="empty-cart" class="btn btn-warning">Empty Cart</button>
                        </div>


                    </div>
                    <div id="popupForm" class="modal-overlay"
                        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:999;">
                        <div class="modal-content"
                            style="background:#fff; margin:10% auto; padding:20px; width:400px; position:relative; border-radius:10px;">
                            <span class="close-btn"
                                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">&times;</span>
                            <h3>Customer Details</h3>
                            <label for="comp_name">Company Name:</label>
                            <input type="text" id="comp_name" name="comp_name" required><br>

                            <label for="cus_name">Customer Name:</label>
                            <input type="text" id="cus_name" name="cus_name" required><br>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required><br>

                            <label for="phone">Phone Number:</label>
                            <input type="text" id="phone" name="phone"><br>

                            <button type="submit" id="checkout">Confirm Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript Files -->
    <script src="../js/plugins.js"></script>
    <script src="../js/designesia.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log(<?= json_encode($collection_dates)?>);
            console.log(<?= json_encode($pickup_dates)?>);
            // Remove single item
            document.querySelectorAll(".delete-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    const index = btn.getAttribute("data-index");
                    Swal.fire({
                        title: `Delete From Cart?`,
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: 'remove_cart.php',
                                data: { index: index },
                                success: function (response) {
                                    console.log(response);

                                    let res;
                                    try {
                                        res = typeof response === 'string' ? JSON.parse(response) : response;
                                    } catch (e) {
                                        res = { status: 'error', message: 'Invalid server response format.' };
                                    }

                                    if (res.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: res.message
                                        }).then(() => {
                                            location.reload(); // or redirect
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Failed',
                                            text: res.message
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error("AJAX error:", error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'AJAX Request Failed',
                                        text: 'Something went wrong. Please try again.'
                                    });
                                }
                            });
                        }
                    });
                });
            });

            // Empty entire cart
            document.getElementById("empty-cart").addEventListener("click", function () {
                Swal.fire({
                    title: `Empty Your Cart?`,
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: 'remove_cart.php', // same file
                            data: { empty: 'true' },
                            success: function (response) {
                                console.log(response);

                                let res;
                                try {
                                    res = typeof response === 'string' ? JSON.parse(response) : response;
                                } catch (e) {
                                    res = { status: 'error', message: 'Invalid server response format.' };
                                }

                                if (res.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: res.message
                                    }).then(() => {
                                        location.reload(); // or redirect
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed',
                                        text: res.message
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("AJAX error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'AJAX Request Failed',
                                    text: 'Something went wrong. Please try again.'
                                });
                            }
                        });
                    }
                });
            });
            document.getElementById("show").addEventListener("click", function (d) {
                d.preventDefault();
                document.getElementById("popupForm").style.display = 'block';
            })
            document.querySelector(".close-btn").addEventListener("click", function () {
                document.getElementById("popupForm").style.display = "none";
            });
            // Checkout button
            document.getElementById("checkout").addEventListener("click", function () {
                const company = document.getElementById("comp_name").value;
                const customer = document.getElementById("cus_name").value;
                const email = document.getElementById("email").value;
                const phone = document.getElementById("phone").value;

                const collectionDate = <?= json_encode($min_collection_date) ?>;
                const dropoffDate = <?= json_encode($max_pickup_date) ?>;

                const cartProducts = <?= json_encode(array_map(function ($item) use ($connection_instance) {
                    $stmt = $connection_instance->prepare('SELECT Product_id FROM product_details WHERE Product_Name = :name');
                    $stmt->execute([':name' => $item['product_name']]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    return [
                        'name' => $item['product_name'],
                        'id' => $row ? $row['Product_id'] : null,
                        'item_collect' => $item['collection_date'],
                        'item_drop' => $item['pickup_date']
                    ];
                }, $cart)) ?>;
                const checkoutData = {
                    customer_name: customer,
                    company_name: company,
                    email: email,
                    phone: phone,
                    collection_d: collectionDate,
                    dropoff_d: dropoffDate,
                    products: cartProducts
                };

                $.ajax({
                    type: 'POST',
                    url: 'order_process.php',
                    data: JSON.stringify(checkoutData),
                    contentType: 'application/json',
                    success: function (response) {
                        // If your response is JSON, parse it (if jQuery didn't auto-parse it)
                        console.log(response);
                        let res;
                        try {
                            res = typeof response === 'string' ? JSON.parse(response) : response;
                        } catch (e) {
                            res = { status: 'error', message: 'Invalid server response.' };
                        }

                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Order Submitted!',
                                text: res.message
                            }).then(() => {
                                window.location.href = "cart_disp.php";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Order Failed',
                                text: res.message || 'Something went wrong. Please try again.'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Checkout Failed',
                            text: 'There was an error during checkout. Please try again.'
                        });
                    }
                });
            });


        });
    </script>
</body>

</html>
