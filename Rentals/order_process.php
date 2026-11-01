<?php
include_once 'C:\xampp\htdocs\TER PAGE\connection\config.php';
include_once 'C:\xampp\htdocs\TER PAGE\connection\connect.php';
$connection_instance = connect($config);
include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
session_start();
$json = file_get_contents('php://input');

// Decode JSON into associative array
$data = json_decode($json, true);

if ($data === null) {
    // JSON decode failed or no data sent
    echo "Invalid JSON or no data received.";
    exit;
}
$cart = $_SESSION['cart'] ?? [];
if (isset($data['customer_name']) && !empty($cart)) {
    $collection_d = $data['collection_d'];
    $dropoff_d = $data['dropoff_d'];

    $start = new DateTime($collection_d);
    $end = new DateTime($dropoff_d);
    $end->modify('+1 day');
    $interval = new DateInterval('P1D');
    $period = new DatePeriod($start, $interval, $end);
    $total = 0;
    foreach ($data['products'] as $item) {
        $start = new DateTime($item['item_collect']);
        $end = new DateTime($item['item_drop']);
        $end->modify('+1 day');
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);
        $query_SQL = "SELECT Weekday_price, Weekend_price FROM product_details WHERE Product_Name = :p_name";
        $query_stmt = $connection_instance->prepare($query_SQL);
        $query_stmt->bindParam(":p_name", $item['name']);
        $query_stmt->execute();
        $p_instance = $query_stmt->fetch(PDO::FETCH_ASSOC);
        $weekday = $p_instance['Weekday_price'] ?? 0;
        $weekend = $p_instance['Weekend_price'] ?? 0;

        foreach ($period as $date) {
            $dayOfWeek = $date->format('w');
            $total += ($dayOfWeek == 0 || $dayOfWeek == 6) ? $weekend : $weekday;
        }
    }
    // Generate invoice and order IDs
    $inv_SQL = 'SELECT MAX(invoice_num) AS last_num FROM invoice_gen';
    $inv_stmt = $connection_instance->prepare($inv_SQL);
    $inv_stmt->execute();
    $prev_inv = $inv_stmt->fetch(PDO::FETCH_ASSOC);
    $new_inv = isset($prev_inv['last_num']) ? $prev_inv['last_num'] + 1 : 1;

    $order_SQL = 'SELECT MAX(Order_id) AS last_id FROM order_history';
    $order_stmt = $connection_instance->prepare($order_SQL);
    $order_stmt->execute();
    $prev_order = $order_stmt->fetch(PDO::FETCH_ASSOC);
    $new_order = isset($prev_order['last_id']) ? $prev_order['last_id'] + 1 : 1;

    $placeholder = null;
    $encrypted_cusname = encryptString($data['customer_name']);
    // Insert into order_history
    $query_SQL3 = 'INSERT INTO order_history (Order_id,Customer_name,Date_initiated,Intended_returndate,Date_completed,Late,Discount,Total) 
                   VALUES(:unique_o,:customer,:date_start,:date_end,:date_complete,:late,:discount,:total)';
    $query_stmt3 = $connection_instance->prepare($query_SQL3);
    $query_stmt3->bindParam(":unique_o", $new_order);
    $query_stmt3->bindParam(":customer", $encrypted_cusname);
    $query_stmt3->bindParam(":date_start", $collection_d);
    $query_stmt3->bindParam(":date_end", $dropoff_d);
    $query_stmt3->bindParam(":date_complete", $placeholder);
    $query_stmt3->bindParam(":late", $placeholder);
    $query_stmt3->bindParam(":discount", $placeholder);
    $query_stmt3->bindParam(":total", $total);
    $query_stmt3->execute();
    $encrypted_coname = encryptString($data['company_name']);
    $encrypted_mail = encryptString($data['email']);
    $encrypted_phone = encryptString($data['phone']);
    // Insert into invoice_gen
    $query_SQL2 = 'INSERT INTO invoice_gen (invoice_num,Order_id,date_gen,cus_name,comp_name,email,phone,total_cost,discount_amt,paid,paid_date) 
                   VALUES(:inv_num,:unique_o,:date_start,:customer,:company,:mail,:phone,:cost,:discount,:paid,:date_end)';
    $query_stmt2 = $connection_instance->prepare($query_SQL2);
    $query_stmt2->bindParam(":inv_num", $new_inv);
    $query_stmt2->bindParam(":unique_o", $new_order);
    $query_stmt2->bindParam(":date_start", $collection_d);
    $query_stmt2->bindParam(":customer", $encrypted_cusname);
    $query_stmt2->bindParam(":company", $encrypted_coname);
    $query_stmt2->bindParam(":mail", $encrypted_mail);
    $query_stmt2->bindParam(":phone", $encrypted_phone);
    $query_stmt2->bindParam(":cost", $total);
    $query_stmt2->bindParam(":discount", $placeholder);
    $query_stmt2->bindParam(":paid", $placeholder);
    $query_stmt2->bindParam(":date_end", $dropoff_d);
    $query_stmt2->execute();

    // Insert into order_subtable for each cart item
    // Count quantities of each product_id in the cart
