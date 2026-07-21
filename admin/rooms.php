<?php

include_once __DIR__ . "/../app/services/AmenityService.php";

$amenityService = new AmenityService();
$amenities = $amenityService->getAll();
$amenitiesData = $amenities["message"];

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

<body class="d-flex flex-column flex-lg-row app-wrapper bg-main">
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
    <div class="flex-grow-1 w-100 app-main d-flex flex-column">
        <div class="modal fade" id="removeRoomModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-sm">
                <div class="modal-content p-2 ">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                        <div class="bg-danger-subtle p-3 rounded-circle">
                            <i class="fa-solid fa-xmark text-danger"></i>
                        </div>
                        <h2 class="fw-semibold fs-4">Delete Room?</h2>
                        <p class="small text-center">This action cannot be undone. All associated data will be removed.</p>
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

        <div class="modal fade" id="addRoom" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-md">
                <div class="modal-content p-2">
                    <header class="modal-header d-flex justify-content-between">
                        <div>
                            <h5 class="modal-title" data-title>Add New Room</h5>
                        </div>
                    </header>

                    <div class="modal-body">
                        <div class="alert alert-danger py-2 d-none" id="modalMessage"></div>
                        <form id="addRoomForm" method="post">
                            <div class="row">
                                <div class="col-md-9 col-6">
                                    <label for="name" class="form-label extra-small fw-semibold">Room Name *</label>
                                    <input type="text" id="name" name="name" class="form-control outline-hover rounded input-subtle" placeholder="Deluxe Ocean Suite">
                                </div>
                                <div class="col-md-3 col-6">
                                    <label for="room_number" class="form-label extra-small fw-semibold">Room Number</label>
                                    <input type="text" id="room_number" name="room_number" class="form-control outline-hover rounded input-subtle" placeholder="102">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="type" class="form-label extra-small fw-semibold">Type</label>
                                    <select name="type" id="type" class="form-select outline-hover rounded input-subtle">
                                        <option value="1">Standard</option>
                                        <option value="2">Deluxe</option>
                                        <option value="3">Family Room</option>
                                        <option value="4">Suite</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="status" class="form-label extra-small fw-semibold">Status</label>
                                    <select name="status" id="status" class="form-select outline-hover rounded input-subtle">
                                        <option value="1">Available</option>
                                        <option value="2">Occupied</option>
                                        <option value="3">Maintenance</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label class="form-label extra-small fw-semibold">Price/Night *</label>
                                    <span value="0" type="number" id="price" name="price" class="form-control outline-hover rounded disabled bg-disabled fw-semibold">123</span>
                                </div>
                                <div class="col">
                                    <label class="form-label extra-small fw-semibold">Capacity</label>
                                    <span value="2" type="number" id="capacity" name="capacity" class="form-control outline-hover rounded disabled bg-disabled">123</span>
                                </div>
                                <div class="col">
                                    <label for="size" class="form-label extra-small fw-semibold">Size</label>
                                    <input type="text" id="size" name="size" class="form-control outline-hover rounded input-subtle" placeholder="480 sq ft">
                                </div>
                            </div>
                            <div class="row mt-2">

                                <div class="col ">
                                    <label for="bed_type" class="form-label extra-small fw-semibold">Bed Type</label>
                                    <input type="text" id="bed_type" name="bed_type" class="form-control outline-hover rounded input-subtle" placeholder="1 King Bed">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p class="extra-small fw-semibold my-2">Ameneties</p>

                                    <div id="amenitiesEdit">
                                        <?php foreach ($amenitiesData as $amenity): ?>
                                            <label class="checkbox mb-2">
                                                <input
                                                    type="checkbox"
                                                    name="amenities[]"
                                                    value="<?= $amenity["id"] ?>">

                                                <span class="extra-small">
                                                    <?= htmlspecialchars($amenity["name"]) ?>
                                                </span>

                                                <i class="fa-solid fa-check"></i>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div id="amenitiesView" class="d-none">
                                    </div>

                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn btn-primary" id="closeModal">
                            Save Changes
                        </button>
                    </div>
                    </form>

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
                        <h1 class="h4 m-0 p-0">Room Management</h1>
                    </div>
                    <button class="btn btn-primary rounded-5 fw-bold small" data-bs-toggle="modal"
                        data-bs-target="#addRoom" id="addRoomButton">
                        <i class="fa-solid fa-plus extra-small align-middle me-1"></i>
                        Add Room
                    </button>
                </header>

                <div class="d-flex flex-column flex-md-row gap-3 mt-4">
                    <div class="search-group flex-grow-1">
                        <i class="fa-solid fa-search"></i>
                        <input type="text" name="search" id="roomSearch" placeholder="Search rooms..." class="form-control outline-hover rounded">
                    </div>
                    <div class="sort-group rounded-5 gap-2 p-1 overflow-x-auto">
                        <div class="sort-input">
                            <input type="radio" name="sort" id="all" value="all" checked>
                            <label for="all" class="extra-small rounded-5 fw-semibold">All</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="available" value="available">
                            <label for="available" class="extra-small rounded-5 fw-semibold">Available</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="occupied" value="occupied">
                            <label for="occupied" class="extra-small rounded-5 fw-semibold">Occupied</label>
                        </div>
                        <div class="sort-input">
                            <input type="radio" name="sort" id="maintenance" value="maintenance">
                            <label for="maintenance" class="extra-small rounded-5 fw-semibold">Maintenance</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="table-container border rounded-3 overflow-hidden rounded-4 p-0 ">
                        <table class=" table table-custom mb-0" id="roomsTable">
                            <thead>
                                <tr>
                                    <th scope="col">Room</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="fw-semibold small">Classic Garden Room</p>
                                        <p class="text-gray-light extra-small mt-1">1 Queen Bed · 320 sq ft</p>
                                    </td>
                                    <td><span class="small text-gray-light fw-semibold">Room 105</span></td>
                                    <td>
                                        <span class="status py-1 extra-small rounded-2">Standard</span>
                                    </td>
                                    <td>
                                        <p class="fw-semibold small" data-price="69420"></p>
                                    </td>
                                    <td><span class="small text-gray-light">2 guests</span></td>
                                    <td><span class="status status-success rounded-2 text-uppercase small fw-bold">Available</span></td>
                                    <td>
                                        <div class="action-group">
                                            <button class="btn btn-outline action-edit text-gray-light"
                                                title="Edit details"
                                                data-edit
                                                data-bs-toggle="modal"
                                                data-bs-target="#editReservationModal">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-outline action-remove"
                                                title="Cancel"
                                                data-remove
                                                data-bs-toggle="modal"
                                                data-bs-target="#removeModal">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                            <tfoot>

                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
    <!-- <script src="./js/app.js"></script> -->
    <script type="module" src="./js/pages/rooms.js"></script>
    <script type="module" src="./js/admin/rooms.js"></script>
</body>

</html>