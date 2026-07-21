<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grand Horizon - Make a Reservation</title>

  <!-- Local Bootstrap Grid System -->
  <link class="search" rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Main Custom CSS File Link -->
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      background-color: #fcfbfa;
      font-family: "Playfair Display", serif;
      color: #333;
    }

    /* --- HERO SECTION --- */
    .booking-hero {
      position: relative;
      height: 1200px;
      background: url("assets/images/pexels-bianca-jelezniac-38713659-8918652.jpg") center/contain no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
    }

    /* Large Elegant Watermark Background Text */
    .hero-watermark {
      position: absolute;
      font-size: 8rem;
      font-weight: 900;
      color: rgba(255, 255, 255, 0.06);
      letter-spacing: 15px;
      text-transform: uppercase;
      user-select: none;
      z-index: 1;
      top: 15%;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: #ffffff;
    }

    .hero-content h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .hero-content p {
      font-size: 1.1rem;
      letter-spacing: 1px;
      opacity: 0.9;
    }

    /* --- FORM STYLING --- */
    .section-title {
      font-size: 1.4rem;
      font-weight: 700;
      color: #110f0d;
      margin-bottom: 20px;
      border-left: 4px solid #c49a45;
      padding-left: 10px;
    }

    .form-label {
      font-size: 0.9rem;
      font-weight: 600;
      color: #4a4a4a;
      margin-bottom: 6px;
    }

    .form-control,
    .form-select {
      background-color: #f7f5f2 !important;
      border: 1px solid #e1deda !important;
      border-radius: 8px !important;
      padding: 12px 16px !important;
      color: #333 !important;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
      background-color: #ffffff !important;
      border-color: #c49a45 !important;
      box-shadow: 0 0 0 3px rgba(196, 154, 69, 0.15) !important;
    }

    /* --- CARD / SUMMARY BOX --- */
    .summary-card {
      background-color: #fbf9f6;
      border: 1px solid #efebe6;
      border-radius: 12px;
      padding: 30px;
      position: sticky;
      top: 120px;
      /* Sasabay sa scroll mo */
    }

    .summary-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #110f0d;
      margin-bottom: 15px;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      font-size: 0.95rem;
      color: #555;
    }

    .summary-total {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
      padding-top: 15px;
      border-top: 1px dashed #d1cac0;
      font-size: 1.2rem;
      font-weight: 700;
      color: #110f0d;
    }

    /* --- GOLD BUTTON --- */
    .btn-confirm-booking {
      background-color: #c49a45 !important;
      border: none !important;
      color: #ffffff !important;
      padding: 15px 30px !important;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 30px !important;
      width: 100%;
      transition: all 0.3s ease !important;
      box-shadow: 0 4px 15px rgba(196, 154, 69, 0.2) !important;
    }

    .btn-confirm-booking:hover {
      background-color: #af8639 !important;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(196, 154, 69, 0.3) !important;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3">
    <div class="container-fluid px-4 px-md-5">
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
        <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
        <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
      </div>
    </div>
  </nav>

  <header class="booking-hero">
    <div class="hero-watermark">Booking</div>
    <div class="hero-content">
      <h1>Make a Reservation</h1>
      <p>Secure your stay at Grand Horizon in just a few steps.</p>
    </div>
  </header>

  <main class="container my-5 py-3">
    <form
      id="reservationForm"
      onsubmit="
          event.preventDefault();
          alert('Reservation Confirmed!');
        ">
      <div class="row g-5">
        <div class="col-lg-7">
          <h2 class="section-title">Guest Information</h2>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">First Name *</label>
              <input type="text" class="form-control" placeholder="Olivia Margaret" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name *</label>
              <input type="text" class="form-control" placeholder="Benson" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Email *</label>
              <input type="email" class="form-control" placeholder="olivia.benson@email.com" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="tel" class="form-control" placeholder="09*********" />
            </div>
          </div>

          <h2 class="section-title">Stay Details</h2>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">Check-in *</label>
              <input type="date" id="checkIn" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Check-out *</label>
              <input type="date" id="checkOut" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Room Type</label>
              <select id="roomType" class="form-select">
                <option value="" selected disabled>Select a room</option>
                <option value="classic" data-price="189">Classic Garden Room ($189/night)</option>
                <option value="deluxe" data-price="349">Deluxe Ocean Suite ($349/night)</option>
                <option value="family" data-price="429">Family Garden Terrace ($429/night)</option>
                <option value="presidential" data-price="899">Presidential Sanctuary ($899/night)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Guests</label>
              <select class="form-select">
                <option value="1">1 Guest</option>
                <option value="2">2 Guests</option>
                <option value="3">3 Guests</option>
                <option value="4">4 Guests</option>
              </select>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label">Special Requests</label>
            <textarea
              class="form-control"
              rows="4"
              maxlength="500"
              placeholder="Any special requests or preferences..."
              oninput="document.getElementById('charCount').innerText = this.value.length + '/500'"></textarea>
            <div id="charCount" class="text-end text-muted small mt-1">0/500</div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="summary-card">
            <h3 class="summary-title">Reservation Summary</h3>

            <div id="summaryPlaceholder" class="text-muted small">Select a room and dates to see the summary.</div>

            <div id="summaryDetails" style="display: none">
              <div class="summary-item">
                <span>Room Selected:</span>
                <strong id="summaryRoomName">-</strong>
              </div>
              <div class="summary-item">
                <span>Rate per Night:</span>
                <strong id="summaryRate">-</strong>
              </div>
              <div class="summary-item">
                <span>Total Nights:</span>
                <strong id="summaryNights">-</strong>
              </div>
              <div class="summary-total">
                <span>Total Price:</span>
                <span id="summaryTotalPrice">$0</span>
              </div>
            </div>

            <p class="text-muted small mt-4 pt-2 border-top">
              Your card will not be charged yet. Free cancellation up to 48 hours before check-in.
            </p>

            <button type="submit" class="btn btn-confirm-booking mt-3">Confirm Reservation</button>
          </div>
        </div>
      </div>
    </form>
  </main>

  <!-- ================[SECTION 8] FOOTER ======================== -->
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
  <!--============= END OF [SECTION 8] FOOTER ======-->

  <!-- Local Core Bootstrap JavaScript Processing Logic Bundle -->
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

  <script>
    // Limitahan ang kalendaryo para hindi pwede pumili ng nakaraang araw (Past Dates)
    const today = new Date().toISOString().split("T")[0];
    document.getElementById("checkIn").min = today;
    document.getElementById("checkIn").addEventListener("change", function() {
      document.getElementById("checkOut").min = this.value;
    });

    // Dynamic Summary Calculator Function
    const checkInInput = document.getElementById("checkIn");
    const checkOutInput = document.getElementById("checkOut");
    const roomSelect = document.getElementById("roomType");

    function updateSummary() {
      const roomOption = roomSelect.options[roomSelect.selectedIndex];
      const pricePerNight = roomOption ? parseFloat(roomOption.getAttribute("data-price")) : 0;

      const date1 = new Date(checkInInput.value);
      const date2 = new Date(checkOutInput.value);

      // Kunin ang diperensya ng araw
      const timeDiff = date2.getTime() - date1.getTime();
      const totalNights = Math.ceil(timeDiff / (1000 * 3600 * 24));

      if (checkInInput.value && checkOutInput.value && roomSelect.value && totalNights > 0) {
        // Ipakita ang details, itago ang placeholder text
        document.getElementById("summaryPlaceholder").style.display = "none";
        document.getElementById("summaryDetails").style.display = "block";

        // Ilagay ang mga nakalkulang impormasyon
        document.getElementById("summaryRoomName").innerText = roomOption.text.split(" ($")[0];
        document.getElementById("summaryRate").innerText = `$${pricePerNight}`;
        document.getElementById("summaryNights").innerText = `${totalNights} Night(s)`;
        document.getElementById("summaryTotalPrice").innerText = `$${pricePerNight * totalNights}`;
      } else {
        // Ibalik sa static text kapag kulang pa ang input
        document.getElementById("summaryPlaceholder").style.display = "block";
        document.getElementById("summaryDetails").style.display = "none";
      }
    }

    // Patakbuhin ang computation tuwing may magbabago sa form inputs
    checkInInput.addEventListener("change", updateSummary);
    checkOutInput.addEventListener("change", updateSummary);
    roomSelect.addEventListener("change", updateSummary);
  </script>
</body>

</html>