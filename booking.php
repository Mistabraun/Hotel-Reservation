<?php

require_once __DIR__ . "/app/models/Room.php";

$service = new Room();
$query = $service->getClientRooms();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grand Horizon - Make a Reservation</title>

  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
  <link rel="stylesheet"
    href="../node_modules/flatpickr/dist/flatpickr.min.css">

  <script src="../node_modules/flatpickr/dist/flatpickr.min.js"></script>
  <link rel="stylesheet" href="/css/booking.css">
  <link rel="stylesheet" href="/css/style.css">

  <style>
    .step-section {
      display: none;
      animation: fadeInSlide 0.4s ease-in-out forwards;
    }

    .step-section.active {
      display: block;
    }

    @keyframes fadeInSlide {
      from {
        opacity: 0;
        transform: translateX(20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .payment-card-option {
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      padding: 15px;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
    }

    .payment-card-option:hover {
      border-color: #c49a45;
      background-color: #fcfbfa;
    }

    .payment-card-option input[type="radio"]:checked+label {
      color: #c49a45;
      font-weight: bold;
    }
  </style>
</head>

<body class="booking-page-body">

  <!-- NAVIGATION BAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3">
    <div class="container-fluid px-4 px-md-5">
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
        <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
      </div>
    </div>
  </nav>

  <!-- HERO HEADER -->
  <header class="booking-hero">
    <div class="hero-watermark">Booking</div>
    <div class="hero-content">
      <h1>Make a Reservation</h1>
      <p>Secure your stay at Grand Horizon in just a few steps.</p>
    </div>
  </header>

  <!-- MAIN FORM -->
  <main class="container my-5 py-3">
    <form id="reservationForm" onsubmit="handleFormSubmit(event)">
      <div class="row g-5">

        <div class="col-lg-7">

          <!-- STEP 1: GUEST DETAILS -->
          <div id="step1" class="step-section active">
            <h2 class="section-title">Guest Information</h2>
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label">First Name *</label>
                <input type="text" id="firstName" class="form-control" placeholder="Olivia Margaret" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Last Name *</label>
                <input type="text" id="lastName" class="form-control" placeholder="Benson" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" id="email" class="form-control" placeholder="olivia.benson@email.com" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="tel" id="phone" class="form-control" placeholder="09*********">
              </div>
            </div>

            <h2 class="section-title">Stay Details</h2>
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label">Room Type *</label>
                <select id="roomType" class="form-select" required>
                  <option value="" selected disabled>Select a room</option>
                  <!--   <option value="classic" data-price="189">Classic Garden Room ($189/night)</option>
                  <option value="deluxe" data-price="349">Deluxe Ocean Suite ($349/night)</option>
                  <option value="family" data-price="429">Family Garden Terrace ($429/night)</option> -->
                  <!-- <option value="presidential" data-price="899">Presidential Sanctuary ($899/night)</option> -->
                  <?php foreach ($query as $room): ?>
                    <option
                      id="roomData"
                      value="<?= $room['id'] ?>"
                      data-value="<?= $room['price_per_night'] ?>"
                      data-name="<?= $room['room_name'] ?>">
                      <?= htmlspecialchars($room['room_name']) ?>
                      ($<?= htmlspecialchars($room['price_per_night']) ?>/night)
                    </option>
                  <?php endforeach; ?>

                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Guests</label>
                <select class="form-select" id="guestCount">
                  <option value="1">1 Guest</option>
                  <option value="2">2 Guests</option>
                  <option value="3">3 Guests</option>
                  <option value="4">4 Guests</option>
                  <option value="5">5 Guests (+$20)</option>
                  <option value="6">6 Guests (+$40)</option>
                  <option value="7">7 Guests (+$60)</option>
                  <option value="8">8 Guests (+$80)</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Select date *</label>

                <input
                  type="text"
                  id="booking_date"
                  class="form-control outline-hover rounded input-subtle"
                  placeholder="Select a date"
                  readonly>
              </div>
              <input type="hidden" id="checkIn" name="check_in">
              <input type="hidden" id="checkOut" name="check_out">
              <!-- <input type="date" id="checkIn" class="form-control" required> -->
            </div>



            <div class="mb-4">
              <label class="form-label">Special Requests</label>
              <textarea id="requests" name="requests" class="form-control" rows="3" maxlength="500" placeholder="Any special requests or preferences..." oninput="document.getElementById('charCount').innerText = this.value.length + '/500'"></textarea>
              <div id="charCount" class="text-end text-muted small mt-1">0/500</div>
            </div>

          </div>


          <!-- STEP 2: PAYMENT METHOD -->
          <div id="step2" class="step-section">
            <div class="d-flex align-items-center mb-3">
              <button type="button" class="btn btn-link text-dark p-0 me-3 fs-5" onclick="goToStep(1)"><i class="fa-solid fa-arrow-left"></i></button>
              <h2 class="section-title mb-0">Select Payment Method</h2>
            </div>

            <div class="d-grid gap-3 mb-4">
              <!-- GCash Option -->
              <div class="payment-card-option d-flex align-items-center justify-content-between">
                <div class="form-check m-0">
                  <input class="form-check-input" type="radio" name="paymentMethod" id="payGCash" value="GCash" checked onchange="togglePaymentFields()">
                  <label class="form-check-label ms-2 fw-semibold" for="payGCash">
                    GCash / E-Wallet
                  </label>
                </div>
                <i class="fa-solid fa-qrcode fs-4 text-primary"></i>
              </div>

              <!-- Card Option -->
              <div class="payment-card-option d-flex align-items-center justify-content-between">
                <div class="form-check m-0">
                  <input class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="Card" onchange="togglePaymentFields()">
                  <label class="form-check-label ms-2 fw-semibold" for="payCard">
                    Credit / Debit Card
                  </label>
                </div>
                <i class="fa-solid fa-credit-card fs-4 text-success"></i>
              </div>

              <!-- Pay at Hotel Option -->
              <div class="payment-card-option d-flex align-items-center justify-content-between">
                <div class="form-check m-0">
                  <input class="form-check-input" type="radio" name="paymentMethod" id="payHotel" value="Cash" onchange="togglePaymentFields()">
                  <label class="form-check-label ms-2 fw-semibold" for="payHotel">
                    Pay Upon Check-in
                  </label>
                </div>
                <i class="fa-solid fa-building fs-4 text-warning"></i>
              </div>
            </div>

            <!-- GCASH INPUT DETAILS -->
            <div id="gcashDetails" class="p-3 border rounded bg-light mb-4">
              <h6 class="fw-bold mb-2">GCash Payment Instructions:</h6>
              <p class="small text-muted mb-3">Scan the QR code using your GCash app and input the Reference Number below after sending the payment.</p>

              <div class="text-center mb-3">
                <div class="p-2 bg-white d-inline-block border rounded shadow-sm">
                  <!-- Replace with your actual QR code image -->
                  <img src="assets/images/QR.jpeg" alt="GCash QR Code" class="img-fluid" style="max-width: 150px;">
                </div>
                <p class="small text-muted mt-1 mb-0">Merchant: <strong>Grand Horizon Resort</strong></p>
              </div>

              <div class="mb-2">
                <label class="form-label small fw-semibold">GCash Reference Number (13 digits) *</label>
                <input type="text" id="gcash_reference" class="form-control" placeholder="e.g. 1002 9384 1923" maxlength="13">
              </div>
            </div>

            <!-- CREDIT CARD INPUT DETAILS -->
            <div id="cardDetails" class="p-3 border rounded bg-light mb-4" style="display: none;">
              <div class="mb-3">
                <label class="form-label small fw-semibold">Cardholder Name</label>
                <input type="text" id="cardholder_name" class="form-control" placeholder="Olivia Margaret Benson">
              </div>
              <div class="mb-3">
                <label class="form-label small fw-semibold">Card Number</label>
                <input type="text" id="card_number" class="form-control" placeholder="1234 5678 9101 1121" maxlength="19">
              </div>
              <div class="row g-2">
                <div class="col-6">
                  <label class="form-label small fw-semibold">Expiry Date</label>
                  <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY" maxlength="5">
                </div>
                <div class="col-6">
                  <label class="form-label small fw-semibold">CVV</label>
                  <input type="password" id="cvv" class="form-control" placeholder="123" maxlength="4">
                </div>
              </div>
            </div>

            <!-- PAY AT HOTEL DETAILS -->
            <div id="hotelDetails" class="p-3 border rounded bg-light mb-4" style="display: none;">
              <p class="small text-muted mb-0"><i class="fa-solid fa-info-circle me-1"></i> You will pay the total amount directly at the front desk during check-in. Please bring a valid ID.</p>
            </div>

          </div>
        </div>


        <!-- RESERVATION SUMMARY -->
        <div class="col-lg-5">
          <div class="summary-card position-sticky" style="top: 100px;">
            <h3 class="summary-title">Reservation Summary</h3>

            <div id="summaryPlaceholder" class="text-muted small">
              Select a room and dates to see the summary.
            </div>

            <div id="summaryDetails" style="display: none;">
              <div class="summary-item d-flex justify-content-between mb-2">
                <span>Room Selected:</span>
                <strong id="summaryRoomName">-</strong>
              </div>
              <div class="summary-item d-flex justify-content-between mb-2">
                <span>Rate per Night:</span>
                <strong id="summaryRate">-</strong>
              </div>

              <div class="summary-item d-flex justify-content-between mb-2">
                <span>Guests:</span>
                <strong id="summaryGuests">1 Guest(s)</strong>
              </div>

              <div class="summary-item d-flex justify-content-between mb-2" id="summaryExtraFeeRow" style="display: none !important;">
                <span>Extra Guest Fee:</span>
                <strong id="summaryExtraFee" class="text-gold" style="color: #c49a45;">+$0</strong>
              </div>

              <div class="summary-item d-flex justify-content-between mb-2">
                <span>Total Nights:</span>
                <strong id="summaryNights">-</strong>
              </div>
              <hr>
              <div class="summary-total d-flex justify-content-between fs-5 fw-bold text-dark">
                <span>Total Price:</span>
                <span id="summaryTotalPrice" class="text-gold" style="color: #c49a45;">$0</span>
              </div>
            </div>

            <p class="text-muted small mt-4 pt-2 border-top">
              Your card will not be charged yet. Free cancellation up to 48 hours before check-in.
            </p>


            <button id="summaryActionBtn" type="button" class="btn btn-confirm-booking w-100 mt-3" onclick="handleSummaryButtonClick()">Proceed to Payment</button>
          </div>
          <div class="alert alert-danger mt-2 d-none" id="errorMessage">
          </div>
        </div>

      </div>

    </form>
  </main>

  <!-- FOOTER -->
  <footer id="contact" class="custom-dark-footer text-white py-5 w-100">
    <div class="container-fluid px-4 px-md-5 pt-4">
      <div class="row g-4 mb-5">
        <div class="col-12 col-lg-4 mb-4 mb-lg-0">
          <h3 class="font-serif h4 mb-3 fw-bold">Grand Horizon</h3>
          <p class="opacity-60 font-sans font-light small lh-lg" style="max-width: 900px;">
            Where timeless elegance meets the serene beauty of the shore. Immerse yourself in unparalleled luxury, breathtaking ocean views, and unforgettable moments along the pristine Malibu coastline.
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
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#aboutModal">About Us</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#contactModal">Contact</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#locationModal">Location</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#careersModal">Careers</a></li>
              </ul>
            </div>
            <div class="col-4">
              <h6 class="text-uppercase tracking-wider font-sans small mb-3 fw-bold">Policies</h6>
              <ul class="list-unstyled font-sans small d-grid gap-2">
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#cancellationModal">Cancellation Policy</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of Service</a></li>
                <li><a href="#" class="footer-link" data-bs-toggle="modal" data-bs-target="#faqModal">FAQ</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="pt-4 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center">
        <p class="font-sans small opacity-50 mb-0">&copy; 2026 Grand Horizon. All rights reserved.</p>
        <div class="d-flex gap-4 social-icons-wrap">
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-facebook"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="#" class="footer-icon-link"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!-- ACCOUNT SETTINGS MODAL -->
  <div class="modal fade" id="userSettingsModal" tabindex="-1" aria-labelledby="userSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
        <div class="modal-header bg-dark text-white p-4">
          <h5 class="modal-title font-serif" id="userSettingsModalLabel">
            <i class="bi bi-sliders me-2"></i> Account Settings
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <div class="row g-0">
            <div class="col-md-4 bg-light border-end p-3">
              <div class="nav flex-column nav-pills gap-2" id="v-pills-tab" role="tablist">
                <button class="nav-link active text-start rounded-3 d-flex align-items-center gap-2" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                  <i class="bi bi-person"></i> Personal Info
                </button>
                <button class="nav-link text-start rounded-3 d-flex align-items-center gap-2" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab">
                  <i class="bi bi-shield-lock"></i> Password & Security
                </button>
              </div>
            </div>

            <div class="col-md-8 p-4">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel">
                  <h6 class="font-serif fw-bold mb-3">Update Personal Details</h6>
                  <form>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Full Name</label>
                      <input type="text" class="form-control rounded-3" placeholder="Juan Dela Cruz">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Email Address</label>
                      <input type="email" class="form-control rounded-3" placeholder="juan@example.com">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Phone Number</label>
                      <input type="tel" class="form-control rounded-3" placeholder="+63 912 345 6789">
                    </div>
                    <button type="submit" class="btn btn-gold rounded-pill px-4 btn-sm font-sans fw-medium">Save Changes</button>
                  </form>
                </div>

                <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                  <h6 class="font-serif fw-bold mb-3">Change Your Password</h6>
                  <form>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Current Password</label>
                      <input type="password" class="form-control rounded-3" placeholder="••••••••">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">New Password</label>
                      <input type="password" class="form-control rounded-3" placeholder="••••••••">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Confirm New Password</label>
                      <input type="password" class="form-control rounded-3" placeholder="••••••••">
                    </div>
                    <button type="submit" class="btn btn-gold rounded-pill px-4 btn-sm font-sans fw-medium">Update Password</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 1. ABOUT US MODAL -->
  <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Our Story</span>
            <h4 class="modal-title font-serif text-white mt-1">About Grand Horizon</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <p class="text-white">Founded on the shores of coastal luxury, Grand Horizon redefines hospitality through timeless elegance, bespoke service, and refined accommodations. Nestled along pristine coastlines, our sanctuary is designed for travelers seeking both tranquility and elevated experiences.</p>
          <p class="mb-0">From world-class dining crafted by Michelin-starred culinary talent to serene oceanfront wellness suites, every detail at Grand Horizon is tailored to inspire and rejuvenate.</p>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. CONTACT MODAL -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Get In Touch</span>
            <h4 class="modal-title font-serif text-white mt-1">Concierge & Inquiries</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans">
          <div class="mb-3">
            <label class="small text-uppercase tracking-wider modal-gold-title mb-1 d-block fw-semibold">Reservations</label>
            <p class="mb-0 text-white">+1 (800) 555-0199 | concierge@grandhorizon.com</p>
          </div>
          <hr class="modal-divider">
          <div class="mb-3">
            <label class="small text-uppercase tracking-wider modal-gold-title mb-1 d-block fw-semibold">Front Desk & Services</label>
            <p class="mb-0 text-white">Available 24/7 at main lobby reception</p>
          </div>
          <hr class="modal-divider">
          <div>
            <label class="small text-uppercase tracking-wider modal-gold-title mb-1 d-block fw-semibold">Address</label>
            <p class="mb-0 text-white">100 Oceanward Boulevard, Coastal Bay, CA 90210</p>
          </div>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. LOCATION MODAL -->
  <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Destination</span>
            <h4 class="modal-title font-serif text-white mt-1">Our Location</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50">
          <p class="mb-3 text-white">Grand Horizon is situated directly on the Pacific coastline, conveniently located 25 minutes from International Airport (LAX) with private valet and helipad transfer services available upon request.</p>
          <div class="p-4 bg-black rounded-3 border border-warning border-opacity-25 text-center my-3">
            <span class="modal-gold-title small">📍 Interactive Map View Integration Placeholder</span>
          </div>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 4. CAREERS MODAL -->
  <div class="modal fade" id="careersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Join Our Team</span>
            <h4 class="modal-title font-serif text-white mt-1">Careers at Grand Horizon</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <p class="text-white">We are always searching for passionate, dedicated individuals to join our luxury hospitality family. Build a career delivering exceptional experiences across our operations, guest relations, fine dining, and spa facilities.</p>
          <div class="mt-4">
            <h6 class="modal-gold-title font-serif mb-2">Current Openings:</h6>
            <ul class="list-unstyled d-grid gap-2">
              <li class="p-3 bg-black rounded border border-warning border-opacity-25 d-flex justify-content-between align-items-center">
                <span class="text-white">Guest Relations Manager</span>
                <span class="badge btn-gold">Full-Time</span>
              </li>
              <li class="p-3 bg-black rounded border border-warning border-opacity-25 d-flex justify-content-between align-items-center">
                <span class="text-white">Sommelier & Beverage Director</span>
                <span class="badge btn-gold">Full-Time</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 5. CANCELLATION POLICY MODAL -->
  <div class="modal fade" id="cancellationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Reservations</span>
            <h4 class="modal-title font-serif text-white mt-1">Cancellation & Modification Policy</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <h6 class="modal-gold-title font-serif">Standard Bookings</h6>
          <p class="text-white">Reservations canceled up to 48 hours prior to local check-in time (3:00 PM PST) will receive a full refund with no additional penalty fees.</p>

          <h6 class="modal-gold-title font-serif mt-4">Late Cancellations & No-Shows</h6>
          <p class="text-white">Cancellations made within 48 hours of arrival, or guest no-shows, will be charged an amount equal to one night’s room rate plus applicable taxes.</p>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 6. PRIVACY POLICY MODAL -->
  <div class="modal fade" id="privacyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Legal</span>
            <h4 class="modal-title font-serif text-white mt-1">Privacy Policy</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <p class="text-white">At Grand Horizon, we hold the privacy of our distinguished guests in highest regard. This policy outlines how your personal information is gathered, protected, and processed.</p>
          <h6 class="modal-gold-title font-serif mt-3">Data Collection</h6>
          <p class="text-white">We collect essential personal information strictly for processing reservations, tailoring customized stay preferences, and handling transaction processing through secure encrypted protocols.</p>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 7. TERMS OF SERVICE MODAL -->
  <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Legal</span>
            <h4 class="modal-title font-serif text-white mt-1">Terms of Service</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <p class="text-white">By booking or residing at Grand Horizon, guests agree to adhere to our estate guidelines and standards of luxury conduct.</p>
          <h6 class="modal-gold-title font-serif mt-3">Check-In & Checkout</h6>
          <p class="text-white">Standard check-in begins at 3:00 PM. Checkout is required by 11:00 AM. Late checkouts can be requested via front desk and are subject to availability.</p>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 8. FAQ MODAL -->
  <div class="modal fade" id="faqModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content custom-modal text-white rounded-4">
        <div class="modal-header modal-divider px-4 pt-4">
          <div>
            <span class="text-uppercase tracking-wider small modal-gold-title font-sans fw-semibold">Help Center</span>
            <h4 class="modal-title font-serif text-white mt-1">Frequently Asked Questions</h4>
          </div>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4 py-4 font-sans text-white-50 lh-lg" style="max-height: 60vh; overflow-y: auto;">
          <div class="mb-4">
            <h6 class="modal-gold-title font-serif">What are the check-in and checkout times?</h6>
            <p class="mb-0 text-white">Check-in is at 3:00 PM and checkout is at 11:00 AM.</p>
          </div>
          <div class="mb-4">
            <h6 class="modal-gold-title font-serif">Are pets allowed at the property?</h6>
            <p class="mb-0 text-white">We welcome small pets in designated pet-friendly ocean suites with prior reservation notice.</p>
          </div>
          <div>
            <h6 class="modal-gold-title font-serif">Is airport transportation included?</h6>
            <p class="mb-0 text-white">Private luxury chauffeur transfers are complimentary for Penthouse and Villa tier guests.</p>
          </div>
        </div>
        <div class="modal-footer modal-divider px-4 pb-4">
          <button type="button" class="btn btn-gold btn-sm rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/app.js"></script>

  <script>
    function validateInputs(items) {
      let success = true
      items.forEach(item => {
        if (!item.value) {
          success = false
          if (!item.classList.contains("error")) {
            item.classList.add("error")
          }
        }
      });
      return success
    }

    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);
    const roomId = urlParams.get('roomId');


    let currentStep = 1;

    // Date Conditions whatsoever
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().split('T')[0];

    document.getElementById('checkIn').min = minDate;
    document.getElementById('checkIn').addEventListener('change', function() {
      document.getElementById('checkOut').min = this.value;
    });

    const checkInInput = document.getElementById('checkIn');
    const checkOutInput = document.getElementById('checkOut');
    const roomSelect = document.getElementById('roomType');
    const guestSelect = document.getElementById('guestCount'); // Target guest input

    if (roomId) {
      if (roomSelect.querySelector(`option[value="${roomId}"]`)) {
        roomSelect.value = roomId;
      }
    }

    // Summary Calculation for payment
    function updateSummary() {
      const roomElement = document.querySelector("#roomType")
      const element = roomElement.options[roomElement.selectedIndex];

      console.log(element)
      if (!element) {
        return
      }

      const roomDataset = element.dataset
      const pricePerNight = parseInt(roomDataset.value)
      const roomName = roomDataset.name

      const date1 = new Date(checkInInput.value);
      const date2 = new Date(checkOutInput.value);

      const timeDiff = date2.getTime() - date1.getTime();
      const totalNights = Math.ceil(timeDiff / (1000 * 3600 * 24));

      // Guest Fee Computation (for extra guest)
      const guests = parseInt(guestSelect.value) || 1;
      const extraGuests = guests > 4 ? guests - 4 : 0;
      const extraGuestFeePerNight = extraGuests * 250;

      const effectiveNightlyRate = pricePerNight + parseInt(extraGuestFeePerNight);
      console.log(pricePerNight, totalNights, guests, extraGuests, extraGuestFeePerNight, effectiveNightlyRate)


      if (checkInInput.value && checkOutInput.value && roomSelect.value && totalNights > 0) {
        document.getElementById('summaryPlaceholder').style.display = 'none';
        document.getElementById('summaryDetails').style.display = 'block';

        document.getElementById('summaryRoomName').innerText = roomName.split(' (₱')[0];
        document.getElementById('summaryRate').innerText = `${formatCurrency(pricePerNight)}`; // Base Room Price
        document.getElementById('summaryGuests').innerText = `${guests} Guest(s)`; // Guest count

        // Extra Fee Breakdown Handling (overall if there is an extra pax)
        const extraFeeRow = document.getElementById('summaryExtraFeeRow');
        if (extraGuests > 0) {
          extraFeeRow.style.setProperty('display', 'flex', 'important');
          document.getElementById('summaryExtraFee').innerText = `+₱${extraGuestFeePerNight}/night (${extraGuests} extra pax)`;
        } else {
          extraFeeRow.style.setProperty('display', 'none', 'important');
        }

        document.getElementById('summaryNights').innerText = `${totalNights} Night(s)`;

        // Total Computation = (Base Price + Extra Guest Fee) * Total Nights
        const grandTotal = effectiveNightlyRate * totalNights;
        document.getElementById('summaryTotalPrice').innerText = `${formatCurrency(grandTotal)}`;
      } else {
        document.getElementById('summaryPlaceholder').style.display = 'block';
        document.getElementById('summaryDetails').style.display = 'none';
      }




    }

    function getMinCheckInDate() {
      const now = new Date();

      // 3:00 PM cutoff
      const cutoffHour = 15;

      if (now.getHours() >= cutoffHour) {
        // Move to tomorrow
        now.setDate(now.getDate() + 1);
      }

      // Remove the time portion
      now.setHours(0, 0, 0, 0);

      return now;
    }



    const datePicker = flatpickr("#booking_date", {
      mode: "range",
      dateFormat: "Y-m-d",
      minDate: getMinCheckInDate(),
      disable: [],
      onClose(selectedDates) {

        if (selectedDates.length !== 2) {
          return;
        }

        document.querySelector("#checkIn").value =
          this.formatDate(selectedDates[0], "Y-m-d");

        document.querySelector("#checkOut").value =
          this.formatDate(selectedDates[1], "Y-m-d");

      },
      onChange: updateSummary
    })

    function promptError(msg) {
      const element = document.getElementById("errorMessage")
      element.textContent = msg
      element.classList.remove("d-none")
      element.classList.add("Shake")
    }

    async function setUnavailableDates(value) {
      const dates = await loadUnavailableDates(roomSelect.value)

      datePicker.set(
        "disable",
        dates
      );
    }

    if (roomSelect.value) {
      setUnavailableDates(roomSelect.value)
    }
    roomSelect.addEventListener("change", async function() {
      datePicker.clear()
      setUnavailableDates(this.value)
    })

    // checkInInput.addEventListener('change', updateSummary);
    // checkOutInput.addEventListener('change', updateSummary);
    roomSelect.addEventListener('change', updateSummary);
    guestSelect.addEventListener('change', updateSummary); // Automatic recalculate pag nagbago ng guest count


    function goToStep(stepNumber) {
      if (stepNumber === 2) {
        if (!document.getElementById('firstName').value ||
          !document.getElementById('lastName').value ||
          !document.getElementById('email').value ||
          !checkInInput.value ||
          !checkOutInput.value ||
          !roomSelect.value) {
          promptError("Please fill in the required list")
          return;
        }
      }

      document.querySelectorAll('.step-section').forEach(sec => sec.classList.remove('active'));
      document.getElementById(`step${stepNumber}`).classList.add('active');
      currentStep = stepNumber;

      // Update Summary Button
      const summaryBtn = document.getElementById('summaryActionBtn');
      if (currentStep === 1) {
        summaryBtn.innerText = "Proceed to Payment";
      } else {
        summaryBtn.innerText = "Confirm & Pay Reservation";
      }
    }

    // Summary Button Click
    function handleSummaryButtonClick() {
      if (currentStep === 1) {
        goToStep(2);
        const element = document.getElementById("errorMessage")
        element.classList.add("d-none")
      } else {
        document.getElementById('reservationForm').requestSubmit();
      }
    }

    // Payment Option Toggle Fields
    function togglePaymentFields() {
      const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

      document.getElementById('gcashDetails').style.display = selectedMethod === 'GCash' ? 'block' : 'none';
      document.getElementById('cardDetails').style.display = selectedMethod === 'Card' ? 'block' : 'none';
      document.getElementById('hotelDetails').style.display = selectedMethod === 'Cash' ? 'block' : 'none';
    }


    // Final Form Submission
    async function handleFormSubmit(event) {
      event.preventDefault();

      const formData = new FormData();

      formData.append("room_id", roomSelect.value);

      formData.append("first_name", document.getElementById("firstName").value.trim());
      formData.append("last_name", document.getElementById("lastName").value.trim());
      formData.append("email", document.getElementById("email").value.trim());
      formData.append("phone", document.getElementById("phone").value.trim());

      formData.append("check_in", checkInInput.value);
      formData.append("check_out", checkOutInput.value);

      formData.append("guests", guestSelect.value);
      formData.append("requests", document.getElementById("requests").value)

      const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

      if (selectedMethod == "GCash") {
        formData.append("gcash_reference", document.getElementById("gcash_reference").value)
      } else if (selectedMethod == "Card") {
        formData.append("cardholder_name", document.getElementById("cardholder_name").value)
        formData.append("card_number", document.getElementById("card_number").value)
        formData.append("expiry_date", document.getElementById("expiry_date").value)
        formData.append("cvv", document.getElementById("cvv").value)
      }


      formData.append(
        "payment_method",
        selectedMethod
      );

      const response = await fetch(
        "api/users/booking/create.php", {
          method: "POST",
          body: formData
        }
      );

      const result = await response.json();

      if (!response.ok || !result.success) {
        promptError(result.message);
        return;
      }

      window.location.href =
        `confirmation.php?secret_key=${result.data.secret_key}`;
    }
  </script>
</body>

</html>