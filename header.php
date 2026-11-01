<!-- header begin -->
<!-- MAKE SURE TO CHANGE THE NAVBAR FROM BEING TRANSPARENT -->
<header class=" transparent smaller scroll-light has-topbar">
    <div id="topbar" class="topbar-dark text-light">
        <div class="container">
            <div class="topbar-left xs-hide">
                <div class="topbar-widget">
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-phone"></i>1-876-978-4509</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-envelope"></i>info@technologyequipmentrental.com</a>
                    </div>
                    <div class="topbar-widget">
                        <a href="#"><i class="fa fa-clock-o"></i>Mon - Fri 09.00 - 5.00</a>
                    </div>
                </div>
            </div>
            <div class="topbar-right">
                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="de-flex sm-pt10">
                    <div class="de-flex-col">
                        <div class="de-flex-col">
                            <!-- logo begin -->
                            <div id="logo">
                                <a href="/TER Page/index.php">
                                    <img class="logo-1" src="/TER Page/images/logo_small2.png" alt="" />
                                    <img class="logo-2" src="/TER Page/images/logo_small2.png" alt="" />
                                </a>
                            </div>
                            <!-- logo close -->
                        </div>
                    </div>
                    <div class="de-flex-col header-col-mid">
                        <ul id="mainmenu">
                            <li>
                                <a class="menu-item" href="/TER Page/index.php">Home</a>
                            </li>
                            <li>
                                <a class="menu-item" href="/TER Page/Information Desk/About_us.php">About Us</a>
                            </li>
                            <li>
                                <a class="menu-item">Product Rentals</a>
                                <ul>
                                    <li>
                                        <a id='PRJ' class="menu-item" href="/TER Page/Rentals.php">Projectors</a>
                                    </li>
                                    <li>
                                        <a id='ASM' class="menu-item" href="/TER Page/Rentals.php">Audio Systems</a>
                                    </li>
                                    <li>
                                        <a id='OER' class="menu-item" href="/TER Page/Rentals.php">Other Equipment</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="menu-item" href="/TER Page/Information Desk/learning_center.php">Learning
                                    Center</a>
                            </li>
                            <li>
                                <a class="menu-item" href="/TER Page/Information Desk/contact.php">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="de-flex-col">
                        <div class="menu-item">
                            <a href="/TER Page/Rentals/cart_disp.php">
                                <img class="cart-fixed" src="/TER Page/images/Shopping-cart.png" alt="Cart" />
                            </a>
                        </div>

                        <!-- <a class="menu-item" href="https://www.flaticon.com/free-icons/supermarket" title="supermarket icons">Supermarket icons created by Freepik - Flaticon</a> -->
                    </div>
                    <div class="de-flex-col">
                        <div class="menu_side_area">
                            <a href="http://localhost/TER Page/admin/login.php" class="btn-main">Sign In</a>
                            <span id="menu-btn"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function postFilter(id, url) {
            window.location.href = url + '?product_filter=' + encodeURIComponent(id);
        }

        document.getElementById("PRJ").addEventListener("click", function (e) {
            e.preventDefault();
            postFilter('PRJ', '/TER Page/Rentals/Rentals.php');
        });

        document.getElementById("ASM").addEventListener("click", function (e) {
            e.preventDefault();
            postFilter('ASM', '/TER Page/Rentals/Rentals.php');
        });

        document.getElementById("OER").addEventListener("click", function (e) {
            e.preventDefault();
            postFilter('OER', '/TER Page/Rentals/Rentals.php');
        });  
    </script>

</header>
<!-- header close -->

<!-- Javascript Files -->
<script src="/TER Page/js/plugins.js"></script>
<script src="/TER Page/js/designesia.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgiM7ogCAA2Y5pgSk2KXZfxF5S_1jsptA&libraries=places&callback=initPlaces"
    async defer></script>