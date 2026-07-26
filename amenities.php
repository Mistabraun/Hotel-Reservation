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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amenities - Grand Horizon</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: #fcfaf6;">
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

  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3">
    <div class="container-fluid px-4 px-md-5">
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
        <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
        <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
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
  </nav>

  <header class="py-5 text-center bg-white border-bottom border-light">
    <div class="container py-4">
      <h1 class="font-serif display-4 fw-bold mb-3" style="color: #161310;">Our World-Class Amenities</h1>
      <p class="font-sans text-muted mx-auto" style="max-width: 600px; font-size: 1.1rem;">
        From world-class dining to our serene spa, every detail has been curated carefully for your ultimate comfort.
      </p>
    </div>
  </header>

  <!-- ======================================================================
[DYNAMIC AMENITIES DETAIL SECTIONS - LOCAL IMAGES VERSION]
====================================================================== -->
  <main id="amenities-showcase" class="py-5" style="background-color: #fcfaf6;">
    <div class="container py-4">

      <!-- SECTION 1: INFINITY POOL (Local Image Left, Text Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may pool.jpg ka sa images folder mo -->
            <img src="assets/images/pool.jpg" alt="Infinity Pool" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Premium Relaxation</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">The Infinity Pool</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Perched dramatically over the Pacific horizon, our heated dual-level infinity pools offer a seamless illusion of merging with the ocean. Unwind in exclusive, fully serviced private cabanas while enjoying curated artisan cocktails and panoramic sunset vistas.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Heated water calibrated daily</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Private premium cabana reservations</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Direct pool-side lounge bar service</li>
          </ul>
        </div>
      </section>

      <!-- SECTION 2: FINE DINING (Text Left, Local Image Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5 flex-md-row-reverse">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may dining.jpg ka sa images folder mo -->
            <img src="assets/images/dining.jpg" alt="Fine Dining" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Culinary Arts</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">World-Class Dining</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Savor exceptional gastronomic journeys across three signature award-winning beach restaurants. From freshly caught local Pacific seafood to upscale international open-flame grills, our world-class master chefs craft every single dish to be an absolute masterpiece.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Three ocean-view venue decks</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Curated international premium wine pairings</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Private custom candlelight shore dinners</li>
          </ul>
        </div>
      </section>

      <!-- SECTION 3: LUXURY SPA (Local Image Left, Text Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may spa.jpg ka sa images folder mo -->
            <img src="assets/images/spa.jpg" alt="Luxury Spa" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Holistic Wellness</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">The Oasis Spa & Wellness</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Step into a quiet sanctuary of deep rejuvenation designed to align body and mind. Our highly trained therapists specialize in traditional healing arts, mineral-rich ocean body wraps, and luxury deep-tissue oil massages powered by pure organic seaside extracts.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Therapeutic individual sound baths</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Aromatherapy steam and hot rock rooms</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Customized botanical health facial sessions</li>
          </ul>
        </div>
      </section>

      <!-- SECTION 4: FITNESS CENTER (Local Image Left, Text Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5 flex-md-row-reverse">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may fitness.jpg ka sa images folder mo -->
            <img src="assets/images/booking.jpg" alt="Fitness Center" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Active Wellness</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">The Elite Fitness Center</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Maintain your health regime in our ultra-modern, ocean-facing wellness studio. Fully equipped with world-class strength training machines, panoramic treadmills, and dedicated free-weight spaces, our fitness environment is beautifully designed to keep you inspired, active, and energized 24 hours a day.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> 24/7 keycard access overlooking the Malibu coastline</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Premium cardio machines and dynamic free weights</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> On-demand private personal trainer sessions</li>
          </ul>
        </div>
      </section>

      <!-- SECTION 5: VALET PARKING (Local Image Left, Text Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may valet.jpg ka sa images folder mo -->
            <img src="assets/images/valet.jpg" alt="Valet Parking" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Effortless Arrival</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">Premium Valet & Storage</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Experience standard hospitality the very second you cross our gates. Our professional, round-the-clock white-glove valet service handles your vehicle with absolute care, ensuring swift arrivals and departures so you can focus entirely on immersing yourself in our coastal paradise.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> 24-hour secure underground guest car garage</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Rapid electric vehicle (EV) charging stations</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> On-demand vehicle retrieval via room telephone</li>
          </ul>
        </div>
      </section>

      <!-- SECTION 6: HIGH WIFI SPEED (Local Image Left, Text Right) -->
      <section class="row align-items-center g-5 mb-5 pb-5 flex-md-row-reverse">
        <div class="col-12 col-md-6">
          <div class="overflow-hidden rounded-4 shadow-sm">
            <!-- LOCAL PATH: Siguraduhing may fitness.jpg ka sa images folder mo -->
            <img src="assets/images/wifi.jpg" alt="High Speed WiFi" class="img-fluid w-100 h-100 object-fit-cover amenity-zoom-img">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <span class="text-uppercase tracking-wider font-sans small fw-bold" style="color: #c49a45;">Seamless Connectivity</span>
          <h2 class="font-serif display-5 fw-bold mt-2 mb-3">High-Speed Wi-Fi</h2>
          <p class="font-sans text-muted lh-lg mb-4">
            Stay effortlessly connected with our state-of-the-art gigabit fiber-optic network covering the entire property. Whether you are taking an urgent business call from your private balcony or streaming your favorite playlist directly from a beach lounge chair, experience uninterrupted high-speed internet anywhere the shore takes you.
          </p>
          <ul class="list-unstyled d-grid gap-2 font-sans text-dark fw-medium small">
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Complimentary gigabit access for all registered guests</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Complete coverage extending to the beach and pool areas</li>
            <li><i class="fa-regular fa-check-circle me-2 text-gold"></i> Secure enterprise-grade network protocols</li>
          </ul>
        </div>
      </section>


    </div>
  </main>
  <!-- ======================================================================
[FOOTER NA ITO]
====================================================================== -->
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
          <a href="https://www.instagram.com" class="footer-icon-link"><i class="fa-brands fa-instagram"></i></a>
          <a href="https://www.facebook.com" class="footer-icon-link"><i class="fa-brands fa-facebook"></i></a>
          <a href="https://www.twitter.com" class="footer-icon-link"><i class="fa-brands fa-x-twitter"></i></a>
          <a href="https://www.youtube.com" class="footer-icon-link"><i class="fa-brands fa-youtube"></i></a>
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
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>

</html>