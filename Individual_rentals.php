<!DOCTYPE html>
<html lang="zxx">
<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/car-single.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Jun 2024 17:22:18 GMT -->

<head>
    <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
    <link rel="icon" href="../images/icon.png" type="image/gif" sizes="16x16" />
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <!-- CSS Files
    ================================================== -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap" />
    <link href="../css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb" />
    <link href="../css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/coloring.css" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <link id="colors" href="../css/colors/scheme-01.css" rel="stylesheet" type="text/css" />
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>
    <div id="wrapper">
        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->

        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php';
        include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
        ?>
        <!-- content begin -->
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="../images/background/tech_img.png" class="jarallax-img" alt="" />
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Product Rental</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->
            <?php
            include_once 'C:\xampp\htdocs\TER PAGE\connection\config.php';
            include_once 'C:\xampp\htdocs\TER PAGE\connection\connect.php';
            $connection_instance = connect($config);
            $day = date('w');
            if ($day == 0 || $day == 6) {//Sunday:0, Saturday:6
                $day_filter = 'Weekend_price';
            } else {
                $day_filter = 'Weekday_price';
            }
            $Product = [];
            if (isset($_GET['product'])) {
                $query_SQL = 'SELECT Product_id,Product_img, Product_name, `Description`, Manufacturer, Model, Dimensions, `Year`, Weekday_price, Weekend_price FROM product_details WHERE Product_name = :product_name';
                $query_stmt = $connection_instance->prepare($query_SQL);
                $query_stmt->bindParam(':product_name', $_GET['product']);
                $query_stmt->execute();
                $query_instance = $query_stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <section id="section-car-details">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <div id="slider-carousel" class="owl-carousel">
                                <div class="item">
                                    <img src="../images/<?= htmlspecialchars($query_instance['Product_img']) ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <h3><?= $query_instance['Product_name'] ?></h3>
                            <p>
                                <?php
                                $query_instance['Description'];
                                ?>
                            </p>

                            <div class="spacer-10"></div>

                            <h4>Specifications</h4>
                            <div class="de-spec">
                                <div class="d-row">
                                    <span class="d-title">Manufacturer</span>
                                    <spam class="d-value"><?= $query_instance['Manufacturer'] ?></spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Model</span>
                                    <spam class="d-value"><?= $query_instance['Model'] ?></spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Dimensions</span>
                                    <spam class="d-value"><?= $query_instance['Dimensions'] ?></spam>
                                </div>
                                <div class="d-row">
                                    <span class="d-title">Year</span>
                                    <spam class="d-value"><?= $query_instance['Year'] ?></spam>
                                </div>
                            </div>
                            <br><br>
                            <h4>Description</h4>
                            <div class="description-box">
                                <span><?= htmlspecialchars($query_instance['Description']) ?></span>
                            </div>

                            <div class="spacer-single"></div>
                        </div>

                        <div class="col-lg-3">
                            <div class="de-price text-center">
                                Daily rate
                                <h3>$<?= $query_instance[$day_filter] ?></h3>
                            </div>
                            <div class="spacer-30"></div>
                            <div class="de-box mb25">
                                <h4>Booking this item</h4>

                                <div class="spacer-20"></div>

                                <div class="row">
                                    <div class="col-lg-12 mb20">
                                        <h5>Pick Up Date & Time</h5>
                                        <div class="date-time-field">
                                            <input type="text" id="date-picker" name="Pick Up Date" value="" />
                                            <select name="Pick Up Time" id="pickup-time">
                                                <option selected disabled value="Select time">
                                                    Time
                                                </option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb20">
                                        <h5>Return Date & Time</h5>
                                        <div class="date-time-field">
                                            <input type="text" id="date-picker-2" name="Collection Date" value="" />
                                            <select name="Collection Time" id="collection-time">
                                                <option selected disabled value="Select time">
                                                    Time
                                                </option>
                                                <option value="00:00">00:00</option>
                                                <option value="00:30">00:30</option>
                                                <option value="01:00">01:00</option>
                                                <option value="01:30">01:30</option>
                                                <option value="02:00">02:00</option>
                                                <option value="02:30">02:30</option>
                                                <option value="03:00">03:00</option>
                                                <option value="03:30">03:30</option>
                                                <option value="04:00">04:00</option>
                                                <option value="04:30">04:30</option>
                                                <option value="05:00">05:00</option>
                                                <option value="05:30">05:30</option>
                                                <option value="06:00">06:00</option>
                                                <option value="06:30">06:30</option>
                                                <option value="07:00">07:00</option>
                                                <option value="07:30">07:30</option>
                                                <option value="08:00">08:00</option>
                                                <option value="08:30">08:30</option>
                                                <option value="09:00">09:00</option>
                                                <option value="09:30">09:30</option>
                                                <option value="10:00">10:00</option>
                                                <option value="10:30">10:30</option>
                                                <option value="11:00">11:00</option>
                                                <option value="11:30">11:30</option>
                                                <option value="12:00">12:00</option>
                                                <option value="12:30">12:30</option>
                                                <option value="13:00">13:00</option>
                                                <option value="13:30">13:30</option>
                                                <option value="14:00">14:00</option>
                                                <option value="14:30">14:30</option>
                                                <option value="15:00">15:00</option>
                                                <option value="15:30">15:30</option>
                                                <option value="16:00">16:00</option>
                                                <option value="16:30">16:30</option>
                                                <option value="17:00">17:00</option>
                                                <option value="17:30">17:30</option>
                                                <option value="18:00">18:00</option>
                                                <option value="18:30">18:30</option>
                                                <option value="19:00">19:00</option>
                                                <option value="19:30">19:30</option>
                                                <option value="20:00">20:00</option>
                                                <option value="20:30">20:30</option>
                                                <option value="21:00">21:00</option>
                                                <option value="21:30">21:30</option>
                                                <option value="22:00">22:00</option>
                                                <option value="22:30">22:30</option>
                                                <option value="23:00">23:00</option>
                                                <option value="23:30">23:30</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hidden popup modal (initially not visible) -->
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

                                        <button type="submit" id="sendmessage">Send</button>
                                    </div>
                                </div>
                                <input type="button" id="send_message" value="Book Now"
                                    class="btn-main btn-fullwidth" />

                                <div class="clearfix"></div>
                                <!-- </form> -->
                            </div>

                            <div class="de-box">
                                <h4>Share</h4>
                                <div class="de-color-icons">
                                    <span><i class="fa fa-twitter fa-lg"></i></span>
                                    <span><i class="fa fa-facebook fa-lg"></i></span>
                                    <span><i class="fa fa-reddit fa-lg"></i></span>
                                    <span><i class="fa fa-linkedin fa-lg"></i></span>
                                    <span><i class="fa fa-pinterest fa-lg"></i></span>
                                    <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                                    <span><i class="fa fa-delicious fa-lg"></i></span>
                                    <span><i class="fa fa-envelope fa-lg"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p style="margin-left: 520px;"><strong>*All orders are subject to both Weekday and Weekend
                        rates*</strong></p>
            </section>
        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>

        <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/footer.php'
            ?>
    </div>
    <?php
    $product_name = $_GET['product'];
    $query_items = 'SELECT pdp.item_id FROM product_dump pdp JOIN product_details pd on pd.Product_id = pdp.Product_id WHERE pd.Product_name = :p_name';
    $stmt_items = $connection_instance->prepare($query_items);
    $stmt_items->bindParam(":p_name", $product_name);
    $stmt_items->execute();
    $all_item_ids = $stmt_items->fetchAll(PDO::FETCH_COLUMN); // e.g. [1, 2, 3]
    $total_items = count($all_item_ids);

    if ($total_items === 0) {
        exit;
    }

    $query_orders = '
        SELECT oh.Date_initiated, oh.Intended_returndate, os.item_id
        FROM order_history oh
        JOIN order_subtable os ON os.Order_id = oh.Order_id
        JOIN product_details pd ON pd.Product_id = os.Product_id
        WHERE oh.Date_completed IS NULL AND pd.Product_name = :p_name
    ';
    $stmt_orders = $connection_instance->prepare($query_orders);
    $stmt_orders->bindParam(":p_name", $product_name);
    $stmt_orders->execute();
    $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);
    $date_map = []; // date => array of item_ids
    
    foreach ($orders as $order) {
        $start = new DateTime($order['Date_initiated']);
        $end = new DateTime($order['Intended_returndate']);
        $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');
            $date_map[$day][] = $order['item_id']; // collect item_id for that date
        }
    }

    // Step 4: Filter banned dates
    $banned_dates = [];
    foreach ($date_map as $date => $item_ids_booked) {
        $unique = array_unique($item_ids_booked);
        if (count($unique) >= $total_items) {
            $banned_dates[] = $date;
        }
    }
    // Output banned dates as JSON
    ?>
    <!-- Javascript Files
    ================================================== -->
    <!-- ALSO REMEMBER TO HAVE THE INVOICE AUTOFILL AND BE SENT TO THE PERSON -->
    <script>console.log('test');</script>
    <script src="../js/designesia.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bannedDates = <?= isset($banned_dates) ? json_encode($banned_dates) : '[]' ?>;
            const dp1 = document.querySelector("#date-picker");
            const dp2 = document.querySelector("#date-picker-2");
            console.log("Initializing Flatpickr on:", dp1, dp2);

            if (dp1 && dp2) {
                const pickupPicker = flatpickr(dp1, {
                    dateFormat: "Y-m-d",
                    disable: bannedDates,
                    onChange: function (selectedDates, dateStr, instance) {
                        if (!dateStr) return;

                        const selectedStart = new Date(dateStr);
                        let nextBanned = null;

                        // Find the next banned date after the selected start
                        for (let bd of bannedDates) {
                            const bannedDate = new Date(bd);
                            if (bannedDate > selectedStart) {
                                nextBanned = bannedDate;
                                break;
                            }
                        }

                        let maxDate = null;
                        if (nextBanned) {
                            const dayBefore = new Date(nextBanned);
                            dayBefore.setDate(dayBefore.getDate() - 1);
                            maxDate = dayBefore.toISOString().split("T")[0];
                        }
                        // Clear previously selected return date
                        dp2.value = "";

                        returnPicker.set("minDate", dateStr); // can't return before pickup
                        returnPicker.set("maxDate", maxDate); // can't return beyond banned period
                    }
                });
                const weekdayRate = <?= json_encode((float) $query_instance['Weekday_price']) ?>;
                const weekendRate = <?= json_encode((float) $query_instance['Weekend_price']) ?>;

                const returnPicker = flatpickr(dp2, {
                    dateFormat: "Y-m-d",
                    disable: bannedDates,
                    onChange: function (selectedDates, dateStr, instance) {
                        const startDate = new Date(dp1.value + "T12:00:00"); // Noon avoids timezone issues
                        const endDate = new Date(dp2.value + "T12:00:00");
                        if (!dp1.value || !dp2.value) return;
                        total = 0;
                        const current = new Date(startDate);
                        while (current <= endDate) {
                            const day = current.getDay(); // 0 = Sunday, 6 = Saturday
                            total += (day === 0 || day === 6) ? weekendRate : weekdayRate;
                            current.setDate(current.getDate() + 1);
                        }

                        let priceDisplay = document.getElementById("total-price");
                        if (!priceDisplay) {
                            priceDisplay = document.createElement("div");
                            priceDisplay.id = "total-price";
                            priceDisplay.style.marginTop = "15px";
                            priceDisplay.style.fontWeight = "bold";
                            dp2.parentElement.appendChild(priceDisplay);
                        }

                        priceDisplay.textContent = "Total: $" + total.toFixed(2);
                    }
                });


            }
            document.getElementById("send_message").addEventListener("click", function (e) {
                e.preventDefault();
                const img = <?= json_encode($query_instance['Product_img']) ?>;
                const c_time = document.getElementById("collection-time").value;
                const d_time = document.getElementById("pickup-time").value;
                const c_date = document.getElementById("date-picker").value;
                const d_date = document.getElementById("date-picker-2").value;
                const product = "<?= htmlspecialchars($_GET['product'] ?? '', ENT_QUOTES) ?>";

                if (!c_time || !d_time || !c_date || !d_date) {
                    Swal.fire({
                        title: 'Select all date and time information?',
                        text: "Your order is incomplete.",
                        icon: 'warning',
                    })
                    return;
                }

                const cart_obj = {
                    collection_t: c_time,
                    dropoff_t: d_time,
                    collection_d: c_date,
                    dropoff_d: d_date,
                    total_price: total,
                    product_name: product,
                    product_img: img
                };
                console.log(cart_obj);
                $.ajax({
                    type: 'POST',
                    url: 'add_cart.php',
                    data: cart_obj,
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
                                location.replace("cart_disp.php");
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
            });
        });
    </script>
</body>

</html>