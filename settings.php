<?php

include_once __DIR__ . "/app/services/SessionService.php";
include_once __DIR__ . "/app/services/CustomerProfileService.php";
include_once __DIR__ . "/app/middleware/Authmidlleware.php";

AuthMiddleware::user(false);
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
    <title>Account Settings - Grand Horizon</title>

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
    <link rel="stylesheet" href="/css/style.css">

    <style>
        .settings-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #f0f0f0;
        }

        .nav-pills .nav-link {
            color: #4a5568;
            font-weight: 500;
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.2s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #f8f9fa;
            color: #000000;
        }

        .btn-gold {
            background-color: #c49a45;
            color: #ffffff;
            border: none;
        }

        .btn-gold:hover {
            background-color: #a88235;
            color: #ffffff;
        }
    </style>
</head>

<body style="background-color: #fdfcf7;">

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg fixed-top py-3" style="background-color: #ffffff; border-bottom: 1px solid rgba(0,0,0,0.05);">
        <div class="container-fluid px-4 px-md-5">
            <a class="navbar-brand font-serif fw-bold h4 mb-0 text-decoration-none" href="index.php" style="font-size: 1.6rem; letter-spacing: 0.5px; color: #1a1a1a !important;">Grand Horizon</a>

            <div class="ms-auto d-flex align-items-center gap-4">
                <a href="index.php" class="nav-link font-sans small fw-medium text-decoration-none" style="color: #1a1a1a !important; opacity: 0.8;">Home</a>
                <a href="index.php#about" class="nav-link font-sans small fw-medium text-decoration-none" style="color: #1a1a1a !important; opacity: 0.8;">About</a>
                <a href="rooms.php" class="nav-link font-sans small fw-medium text-decoration-none" style="color: #1a1a1a !important; opacity: 0.8;">Rooms</a>
                <a href="amenities.php" class="nav-link font-sans small fw-medium text-decoration-none" style="color: #1a1a1a !important; opacity: 0.8;">Amenities</a>
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

    <main class="container py-5 my-5">
        <div class="mb-4">
            <h2 class="font-serif fw-bold text-dark">Account Settings</h2>
            <p class="text-muted small">Manage your personal information, and security.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="settings-card p-3">
                    <div class="nav flex-column nav-pills" id="settingsTabs" role="tablist">
                        <button class="nav-link active d-flex align-items-center gap-3 mb-1" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab">
                            <i class="bi bi-person fs-5"></i> Profile Info
                        </button>
                        <button class="nav-link d-flex align-items-center gap-3 mb-1" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">
                            <i class="bi bi-shield-lock fs-5"></i> Security & Password
                        </button>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="settings-card p-4 p-md-5">
                    <div class="tab-content" id="settingsTabsContent">

                        <!-- TAB 1: PROFILE INFO -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <h4 class="fw-bold mb-4">Personal Details</h4>

                            <form id="profileInfo" method="post">
                                <!-- USER INPUT FIELDS -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">First Name</label>
                                        <input type="text" class="form-control" placeholder="Olivia Margaret" id="first_name" name="first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Benson" id="last_name" name="last_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Email Address</label>
                                        <input type="email" class="form-control" placeholder="oliv@gmail.com" id="email" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold">Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="9123456789"
                                            pattern="9[0-9]{9}" id="phone" name="phone">
                                    </div>
                                </div>

                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <span class="alert alert-success py-2 d-none" id="profileChange">You have successfully changed your profile.</span>

                                    <button type="submit" class="btn btn-gold rounded-pill px-4 fw-semibold">Save Changes</button>

                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: SECURITY & PASSWORD -->
                        <div class="tab-pane fade" id="security" role="tabpanel">
                            <h4 class="fw-bold mb-4">Password & Security</h4>
                            <form id="securityInfo" method="post">
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">Current Password</label>
                                    <input type="password" class="form-control" placeholder="••••••••" id="current_password" name="current_password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">New Password</label>
                                    <input type="password" class="form-control" placeholder="••••••••" id="new_password" name="new_password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-semibold">Confirm New Password</label>
                                    <input type="password" class="form-control" placeholder="••••••••" id="confirm_password" name="confirm_password">
                                </div>

                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <span class="alert alert-success py-2 d-none" id="passwordChange">You have successfully changed your profile.</span>

                                    <button type="submit" class="btn btn-gold rounded-pill px-4 fw-semibold">Update Password</button>

                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="/scripts/app.js"></script>
    <!-- <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        const profileInfo = document.getElementById("profileInfo");

        profileInfo.addEventListener("submit", async (event) => {
            event.preventDefault();

            const formData = new FormData();
            [
                "first_name",
                "last_name",
                "email",
                "phone"
            ].forEach(id => {

                const input = document.getElementById(id);

                const value = input.value.trim();

                if (value !== "") {
                    formData.append(id, value);
                }

            });

            const response = await fetch("/api/users/settings/profile.php", {
                method: "post",
                body: formData
            });

            const result = await response.json();
            const profileChange = document.getElementById("profileChange");

            if (response.ok && result.success) {

                profileChange.classList.remove(
                    "d-none",
                    "alert-danger"
                );

                profileChange.classList.add(
                    "alert-success"
                );

                profileChange.textContent =
                    result.message ?? "Profile updated successfully.";

            } else {

                profileChange.classList.remove(
                    "d-none",
                    "alert-success"
                );

                profileChange.classList.add(
                    "alert-danger"
                );

                profileChange.textContent =
                    result.message ?? "Unable to update your profile.";

                return;
            }
        });
    </script>
    <script>
        const securityInfo = document.getElementById("securityInfo");

        securityInfo.addEventListener("submit", async (event) => {
            event.preventDefault();

            const formData = new FormData(securityInfo);

            const response = await fetch("/api/users/settings/password.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            const alert = document.getElementById("passwordChange");

            if (response.ok && result.success) {

                alert.classList.remove(
                    "d-none",
                    "alert-danger"
                );

                alert.classList.add(
                    "alert-success"
                );

                alert.textContent =
                    result.message ?? "Password updated successfully.";

                securityInfo.reset();

            } else {

                alert.classList.remove(
                    "d-none",
                    "alert-success"
                );

                alert.classList.add(
                    "alert-danger"
                );

                alert.textContent =
                    result.message ?? "Unable to update password.";
            }
        });
    </script>
</body>

</html>