<!DOCTYPE html>
<html lang="zxx">
<?php
include_once 'C:\xampp\htdocs\TER PAGE\connection\config.php';
include_once 'C:\xampp\htdocs\TER PAGE\connection\connect.php';
$connection_instance = connect($config);
include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
$year_SQL = 'SELECT MIN(`Year`) as min_year, MAX(`Year`) as max_year FROM product_details';
$year_stmt = $connection_instance->prepare($year_SQL);
$year_stmt->execute();
$filter = $year_stmt->fetch(PDO::FETCH_ASSOC);
$num = $filter['max_year'] - $filter['min_year'];
$man_SQL = 'SELECT DISTINCT pd.Manufacturer FROM product_details pd JOIN product_master pm on pm.Prod_type = pd.Prod_type WHERE pm.Prod_cat = :product';
$man_stmt = $connection_instance->prepare($man_SQL);
$man_stmt->bindParam(":product", $_GET['product_filter']);
$man_stmt->execute();
$man_details = $man_stmt->fetchAll(PDO::FETCH_ASSOC);
$selected_brands = isset($_GET['brands']) ? explode(',', $_GET['brands']) : [];
$selected_years = isset($_GET['years']) ? explode(',', $_GET['years']) : [];
?>
<!-- Mirrored from www.madebydesignesia.com/themes/rentaly/cars.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Jun 2024 17:22:14 GMT -->
<!-- REMEMBER TO ADD FILTERS -->

