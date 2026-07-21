<?php

include_once __DIR__ . "/../app/services/AmenityService.php";

$amenityService = new AmenityService();
$amenities = $amenityService->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Room Types - Grand Horizon</title>
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
    <div class="flex-grow-1 w-100 vh-100 overflow-y-auto">
        <div class="modal fade" id="removeTypeModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-sm">
                <div class="modal-content p-2 ">
                    <div class="modal-body d-flex flex-column justify-content-center align-items-center gap-2">
                        <div class="bg-danger-subtle p-3 rounded-circle">
                            <i class="fa-solid fa-xmark text-danger"></i>
                        </div>
                        <h2 class="fw-semibold fs-4">Delete Room Type?</h2>
                        <p class="small text-center">This will remove the room type definition. Existing rooms won't be affected..</p>
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

        <div class="modal fade" id="addTypeModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered mx-w-md">
                <div class="modal-content p-2">
                    <header class="modal-header d-flex justify-content-between">
                        <div>
                            <h5 class="modal-title" data-title>Add New Room</h5>
                        </div>
                    </header>

                    <div class="modal-body">
                        <div class="alert alert-danger py-2 d-none" id="modalMessage"></div>
                        <form id="addTypeForm" method="post">
                            <div class="row">
                                <div class="col">
                                    <label for="name" class="form-label extra-small fw-semibold">Type Name *</label>
                                    <input type="text" id="name" name="name" class="form-control outline-hover rounded input-subtle" placeholder="Deluxe Ocean Suite">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="description" class="form-label extra-small fw-semibold">Description</label>
                                    <textarea name="description" id="description" class="form-control outline-hover rounded input-subtle"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="price" class="form-label extra-small fw-semibold">Base Price/Night *</label>
                                    <input type="number" id="price" name="price" class="form-control outline-hover rounded input-subtle" value="0">
                                </div>
                                <div class="col">
                                    <label for="capacity" class="form-label extra-small fw-semibold">Capacity</label>
                                    <input type="number" id="capacity" name="capacity" class="form-control outline-hover rounded input-subtle" value="2">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p class="extra-small fw-semibold my-2">Ameneties</p>

                                    <?php

                                    $amenitiesData = $amenities["message"];
                                    foreach ($amenitiesData as $amenity): ?>

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
                            <button class="link link-danger fs-7 btn-default" href="settings.php">
                                <i class="fa-solid fa-sign-out"></i>
                                <p>Logout</p>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>
        </header>
        <main class="p-4">
            <div class="container m-0 p-0">
                <div class="container-fluid">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold">Room Types</h2>
                            <p class="text-secondary">
                                Manage hotel room categories and pricing.
                            </p>
                        </div>
                        <button
                            id="addTypeButton"
                            class="btn btn-warning text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#addTypeModal">
                            <i class="fa-regular fa-plus"></i>
                            Add Room Type
                        </button>
                    </div>

                    <div class="row g-4" id="roomTypesContainer">

                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="fw-bold">
                                                Name
                                            </h4>
                                            <p class="text-secondary">
                                                This is a description
                                            </p>
                                        </div>
                                        <div>
                                            <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#addTypeModal">
                                                <i class="fa-solid fa-pen"></i>Edit
                                            </button>
                                            <button class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#removeTypeModal">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <small class="text-secondary">Base Price</small>
                                            <h5>₱199 <span class="extra-small text-secondary-2">/night</span></h5>
                                        </div>
                                        <div class="col">
                                            <small class="text-secondary">Capacity</small>
                                            <h5>2 Guests</h5>
                                        </div>
                                    </div>

                                    <div class="mt-2 border-top">
                                        <div class="text-secondary-2 fw-semibold mt-3">
                                            <p class="small mb-2">Amenities (1)</p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </main>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="../scripts/app.js"></script>
    <script type="module" src="./js/admin/room-types.js"></script>
</body>

</html>