// Count quantities of each product_id in the cart
    $productCounts = [];
    foreach ($data['products'] as $row) {
        $productId = $row['id'];
        if (!isset($productCounts[$productId])) {
            $productCounts[$productId] = 0;
        }
        $productCounts[$productId]++;
    }

    foreach ($productCounts as $productId => $quantity) {
        // Get product type
        $type_SQL = "SELECT Prod_type FROM product_details WHERE Product_id = :pid";
        $type_stmt = $connection_instance->prepare($type_SQL);
        $type_stmt->bindParam(":pid", $productId);
        $type_stmt->execute();
        $productType = $type_stmt->fetchColumn();

        if (strtolower($productType) === 'packages') {
            // Get all available items grouped by product type for this package
            $avail_SQL = "
        SELECT pdp.item_id, pd.Product_id AS product_type
        FROM product_dump pdp
        JOIN product_details pd ON pdp.product_id = pd.Product_id
        LEFT JOIN order_subtable os ON pdp.item_id = os.item_id
        WHERE pdp.product_id = :pkg_id AND (os.item_id IS NULL OR os.returned = 1)";
            $avail_stmt = $connection_instance->prepare($avail_SQL);
            $avail_stmt->bindParam(":pkg_id", $productId);
            $avail_stmt->execute();
            $available_items = $avail_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Group items by product type
            $groupedItems = [];
            foreach ($available_items as $row) {
                $type = $row['product_type'];
                if (!isset($groupedItems[$type])) {
                    $groupedItems[$type] = [];
                }
                $groupedItems[$type][] = $row['item_id'];
            }

            // Determine required product types for the package
            $required_SQL = "
        SELECT DISTINCT pd.Product_id AS product_type
        FROM product_dump pdp
        JOIN product_details pd ON pdp.product_id = pd.item_id
        WHERE pdp.product_id = :pkg_id";
            $required_stmt = $connection_instance->prepare($required_SQL);
            $required_stmt->bindParam(":pkg_id", $productId);
            $required_stmt->execute();
            $requiredTypes = $required_stmt->fetchAll(PDO::FETCH_COLUMN);

            // Process each package instance
            for ($i = 0; $i < $quantity; $i++) {
                $selected_items = [];

                // Ensure availability of all types for this instance
                $missing = false;
                foreach ($requiredTypes as $type) {
                    if (!isset($groupedItems[$type]) || count($groupedItems[$type]) === 0) {
                        $missing = true;
                        break;
                    }
                    $selected_items[$type] = array_shift($groupedItems[$type]); // reserve item
                }

                if ($missing) {
                    echo "Package $i skipped: one or more product types are unavailable.\n";
                    continue; // skip this instance
                }

                // Find matching product for dates
                $matchedProduct = null;
                foreach ($data['products'] as $entry) {
                    if ($entry['id'] == $productId) {
                        $matchedProduct = $entry;
                        break;
                    }
                }

                $item_collect = $matchedProduct['item_collect'] ?? null;
                $item_drop = $matchedProduct['item_drop'] ?? null;

                // Insert one row per reserved item
                foreach ($selected_items as $type => $item_id) {
                    $insert_SQL = 'INSERT INTO order_subtable (Order_id, item_id, Product_id, returned, Date_initiated, Intended_returndate) 
                           VALUES (:o_id, :i_id, :p_id, :ret, :collect, :drop)';
                    $insert_stmt = $connection_instance->prepare($insert_SQL);
                    $insert_stmt->bindParam(":o_id", $new_order);
                    $insert_stmt->bindParam(":i_id", $item_id);
                    $insert_stmt->bindParam(":p_id", $productId); // still track the package ID
                    $insert_stmt->bindParam(":ret", $placeholder);
                    $insert_stmt->bindParam(":collect", $item_collect);
                    $insert_stmt->bindParam(":drop", $item_drop);
                    $insert_stmt->execute();
                }
            }

        } else {
            // Default handling for non-packages (as you had before)
            $safeQty = intval($quantity);
            $avail_SQL = "SELECT pdp.item_id FROM product_dump pdp 
                      LEFT JOIN order_subtable os ON pdp.item_id = os.item_id 
                      WHERE pdp.Product_id = :p_id AND (os.item_id IS NULL OR os.returned = 1) 
                      LIMIT $safeQty";

            $avail_stmt = $connection_instance->prepare($avail_SQL);
            $avail_stmt->bindParam(":p_id", $productId, PDO::PARAM_INT);
            $avail_stmt->execute();
            $availableItems = $avail_stmt->fetchAll(PDO::FETCH_COLUMN);

            if (count($availableItems) < $safeQty) {
                echo "Not enough items available for product ID: $productId";
                continue;
            }

            foreach ($availableItems as $item_id) {
                $matchedProduct = null;
                foreach ($data['products'] as $entry) {
                    if ($entry['id'] == $productId) {
                        $matchedProduct = $entry;
                        break;
                    }
                }

                $item_collect = $matchedProduct['item_collect'] ?? null;
                $item_drop = $matchedProduct['item_drop'] ?? null;

                $insert_SQL = 'INSERT INTO order_subtable (Order_id, item_id, Product_id, returned, Date_initiated, Intended_returndate) 
                   VALUES (:o_id, :i_id, :p_id, :ret, :collect, :drop)';
                $insert_stmt = $connection_instance->prepare($insert_SQL);
                $insert_stmt->bindParam(":o_id", $new_order);
                $insert_stmt->bindParam(":i_id", $item_id);
                $insert_stmt->bindParam(":p_id", $productId);
                $insert_stmt->bindParam(":ret", $placeholder);
                $insert_stmt->bindParam(":collect", $item_collect);
                $insert_stmt->bindParam(":drop", $item_drop);
                $insert_stmt->execute();
            }
        }
    }
    unset($_SESSION['cart']);
    echo json_encode([
        'status' => 'success',
        'message' => 'Order submitted successfully!'
    ]);
} else {
    unset($_SESSION['cart']);
    echo json_encode([
        'status' => 'error',
        'message' => 'No products available for checkout.'
    ]);
}
?>
