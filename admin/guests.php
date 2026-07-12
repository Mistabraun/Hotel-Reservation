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
                        <a href="checking.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Check-in / Out
                        </a>
                    </li>
                    <li>
                        <a href="checking.php" class="sidebar-link link link-gray">
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
    <div class="flex-grow-1">
        <div class="modal fade" id="viewDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-lg">
                <div class="modal-content p-2 border-0">
                    <div class="modal-header d-flex justify-content-start align-items-start gap-3 border-0">
                        <div class="bg-warning-subtle p-4 rounded-circle extra-small">
                            <span class="fw-bold text-secondary-2 h6">ER</span>
                        </div>
                        <div>
                            <h4 class="fs-5 fw-semibold">Emma Richardson</h4>
                            <div class="extra-small text-gray-light mt-2">
                                <span><i class="fa-regular fa-envelope"></i> eemma.r@mail.com</span>
                                <span><i class="fa-solid fa-phone"></i> +1 (415) 555-0123</span>
                            </div>
                        </div>
                    </div>

                    <div class=" modal-body">
                        <div class="row text-black">
                            <div class="col">
                                <div class="bg-subtle text-center rounded-4 p-3">
                                    <h5>3</h5>
                                    <p class="text-gray-light fw-semibold extra-small mt-2">Total Stays</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="bg-subtle text-center rounded-4 p-3">
                                    <h5>May 12, 2026</h5>
                                    <p class="text-gray-light fw-semibold extra-small mt-2">Last Stay</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="bg-subtle text-center rounded-4 p-3">
                                    <h5>January 1, 2026</h5>
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
                                <tbody>
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
                            <button class="link link-danger fs-7 btn-default" href="settings.php">
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
                <header>
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
                                <h2 class="status-card-value fw-bold">3</h2>
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
                                <h2 class="status-card-value fw-bold">12</h2>
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
                                <h2 class="status-card-value fw-bold">3</h2>
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
                                <h2 class="status-card-value fw-bold">1</h2>
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
                    <div class="row">
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
</body>

</html>