<?php

require_once __DIR__ . "/app/services/BookingService.php";

$secretKey = $_GET["secret_key"];

if (!$secretKey) {
    header("Location: /rooms.php");
}

$service = new BookingService();

$booking = $service->viewBySecretKey($secretKey);
print_r($booking);

if (!$booking["success"]) {
    header("Location: /rooms.php");
}

$reservationStatus = $booking['data']['reservation_status'];
$paymentStatus     = $booking['data']['payment_status'];
$roomName          = $booking['data']['room_name'];
$roomType          = $booking['data']['room_type'];
$reference          = $booking['data']['reference'];

// Function to determine badge color
function getBadgeClass(string $status)
{
    return match (strtolower($status)) {
        'confirmed', 'paid', 'completed' => 'bg-success bg-opacity-25 text-success',
        'pending'                        => 'bg-warning bg-opacity-25 text-warning',
        'cancelled', 'failed'            => 'bg-danger bg-opacity-25 text-danger',
        default                          => 'bg-secondary bg-opacity-25 text-secondary',
    };
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Horizon - Reservation Confirmed</title>

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/booking.css">
</head>

<body style="background-color: #fcfaf6;">

    <div class="modal fade" id="cancelReservation" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered mx-w-sm">
            <div class="modal-content p-2 ">
                <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                    <div class="bg-danger-subtle p-3 rounded-circle">
                        <i class="fa-solid fa-xmark text-danger"></i>
                    </div>
                    <h2 class="fw-semibold fs-4">Cancel Reservation?</h2>
                    <p class="small text-center">This action cannot be undone. Your reservation will be cancelled.</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center p-0 pb-2 m-0">
                    <button class="btn btn-secondary rounded-5" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-danger rounded-5" data-confirm>
                        Remove
                    </button>

                </div>
                <div class="alert alert-danger py-0 text-center d-none" id="modalMessage">Error occured</div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmCancel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered mx-w-sm">
            <div class="modal-content p-2 ">
                <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                    <div class="bg-warning-subtle p-3 rounded-circle">
                        <i class="fa-solid fa-check text-danger"></i>
                    </div>
                    <h2 class="fw-semibold fs-4">Cancelled</h2>
                    <p class="small text-center">You have cancelled your reservation.</p>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center p-0 pb-2 m-0">
                    <button class="btn btn-secondary rounded-5" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-danger rounded-5" data-confirm>
                        Remove
                    </button>

                </div>
                <div class="alert alert-danger py-0 text-center d-none" id="modalMessage">Error occured</div>

            </div>
        </div>
    </div>

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3">
        <div class="container-fluid px-4 px-md-5">
            <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.html">Grand Horizon</a>
            <div class="ms-auto d-flex align-items-center gap-4">
    </nav>

    <!-- SUCCESS MESSAGE -->
    <main class="container py-5 my-5 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="card border-0 shadow-lg p-4 p-md-5 ounded-4" style="max-width: 600px; background: #ffffff;">

            <div class="text-center">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle" style="width: 90px; height: 90px;">
                        <i class="fa-solid fa-circle-check display-4 text-success"></i>
                    </div>
                </div>

                <span class="text-uppercase tracking-wider text-gold small fw-bold mb-2 d-block" style="color: #c49a45;">Booking Confirmed</span>
                <h1 class="font-serif fw-bold mb-3">Thank You for Your Reservation!</h1>
                <p class="text-muted mb-4">
                    We have received your booking details. A confirmation email with your booking summary and receipt has been sent to your inbox.
                </p>

                <div class="bg-light p-3 rounded-3 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">#Booking Reference:</span>
                        <strong class="small text-dark"><?= htmlspecialchars($reference) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Room:</span>
                        <strong class="small text-dark"><?= htmlspecialchars($roomName) ?></strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Room Type:</span>
                        <strong class="small text-dark"><?= htmlspecialchars($roomType) ?></strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Reservation Status:</span>
                        <span class="badge <?= getBadgeClass($reservationStatus) ?> fw-semibold">
                            <?= htmlspecialchars($reservationStatus) ?>
                        </span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Payment Status:</span>
                        <span class="badge <?= getBadgeClass($paymentStatus) ?> fw-semibold">
                            <?= htmlspecialchars($paymentStatus) ?>
                        </span>
                    </div>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center flex-column">
                    <a href="/" class="btn btn-dark px-4 py-2 rounded-pill fw-semibold">Back to Home</a>
                    <button class="text-danger btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#cancelReservation">Cancel Reservation</button>
                </div>

            </div>
        </div>
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
                                <li><a href="rooms.html" class="footer-link">Our Rooms</a></li>
                                <li><a href="amenities.html" class="footer-link">Dining</a></li>
                                <li><a href="amenities.html" class="footer-link">Spa & Wellness</a></li>
                                <li><a href="amenities.html" class="footer-link">Pool</a></li>
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

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const secretKey = urlParams.get('secret_key');

    const formData = new FormData()
    formData.append("secret_key", secretKey)

    async function cancel() {
        const response = await fetch("api/users/booking/cancel.php", {
            method: "post",
            body: formData
        })

        const result = await response.json()
        if (response.ok || result["success"]) {

            bootstrap.Modal
                .getInstance(document.getElementById("cancelReservation"))
                .hide();

            bootstrap.Modal
                .getInstance(document.getElementById("confirmCancel"))
                .show();

        }
    }

    if (secretKey) {
        document.addEventListener("click", e => {
            const button = e.target.closest("[data-confirm]");
            if (!button) return;
            cancel()
        });
    }
</script>

</html>