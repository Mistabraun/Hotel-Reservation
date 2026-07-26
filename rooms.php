<?php

include_once __DIR__ . "/app/services/SessionService.php";
include_once __DIR__ . "/app/services/CustomerProfileService.php";

$sessionService = new SessionService();
$sessionService->start();

$userId = $sessionService->getUserId();
$profile = null;
if ($userId) {
  $customerProfile = new CustomerProfile();
  $profile = $customerProfile->findByUserId($userId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grand Horizon Rooms</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/room.css" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/booking.css">
</head>

<body>
  <div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered mx-w-md">
      <div class="modal-content p-2">
        <div class="modal-body">
          <section class="mb-4">
            <h2 class="fs-4 text-center">Sign up</h2>
          </section>
          <div class="line mb-3"></div>

          <div class="alert alert-danger p-1 px-2 mt-3 d-none" id="errorMessage">Error message here!</div>

          <form method="post" id="registerForm">

            <div class="row">
              <div class="col-md-6 col mb-4">
                <label for="fname" class="form-label">First Name</label>
                <input title="" type="text" class="form-control outline-hover" id="fname" name="fname" placeholder="Ramcel" autocomplete="email" required="">
              </div>

              <div class="col-md-6 col mb-4">
                <label for="lname" class="form-label">Last Name</label>
                <input title="" type="text" class="form-control outline-hover" id="lname" name="lname" placeholder="Esteron" autocomplete="email" required="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col mb-4">
                <label for="fname" class="form-label">Phone</label>
                <div class="input-group">
                  <span class="input-group-text">+63</span>
                  <input
                    type="tel"
                    class="form-control"
                    id="phone"
                    name="phone"
                    oninvalid="this.setCustomValidity('Enter a valid number')"
                    placeholder="9123456789"
                    pattern="9[0-9]{9}"
                    maxlength="10"
                    required>
                </div>
              </div>

              <div class="col-md-6 col mb-4">
                <label for="email" class="form-label">Email Address</label>
                <input title="" type="email" class="form-control outline-hover" id="email" name="email" placeholder="example@mail.com" autocomplete="email" required="">
              </div>
            </div>


            <div class="row">
              <div class="col-md-6 col mb-4">
                <label for="password" class="mb-2"> Password </label>
                <div class="input-group password-group">
                  <input title="" type="password" class="form-control outline-hover rounded z-2" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required="">

                  <button type="button" class="toggle-password">
                    <i class="fa-regular fa-eye"></i>
                  </button>
                </div>

              </div>
              <div class="col-md-6 col mb-4">

                <label for="password" class="mb-2"> Confirm Password </label>
                <div class="input-group password-group">
                  <input title="" type="password" class="form-control outline-hover rounded z-2" id="cpassword" name="cpassword" placeholder="Enter your password" autocomplete="current-password" required="">

                  <button type="button" class="toggle-password">
                    <i class="fa-regular fa-eye"></i>
                  </button>

                </div>

              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold mt-3">
              <i class="fa-solid fa-user-plus me-2"></i>Sign up
            </button>
          </form>
          <div>
            <div class="border-0 border-top mt-4 p-1"></div>
            <p class="text-center">Already have an account?
              <button
                data-bs-toggle="modal"
                data-bs-target="#loginModal"
                class="btn-plain text-decoration-underline text-primary p-0">Sign in</button>
            </p>
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered mx-w-sm">
      <div class="modal-content p-2">
        <div class="modal-body">
          <section class="mb-4">
            <h2 class="fs-4 text-center">Login</h2>
          </section>
          <div class="line mb-3"></div>

          <div class="alert alert-danger p-1 px-2 mt-3 d-none" id="errorMessage">Error message here!</div>

          <form method="post" id="loginForm">
            <div class="mb-4">
              <label for="email" class="form-label"> Email address </label>
              <input title="" type="email" class="form-control outline-hover" id="email" name="email" placeholder="example@mail.com" autocomplete="email" required="">
            </div>

            <label for="password" class=""> Password </label>
            <div class="input-group password-group">
              <input title="" type="password" class="form-control outline-hover rounded z-2" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required="">

              <button type="button" class="toggle-password">
                <i class="fa-regular fa-eye"></i>
              </button>

            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 text-secondary-2 mt-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember"> Remember me </label>
              </div>

              <a href="/" class="text-gray-light text-decoration-underline">Forgot password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">
              <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>Sign In
            </button>
          </form>
          <div>
            <div class="border-0 border-top mt-4 p-1"></div>
            <p class="text-center">Don't have an account?
              <button
                data-bs-toggle="modal"
                data-bs-target="#registerModal"
                class="btn-plain text-decoration-underline text-primary p-0">Sign up</button>
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm py-3 bg-white bg-opacity-95">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Rooms</a>
        <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
        <a href="amenities.php" class="nav-link font-sans small fw-meduim text-dark text-decoration-none opacity-75">Amenities</a>
        <?php
        if ($profile) {
          echo '    <div class="dropdown ms-auto">
                <button
                    class="btn border-0 text-start p-0 "
                    style="color: var(--bg-primary)"
                    type="button"
                    id="profile-dropdown-btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-user-circle fs-2 mt-1"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end mt-2 me-1 profile-menu pt-2 pb-1" aria-labelledby="profile-dropdown-btn">
                    <div class="profile-header p-1 px-3 mb-2">
                        <p class="profile-name fw-semibold">' . $profile["full_name"] . '</p>
                        <span class="status status-warning rounded-1">Customer</span>
                    </div>
                    <div class="line"></div>
                    <ul class="profile-items my-1">
                        <li>
                            <a class="link link-subtle fs-7" href="transactions.php">
                                <i class="fa-regular fa-user"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                        <li>
                            <a class="link link-subtle fs-7" href="settings.php">
                                <i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                    <div class="line"></div>
                    <ul class="profile-items mt-1">
                        <li>
                            <button class="link link-danger fs-7 btn-default" id="logout">
                                <i class="fa-solid fa-sign-out"></i>
                                <p>Logout</p>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>';
        } else {
          echo '<button class="btn btn-book-now btn-primary border-0 font-sans text-decoration-none fw-medium text-white text-center" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
        }
        ?>
      </div>
    </div>
    </div>
  </nav>

  <header id="hero" class="hero-section d-flex align-items-center text-white">
    <div class="container text-center hero-content">
      <h1 class="hero-title mb-4">Our Rooms</h1>
      <p class="hero-text mx-auto mb-4">Choose from our carefully curated selection of rooms and suites, each designed for your perfect stay.</p>
    </div>
  </header>

  <main>
    <section class="filter-section py-5 bg-light">
      <div class="container">
        <div class="row gx-4 gy-3 align-items-center">
          <div class="col-lg-8">
            <div class="filter-group d-flex flex-wrap gap-2">
              <button class="filter-pill active" data-type="All">All</button>
              <button class="filter-pill" data-type="Standard">Standard</button>
              <button class="filter-pill" data-type="Deluxe">Deluxe</button>
              <button class="filter-pill" data-type="Family Room">Family Room</button>
              <button class="filter-pill" data-type="Suite">Suite</button>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="capacity-row d-flex align-items-center justify-content-lg-end gap-2">
              <label class="capacity-label text-muted mb-0" for="capacitySelect">Capacity</label>
              <div class="capacity-picker">
                <select id="capacitySelect" class="form-select capacity-select" aria-label="Select guest capacity">
                  <option value="1">1+ guests</option>
                  <option value="2">2+ guests</option>
                  <option value="3">3+ guests</option>
                  <option value="4">4+ guests</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="rooms" class="rooms-section py-5">
      <div class="container">
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3" id="roomsContainer">
          <article class="col room-item" data-type="family" data-capacity="4">
            <div class="card room-card h-100 overflow-hidden">
              <img src="assets/images/Room1.jpg" class="card-img-top" alt="Family Suite">
              <div class="card-body">
                <span class="room-tag">Family</span>
                <h2 class="room-title">Family Suite</h2>
                <p class="room-price">$260 <span>/ night</span></p>
                <p class="room-meta">4 guests · 500 sq ft · 2 Queen Beds</p>
                <div class="room-features d-flex flex-wrap gap-2 mb-4">
                  <span>Breakfast</span>
                  <span>Living Area</span>
                  <span>Room Service</span>
                </div>
                <a href="room-id.html?roomId=3" class="btn btn-room rounded-pill">View details</a>
              </div>
            </div>
          </article>
          <article class="col room-item" data-type="standard" data-capacity="2">
            <div class="card room-card h-100 overflow-hidden">
              <img src="assets/images/Room2.jpg" class="card-img-top" alt="Classic Garden Room">
              <div class="card-body">
                <span class="room-tag">Standard</span>
                <h2 class="room-title">Classic Garden Room</h2>
                <p class="room-price">$189 <span>/ night</span></p>
                <p class="room-meta">2 guests · 320 sq ft · 1 Queen Bed</p>
                <div class="room-features d-flex flex-wrap gap-2 mb-4">
                  <span>Free Wi-Fi</span>
                  <span>Smart TV</span>
                  <span>Mini Bar</span>
                </div>
                <a href="room-id.html?roomId=1" class="btn btn-room rounded-pill">View details</a>
              </div>
            </div>
          </article>
          <article class="col room-item" data-type="deluxe" data-capacity="2">
            <div class="card room-card h-100 overflow-hidden">
              <img src="assets/images/Room3.jpg" class="card-img-top" alt="Deluxe Room">
              <div class="card-body">
                <span class="room-tag">Deluxe</span>
                <h2 class="room-title">Deluxe Coastal Room</h2>
                <p class="room-price">$320 <span>/ night</span></p>
                <p class="room-meta">2 guests · 420 sq ft · 1 King Bed</p>
                <div class="room-features d-flex flex-wrap gap-2 mb-4">
                  <span>Ocean View</span>
                  <span>King Bed</span>
                  <span>Balcony</span>
                </div>
                <a href="room-id.html?roomId=2" class="btn btn-room rounded-pill">View details</a>
              </div>
            </div>
          </article>
          <article class="col room-item" data-type="suite" data-capacity="3">
            <div class="card room-card h-100 overflow-hidden">
              <img src="assets/images/Room4.jpg" class="card-img-top" alt="Ocean View Suite">
              <div class="card-body">
                <span class="room-tag">Suite</span>
                <h2 class="room-title">Ocean View Suite</h2>
                <p class="room-price">$398 <span>/ night</span></p>
                <p class="room-meta">3 guests · 620 sq ft · 1 King Bed</p>
                <div class="room-features d-flex flex-wrap gap-2 mb-4">
                  <span>Balcony</span>
                  <span>Soaking Tub</span>
                  <span>Ocean View</span>
                </div>
                <a href="room-id.html?roomId=4" class="btn btn-room rounded-pill">View details</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <section id="about" class="about-section py-5">
      <div class="container">
        <div class="row align-items-center gy-4">
          <div class="col-lg-6">
            <h2 class="section-title">A signature stay in Malibu.</h2>
            <p class="section-text">Experience warm coastal design, world-class service, and thoughtfully curated spaces that make every stay unforgettable.</p>
            <ul class="list-unstyled feature-list">
              <li><i class="fa-solid fa-check text-warning me-2"></i> Oceanfront views and private terraces</li>
              <li><i class="fa-solid fa-check text-warning me-2"></i> On-site dining, spa, and concierge service</li>
              <li><i class="fa-solid fa-check text-warning me-2"></i> Fast booking and responsive stay support</li>
            </ul>
          </div>
          <div class="col-lg-6">
            <div class="about-image rounded-4 overflow-hidden shadow-sm">
              <img src="assets/images/rooms/download (2).jpg" alt="Hotel experience" />
            </div>
          </div>
        </div>
      </div>
    </section>
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
    let selectedType = "All";
    let selectedCapacity = 1;

    const container = document.getElementById("roomsContainer")
    const filterButtons = document.querySelectorAll('.filter-pill');
    const capacitySelect = document.getElementById('capacitySelect');

    function generateRooms(items) {

      container.innerHTML = "";

      items.forEach(room => {

        const visibleAmenities = room.amenities.slice(0, 3);

        const amenities = visibleAmenities
          .map(amenity => `<span>${amenity.name}</span>`)
          .join("");

        const remaining =
          room.amenities.length - visibleAmenities.length;

        const more =
          remaining > 0 ?
          `<span>+${remaining} More</span>` :
          "";

        container.insertAdjacentHTML(
          "beforeend",
          `
            <article
                class="col room-item"
                data-type="${room.room_type}"
                data-capacity="${room.capacity}">

                <div class="card room-card h-100 overflow-hidden">

                    <img
                        src="assets/images/rooms/${room.thumbnail}"
                        class="card-img-top"
                        alt="${room.room_name}">

                    <div class="card-body">

                        <span class="room-tag">
                            ${room.room_type}
                        </span>

                        <h2 class="room-title">
                            ${room.room_name}
                        </h2>

                        <p class="room-price">
                            ${formatCurrency(room.price_per_night)}
                            <span>/ night</span>
                        </p>

                        <p class="room-meta">
                            ${room.capacity}
                            ${room.capacity === 1 ? "guest" : "guests"}
                            ·
                            ${parseInt(room.size)}
                            sq ft
                            ·
                            ${room.bed_type}
                        </p>

                        <div class="room-features d-flex flex-wrap gap-2 mb-4">

                            ${amenities}

                            ${more}

                        </div>

                        <a
                            href="room-id.php?roomId=${room.id}"
                            class="btn btn-room rounded-pill">

                            View details

                        </a>

                    </div>

                </div>

            </article>
            `
        );

      });

    }

    async function loadRooms() {

      const params = new URLSearchParams();

      if (selectedType !== "All") {
        params.append("type", selectedType);
      }

      if (selectedCapacity) {
        params.append("capacity", selectedCapacity);
      }

      const response = await fetch(
        `api/users/rooms/get.php?${params.toString()}`, {
          headers: {
            Accept: "application/json"
          }
        }
      );

      const result = await response.json();
      if (!response.ok || !result.success) {
        return
      }
      generateRooms(result.data)
    }

    filterButtons.forEach(button => {

      button.addEventListener("click", () => {

        filterButtons.forEach(btn =>
          btn.classList.remove("active")
        );

        button.classList.add("active");

        selectedType = button.dataset.type;

        loadRooms();

      });

    });

    capacitySelect.addEventListener("change", function() {
      selectedCapacity = Number(capacitySelect.value);
      loadRooms()
    })
    loadRooms()
  </script>
</body>

</html>