<head>
    <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
    <link rel="icon" href="../images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
    ================================================== -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="../css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="../css/plugins.css" rel="stylesheet" type="text/css">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="../css/colors/scheme-01.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">

        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->

        <?php include_once '../header.php' ?>
        <!-- content begin -->
        <div class="no-bottom no-top zebra" id="content">
            <div id="top"></div>

            <!-- section begin -->
            <section id="subheader" class="jarallax text-light">
                <img src="../images/background/rentals_img.png" class="jarallax-img" alt="">
                <div class="center-y relative text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Available Rentals</h1>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section id="section-cars">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="item_filter_group">
                                <h4>Brand</h4>
                                <div class="de_form">
                                    <?php
                                    $count = 0;
                                    foreach ($man_details as $Man):
                                        $count++;
                                        ?>
                                        <div class="de_checkbox">
                                            <input id="vehicle_type_<?= $count ?>" name="vehicle_type_<?= $count ?>"
                                                type="checkbox" value="<?= htmlspecialchars($Man['Manufacturer']) ?>"
                                                class="manufacturer" <?= in_array($Man['Manufacturer'], $selected_brands) ? 'checked' : '' ?>>
                                            <label
                                                for="vehicle_type_<?= $count ?>"><?php echo htmlspecialchars($Man['Manufacturer']); ?></label>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>

                            <div class="item_filter_group">
                                <h4>Year</h4>
                                <div class="de_form">
                                    <?php
                                    for ($i = 1; $i <= $num + 1; $i++): ?>
                                        <div class="de_checkbox">
                                            <?php
                                            $year_value = $filter['min_year'] + $i - 1;
                                            ?>
                                            <input id="car_seat_<?= $i ?>" name="car_seat" type="checkbox"
                                                value="<?= htmlspecialchars($year_value) ?>" class="year"
                                                <?= in_array((string) $year_value, $selected_years) ? 'checked' : '' ?>>
                                            <label
                                                for="car_seat_<?= $i ?>"><?php echo htmlspecialchars(($filter['min_year'] + $i - 1)) ?></label>
                                        </div>

                                        <?php
                                    endfor;
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="row">
                                <?php
                                $day = date('w');
                                if ($day == 0 || $day == 6) {//Sunday:0, Saturday:6
                                    $day_filter = 'Weekend_price';
                                } else {
                                    $day_filter = 'Weekday_price';
                                }
                                $Product = [];
                                if (isset($_GET['product_filter'])) {
                                    $query_SQL = 'SELECT pd.Product_img, pd.Product_name, pd.Inventory_amt, pd.Description, pm.Prod_cat, pd.' . $day_filter . ', pd.Special_event FROM product_details pd JOIN Product_master pm ON pd.Prod_type = pm.Prod_type WHERE pm.Prod_cat = :type_filter';
                                    $params = [':type_filter' => $_GET['product_filter']];
                                    // Brand filter
                                    if (!empty($_GET['brands'])) {
                                        $brands = explode(',', $_GET['brands']);
                                        $inClauses = [];
                                        foreach ($brands as $index => $brand) {
                                            $key = ":brand_$index";
                                            $inClauses[] = $key;
                                            $params[$key] = $brand;
                                        }
                                        $query_SQL .= " AND pd.Manufacturer IN (" . implode(',', $inClauses) . ")";
                                    }

                                    // Year filter
                                    if (!empty($_GET['years'])) {
                                        $years = explode(',', $_GET['years']);
                                        $inClauses = [];
                                        foreach ($years as $index => $year) {
                                            $key = ":year_$index";
                                            $inClauses[] = $key;
                                            $params[$key] = $year;
                                        }
                                        $query_SQL .= " AND pd.Year IN (" . implode(',', $inClauses) . ")";
                                    }

                                    $query_stmt = $connection_instance->prepare($query_SQL);
                                    $query_stmt->execute($params);

                                    $Product = $query_stmt->fetchAll(PDO::FETCH_ASSOC);

                                    //Display the img values for all with the relevant invoice and cart and quotation generation
                                    foreach ($Product as $item_list):
                                        ?>
                                        <div class="col-xl-4 col-lg-6">
                                            <div class="de-item mb30">
                                                <div class="d-img">
                                                    <img style='center !important;'
                                                        src="../images/<?= htmlspecialchars($item_list['Product_img']) ?>"
                                                        class="img-fluid" alt="">
                                                </div>
                                                <?php
                                                $likes_SQL = 'SELECT Likes FROM product_details WHERE Product_name = :Likes';
                                                $likes_stmt = $connection_instance->prepare($likes_SQL);
                                                $likes_stmt->bindParam(":Likes", $item_list['Product_name']);
                                                $likes_stmt->execute();
                                                $prod_likes = $likes_stmt->fetch(PDO::FETCH_ASSOC);
                                                ?>
                                                <div class="d-info">
                                                    <div class="d-text">
                                                        <h4><?= $item_list['Product_name'] ?></h4>
                                                        <div class="d-item_like">
                                                            <i class="fa fa-heart like-btn"
                                                                data-product="<?= htmlspecialchars($item_list['Product_name']) ?>"></i>
                                                            <span class="like-count"><?= $prod_likes['Likes'] ?></span>
                                                        </div>

                                                        <div class="d-atr-group">
                                                            <span class="d-atr"><img src="../images/icons/2-green.svg"
                                                                    alt=""><?= $item_list['Inventory_amt'] ?></span>
                                                            <span class="d-atr"><img src="../images/icons/4-green.svg"
                                                                    alt=""><?= $item_list['Special_event'] ?></span>
                                                        </div>
                                                        <div class="d-price">
                                                            Daily rate from <span>$<?= $item_list[$day_filter] ?></span>
                                                            <a class="btn-main"
                                                                href="individual_rentals.php?product=<?= urlencode($item_list['Product_name']) ?>">Rent
                                                                Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                }
                                ?>
                                <script>
                                    document.querySelectorAll(".like-btn").forEach(function (btn) {
                                        btn.addEventListener("click", function () {
                                            const productName = this.getAttribute("data-product");
                                            const countSpan = this.nextElementSibling;

                                            fetch("like_update.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded"
                                                },
                                                body: "product=" + encodeURIComponent(productName)
                                            })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        countSpan.textContent = data.newLikes;
                                                    } else {
                                                        alert("Error updating like.");
                                                    }
                                                });
                                        });
                                    });
                                </script>
                                <script>
                                    function updateFilters() {
                                        // Get all selected brand checkboxes
                                        const selectedBrands = Array.from(document.querySelectorAll('.manufacturer:checked')).map(cb => cb.value);
                                        const selectedYears = Array.from(document.querySelectorAll('.year:checked')).map(cb => cb.value);

                                        // Get existing product_filter
                                        const urlParams = new URLSearchParams(window.location.search);
                                        const productFilter = urlParams.get('product_filter');

                                        // Build new URL
                                        let newUrl = window.location.pathname + '?product_filter=' + encodeURIComponent(productFilter);

                                        if (selectedBrands.length > 0) {
                                            newUrl += '&brands=' + encodeURIComponent(selectedBrands.join(','));
                                        }

                                        if (selectedYears.length > 0) {
                                            newUrl += '&years=' + encodeURIComponent(selectedYears.join(','));
                                        }

                                        // Redirect to new URL with filters
                                        window.location.href = newUrl;
                                    }

                                    // Attach change listeners
                                    document.querySelectorAll('.manufacturer, .year').forEach(function (checkbox) {
                                        checkbox.addEventListener('change', updateFilters);
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>


    </div>
    <!-- content close -->

    <a href="#" id="back-to-top"></a>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/footer.php' ?>
    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="../js/plugins.js"></script>
    <script src="../js/designesia.js"></script>

</body>

</html>