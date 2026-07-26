<?php

include_once __DIR__ . "../../app/services/CustomerProfileService.php";
include_once __DIR__ . "../../app/middleware/Authmidlleware.php";

$userId = AuthMiddleware::admin(false);

$customerProfile = new CustomerProfile();
$profile = $customerProfile->findByUserId($userId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        .nav-pills .nav-link {
            color: #111;
            background-color: transparent;
            transition: all 0.2s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #111 !important;
            color: #fff !important;
            box-shadow: none;
        }

        .nav-pills .nav-link:not(.active):hover {
            background-color: #f5f5f5;
            color: #111;
        }
    </style>
    <title>Check-in / Out - Grand Horizon</title>
</head>

<body class="d-flex flex-column flex-lg-row app-wrapper bg-main">
    <div class="modal fade" id="viewDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered mx-w-lg">
            <div class="modal-content p-2 border-0">
                <div class="modal-header d-flex justify-content-start align-items-start gap-3 border-0">
                    <div class="bg-warning-subtle p-4 rounded-circle extra-small">
                        <span class="fw-bold text-secondary-2 h6">ER</span>
                    </div>
                    <div>
                        <h4 class="fs-5 fw-semibold" id="modalName">Emma Richardson</h4>
                        <div class="extra-small text-gray-light mt-2">
                            <span><i class="fa-regular fa-envelope" id></i><span id="modalEmail">eemma.r@mail.com</span></span>
                            <span><i class="fa-solid fa-phone"></i><span id="modalPhone">eemma.r@mail.com</span></span>
                        </div>
                    </div>
                </div>

                <div class=" modal-body">
                    <div class="row text-black">
                        <div class="col">
                            <div class="bg-subtle text-center rounded-4 p-3">
                                <h5 id="modalStays">3</h5>
                                <p class="text-gray-light fw-semibold extra-small mt-2">Total Stays</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bg-subtle text-center rounded-4 p-3">
                                <h5 id="modalLastStay">May 12, 2026</h5>
                                <p class="text-gray-light fw-semibold extra-small mt-2">Last Stay</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="bg-subtle text-center rounded-4 p-3">
                                <h5 id="modalMemberSince">January 1, 2026</h5>
                                <p class="text-gray-light fw-semibold extra-small mt-2">Member Since</p>
                            </div>
                        </div>
                    </div>
                    <h4 class="fs-7 fw-semibold mb-2 mt-4">Resrvation History</h4>
                    <div class="overflow-y-auto position-relative" style="max-height: 20rem;">
                        <table class="table-custom w-100 bg-subtle rounded-4">
                            <thead class="position-sticky top-0 z-1 bg-subtle">
                                <tr>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Dates</th>
                                    <th scope="col">Guets</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="historyBody">
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                                <tr class="extra-small">
                                    <td class="fw-bold">GH-2026-0742</td>
                                    <td>
                                        <p>Jul 15, 2026</p>
                                        <p class="mt-2 text-secondary-2">to Jul 18, 2026</p>
                                    </td>
                                    <td>2</td>
                                    <td class="fw-bold" data-currency data-price="1047"></td>
                                    <td>
                                        <div class="status status-success text-uppercase fw-bold">Confirmed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <aside id="sidebar"
        class="offcanvas-lg offcanvas-start bg-secondary text-white d-flex flex-column flex-shrink-0"
        tabindex="-1"
        style="width: 16rem;">

        <header class="cpx-3 pt-4 pb-2">
            <h1 class="h5">Grand Horizon</h1>
            <p class="f-spacing-wide fw-semibold text-uppercase ultra-small text-gray">Admin Panel</p>
        </header>
        <div class="line"></div>
        <nav class="px-2.5 pt-4 pb-2 d-flex flex-column gap-4 overflow-y-auto flex-grow-1">
            <div class="sidebar-category">
                <h2>Overview</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="dashboard.php" class="sidebar-link link link-gray">
                            <i class=" fa-solid fa-cube"></i>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Management</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="rooms.php" class="sidebar-link link link-gray">
                            <i class=" fa-solid fa-bed"></i>
                            Rooms
                        </a>
                    </li>
                    <li>
                        <a href="rooms-types.php" class="sidebar-link link link-gray">
                            <i class=" fa-regular fa-building"></i>
                            Room Types
                        </a>
                    </li>
                    <li>
                        <a href="reservation.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-calendar-check"></i>
                            Reservation
                        </a>
                    </li>
                    <li>
                        <a href="guests.php" class="sidebar-link link link-gray">
                            <i class=" fa-regular fa-user"></i>
                            Guests
                        </a>
                    </li>

                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Operations</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="stay.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Check-in / Out
                        </a>
                    </li>
                    <li>
                        <a href="payments.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-credit-card"></i>
                            Payments
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Insights</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="reports.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-chart-simple"></i>
                            Reports
                        </a>
                    </li>
                    <li>
                        <a href="/settings.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mt-auto text-gray opacity-75">
            <div class="line"></div>
            <a href="/" class="extra-small d-flex p-4 pt-3 gap-3 align-items-center">
                <i class="fa-solid fa-arrow-left ultra-small"></i>
                <p class="m-0 fw-semibold">Back to Website</p>
            </a>
        </div>
    </aside>
    <div class="flex-grow-1 d-flex flex-column overflow-hidden">
        <!-- Responsive Header: Replaced static margins with responsive padding -->
        <header class="border-bottom d-flex px-3 px-md-4 py-2 align-items-center bg-white" style="height: 3.5rem;">
            <button class="btn btn-outline-secondary d-lg-none border-0 px-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>


            <?php
            if ($profile) {
                echo '    <div class="dropdown ms-auto">
                  <button
                    class="btn border-0 text-start p-0 text-secondary"
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
                            <a class="link link-subtle fs-7" href="/transactions.php">
                                <i class="fa-regular fa-user"></i>
                                <p>Transactions</p>
                            </a>
                        </li>
                        <li>
                            <a class="link link-subtle fs-7" href="/settings.php">
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

        </header>

        <!-- Responsive Main: Adjusted padding for mobile (p-2 p-md-4) -->
        <main class="p-4 m-1  overflow-y-auto">
            <div class="container-fluid m-0 p-0">
                <header class="d-flex justify-content-between align-items-center">
                    <h1 class="h4 m-0 p-0">Guest Management</h1>
                    <p class="text-secondary-2 m-0 p-0">1 guest on record</p>
                </header>
                <div class="row my-4 gx-2">
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3">
                            <div class="combo-warning p-3 rounded extra-small">
                                <i class="fa-regular fa-user text-gray-light"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" id="totalGuests">3</h2>
                                <p class="status-card-label fw-semibold">Total Guests</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3">
                            <div class="combo-danger p-3 rounded extra-small">
                                <i class="fa-solid fa-hotel"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" id="totalStays">12</h2>
                                <p class="status-card-label fw-semibold">Total Stays</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3">
                            <div class="combo-success p-3 rounded extra-small">
                                <i class="fa-solid fa-arrows-rotate"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" id="repeatGuests">3</h2>
                                <p class="status-card-label fw-semibold">Repeat Guests</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3">
                            <div class="combo-warning p-3 rounded extra-small">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" id="newGuests">1</h2>
                                <p class="status-card-label fw-semibold">New Guests</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="search-group flex-grow-1">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" name="search" id="search" placeholder="Search by name, email, or phone" class="form-control outline-hover rounded">
                </div>
                <div class="container-fluid my-4 p-0">
                    <div class="row g-2" id="guestContainer">
                        <div class="col-lg-4 col-md-6 col-12">
                            <button class="btn btn-primary-outline status-card rounded-3 d-flex align-items-start gap-3 w-100 py-4 px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#viewDetailsModal">
                                <div class="bg-warning-subtle p-3 rounded-circle extra-small">
                                    <span class="fw-bold text-secondary-2 h6">ER</span>
                                </div>
                                <div class="text-start flex-grow-1">
                                    <h2 class="small fw-semibold">Emma Richardson</h2>
                                    <div class="mt-1">
                                        <p class="status-card-label opacity-75 fw-semibold">emma.r@email.com</p>
                                        <p class="status-card-label opacity-75 fw-semibold">+1 (415 555-0123)</p>
                                    </div>
                                    <div class="d-flex gap-3 border-top align-middle mt-2 pt-2 text-black">
                                        <div class="border-end pe-4">
                                            <p class="h5 fw-bold">3</p>
                                            <p class="ultra-small fw-semibold text-secondary-2">stays</p>
                                        </div>
                                        <div class="align-self-center">
                                            <p class="extra-small">May 12, 2026</p>
                                            <p class="ultra-small fw-semibold text-secondary-2 mt-2">Last stay</p>
                                        </div>
                                    </div>
                                </div>
                                <i class="fa-solid fa-angle-right flex-shrink-0 opacity-50"></i>

                            </button>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>




        </main>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
    <script>
        const guestContainer = document.getElementById("guestContainer");

        async function loadGuestSummary() {

            const response = await fetch(
                "/api/guests/summary.php"
            );

            const result = await response.json();

            if (!response.ok || !result.success) {
                return;
            }

            const summary = result.data;

            document.getElementById("totalGuests").textContent =
                summary.total_guests;

            document.getElementById("totalStays").textContent =
                summary.total_stays;

            document.getElementById("repeatGuests").textContent =
                summary.repeat_guests;

            document.getElementById("newGuests").textContent =
                summary.new_guests;
        }

        function getStatusClass(status) {

            switch (status.toLowerCase()) {

                case "confirmed":
                case "completed":
                    return "status-success";

                case "pending":
                    return "status-warning";

                case "cancelled":
                    return "status-danger";

                case "checked in":
                    return "status-primary";

                case "checked out":
                    return "status-secondary";

                default:
                    return "status-secondary";
            }

        }

        function populateModal(
            guest,
            history
        ) {

            document.getElementById("modalName")
                .textContent = guest.full_name;

            document.getElementById("modalEmail")
                .textContent = guest.email;

            document.getElementById("modalPhone")
                .textContent = guest.phone_number;

            document.getElementById("modalStays")
                .textContent = guest.total_stays;

            document.getElementById("modalLastStay")
                .textContent = formatDate(
                    guest.last_stay
                ) || "No stays yet";

            document.getElementById("modalMemberSince")
                .textContent = formatDate(
                    guest.member_since
                );

            const tbody =
                document.getElementById(
                    "historyBody"
                );

            tbody.innerHTML = "";

            historyBody.innerHTML = "";

            if (history.length === 0) {

                historyBody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center py-4 text-secondary">
                    No reservation history found.
                </td>
            </tr>
        `;

                return;
            }


            history.forEach(item => {

                tbody.insertAdjacentHTML(
                    "beforeend",
                    `
            <tr class="extra-small">

                <td class="fw-bold">
                    ${item.booking_reference}
                </td>

                <td>

                    <p>
                        ${formatDate(
                            item.check_in
                        )}
                    </p>

                    <p class="mt-2 text-secondary-2">
                        to ${formatDate(
                            item.check_out
                        )}
                    </p>

                </td>

                <td>
                    ${item.number_of_guests}
                </td>

                <td class="fw-bold">
                    ${formatCurrency(
                        item.total_amount
                    )}
                </td>

                <td>

                      <div class="status ${getStatusClass(item.status)} text-uppercase text-center fw-bold rounded-pill">

        ${item.status}

    </div>

                </td>

            </tr>
            `
                );

            });

        }

        async function loadGuestDetails(customerId) {

            const [
                guestResponse,
                historyResponse
            ] = await Promise.all([

                fetch(
                    `/api/guests/getById.php?customer_id=${customerId}`
                ),

                fetch(
                    `/api/guests/history.php?customer_id=${customerId}`
                )

            ]);

            const guest =
                await guestResponse.json();

            const history =
                await historyResponse.json();

            if (
                !guest.success ||
                !history.success
            ) {
                return;
            }

            populateModal(
                guest.data,
                history.data
            );

        }

        function renderGuests(guests) {

            guestContainer.innerHTML = "";

            guests.forEach(guest => {

                const initials =
                    guest.first_name.charAt(0) +
                    guest.last_name.charAt(0);

                guestContainer.insertAdjacentHTML(
                    "beforeend",
                    `
            <div class="col-lg-4 col-md-6 col-12">

                <button
                    class="btn btn-primary-outline status-card rounded-3 d-flex align-items-start gap-3 w-100 py-4 px-3"

                    data-id="${guest.id}"

                    data-bs-toggle="modal"
                    data-bs-target="#viewDetailsModal">

                    <div class="bg-warning-subtle p-3 rounded-circle extra-small">
                        <span class="fw-bold text-secondary-2 h6">
                            ${initials}
                        </span>
                    </div>

                    <div class="text-start flex-grow-1">

                        <h2 class="small fw-semibold">
                            ${guest.full_name}
                        </h2>

                        <div class="mt-1">
                            <p class="status-card-label opacity-75 fw-semibold">
                                ${guest.email}
                            </p>

                            <p class="status-card-label opacity-75 fw-semibold">
                                ${guest.phone_number}
                            </p>
                        </div>

                        <div class="d-flex gap-3 border-top align-middle mt-2 pt-2 text-black">

                            <div class="border-end pe-4">

                                <p class="h5 fw-bold">
                                    ${guest.total_stays}
                                </p>

                                <p class="ultra-small fw-semibold text-secondary-2">
                                    stays
                                </p>

                            </div>

                            <div class="align-self-center">

                                <p class="extra-small">
                                    ${formatDate(
                                        guest.last_stay
                                    )}
                                </p>

                                <p class="ultra-small fw-semibold text-secondary-2 mt-2">
                                    Last stay
                                </p>

                            </div>

                        </div>

                    </div>

                    <i class="fa-solid fa-angle-right flex-shrink-0 opacity-50"></i>

                </button>

            </div>
            `
                );

            });

        }

        async function loadGuests() {

            const response = await fetch(
                "/api/guests/get.php"
            );

            const result = await response.json();

            if (!response.ok || !result.success) {
                return;
            }

            renderGuests(result.data);

        }

        guestContainer.addEventListener(
            "click",
            async function(event) {

                const button = event.target.closest(
                    "[data-id]"
                );

                if (!button) return;

                const customerId =
                    button.dataset.id;

                await loadGuestDetails(customerId);

            }
        );

        document.addEventListener("DOMContentLoaded", () => {

            loadGuestSummary();

            loadGuests();

        });
    </script>
</body>

</html>