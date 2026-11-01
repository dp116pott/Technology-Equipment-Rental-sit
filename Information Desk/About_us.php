<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Rentaly - Multipurpose Vehicle Car Rental Website Template</title>
    <link rel="icon" href="/TER Page/images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Rentaly - Multipurpose Vehicle Car Rental Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files
        ================================================== -->
    <link href="/TER Page/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="/TER Page/css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb">
    <link href="/TER Page/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="/TER Page/css/coloring.css" rel="stylesheet" type="text/css">
    <link href="/TER Page/css/style.css" rel="stylesheet">
    <!-- color scheme -->
    <link id="colors" href="/TER Page/css/colors/scheme-01.css" rel="stylesheet" type="text/css">
</head>

  <body>
    <div id="wrapper">
      <!-- page preloader begin -->
      <div id="de-preloader"></div>
      <!-- page preloader close -->
       <?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php';
        include_once $_SERVER['DOCUMENT_ROOT'] .'/TER PAGE/connection/config.php';
        include_once $_SERVER['DOCUMENT_ROOT'] .'/TER PAGE/connection/connect.php';
        $connection_instance = connect($config);
        include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
       ?>
      <!-- content begin -->
      <div class="no-bottom no-top zebra" id="content">
        <div id="top"></div>

        <!-- section begin -->
        <section id="subheader" class="jarallax text-light">
          <img
            src="/TER Page/images\background\multimedia-projector-shut.jpg"
            class="jarallax-img"
            alt=""
          />
          <div class="center-y relative text-center">
            <div class="container">
              <div class="row">
                <div class="col-md-12 text-center">
                  <h1>About Us</h1>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </section>
        <!-- section close -->

        <section>
          <div class="container">
            <div class="row g-5">
              <div class="col-lg-6 wow fadeInRight">
                <h2>
                  We offer customers a wide range of
                  <span class="id-color">technology equipment</span> and for any
                  occasion.
                </h2>
              </div>
              <div class="col-lg-6 wow fadeInRight" data-wow-delay=".25s">
                Technology Equipment Rental is an industry leader in providing
                Audio-Visual rental solutions to the corporate area. We can be
                relied on to supply your short- term rental requirements for
                Tradeshows, Conventions, Meetings, Seminars, Training and
                Special Projects. Our Projectors, Projector Screens, and Audio
                Systems are among the equipment we have readily available for
                your needs. We believe that our core strength lies in our
                People. <br />
                <br />
                At Technology Equipment Rental, the team has one mission - to
                provide the highest level of customer satisfaction.
              </div>
            </div>
            <?php
              $query_SQL = 'SELECT SUM(CASE when Date_completed IS NULL THEN 0 ELSE 1 END) as completed_count FROM order_history';
              $query_SQL2 = 'SELECT SUM(CASE when Special_event = "hidden" THEN 0 ELSE 1 END) as available_products FROM product_details';
              $query_SQL3 = 'SELECT SUM(Likes) as t_likes FROM product_details';
              $query_stmt = $connection_instance->prepare($query_SQL);
              $query_stmt2 = $connection_instance->prepare($query_SQL2);
              $query_stmt3 = $connection_instance->prepare($query_SQL3);
              $query_stmt->execute();
              $query_stmt2->execute();
              $query_stmt3->execute();
              $comp_cust = $query_stmt->fetch(PDO::FETCH_ASSOC);
              $avail_prod = $query_stmt2->fetch(PDO::FETCH_ASSOC);
              $total_likes= $query_stmt3->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="spacer-double"></div>
            <div class="row text-center">
              <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                  <h3 class="timer" data-to="<?=$total_likes['t_likes']?>" data-speed="3000">0</h3>
                  Happy Customers
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                  <h3 class="timer" data-to="<?= htmlspecialchars($comp_cust['completed_count'] ?? 0)?>" data-speed="3000">0</h3>
                  Completed Orders
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                  <h3 class="timer" data-to="<?= htmlspecialchars($avail_prod['available_products']?? 0)?>" data-speed="3000">0</h3>
                 Available Products
                </div>
              </div>
              <div class="col-md-3 col-sm-6 mb-sm-30">
                <div class="de_count wow fadeInUp" data-bgcolor="#f5f5f5">
                  <h3 class="timer" data-to="<?=htmlspecialchars((date('Y')-2015))?>" data-speed="3000">0</h3>
                  Years Experience
                </div>
              </div>
            </div>
          </div>
        </section>
        <section id="section-img-with-tab">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-5 offset-lg-7">
                <h2>Only Quality For Clients</h2>
                <div class="spacer-20"></div>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button
                      class="nav-link active"
                      id="pills-home-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#pills-home"
                      type="button"
                      role="tab"
                      aria-controls="pills-home"
                      aria-selected="true"
                    >
                      Luxury
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button
                      class="nav-link"
                      id="pills-profile-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#pills-profile"
                      type="button"
                      role="tab"
                      aria-controls="pills-profile"
                      aria-selected="false"
                    >
                      Comfort
                    </button>
                  </li>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div
                    class="tab-pane fade show active"
                    id="pills-home"
                    role="tabpanel"
                    aria-labelledby="pills-home-tab"
                  >
                    <p>
                      We provide a carefully selected range of high-quality tech gear to meet your event, office, or production needs.
                      Whether you're planning a corporate presentation, outfitting a classroom, or launching a startup project. 
                      Our inventory includes everything from projectors and laptops to audio systems and microphones—reliable solutions tailored to your goals.
                    </p>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="pills-profile"
                    role="tabpanel"
                    aria-labelledby="pills-profile-tab"
                  >
                    <p>
                      We focus on making technology rentals seamless and stress-free.
                      Our equipment is thoroughly tested and maintained, and our team is always ready to provide setup support or guidance when needed.
                      Whether you’re renting for a few hours or several weeks, you can trust us to deliver flexible, dependable tech rentals that elevate your experience and leave a lasting impression.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </section>
      <a href="#" id="back-to-top"></a>
      <?php include_once $_SERVER['DOCUMENT_ROOT'] .'/TER Page/footer.php'?>
    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="/TER Page/js/plugins.js"></script>
    <script src="/TER Page/js/designesia.js"></script>
  </body>
</html>
