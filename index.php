<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grand Horizon | Luxury Coastal Hotel</title>

  <!-- /* ==== Different Stylesheet Libraries to ===== */ -->
  <!-- Local Bootstrap Grid System -->
  <link class="search" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Local Icons for UI Elements | FOR SOCMED ACCOUNTS-->
  <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- Connection to Main Custom CSS File Link -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body data-bs-spy="scroll" data-bs-target=".custom-luxury-nav" data-bs-offset="120">
  <!-- Bootstrap ScrollSpy making sure the navbar changes color kapag priness mo yung specific section -->

  <!-- /* ==========================================
    [SECTION 1] TOP NAVIGATION BAR
       ========================================== */ -->
  <nav class="navbar navbar-expand-lg fixed-top custom-luxury-nav py-3" style="background-color: transparent !important">
    <div class="container-fluid px-4 px-md-5">
      <a
        class="navbar-brand font-serif fw-bold text-white mb-0 text-decoration-none"
        href="index.php"
        style="font-size: 1.6rem; letter-spacing: 0.5px">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-bold text-white text-decoration-none opacity-100">Home</a>
        <a href="#about" class="nav-link font-sans small fw-medium text-white text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-white text-decoration-none opacity-75">Rooms</a>
        <a href="amenities.php" class="nav-link font-sans small fw-medium text-white text-decoration-none opacity-75">Amenities</a>

        <a href="rooms.php#rooms" class="btn-book-now font-sans text-decoration-none fw-medium text-white text-center">Book Now</a>
      </div>
    </div>
  </nav>
  <!-- /* ==========================================
    END OF [SECTION 1] TOP NAVIGATION BAR
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 2] HERO WELCOME BANNER
       ========================================== */ -->
  <section id="hero" class="hero-section d-flex align-items-center">
    <div class="container text-white">
      <div class="row align-items-center min-vh-75 mt-5">
        <!-- Left Content Block (Titles, Badges, Button) -->
        <div class="col-lg-7 mb-4 mb-lg-0">
          <div class="d-flex align-items-center mb-4">
            <div class="avatar-group d-flex me-3">
              <img src="assets/images/Guest1.jpg" alt="Guest" class="rounded-circle border border-2 border-white" />
              <img src="assets/images/Guest2.jpg" alt="Guest" class="rounded-circle border border-2 border-white guest-overlap" />
              <img src="assets/images/Guest3.jpg" alt="Guest" class="rounded-circle border border-2 border-white guest-overlap" />
            </div>
            <span class="small font-sans opacity-75">Loved by 2,500+ guests</span>
          </div>

          <h1 class="font-serif display-3 mb-4">Your Coastal <br /><span class="fst-italic">Sanctuary Awaits</span></h1>
          <a href="rooms.php" class="btn btn-light rounded-pill px-4 py-2.5 font-sans fw-medium">
            Explore Rooms <i class="fa-solid fa-arrow-right ms-2"></i>
          </a>
        </div>

        <!-- Right Content Block (Brief Narrative Paragraph) -->
        <div class="col-lg-4 offset-lg-1">
          <p class="font-sans font-light lead fs-6 opacity-90 lh-lg">
            Perched along the Malibu coastline, Grand Horizon blends timeless elegance with modern comfort. Every sunrise paints a new
            masterpiece across the Pacific.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 2] HERO WELCOME BANNER
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 3] ABOUT & STATS COUNTERS
       ========================================== */ -->
  <section id="about" class="py-5 bg-sand">
    <div class="container my-4">
      <!-- Row 1: Profile Essay Text Box -->
      <div class="row mb-5">
        <div class="col-lg-3">
          <span class="text-uppercase font-sans tracking-widest text-muted small fw-bold d-block mb-3">About Us</span>
        </div>
        <div class="col-lg-9">
          <p class="font-sans fs-3 text-dark font-light lh-base">
            Nestled along the pristine coastline, Grand Horizon offers an unparalleled luxury experience. With 120 meticulously designed
            rooms, world-class dining, a rejuvenating spa, and breathtaking ocean views, every moment here is crafted for your comfort and
            delight.
          </p>
        </div>
      </div>

      <!-- Row 2: Four Columns Metrics Breakdown -->
      <div class="row text-center py-4">
        <!-- STAT 1 -->
        <div class="col-md-3">
          <h2 class="font-serif display-4"><span class="counter" data-target="120">0</span>+</h2>
          <p class="small text-uppercase tracking-wider font-sans opacity-75">Luxurious Rooms</p>
        </div>
        <!-- STAT 2 -->
        <div class="col-md-3">
          <h2 class="font-serif display-4"><span class="counter" data-target="10">0</span></h2>
          <p class="small text-uppercase tracking-wider font-sans opacity-75">Fine Dining Venues</p>
        </div>
        <!-- STAT 3 -->
        <div class="col-md-3">
          <h2 class="font-serif display-4"><span class="counter" data-target="5">0</span>⭐</h2>
          <p class="small text-uppercase tracking-wider font-sans opacity-75">Star Rating</p>
        </div>
        <!-- STAT 4 -->
        <div class="col-md-3">
          <h2 class="font-serif display-4"><span class="counter" data-target="25">0</span></h2>
          <p class="small text-uppercase tracking-wider font-sans opacity-75">Years of Excellence</p>
        </div>
      </div>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 3] ABOUT & STATS COUNTERS
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 4] FEATURED ROOMS PREVIEW CARDS
       ========================================== */ -->
  <section id="rooms" class="py-5">
    <div class="container-fluid px-4 px-md-5 py-4">
      <!-- Section Title Text -->
      <div class="text-center mb-5">
        <h2 class="font-serif display-4 text-dark mb-2">Featured Rooms</h2>
        <p class="text-muted font-sans font-light">
          Discover our most sought-after accommodations, each designed to provide an unforgettable stay.
        </p>
      </div>

      <!-- Room Grid Row Container -->
      <div class="row g-4">
        <!-- Room Card 1 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 bg-transparent">
            <div class="position-relative overflow-hidden rounded-4 mb-3">
              <span class="badge bg-orange position-absolute top-0 start-0 m-3 px-3 py-2 text-uppercase tracking-wider font-sans">Most Popular</span>
              <img src="assets/images/Room1.jpg" alt="Classic Garden Room" class="img-fluid room-card-img" />
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Classic Garden Room</h4>
            <div class="d-flex text-muted small font-sans gap-3 mb-3">
              <span><i class="fa-solid fa-user-group"></i> 2 guests</span>
              <span><i class="fa-solid fa-expand"></i> 320 sq ft</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="font-sans fw-bold text-dark fs-5">$189<span class="text-muted font-light fs-6">/night</span></span>
              <a href="rooms.php" class="text-dark font-sans small fw-medium text-decoration-underline">View Details</a>
            </div>
          </div>
        </div>

        <!-- Room Card 2 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 bg-transparent">
            <div class="position-relative overflow-hidden rounded-4 mb-3">
              <img src="assets/images/Room2.jpg" alt="Deluxe Ocean Suite" class="img-fluid room-card-img" />
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Deluxe Ocean Suite</h4>
            <div class="d-flex text-muted small font-sans gap-3 mb-3">
              <span><i class="fa-solid fa-user-group"></i> 2 guests</span>
              <span><i class="fa-solid fa-expand"></i> 480 sq ft</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="font-sans fw-bold text-dark fs-5">$349<span class="text-muted font-light fs-6">/night</span></span>
              <a href="rooms.php" class="text-dark font-sans small fw-medium text-decoration-underline">View Details</a>
            </div>
          </div>
        </div>

        <!-- Room Card 3 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 bg-transparent">
            <div class="position-relative overflow-hidden rounded-4 mb-3">
              <img src="assets/images/Room3.jpg" alt="Family Garden Terrace" class="img-fluid room-card-img" />
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Family Garden Terrace</h4>
            <div class="d-flex text-muted small font-sans gap-3 mb-3">
              <span><i class="fa-solid fa-user-group"></i> 4 guests</span>
              <span><i class="fa-solid fa-expand"></i> 650 sq ft</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="font-sans fw-bold text-dark fs-5">$429<span class="text-muted font-light fs-6">/night</span></span>
              <a href="rooms.php" class="text-dark font-sans small fw-medium text-decoration-underline">View Details</a>
            </div>
          </div>
        </div>

        <!-- Room Card 4 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 bg-transparent">
            <div class="position-relative overflow-hidden rounded-4 mb-3">
              <img src="assets/images/Room4.jpg" alt="Presidential Suite" class="img-fluid room-card-img" />
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Presidential Suite</h4>
            <div class="d-flex text-muted small font-sans gap-3 mb-3">
              <span><i class="fa-solid fa-user-group"></i> 2 guests</span>
              <span><i class="fa-solid fa-expand"></i> 950 sq ft</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <span class="font-sans fw-bold text-dark fs-5">$899<span class="text-muted font-light fs-6">/night</span></span>
              <a href="rooms.php" class="text-dark font-sans small fw-medium text-decoration-underline">View Details</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Centralized Anchor Redirect Button -->
      <div class="text-center mt-5">
        <a href="rooms.php" class="btn btn-outline-dark rounded-pill px-5 py-2.5 font-sans fw-medium">View All Rooms <i class="fa-solid fa-arrow-right ms-2"></i></a>
      </div>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 4] FEATURED ROOMS PREVIEW CARDS
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 5] AMENITIES ICON BLOCKS
       ========================================== */ -->
  <section id="amenities" class="py-5 bg-sand">
    <div class="container my-4">
      <!-- Headers info description -->
      <div class="text-center mb-5">
        <h2 class="font-serif display-4 text-dark mb-2">Everything You Need</h2>
        <p class="text-muted font-sans font-light">
          From world-class dining to our serene spa, every detail has been curated for your comfort.
        </p>
      </div>

      <!-- Amenities Feature Grid List -->
      <div class="row g-4">
        <!-- Icon Card 1: WiFi -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-wifi fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">High-Speed Wi-Fi</h4>
            <p class="text-muted small font-sans mb-0">Complimentary gigabit internet throughout the property and beach spaces.</p>
          </div>
        </div>

        <!-- Icon Card 2: Dining -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-utensils fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Fine Dining</h4>
            <p class="text-muted small font-sans mb-0">Three award-winning restaurants with world-class chefs and ocean vistas.</p>
          </div>
        </div>

        <!-- Icon Card 3: Infinity Pool -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-water fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Infinity Pool</h4>
            <p class="text-muted small font-sans mb-0">Two expansive heated swimming areas with sunset cabana reservations.</p>
          </div>
        </div>

        <!-- Icon Card 4: Luxury Spa -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-spa fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Luxury Spa</h4>
            <p class="text-muted small font-sans mb-0">Rejuvenating holistic deep-tissue sessions and natural skin therapies.</p>
          </div>
        </div>

        <!-- Icon Card 5: Fitness -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-heart-circle-bolt fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Fitness Center</h4>
            <p class="text-muted small font-sans mb-0">24/7 modern workout weights, yoga tools, and private dynamic trainers.</p>
          </div>
        </div>

        <!-- Icon Card 6: Special Valet (Tinted Background Color) -->
        <div class="col-md-6 col-lg-4">
          <div class="p-4 rounded-4 bg-white shadow-sm h-100">
            <div class="amenity-icon-box bg-white rounded-circle d-flex align-items-center justify-content-center mb-3">
              <i class="fa-solid fa-car fs-4 text-dark"></i>
            </div>
            <h4 class="font-serif h5 text-dark mb-2">Valet Parking</h4>
            <p class="text-muted small font-sans mb-0">Complimentary guest valet secure storage alongside rapid vehicle charging.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 5] AMENITIES ICON BLOCKS
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 6] MAGAZINE TESTIMONIAL REVIEW BOX
       ========================================== */ -->

  <section class="py-5 bg-white">
    <div class="container my-4">
      <!-- Bootstrap Carousel Wrapper -->
      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators / Navigation Dots sa ilalim -->
        <div class="carousel-indicators" style="bottom: -50px">
          <button
            type="button"
            data-bs-target="#testimonialCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            style="background-color: #c49a45"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" style="background-color: #c49a45"></button>
          <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" style="background-color: #c49a45"></button>
        </div>

        <div class="carousel-inner">
          <!-- SLIDE 1: OLIVIA BENSON -->
          <div class="carousel-item active">
            <div class="testimonial-box rounded-4 overflow-hidden bg-dark text-white mx-auto">
              <div class="row g-0 h-100">
                <!-- Left Column Image aspect wrapper -->
                <div class="col-md-5">
                  <img src="assets/images/Reviewer.jpg" alt="Olivia Reviewer" class="w-100 h-100 review-img" />
                </div>
                <!-- Right Column Text fields -->
                <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center">
                  <p class="font-serif fs-5 font-light lh-base mb-4 fst-italic">
                    "Grand Horizon redefines coastal luxury. From the moment you step into the marble lobby, you are enveloped in an
                    atmosphere of refined elegance. The ocean suite was spectacular — waking up to the waves was pure magic."
                  </p>
                  <div>
                    <h5 class="font-serif mb-1">Olivia Margaret Benson</h5>
                    <span class="small font-sans opacity-60">Travel Editor of Wanderlust Magazine and Captain of Manhattan Special Victims Unit</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- SLIDE 2: RAFAEL BARBA -->
          <div class="carousel-item">
            <div class="testimonial-box rounded-4 overflow-hidden bg-dark text-white mx-auto">
              <div class="row g-0 h-100">
                <!-- Left Column Image aspect wrapper -->
                <div class="col-md-5">
                  <img src="assets/images/Reviewer2.jpeg" alt="Rafael Reviewer" class="w-100 h-100 review-img" />
                </div>
                <!-- Right Column Text fields -->
                <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center">
                  <p class="font-serif fs-5 font-light lh-base mb-4 fst-italic">
                    "Grand Horizon redefines coastal luxury. From the moment you step into the marble lobby, you are enveloped in an
                    atmosphere of refined elegance. The ocean suite was spectacular — waking up to the waves was pure magic."
                  </p>
                  <div>
                    <h5 class="font-serif mb-1">Rafael Barba</h5>
                    <span class="small font-sans opacity-60">Travel Editor of Wanderlust Magazine and Prosecutor and Assistant District Attorney of Manhattan Special Victims
                      Unit</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- SLIDE 3: CASEY NOVAK -->
          <div class="carousel-item">
            <div class="testimonial-box rounded-4 overflow-hidden bg-dark text-white mx-auto">
              <div class="row g-0 h-100">
                <!-- Left Column Image aspect wrapper -->
                <div class="col-md-5">
                  <img src="assets/images/Reviewer3.jpg" alt="Casey Reviewer" class="w-100 h-100 review-img" />
                </div>
                <!-- Right Column Text fields -->
                <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center">
                  <p class="font-serif fs-5 font-light lh-base mb-4 fst-italic">
                    "Grand Horizon redefines coastal luxury. From the moment you step into the marble lobby, you are enveloped in an
                    atmosphere of refined elegance. The ocean suite was spectacular — waking up to the waves was pure magic."
                  </p>
                  <div>
                    <h5 class="font-serif mb-1">Casey Novak</h5>
                    <span class="small font-sans opacity-60">Travel Editor of Wanderlust Magazine and Senior Assistant District Attorney of Manhattan Special Victims Unit</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Left & Right Navigation Arrows -->
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#testimonialCarousel"
          data-bs-slide="prev"
          style="left: -80px">
          <span
            class="carousel-control-prev-icon"
            aria-hidden="true"
            style="filter: invert(68%) sepia(43%) saturate(542%) cp-color(#c49a45); min-width: 35px; min-height: 35px"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#testimonialCarousel"
          data-bs-slide="next"
          style="right: -80px">
          <span
            class="carousel-control-next-icon"
            aria-hidden="true"
            style="filter: invert(68%) sepia(43%) saturate(542%) cp-color(#c49a45); min-width: 35px; min-height: 35px"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 6] MAGAZINE TESTIMONIAL REVIEW BOX
       ========================================== */ -->

  <!-- /* ==========================================
    [SECTION 7] CALL-TO-ACTION BOTTOM BANNER
       ========================================== */ -->
  <section class="py-5 bg-white text-center">
    <div class="container">
      <!-- Graphic Image Card -->
      <div class="cta-banner rounded-4 overflow-hidden d-flex align-items-center justify-content-center position-relative mb-5 shadow-sm">
        <img
          src="assets/images/SunsetCoast.jpg"
          alt="Sunset Coast"
          class="w-100 h-100 position-absolute top-0 start-0 image-dark-cover" />

        <div class="position-relative z-index-top text-white px-3">
          <span class="text-uppercase tracking-widest small fw-semibold opacity-75 d-block mb-2">Reservations open</span>
          <h2 class="font-serif display-4">Experience Unmatched Coastal Luxury</h2>
        </div>
      </div>

      <!-- Bottom Closing Button interface -->
      <h2 class="font-serif display-6 text-dark mt-2">
        <br />Ready to experience the <span class="fst-italic">pinnacle</span> of <strong>coastal luxury</strong>?
      </h2>
      <p class="text-muted font-sans font-light mb-4 fs-5"><br />Your perfect stay is just a click away.<br /><br /></p>
      <a href="booking.php" class="btn btn-black rounded-pill px-5 py-3 font-sans fw-medium tracking-wide shadow-sm">Book Your Stay <i class="fa-solid fa-arrow-right ms-2"></i></a>
    </div>
  </section>
  <!-- /* ==========================================
    END OF [SECTION 7] CALL-TO-ACTION BOTTOM BANNER
       ========================================== */ -->

  <!-- 
    ======================================================================
    [SECTION 8] FOOTER
    ====================================================================== 
    -->
  <footer id="contact" class="custom-dark-footer text-white py-5 w-100">
    <div class="container-fluid px-4 px-md-5 pt-4">
      <div class="row g-4 mb-5">
        <div class="col-12 col-lg-4 mb-4 mb-lg-0">
          <h3 class="font-serif h4 mb-3 fw-bold">Grand Horizon</h3>
          <p class="opacity-60 font-sans font-light small lh-lg" style="max-width: 900px">
            Where timeless elegance meets the serene beauty of the shore. Immerse yourself in unparalleled luxury, breathtaking ocean
            views, and unforgettable moments along the pristine Malibu coastline.
          </p>
        </div>

        <div class="col-12 col-lg-7 offset-lg-1">
          <div class="row g-4">
            <div class="col-4">
              <h6 class="text-uppercase tracking-wider font-sans small mb-3 fw-bold">Explore</h6>
              <ul class="list-unstyled font-sans small d-grid gap-2">
                <li><a href="rooms.php" class="footer-link">Our Rooms</a></li>
                <li><a href="amenities.php" class="footer-link">Dining</a></li>
                <li><a href="amenities.php" class="footer-link">Spa & Wellness</a></li>
                <li><a href="amenities.php" class="footer-link">Pool</a></li>
              </ul>
            </div>

            <div class="col-4">
              <h6 class="text-uppercase tracking-wider font-sans small mb-3 fw-bold">Information</h6>
              <ul class="list-unstyled font-sans small d-grid gap-2">
                <li><a href="#about" class="footer-link">About Us</a></li>
                <li><a href="#" class="footer-link">Contact</a></li>
                <li><a href="#" class="footer-link">Location</a></li>
                <li><a href="#" class="footer-link">Careers</a></li>
              </ul>
            </div>

            <div class="col-4">
              <h6 class="text-uppercase tracking-wider font-sans small mb-3 fw-bold">Policies</h6>
              <ul class="list-unstyled font-sans small d-grid gap-2">
                <li><a href="#" class="footer-link">Cancellation Policy</a></li>
                <li><a href="#" class="footer-link">Privacy Policy</a></li>
                <li><a href="#" class="footer-link">Terms of Service</a></li>
                <li><a href="#" class="footer-link">FAQ</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="pt-4 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
        <p class="font-sans small opacity-50 mb-0">&copy; 2026 Grand Horizon. All rights reserved.</p>

        <div class="d-flex gap-4 social-icons-wrap">
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-x"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!-- 
    ======================================================================
    END OF [SECTION 8] FOOTER
    ====================================================================== 
    -->

  <!-- Local Core Bootstrap JavaScript Processing Logic Bundle -->
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

  <!-- Ditong part yung pag-change ng color ng nav bar kapag iniiscroll -->
  <script>
    window.addEventListener("scroll", function() {
      const navbar = document.querySelector(".custom-luxury-nav");
      const heroSection = document.querySelector("header") || document.querySelector(".hero") || document.querySelector("#home");

      // dito kinukuha yung height ng HERO SEC para malaman kung kelan magbabago yung color ng navbar
      const heroHeight = heroSection ? heroSection.offsetHeight - 80 : window.innerHeight - 80;

      if (window.scrollY > heroHeight) {
        // Dito magiging white yung navbar kasi lumampas na siya sa HERO SEC
        navbar.classList.add("scrolled");
        navbar.style.setProperty("background-color", "#ffffff", "important");
        navbar.style.setProperty("background", "#ffffff", "important");
      } else {
        // Ang nangyayari dito is kapag nasa HERO SEC pa siya, trasparent pa rin ang navbar
        navbar.classList.remove("scrolled");
        navbar.style.setProperty("background-color", "transparent", "important");
        navbar.style.setProperty("background", "transparent", "important");
      }
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const counters = document.querySelectorAll(".counter");
      const speed = 50; // Kung mas mababa ang number, mas mabilis ang takbo ng yung sa counter

      const startCounter = (counter) => {
        const updateCount = () => {
          const target = +counter.getAttribute("data-target");
          const count = +counter.innerText;

          // para smooth
          const inc = Math.ceil(target / speed);

          if (count < target) {
            counter.innerText = count + inc > target ? target : count + inc;
            setTimeout(updateCount, 25); // Mabilis yung tick (in milliseconds)
          } else {
            counter.innerText = target;
          }
        };
        updateCount();
      };

      // Kakapit lang ang animation kapag pumasok na sa viewport/screen ng user
      const observer = new IntersectionObserver(
        (entries, observer) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              startCounter(entry.target);
              observer.unobserve(entry.target); // Para isang beses lang aandar kapag na-scroll
            }
          });
        }, {
          threshold: 0.5
        },
      ); // Iikot kapag 50% ng elemento ay kita na sa screen

      counters.forEach((counter) => observer.observe(counter));
    });
  </script>
</body>

</html>