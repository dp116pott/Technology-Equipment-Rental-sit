<footer class="text-light">
    <div class="container">
        <div class="row g-custom-x">
            <div class="col-lg-4">
                <div class="widget">
                    <h5>About Us</h5>
                    <p>
                        Technology Equipment Rental is an industry leader in providing Audio-Visual rental
                        solutions to the corporate area.
                        We can be relied on to supply your short-term rental requirements for Tradeshows,
                        Conventions, Meetings, Seminars,
                        Training and Special Projects. Our Projectors, Projector Screens, and Audio Systems are
                        among the equipment we have
                        readily available for your needs.
                    </p>
                    <p>
                        We believe that our core strength lies in our People. At Technology Equipment Rental,
                        the team has one mission -
                        to provide the highest level of customer satisfaction.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="widget">
                    <h5>Contact Info</h5>
                    <address class="s1">
                        <span>
                            <i class="id-color fa fa-map-marker fa-lg"></i>
                            22 Trafalgar Road <br />
                            Suite #8<br />
                            Kingston 10<br />
                            Jamaica
                        </span>
                        <span>
                            <i class="id-color fa fa-phone fa-lg"></i>
                            1-876-978-4509
                        </span>
                        <span class="no-wrap">
                            <i class="id-color fa fa-envelope-o fa-lg"></i>
                            <a href="mailto:info@technologyequipmentrental.com">info@technologyequipmentrental.com</a>
                        </span>
                    </address>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="widget">
                    <h5>Social Network</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fa fa-facebook fa-lg"></i></a>
                        <a href="#"><i class="fa fa-twitter fa-lg"></i></a>
                        <a href="#"><i class="fa fa-linkedin fa-lg"></i></a>
                        <a href="#"><i class="fa fa-rss fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="de-flex">
                        <div class="de-flex-col">
                            <a href="index.html">
                            </a>
                        </div>
                        <ul class="menu-simple">
                            <button id="disclaimer-btn">Disclaimer</button>
                            <li><a href="/TER Page/privacypolicy.php">Privacy
                                    Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Style for the button */
        #disclaimer-btn {
            padding: 10px 20px;
            background-color: #121212;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Overlay background */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* translucent */
            z-index: 1000;
            justify-content: center;
            align-items: center;
            
        }

        /* Popup box */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 650px;
            max-height:600px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
            color: black;
            overflow-y: auto; 
        }

        /* Close button */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 20px;
            color: #666;
        }
    </style>
    

    <!-- The popup modal -->
    <div class="modal-overlay" id="disclaimer-modal">
        <div class="modal-content">
            <span class="close-btn" id="close-modal">&times;</span>
            <h3 style="color: black !Important;">Disclaimer</h3>
            <p>The information, products, and services published on this website may include inaccuracies or typographical errors. Changes are periodically made to the information provided. 
                Technology equipment Rental may make improvements and/or changes to this website at any time without prior notice. 
                Technology Equipment Rental makes no representation about the suitability, accuracy, timeliness, or completeness of any information, products and services contained on or available through this website (including, without limitation, any information relating to price, rates, or availability of any service, equipment and/or other product).</p>

            <p>All such information, products and services are provided "as is" without warranty of any kind. Technology Equipment Rental hereby disclaims, to the extent allowed by law, all warranties and conditions with regard to this information, products and services, including all implied warranties and conditions of merchantability, fitness for a particular purpose, title and non-infringement.</p>

            <p>TECHNOLOGY EQUIPMENT RENTAL SHALL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, PUNITIVE, INCIDENTAL, SPECIAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF OR IN ANY WAY CONNECTED WITH THE USE OF THIS WEBSITE OR WITH THE DELAY OR INABILITY TO USE THIS WEBSITE, OR FOR ANY INFORMATION, PRODUCT, AND SERVICE OBTAINED THROUGH THIS WEBSITE, OR OTHERWISE ARISING OUT OF THIS USE OF THIS WEBSITE, WHETHER BASED ON CONTRACT, TORT, STRICT LIABILITY OR OTHERWISE, EVEN IF TECHNOLOGY EQUIPMENT RENTAL HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>
        </div>
    </div>

    <script>
        const openBtn = document.getElementById('disclaimer-btn');
        const modal = document.getElementById('disclaimer-modal');
        const closeBtn = document.getElementById('close-modal');

        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Optional: click outside to close
        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

</footer>