<?php
include_once 'C:\xampp\htdocs\TER PAGE\connection\encryption.php';
?>
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
    <?php
    sendmessage();
    function sendmessage()
    {
        $pname = "";
        $email = "";
        $subject = "";
        $message = "";
        $errormess = "";
        if (isset($_POST["sendmessage"])) {

            $pname = $_POST["Name"];
            $email = $_POST["Email"];
            $subject = $_POST["Subject"];

            $message = $_POST["Message"];
            if (isset($_POST['g-recaptcha-response'])) {
                $captcha = $_POST['g-recaptcha-response'];
            }

            if ($pname == "") {

                $errormess = "<div class='error'>All Fields are Required, Enter name</div>";
            } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

                $errormess = "<div class='error'>All Fields are Required, Enter email, format name@domain.com</div>";
            } else if ($subject == "") {

                $errormess = "<div class='error'>All Fields are Required, Enter subject</div>";
            } else if ($message == "") {

                $errormess = "<div class='error'>All Fields are Required, Enter message</div>";
            } else {
                $to = "pentest_data@dtljadev.com" . "," . $email;

                $headers = "From: info@technologyequipmentrental.com'" . "\r\n" .
                    "Content-type: text/html" . "\r\n";
                $errormess = "<div class='error'>Message was sent</div>";
            }
        }

        echo $errormess; ?>
        <div id="wrapper">

            <!-- page preloader begin -->
            <div id="de-preloader"></div>
            <!-- page preloader close -->

            <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/header.php'; ?>
            <!-- header close -->
            <!-- content begin -->
            <div class="no-bottom no-top" id="content">
                <div id="top"></div>

                <!-- section begin -->
                <section id="subheader" class="jarallax text-light">
                    <img src="../images/background/contact_img.png" class="jarallax-img" alt="">
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1>Contact Us</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- section close -->


                <section aria-label="section">
                    <div class="container">
                        <div class="row g-custom-x">

                            <div class="col-lg-8 mb-sm-30">

                                <h3>Do you have any questions?</h3>

                                <form name="contactForm" id="contact_form" class="form-border" method="post"
                                    action="send_mail.php">
                                    <div class="row">
                                        <div class="col-md-4 mb10">
                                            <div class="field-set">
                                                <input type="text" name="Name" id="name" class="form-control"
                                                    placeholder="Your Name" value="<?php echo $pname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb10">
                                            <div class="field-set">
                                                <input type="text" name="Email" id="email" class="form-control"
                                                    placeholder="Your Email" value="<?php echo $email; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb10">
                                            <div class="field-set">
                                                <input type="text" name="Subject" id="subject" class="form-control"
                                                    placeholder="Email Subject" value="<?php echo $subject; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="field-set mb20">
                                        <textarea name="Message" id="message" class="form-control"
                                            placeholder="Your Message" <?php echo htmlspecialchars($message); ?>
                                            required></textarea>
                                    </div>
                                    <div class="g-recaptcha" data-sitekey="6LdW03QgAAAAAJko8aINFd1eJUdHlpvT4vNKakj6"></div>
                                    <div id='submit' class="mt20">
                                        <input type='submit' name='sendmessage' id='send_message' value='Send Message'
                                            class="btn-main">
                                    </div>

                                    <div id="success_message" class='success'>
                                        Your message has been sent successfully. Refresh this page if you want to send more
                                        messages.
                                    </div>
                                    <div id="error_message" class='error'>
                                        Sorry there was an error sending your form.
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4">

                                <div class="de-box mb30">
                                    <h4>Office</h4>
                                    <address class="s1">
                                        <span><i class="id-color fa fa-map-marker fa-lg"></i>22 Trafalgar Road Suite #8
                                            Kingston 10 Jamaica</span>
                                        <span><i class="id-color fa fa-phone fa-lg"></i>1-876-978-4509</span>
                                        <span><i class="id-color fa fa-envelope-o fa-lg"></i><a
                                                href="mailto:info@technologyequipmentrental.com">info@technologyequipmentrental.com</a></span>
                                    </address>
                                </div>

                            </div>

                        </div>
                    </div>

                </section>
                <?php
    }
    ?>
        </div>
        <!-- content close -->

        <a href="#" id="back-to-top"></a>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/TER Page/footer.php' ?>
        <!-- footer close -->

    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>
    <script src="form.js"></script>
    <script>
        $(document).ready(function () {
            $('#contact_form').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission

                // Gather form data into email_obj
                const email_obj = {
                    Name: $('#name').val(),
                    Email: $('#email').val(),
                    Subject: $('#subject').val(),
                    Message: $('#message').val(),
                };

                // Clear previous messages
                $('#success_message').hide();
                $('#error_message').hide();

                $.ajax({
                    url: 'send_mail.php',
                    type: 'POST',
                    data: email_obj,
                    success: function (response) {
                        // Show success or error based on response content
                        if (response.toLowerCase().includes('error')) {
                            $('#error_message').html(response).show();
                        }
                        alert(response);
                    },
                    error: function () {
                        $('#error_message').html('Sorry there was an error sending your form.').show();
                    }
                });
            });
        });
    </script>
    </script>
</body>

</html>