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
                        <a href="./" class="sidebar-link link link-gray active">
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
    <div class="flex-grow-1" style="min-width: 0;">
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
                    <h1 class="h4 m-0 p-0">Reservation Management</h1>
                    <p class="text-secondary-2 m-0 p-0">8 total reservations</p>
                </header>
                <div class="row my-4 gx-2">
                    <div class="col-md-3 col-6">
                        <div class="status-card status-card--confirmed rounded-3">
                            <h2 class="status-card-value fw-bold">6</h2>
                            <p class="status-card-label fw-semibold">Confirmed</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="status-card status-card--pending rounded-3">
                            <h2 class="status-card-value fw-bold">1</h2>
                            <p class="status-card-label fw-semibold">Pending</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="status-card status-card rounded-3">
                            <h2 class="status-card-value fw-bold">1</h2>
                            <p class="status-card-label fw-semibold">Checked Out</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="status-card status-card--cancelled rounded-3">
                            <h2 class="status-card-value fw-bold">0</h2>
                            <p class="status-card-label fw-semibold">Cancelled</p>
                        </div>
                    </div>

                </div>
                <div class="d-flex flex-column flex-md-row  gap-3 mt-2">
                    <div class="search-group flex-grow-1">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search" id="search" placeholder="Search by guest or reference" class="form-control outline-hover rounded">
                    </div>
                    <div class="sort-group rounded-5 gap-2 p-1">
                        <button class="btn-plain extra-small rounded-5 fw-semibold" data-active="true">All</button>
                        <button class="btn-plain extra-small rounded-5 fw-semibold">Pending</button>
                        <button class="btn-plain extra-small rounded-5 fw-semibold">Confirmed</button>
                        <button class="btn-plain extra-small rounded-5 fw-semibold">Checked Out</button>
                        <button class="btn-plain extra-small rounded-5 fw-semibold">Cancelled</button>
                    </div>
                </div>

                <div class="overflow-hidden">
                    <div class="overflow-x-auto mt-4 rounded-4">
                        <table class="table table-custom w-100">
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
                                    <td>GH-2026-0738</td>
                                    <td>
                                        <p>David & Sarah Mitchell</p>
                                        <p>mitchells@email.com</p>
                                    </td>
                                    <td>
                                        <p>Deluxe Ocean Suite</p>
                                        <span>Deluxe</span>
                                    </td>
                                    <td>Jun 28, 2026</td>
                                    <td>Jun 30, 2026</td>
                                    <td>2</td>
                                    <td>$69420</td>
                                    <td><span class="status status-success rounded-2 text-uppercase small fw-bold">Confirmed</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn-plain action-edit">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn-plain action-remove">
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