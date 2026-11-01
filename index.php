<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Technology Equipment Rental</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16" />
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <!-- CSS Files
    ================================================== -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap" />
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb" />
    <link href="css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/coloring.css" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<body onload="initialize()">
    <div id="wrapper">
        <!-- page preloader begin -->
        <div id="de-preloader"></div>
        <!-- page preloader close -->
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php'; 
        include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
        ?>
        <!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section id="section-hero" aria-label="section" class="jarallax full-height vertical-center">
                <img src="images\background\projector1.webp" class="jarallax-img" alt="" />
                <div class="container position-relative z1000">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-light">
                            <h4>
                                <span class="id-color">Fast and Easy Way to Rent Technology</span>
                            </h4>
                            <div class="spacer-10"></div>
                            <h1 class="mb-2">Enhance your presentations with quality equipment</h1>
                            <div class="spacer-10"></div>
                            <p class="lead">
                                Discover seamless Audio-Visual solutions for your corporate <br />
                                needs with Technology Equipment Rental. From Tradeshows <br />
                                to Meetings and Special Projects, we ensure your events are<br />
                                a success.
                            </p>
                        </div>

                        <div class="col-lg-6">
                            <div class="spacer-single sm-hide"></div>
                            <div class="p-4 rounded-3 shadow-soft" data-bgcolor="#ffffff">
                                <form name="contactForm" id="contact_form" method="post" action="Rentals.php">
                                    <h5>Select the Equipment you would like to rent</h5>

                                    <div class="de_form de_radio row g-3">
                                        <div class="radio-img col-lg-3 col-sm-3 col-6">
                                            <input id="radio-1a" name="Car_Type" type="radio" value="PRJ"
                                                checked="checked" />
                                            <label for="radio-1a"><img src="images\select-form\projector-icon.png"
                                                    alt="" />Projector<br>Essentials</label>
                                        </div>

                                        <div class="radio-img col-lg-3 col-sm-3 col-6">
                                            <input id="radio-1b" name="Car_Type" type="radio" value="PRJ" />
                                            <label for="radio-1b"><img src="images/select-form/presentationscreen.png"
                                                    alt="" />Pointers<br>& More</label>
                                        </div>

                                        <div class="radio-img col-lg-3 col-sm-3 col-6">
                                            <input id="radio-1c" name="Car_Type" type="radio" value="ASM" />
                                            <label for="radio-1c"><img src="images/select-form/speaker.png"
                                                    alt="" />PA<br />System</label>
                                        </div>

                                        <div class="radio-img col-lg-3 col-sm-3 col-6">
                                            <input id="radio-1d" name="Car_Type" type="radio" value="ASM" />
                                            <label for="radio-1d"><img src="images/select-form/microphone.png"
                                                    alt="" />Wireless<br />Microphones</label>
                                        </div>
                                    </div>

                                    <div class="spacer-20"></div>

                                    <div class="row">
                                        <div class="col-lg-6 mb20">

                                            <div class="jls-address-preview jls-address-preview--hidden">
                                                <div class="jls-address-preview__header"></div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb20">

                                            <div class="jls-address-preview jls-address-preview--hidden">
                                                <div class="jls-address-preview__header"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="submit" id="send_message" value="Find Equipment"
                                        class="btn-main pull-right" />

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="position-absolute d-flex bottom-20">
                    <div class="de-marquee-list style-2">
                        <div class="d-item">
                            <span class="d-item-txt">Projectors</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Screens</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">PA Systems</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Wireless Microphones</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Presentation Pointers</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Laptop Computer</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            </span>
                        </div>
                    </div>

                    <div class="de-marquee-list style-2">
                        <div class="d-item">
                            <span class="d-item-txt">Projectors</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Screens</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">PA Systems</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Wireless Microphones</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Presentation Pointers</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            <span class="d-item-txt">Laptop Computer</span>
                            <span class="d-item-display">
                                <i class="d-item-dot"></i>
                            </span>
                            </span>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-cars">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 offset-lg-3 text-center">
                            <h2>Featured Equipment</h2>
                            <p>
                                Select your rental choice from our wide array of products.
                            </p>
                            <div class="spacer-20"></div>
                        </div>

                        <div class="container mt-5">
                            <div id="items-carousel" class="owl-carousel">
                                <?php
                                include_once 'C:\xampp\htdocs\TER PAGE\connection\config.php';
                                include_once 'C:\xampp\htdocs\TER PAGE\connection\connect.php';
                                $connection_instance = connect($config);
                                $Product = [];

                                $query_SQL = 'SELECT pd.Product_img, pd.Product_name, pd.Inventory_amt, pd.Description, pm.Prod_cat 
                  FROM product_details pd 
                  JOIN Product_master pm ON pd.Prod_type = pm.Prod_type
                  WHERE pd.Special_event = "featured"';
                                ;
                                $query_stmt = $connection_instance->prepare($query_SQL);
                                $query_stmt->execute();
                                $Product = $query_stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($Product as $item): ?>
                                    <div class="item">
                                        <div class="card h-100 shadow">
                                            <div class="de-item mb30">
                                                <img src="images/<?= htmlspecialchars($item['Product_img']) ?>"
                                                    class="d-img" alt="<?= htmlspecialchars($item['Product_name']) ?>">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><?= htmlspecialchars($item['Product_name']) ?></h5>
                                                
                                                <p class="card-text"><strong>In stock:</strong>
                                                    <?= (int) $item['Inventory_amt'] ?></p>
                                                <a href="Rentals/individual_rentals.php?product=<?= urlencode($item['Product_name']) ?>"
                                                    class="btn btn-primary">Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="text-light jarallax" aria-label="section">
                <img src="images/banners/bann1.png" alt="" class="jarallax-img" />
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-light">
                            <div class="container-timeline">
                                <ul>
                                    <li>
                                        <h4>Choose a Device</h4>
                                        <p>
                                            Browse our catalog to find the equipment that best suits your needs.
                                        </p>
                                    </li>
                                    <li>
                                        <h4>Pick a rental date</h4>
                                        <p>
                                            Select the start and end dates for your rental period.
                                        </p>
                                    </li>
                                    <li>
                                        <h4>Make your order</h4>
                                        <p>
                                            Confirm your selection and submit your rental request online.
                                        </p>
                                    </li>
                                    <li>
                                        <h4>Collect your new rental</h4>
                                        <p>
                                            Pick up your device at our location or have it delivered to you.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- content close -->
        <a href="#" id="back-to-top"></a>
        <!-- footer begin -->
        <?php include_once $_SERVER['DOCUMENT_ROOT'] .'/TER Page/footer.php' ?>
        <!-- footer close -->
    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>
    <script>
        let selectedOption = "PRJ";

        const radios = document.querySelectorAll('input[name="Car_Type"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.checked) {
                    selectedOption = this.value;
                    console.log("Selected option:", selectedOption);
                }
            });
        });
        console.log(selectedOption);
        document.getElementById('send_message').addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default form submission

            const url = 'Rentals/Rentals.php';
            window.location.href = url + '?product_filter=' + encodeURIComponent(selectedOption);
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgiM7ogCAA2Y5pgSk2KXZfxF5S_1jsptA&amp;libraries=places&amp;callback=initPlaces"
        async="" defer=""></script>
</body>

</html>