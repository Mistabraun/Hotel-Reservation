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
    <div class="flex-grow-1" style="min-width: 0;">

        <div class="modal fade" id="refundModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-sm">
                <div class="modal-content p-2 ">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                        <div class="bg-danger-subtle p-3 rounded-circle">
                            <i class="fa-solid fa-xmark text-danger"></i>
                        </div>
                        <h2 class="fw-semibold fs-4">Process Refund?</h2>
                        <p class="small text-center" id="refund-message"> This will refund payment PAY-001. This action may be irreversible.</p>
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center p-0 pb-2 m-0">
                        <button class="btn btn-secondary rounded-5 hover-animation" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-danger rounded-5" id="refund-confirm">
                            Refund
                        </button>
                    </div>
                    <div class="alert alert-danger py-0 text-center d-none" id="modalMessage">Error occured</div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="addPaymentModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-md-2">
                <div class="modal-content p-2 border-0">
                    <div class="modal-header pb-0 d-flex justify-content-between align-items-start gap-3 border-0">
                        <div>
                            <h4 class="fs-4 fw-semibold mb-2">Record Payment</h4>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-danger py-2 d-none" id="modalMessage"></div>
                        <form id="addRoomForm" method="post">
                            <div class="row">
                                <div class="col">
                                    <label for="name" class="form-label extra-small fw-semibold">Payment ID</label>
                                    <input type="text" id="name" name="name" class="form-control outline-hover rounded input-subtle" placeholder="PAY-008" data-id="8">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="type" class="form-label extra-small fw-semibold">Resrvation ID</label>
                                    <select name="type" id="type" class="form-select outline-hover rounded input-subtle">
                                        <option value="">Select reservation...</option>
                                        <option value="14">GH-2026-0738 — Yodelle Heyo</option>
                                        <option value="26">GH-2026-0782 — Mark Sucker</option>
                                        <option value="32">GH-2026-0803 — Elon Man </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="type" class="form-label extra-small fw-semibold">Amount</label>
                                    <input type="text" value="$101" id="name" name="name" class="form-control outline-hover rounded input-subtle" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="type" class="form-label extra-small fw-semibold">Method</label>
                                    <select name="type" id="type" class="form-select outline-hover rounded input-subtle">
                                        <option value="1">Credit Card</option>
                                        <option value="2">Gcash</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="type" class="form-label extra-small fw-semibold">Method</label>
                                    <select name="type" id="type" class="form-select outline-hover rounded input-subtle">
                                        <option value="1">Paid</option>
                                        <option value="2">Pending</option>
                                        <option value="3">Refunded</option>
                                        <option value="4">Failed</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="type" class="form-label extra-small fw-semibold">Date</label>
                                    <input type="date" id="name" name="name" class="form-control outline-hover rounded input-subtle">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-primary hover-animation" id="closeModal">
                            Save Changes
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-md-2">
                <div class="modal-content py-2 pb-4 px-3 border-0">
                    <div class="modal-header d-flex justify-content-between align-items-start gap-3 border-0">
                        <div>
                            <h4 class="fs-4 fw-semibold mb-2">Payment Receipt</h4>
                            <p class="extra-small text-secondary-2" data-id="PAY-001">PAY-001</p>
                        </div>
                        <div class="d-flex gap-1 text-secondary-2">
                            <button class="btn btn-outline text-gray-light hover-animation extra-small px-1" onclick="window.print">
                                <i class="fa-solid fa-print"></i>
                            </button>
                            <button class="btn btn-outline text-gray-light hover-animation extra-small px-1">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-body bg-main rounded-4">
                        <div class="d-flex flex-column align-items-center">
                            <h5 class="h6 fw-bold">Grand Horizon</h5>
                            <p class="extra-small text-secondary-2" style="letter-spacing: 0.3pt;">1278 Oceanfront Blvd, Malibu, CA 90265</p>
                        </div>
                        <div class="line my-3"></div>
                        <div class="d-flex flex-column small gap-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary-2 fw-semibold">Guest</span>
                                <span class="fw-semibold">David & Sarah Mitchell</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary-2 fw-semibold">Reservation</span>
                                <span class="fw-semibold">GH-2026-0738 </span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary-2 fw-semibold">Method</span>
                                <span class="fw-semibold">Credit Card</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary-2 fw-semibold">Date</span>
                                <span class="fw-semibold">Jun 25, 2026</span>
                            </div>
                            <div class="line"></div>
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary-2 fw-semibold">Amount</span>
                                <span class="fs-5 fw-bold">$698</span>
                            </div>
                            <div class="combo-success py-2 rounded-3 text-center">
                                <i class="fa-solid fa-check-double"></i>
                                <span class="fw-semibold">Payment Received</span>
                            </div>
                            <p class="text-center ultra-small my-2 text-secondary-2">Thank you for choosing Grand Horizon</p>
                        </div>
                    </div>
                    <div class="modal-footer p-0 border-top-0 mt-3">
                        <button class="btn btn-secondary w-100 rounded-5 m-0 fw-semibold" data-bs-dismiss="modal">Close</button>
                    </div>
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
        <main class="p-4 m-1">
            <div class="container-fluid m-0 p-0">
                <header class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h4 m-0 p-0">Payment Management</h1>
                        <p class="text-secondary-2 m-0 p-0">1 guest on record</p>
                    </div>
                    <button class="btn btn-primary rounded-5 fw-bold small" data-bs-target="#addPaymentModal" data-bs-toggle="modal">
                        <i class="fa-solid fa-plus extra-small align-middle me-1"></i>
                        Record Payment
                    </button>
                </header>
                <div class="row my-4 gx-2">
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3 hover-animation">
                            <div class="combo-success p-3 rounded extra-small">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" data-price="6146"></h2>
                                <p class="status-card-label">Total Guests</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3 hover-animation">
                            <div class="combo-warning p-3 rounded extra-small">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" data-price="1716">12</h2>
                                <p class="status-card-label fw-semibold">Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3 hover-animation">
                            <div class="combo-danger p-3 rounded extra-small">
                                <i class="fa-solid fa-undo text-danger"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold" data-price="657">3</h2>
                                <p class="status-card-label fw-semibold">Refunded</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card rounded-3 d-flex align-items-center gap-3 hover-animation">
                            <div class="combo-warning p-3 rounded extra-small">
                                <i class="fa-solid fa-exchange text-gray-light"></i>
                            </div>
                            <div>
                                <h2 class="status-card-value fw-bold">7</h2>
                                <p class="status-card-label fw-semibold">Transactions</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-column flex-md-row  gap-3 mt-2">
                    <div class="search-group flex-grow-1">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search" id="search" placeholder="Search by guest or reference" class="form-control outline-hover rounded">
                    </div>
                    <div class="sort-group rounded-5 gap-2 p-1 overflow-x-auto">
                        <div class="sort-input">
                            <input type="radio" name="sort" id="all" value="active" checked>
                            <label for="all" class="extra-small rounded-5 fw-semibold">All</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="pending">
                            <label for="pending" class="extra-small rounded-5 fw-semibold">Paid</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="confirmed">
                            <label for="confirmed" class="extra-small rounded-5 fw-semibold">Pending</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="checkout">
                            <label for="checkout" class="extra-small rounded-5 fw-semibold">Refunded</label>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div class="overflow-x-auto mt-4 rounded-4">
                        <table class="table table-custom">
                            <thead>
                                <tr>
                                    <th scope="col">Payment ID</th>
                                    <th scope="col">Reservation ID</th>
                                    <th scope="col">Guest</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="extra-small fw-semibold">PAY-001</span>
                                    </td>
                                    <td>
                                        <span class="extra-small text-gray-light">GH-2026-0738</span>
                                    </td>
                                    <td>
                                        <p class="extra-small fw-semibold">David & Sarah Mitchell</p>
                                    </td>
                                    <td><span class="small fw-semibold" data-price="698"></span></td>
                                    <td><span class="small text-gray-light">Credit Card</span></td>
                                    <td><span class="small text-gray-light">June 25,2026</span></td>
                                    <td><span class="status status-warning rounded-2 text-uppercase small fw-bold">Pending</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn btn-outline action-edit text-gray-light hover-animation px-1"
                                                title="Edit details"
                                                data-edit
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewDetailsModal">
                                                <i class="fa-regular fa-file-alt"></i>
                                            </button>
                                            <button class="btn btn-outline action-remove hover-animation px-1"
                                                title="Cancel"
                                                data-confirm-payment>
                                                <i class="fa-solid fa-check text-success"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="extra-small fw-semibold">PAY-001</span>
                                    </td>
                                    <td>
                                        <span class="extra-small text-gray-light">GH-2026-0738</span>
                                    </td>
                                    <td>
                                        <p class="extra-small fw-semibold">David & Sarah Mitchell</p>
                                    </td>
                                    <td><span class="small fw-semibold" data-price="698"></span></td>
                                    <td><span class="small text-gray-light">Credit Card</span></td>
                                    <td><span class="small text-gray-light">June 25,2026</span></td>
                                    <td><span class="status status-success rounded-2 text-uppercase small fw-bold">Paid</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn btn-outline action-edit text-gray-light hover-animation px-1"
                                                title="Edit details"
                                                data-edit
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewDetailsModal">
                                                <i class="fa-regular fa-file-alt"></i>
                                            </button>
                                            <button class="btn btn-outline action-remove hover-animation px-1"
                                                title="Cancel"
                                                data-remove
                                                data-bs-toggle="modal"
                                                data-bs-target="#refundModal">
                                                <i class="fa-solid fa-undo"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="extra-small fw-semibold">PAY-001</span>
                                    </td>
                                    <td>
                                        <span class="extra-small text-gray-light">GH-2026-0738</span>
                                    </td>
                                    <td>
                                        <p class="extra-small fw-semibold">David & Sarah Mitchell</p>
                                    </td>
                                    <td><span class="small fw-semibold" data-price="698"></span></td>
                                    <td><span class="small text-gray-light">Credit Card</span></td>
                                    <td><span class="small text-gray-light">June 25,2026</span></td>
                                    <td><span class="status status-danger rounded-2 text-uppercase small fw-bold">Refunded</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn btn-outline action-edit text-gray-light hover-animation px-1"
                                                title="Edit details"
                                                data-edit
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewDetailsModal">
                                                <i class="fa-regular fa-file-alt"></i>
                                            </button>
                                            <button class="btn btn-outline action-remove hover-animation px-1"
                                                title="Cancel"
                                                data-delete
                                                data-bs-toggle="modal"
                                                data-bs-target="#refundModal">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
</body>

</html>