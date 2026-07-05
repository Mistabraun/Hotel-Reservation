<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../libraries/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Document</title>
</head>

<body class="vh-100 d-flex position-relative">
    <header
        id="sidebar"
        data-bs-scroll="true"
        tabindex="1"
        class="offcanvas-lg offcanvas-start bg-secondary text-white  d-flex flex-column"
        style="width: 16rem">

        <div class="cpx-3 pt-4 pb-2">
            <h1 class="h5">Grand Horizon</h1>
            <p class="f-spacing-wide fw-semibold text-uppercase ultra-small text-gray">Admin Panel</p>
        </div>
        <div class="line"></div>
        <nav class="px-2.5 pt-4 pb-2 d-flex flex-column gap-4">
            <div class="text-gray">
                <h2 class="px-3 text-uppercase ultra-small opacity-50 f-spacing-wide fw-semibold">Overview</h2>
                <ul class="mt-2 small d-flex flex-column gap-1">
                    <li class="active d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-solid fa-cube"></i>
                        <a href="dashboard" class="text-gray">Dashboard</a>
                    </li>
                </ul>
            </div>
            <div class="text-gray">
                <h2 class="px-3 text-uppercase ultra-small opacity-50 f-spacing-wide fw-semibold">Management</h2>
                <ul class="mt-2 small d-flex flex-column gap-1">
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-solid fa-bed"></i>
                        <a href="dashboard" class="text-gray ">Rooms</a>
                    </li>
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-regular fa-building"></i>
                        <a href="dashboard" class="text-gray">Room Types</a>
                    </li>
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-regular fa-calendar-check"></i>
                        <a href="dashboard" class="text-gray">Reservation</a>
                    </li>
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-regular fa-user"></i>
                        <a href="dashboard" class="text-gray">Guests</a>
                    </li>
                </ul>

            </div>
            <div class="text-gray">
                <h2 class="px-3 text-uppercase ultra-small opacity-50 f-spacing-wide fw-semibold">Operations</h2>
                <ul class="mt-2 small d-flex flex-column gap-1">
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <a href="dashboard" class="text-gray ">Check-in / Out</a>
                    </li>
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-regular fa-credit-card"></i>
                        <a href="dashboard" class="text-gray">Payments</a>
                    </li>
                </ul>
            </div>
            <div class="text-gray">
                <h2 class="px-3 text-uppercase ultra-small opacity-50 f-spacing-wide fw-semibold">Insights</h2>
                <ul class="mt-2 small d-flex flex-column gap-1">
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-solid fa-chart-simple"></i>
                        <a href="dashboard" class="text-gray ">Reports</a>
                    </li>
                    <li class="d-flex gap-3 align-items-center item-link px-3 py-2.5 rounded">
                        <i class="fa-solid fa-gear"></i>
                        <a href="dashboard" class="text-gray">Settings</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mt-auto text-gray opacity-75">
            <div class="line"></div>
            <a href="../" class="extra-small d-flex p-4 pt-3 gap-3 align-items-center">
                <i class="fa-solid fa-arrow-left ultra-small"></i>
                <p class="m-0 fw-semibold">Back to Website</p>
            </a>
        </div>
    </header>
    <div class="flex-grow-1">
        <header class="border-bottom d-flex p-2 mx-2" style="height: 3.5rem;">
            <button
                class="btn btn-outline d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebar"
                aria-controls="sidebar">

                <i class="fa-solid fa-bars"></i>
            </button>
        </header>
    </div>
    <script src="../libraries/bootstrap/js/bootstrap.bundle.js"></script>
    <script>

    </script>
</body>

</html>