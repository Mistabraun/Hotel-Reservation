<?php

include_once __DIR__ . "/../app/services/RoomService.php";

$roomService = new RoomService();
$rooms = $roomService->getRooms([]);
$roomsData = $rooms["data"]["items"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Document</title>
</head>

<body class="vh-100 d-flex position-relative bg-main">
    <aside
        id="sidebar"
        data-bs-scroll="true"
        tabindex="1"
        class="offcanvas-lg offcanvas-start bg-secondary text-white d-flex flex-column"
        style="width: 16rem">

        <header class="cpx-3 pt-4 pb-2">
            <h1 class="h5">Grand Horizon</h1>
            <p class="f-spacing-wide fw-semibold text-uppercase ultra-small text-gray">Admin Panel</p>
        </header>

        <div class="line"></div>
        <nav class="px-2.5 pt-4 pb-2 d-flex flex-column gap-4 overflow-y-auto">
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
            <div class="sidebar-category ">
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
                        <a href="payments.php" class="sidebar-link link link-gray">
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
                        <a href="reports.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-gear"></i>
                            Settings
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
    <div class="flex-grow-1 " style="min-width: 0;">

        <div class="modal fade" id="addReservation" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-md">
                <div class="modal-content p-2">
                    <div class="modal-header d-flex justify-content-between">
                        <div>
                            <h5 class="modal-title" data-title>Reservation Details</h5>
                            <p class="ultra-small text-gray-light fw-semibold" data-description>GH-2026-0738</p>
                        </div>
                        <span data-status class="status status-success text-uppercase fw-bold">Confirmed</span>
                    </div>

                    <div class=" modal-body">
                        <div class="alert alert-danger py-2 d-none" id="modalMessage"></div>
                        <form id="addReservationForm" class="reservation-form">
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="room_id" class="form-label extra-small fw-semibold ">Room</label>
                                    <select
                                        id="room_id"
                                        name="room_id"
                                        class="form-select outline-hover rounded input-subtle">
                                        <?php foreach ($roomsData as $room): ?>
                                            <option value="<?= $room["id"] ?>" data-amount="<?= $room["price_per_night"] ?>">
                                                <?= $room["room_name"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="check_in" class="form-label extra-small fw-semibold">Check-in</label>
                                    <input type="date" id="check_in" name="check_in" class="form-control outline-hover rounded input-subtle">
                                </div>
                                <div class="col">
                                    <label for="check_out" class="form-label extra-small fw-semibold">Check-out</label>
                                    <input type="date" id="check_out" name="check_out" class="form-control outline-hover rounded input-subtle">
                                </div>
                                <div class="col">
                                    <label for="guests" class="form-label extra-small fw-semibold">Guests</label>
                                    <input type="number" id="guests" name="guests" min="0" class="form-control outline-hover rounded input-subtle">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="status" class="form-label extra-small fw-semibold">Status</label>
                                    <select name="status" id="status" class="form-control form-select outline-hover rounded input-subtle">
                                        <option value="1">Pending</option>
                                        <option value="2">Confirmed</option>
                                        <option value="3">Checked Out</option>
                                        <option value="4">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-3 bg-subtle rounded outline-hover border">
                                <div class="pt-3 px-4">
                                    <p class="extra-small text-gray-light fw-semibold">Nights</p>
                                    <p id="nights" class="fw-bold" data-nights>2</p>
                                </div>
                                <div class="pt-3 px-4">
                                    <p class="extra-small text-gray-light fw-semibold">Rate / Night</p>
                                    <p id="rate_per_night" class="my-2 fw-bold" data-currency data-price="349">2</p>
                                </div>
                                <div class="pt-3 px-4">
                                    <p class="extra-small text-gray-light fw-semibold">Total</p>
                                    <p id="total" class="fs-5 fw-bold my-2" data-currency data-price="69420" data-total>69420</p>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="removeReservationModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-sm">
                <div class="modal-content p-2 ">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                        <div class="bg-danger-subtle p-3 rounded-circle">
                            <i class="fa-solid fa-xmark text-danger"></i>
                        </div>
                        <h2 class="fw-semibold fs-4">Cancel Reservation?</h2>
                        <p class="small text-center" data-remove-id>Are you sure you want to cancel GH-2026-0738? <br>This may be irreversible based on hotel policy.</p>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center p-0 pb-2 m-0">
                        <button class="btn btn-secondary rounded-5" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-danger rounded-5" data-bs-dismiss="modal" data-confirm>
                            Remove
                        </button>

                    </div>
                    <div class="alert alert-danger py-0 text-center d-none" id="modalMessage">Error occured</div>

                </div>
            </div>
        </div>

        <header class="border-bottom d-flex p-2 px-2 pe-4 ms-0 bg-white" style="height: 3.5rem;">
            <button
                class="btn btn-outline d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebar"
                aria-controls="sidebar">

                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="dropdown ms-auto">
                <button
                    class="btn border-0 text-start p-0 text-secondary"
                    type="button"
                    id="profile-dropdown-btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fa fa-user-circle fs-2 mt-1"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end mt-2 me-3 profile-menu pt-2 pb-1" aria-labelledby="profile-dropdown-btn">
                    <div class="profile-header p-1 px-3 mb-2">
                        <p class="profile-name fw-semibold">Justine Carl</p>
                        <p class="profile-email text-secondary-2">justine.carl@grandhorizon.com</p>
                        <span class="status status-warning rounded-1">Super Admin</span>
                    </div>
                    <div class="line"></div>
                    <ul class="profile-items my-1">
                        <li>
                            <a class="link link-subtle fs-7" href="settings.php">
                                <i class="fa-regular fa-user"></i>
                                <p>Profile</p>
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
            </div>
        </header>
        <main class="p-4 m-1" id="scroll-container">
            <div class="container-fluid m-0 p-0">
                <header class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h4 m-0 p-0">Reservation Management</h1>
                    </div>
                    <button class="btn btn-primary rounded-5 fw-bold small" data-bs-toggle="modal" data-bs-target="#addReservation" id="addReservationButton">
                        <i class="fa-solid fa-plus extra-small align-middle me-1"></i>
                        Add Reservation
                    </button>

                </header>
                <div class="row my-4 gx-2 fade-on-scroll ">
                    <div class="col-md-3 col-6">
                        <div class="status-card status-card-success hover-animation rounded-3">
                            <h2 class="status-card-value fw-bold" id="confirmed-count">6</h2>
                            <p class="status-card-label fw-semibold">Confirmed</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="status-card status-card-warning hover-animation rounded-3">
                            <h2 class="status-card-value fw-bold" id="pending-count">1</h2>
                            <p class="status-card-label fw-semibold">Pending</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="status-card status-card-gray hover-animation status-card rounded-3">
                            <h2 class="status-card-value fw-bold" id="checked_out-count">1</h2>
                            <p class="status-card-label fw-semibold">Checked Out</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card status-card-danger hover-animation rounded-3">
                            <h2 class="status-card-value fw-bold" id="cancelled-count">0</h2>
                            <p class="status-card-label fw-semibold">Cancelled</p>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-column flex-md-row  gap-3 mt-2">
                    <div class="search-group flex-grow-1">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search" id="reservationSearch" placeholder="Search by guest or reference" class="form-control outline-hover rounded">
                    </div>
                    <div class="sort-group rounded-5 gap-2 p-1 overflow-x-auto">
                        <div class="sort-input">
                            <input type="radio" name="sort" id="all" value="all" checked>
                            <label for="all" class="extra-small rounded-5 fw-semibold">All</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="pending">
                            <label for="pending" class="extra-small rounded-5 fw-semibold">Pending</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="confirmed">
                            <label for="confirmed" class="extra-small rounded-5 fw-semibold">Confirmed</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="checkout">
                            <label for="checkout" class="extra-small rounded-5 fw-semibold">Checked Out</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="cancelled">
                            <label for="cancelled" class="extra-small rounded-5 fw-semibold">Cancelled</label>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden">
                    <div class="overflow-x-auto mt-4 rounded-4">
                        <table class="table table-custom" id="reservationsTable">
                            <thead>
                                <tr>
                                    <th scope="col">Booking Ref</th>
                                    <th scope="col">Guest</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">Check-in</th>
                                    <th scope="col">Check-out</th>
                                    <th scope="col">Guests</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="extra-small fw-semibold">GH-2026-0738</span>
                                    </td>
                                    <td>
                                        <p class="fw-semibold small">David & Sarah Mitchell</p>
                                        <p class="text-gray-light extra-small mt-1">mitchells@email.com</p>
                                    </td>
                                    <td>
                                        <p class="small">Deluxe Ocean Suite</p>
                                        <span class="status py-1">Deluxe</span>
                                    </td>
                                    <td><span class="small text-gray-light">Jun 28, 2026</span></td>
                                    <td><span class="small text-gray-light">Jun 30, 2026</span></td>
                                    <td><span class="small text-gray-light fw-semibold">2</span></td>
                                    <td><span class="small fw-semibold" data-currency data-price="69420">$69420</span></td>
                                    <td><span class="status status-success rounded-2 text-uppercase small fw-bold">Confirmed</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn btn-outline action-edit text-gray-light"
                                                title="Edit details"
                                                data-edit
                                                data-bs-toggle="modal"
                                                data-bs-target="#addReservation">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-outline action-remove"
                                                title="Cancel"
                                                data-remove
                                                data-bs-toggle="modal"
                                                data-bs-target="#removeReservationModal">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <tfoot>

                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
    <script type="module" src="./js/pages/Reservation.js"></script>
    <script type="module" src="./js/admin/reservation.js"></script>
</body>

</html>