<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grand Horizon | Room Details</title>
  <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="css/room-id.css" />
  <link rel="stylesheet" href="css/booking.css" />
</head>

<body class="d-flex flex-column" style="height: 100vh;">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm py-3 bg-white bg-opacity-95">
    <div class="container">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
        <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
        <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
        <a href="booking.php" class="btn-book-now font-sans text-decoration-none fw-medium text-white text-center">Book Now</a>
      </div>
    </div>
    </div>
  </nav>

  <main id="pageContent" class="pt-5 flex-grow-1"></main>

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
    const navbar = document.querySelector(".navbar");
    const setNavbarState = () => {
      if (navbar) {
        navbar.classList.toggle("scrolled", window.scrollY > 20);
      }
    };

    window.addEventListener("scroll", setNavbarState, {
      passive: true
    });
    setNavbarState();

    const params = new URLSearchParams(window.location.search);
    const roomId = params.get("roomId");

    const pageContent = document.getElementById("pageContent");

    const highlights = ["Free cancellation up to 48 hours", "Best rate guarantee", "Complimentary Wi-Fi"]

    async function loadRooms() {
      const response = await fetch("api/users/rooms/get.php", {
        headers: {
          Accept: "application/json"
        }
      });

      const result = await response.json();

      if (!response.ok || !result.success) {
        return
      }
      return result.data
    }

    async function loadRoom() {

      const response = await fetch(
        `api/users/rooms/getById.php?id=${roomId}`
      );

      const result = await response.json();

      if (!result.success) {
        renderNotFound();
        return;
      }

      renderRoom(result.data);

    }

    loadRoom();

    function renderNotFound() {

      pageContent.innerHTML = `
        <section class="py-5">
            <div class="container text-center py-5">

                <h1 class="display-6 fw-bold">
                    Room not found
                </h1>

                <p class="text-muted">
                    Please choose one of our available rooms.
                </p>

                <a
                    class="btn btn-room rounded-pill mt-3"
                    href="room.html">

                    Back to rooms

                </a>

            </div>
        </section>
    `;

    }

    async function renderRoom(room) {
      const rooms = await loadRooms();
      pageContent.innerHTML = `
          <section class="room-hero py-5">
                    <div class="container">
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="room.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="room.html#rooms">Rooms</a></li>
                                <li class="breadcrumb-item active" aria-current="page">${room.room_name}</li>
                            </ol>
                        </nav>

                        <div class="row g-4 align-items-start">
                            <div class="col-lg-7">
                                <div class="image-card shadow-sm overflow-hidden rounded-4">
                                    <img src="assets/images/rooms/${room.images[0].cover_image}" alt="${room.room_name}" />
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="detail-card shadow-sm rounded-4 p-4 p-lg-5">
                                    <span class="room-tag">${room.room_type}</span>
                                    <h1 class="detail-title">${room.room_name}</h1>
                                    <p class="detail-intro">${room.description}</p>
                                    <div class="price-row d-flex align-items-center justify-content-between mb-4">
                                        <div>
                                            <p class="detail-price mb-0"> ${formatCurrency(room.price_per_night)}</p>
                                            <span class="detail-price-label">per night</span>
                                        </div>
                                        <span class="detail-badge">${room.status}</span>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Guests</span>
                                                <strong>${room.capacity}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Size</span>
                                                <strong>${parseInt(room.size)}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Bed</span>
                                                <strong>${room.bed_type}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Rating</span>
                                                <strong>4.9/5</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/booking.php?roomId=${room.id}" class="btn btn-room w-100 rounded-pill mb-3">Book Now</a>
                                    <div class="detail-perks">
                                        ${highlights.map((item) => `<div><i class="fa-solid fa-check me-2"></i>${item}</div>`).join("")}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-3">
                            <div class="col-lg-8">
                                <div class="detail-card rounded-4 p-4 p-lg-5 shadow-sm">
                                    <h2 class="detail-section-title">Amenities</h2>
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        ${room.amenities.map((item) => `<span class="detail-chip">${item.name}</span>`).join("")}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-card rounded-4 p-4 shadow-sm">
                                    <h2 class="detail-section-title">Why guests love it</h2>
                                    <ul class="detail-list mt-3">
                                        <li>Private and quiet environment</li>
                                        <li>Thoughtful luxury touches</li>
                                        <li>Perfect balance of comfort and style</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h2 class="section-title text-center mb-4">Explore more rooms</h2>
                            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                                ${rooms
                                  .filter((item) => item.id !== room.id)
                                  .map(
                                    (item) =>  `
                                    <article class="col">
                                        <div class="card room-card h-100 overflow-hidden">
                                            <img src="assets/images/rooms/${item.thumbnail}" class="card-img-top" alt="${item.room_name}">
                                            <div class="card-body">
                                                <span class="room-tag">${item.room_type}</span>
                                                <h3 class="room-title">${item.room_name}</h3>
                                                <p class="room-price">${formatCurrency(item.price_per_night)} <span>/ night</span></p>
                                                <a href="room-id.php?roomId=${item.id}" class="btn btn-room rounded-pill">View details</a>
                                            </div>
                                        </div>
                                    </article>
                                `,
                                  )
                                  .join("")}
                            </div>
                        </div>
                    </div>
                </section>
                `

    }
  </script>
</body>

</html>