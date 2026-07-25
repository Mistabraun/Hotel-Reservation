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
    <div class="flex-grow-1 d-flex flex-column overflow-hidden">
        <!-- Responsive Header: Replaced static margins with responsive padding -->
        <header class="border-bottom d-flex px-3 px-md-4 py-2 align-items-center bg-white" style="height: 3.5rem;">
            <button class="btn btn-outline-secondary d-lg-none border-0 px-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>

            <div class="dropdown ms-auto d-flex align-items-center gap-3">
                <i class="fa-regular fa-bell fs-5 text-secondary bell-ring" onclick="fetchNotifications()"></i>

                <button class="btn border-0 text-start p-0 text-secondary" type="button" id="profile-dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle fs-3"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end mt-2 profile-menu pt-2 pb-1 shadow-sm" aria-labelledby="profile-dropdown-btn">
                    <div class="profile-header p-1 px-3 mb-2">
                        <p class="profile-name fw-semibold">Justine Carl</p>
                        <p class="profile-email text-secondary-2">justine.carl@grandhorizon.com</p>
                        <span class="user-role admin rounded-1">Super Admin</span>
                    </div>
                    <div class="line"></div>
                    <ul class="profile-items my-1">
                        <li><a class="link link-subtle fs-7" href="settings.php"><i class="fa-regular fa-user"></i>
                                <p>Profile</p>
                            </a></li>
                        <li><a class="link link-subtle fs-7" href="settings.php"><i class="fa-solid fa-gear"></i>
                                <p>Settings</p>
                            </a></li>
                    </ul>
                    <div class="line"></div>
                    <ul class="profile-items mt-1">
                        <li><button class="link link-danger fs-7 btn-default" href="settings.php"><i class="fa-solid fa-sign-out"></i>
                                <p>Logout</p>
                            </button></li>
                    </ul>
                </ul>
            </div>
        </header>

        <!-- Responsive Main: Adjusted padding for mobile (p-2 p-md-4) -->
        <main class="p-4 m-1  overflow-y-auto">
            <div class="container-fluid m-0 p-0">
                <header class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h4 m-0 p-0">Check-in / Check-out</h1>
                    </div>

                </header>


                <!-- Stats Row -->
                <div class="row g-3 my-2 g-xl-4 mb-5 fade-on-scroll">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-2 hover-animation">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 text-warning" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0" id="arriving-count">0</h4>
                                    <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Arriving Today</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-2 hover-animation">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-danger bg-opacity-10 text-danger" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0" id="departing-count">1</h4>
                                    <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Departing Today</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-2 hover-animation">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-warning bg-opacity-10 text-warning" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <i class="fa-solid fa-bed"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0" id="occupied-count">2</h4>
                                    <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Currently Occupied</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100 p-2 hover-animation">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-10 text-success" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0" id="rooms-count">4</h4>
                                    <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Available Rooms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Toggle Pills -->
                <div class="mb-4 fade-on-scroll" style="background-color: #fff; padding: 4px; border-radius: 50rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #eaeaea; display: inline-flex;">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4 py-2 fw-bold" id="pills-checkins-tab" data-bs-toggle="pill" data-bs-target="#pills-checkins" type="button" role="tab" aria-controls="pills-checkins" aria-selected="true" style="background-color: #111 !important; color: #fff !important;">
                                Check-ins
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark fw-bold" id="pills-checkouts-tab" data-bs-toggle="pill" data-bs-target="#pills-checkouts" type="button" role="tab" aria-controls="pills-checkouts" aria-selected="false">
                                Check-outs
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content Area -->
                <div class="tab-content fade-on-scroll" id="pills-tabContent">

                    <!-- CHECK-INS TAB (List State) -->
                    <div class="tab-pane fade show active" id="arrivals-list" role="tabpanel" aria-labelledby="pills-checkins-tab">
                        <p class="text-muted fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">Arriving Today</p>

                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3" style="border: 1px solid #eaeaea;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="fw-bold" style="font-size: 0.85rem;">GH-2026-0744</span>
                                    <span class="badge rounded-1 px-2 py-1" style="background-color: #e6f4ea; color: #1e8e3e; font-weight: 700; font-size: 0.7rem;">CONFIRMED</span>
                                </div>
                                <span class="text-warning fw-bold" style="font-size: 0.8rem;">Today</span>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-md-9">
                                    <h5 class="fw-bold mb-2">Ava Carter</h5>
                                    <div class="text-muted mb-3 d-flex gap-4 flex-wrap" style="font-size: 0.85rem;">
                                        <span><i class="fa-regular fa-envelope me-1 text-secondary"></i> ava.carter@email.com</span>
                                        <span><i class="fa-solid fa-phone me-1 text-secondary"></i> +1 (415) 555-0189</span>
                                        <span><i class="fa-regular fa-user me-1 text-secondary"></i> 1 guest</span>
                                    </div>
                                    <div class="d-flex gap-4 fw-semibold text-dark flex-wrap" style="font-size: 0.85rem;">
                                        <span><i class="fa-solid fa-bed text-muted me-1"></i> Ocean View Room <span class="text-muted fw-normal">(Deluxe)</span></span>
                                        <span><i class="fa-regular fa-calendar text-muted me-1"></i> Jul 24, 2026 — Jul 26, 2026 <span class="text-muted fw-normal">(2 nights)</span></span>
                                        <span>$1,240</span>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end mt-4 mt-md-0">
                                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold" style="font-size: 0.9rem;">
                                        <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Check In
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHECK-OUTS TAB (List State) -->
                    <div class="tab-pane fade" id="checkedin-list" role="tabpanel" aria-labelledby="pills-checkouts-tab">
                        <p class="text-muted fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">Departing Today</p>

                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3" style="border: 1px solid #eaeaea;">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="fw-bold" style="font-size: 0.85rem;">GH-2026-0743</span>
                                    <span class="badge rounded-1 px-2 py-1" style="background-color: #e6f4ea; color: #1e8e3e; font-weight: 700; font-size: 0.7rem;">CONFIRMED</span>
                                </div>
                                <span class="text-warning fw-bold" style="font-size: 0.8rem;">Today</span>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-md-9">
                                    <h5 class="fw-bold mb-2">James Whitmore</h5>
                                    <div class="text-muted mb-3 d-flex gap-4 flex-wrap" style="font-size: 0.85rem;">
                                        <span><i class="fa-regular fa-envelope me-1 text-secondary"></i> j.whitmore@email.com</span>
                                        <span><i class="fa-solid fa-phone me-1 text-secondary"></i> +1 (212) 555-0456</span>
                                        <span><i class="fa-regular fa-user me-1 text-secondary"></i> 2 guests</span>
                                    </div>
                                    <div class="d-flex gap-4 fw-semibold text-dark flex-wrap" style="font-size: 0.85rem;">
                                        <span><i class="fa-solid fa-bed text-muted me-1"></i> Presidential Suite <span class="text-muted fw-normal">(Suite)</span></span>
                                        <span><i class="fa-regular fa-calendar text-muted me-1"></i> Jul 20, 2026 — Jul 23, 2026 <span class="text-muted fw-normal">(3 nights)</span></span>
                                        <span>$2,697</span>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end mt-4 mt-md-0">
                                    <button class="btn btn-dark rounded-pill px-4 py-2 fw-bold" style="font-size: 0.9rem;">
                                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Check Out
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </main>
    </div>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            initScrollAnimations();
            initTabButtons();
            loadArrivals();
            loadCheckedIn();
            updateSummary()
        });


        async function updateSummary() {
            const response = await fetch("/api/stays/summary.php", {
                headers: {
                    Accept: "application/json"
                }
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                return
            }

            const data = result.data
            document.getElementById("arriving-count").textContent = data.arrivals
            document.getElementById("occupied-count").textContent = data.checked_in,
                document.getElementById("departing-count").textContent = data.checked_out,
                document.getElementById("rooms-count").textContent = data.available_rooms

        }

        const API = {
            arrivals: "/api/stays/arrivals.php",
            checkedIn: "/api/stays/checkedIn.php"
        };

        function initScrollAnimations() {
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("is-visible");
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: document.getElementById("scroll-container"),
                threshold: 0.1
            });

            document.querySelectorAll(".fade-on-scroll").forEach(el => observer.observe(el));
        }

        function initTabButtons() {

            const buttons = document.querySelectorAll("#pills-tab .nav-link");

            const checkinsPage = document.getElementById("arrivals-list");
            const checkoutsPage = document.getElementById("checkedin-list");


            buttons.forEach(btn => {

                btn.addEventListener("click", () => {

                    // Change button style
                    buttons.forEach(b => {
                        b.classList.remove("active");
                        b.style.background = "transparent";
                        b.style.color = "#111";
                    });

                    btn.classList.add("active");
                    btn.style.background = "#111";
                    btn.style.color = "#fff";


                    // Switch pages
                    if (btn.id === "pills-checkins-tab") {
                        checkinsPage.classList.add("show", "active");
                        checkoutsPage.classList.remove("show", "active");
                        loadArrivals()
                    }

                    if (btn.id === "pills-checkouts-tab") {
                        checkoutsPage.classList.add("show", "active");
                        checkinsPage.classList.remove("show", "active")
                        console.log("sadas")
                        loadCheckedIn()

                    }

                });

            });

        }

        async function loadArrivals() {

            const container = document.getElementById("arrivals-list");

            container.innerHTML = loadingCard();

            try {

                const response = await fetch(API.arrivals, {
                    headers: {
                        Accept: "application/json"
                    }
                });

                const result = await response.json();

                renderArrivals(result.data.items);

            } catch (e) {

                console.error(e);

                container.innerHTML =
                    `<div class="alert alert-danger rounded-3">Unable to load arrivals.</div>`;

            }

        }

        async function loadCheckedIn() {

            const container = document.getElementById("checkedin-list");


            container.innerHTML = loadingCard();

            try {

                const response = await fetch(API.checkedIn, {
                    headers: {
                        Accept: "application/json"
                    }
                });

                const result = await response.json();

                renderCheckedIn(result.data.items);

            } catch (e) {

                console.error(e);

                container.innerHTML =
                    `<div class="alert alert-danger">Unable to load checked-in guests.</div>`;

            }

        }

        function renderArrivals(items) {

            const container = document.getElementById("arrivals-list");
            container.innerHTML = ""
            if (!items.length) {

                container.innerHTML =
                    `<div class="alert alert-light">No arrivals today.</div>`;

                return;

            }

            container.innerHTML = "";

            items.forEach(item => {

                container.insertAdjacentHTML("beforeend", `
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3"
                style="border:1px solid #eaeaea">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div class="d-flex gap-2 align-items-center">

                        <span class="fw-bold">
                            ${item.booking_reference}
                        </span>

                        <span class="badge rounded-1 px-2 py-1"
                            style="background:#e6f4ea;color:#1e8e3e">

                            CONFIRMED

                        </span>

                    </div>

                    <span class="text-warning fw-bold">
                        Today
                    </span>

                </div>

                <div class="row align-items-end">

                    <div class="col-md-9">

                        <h5 class="fw-bold mb-2">
                            ${item.guest}
                        </h5>

                        <div class="text-muted mb-3 d-flex gap-4 flex-wrap">

                            <span>
                                <i class="fa-regular fa-envelope me-1"></i>
                                ${item.email}
                            </span>

                            <span>
                                <i class="fa-regular fa-user me-1"></i>
                                ${item.number_of_guests} guest(s)
                            </span>

                        </div>

                        <div class="d-flex gap-4 flex-wrap fw-semibold">

                            <span>

                                <i class="fa-solid fa-bed me-1"></i>

                                ${item.room_name}

                                <span class="text-muted fw-normal">
                                    (${item.room_type})
                                </span>

                            </span>

                            <span>

                                <i class="fa-regular fa-calendar me-1"></i>

                                ${formatDate(item.check_in)}
                                —
                                ${formatDate(item.check_out)}

                            </span>

                        </div>

                    </div>

                    <div class="col-md-3 text-md-end mt-4 mt-md-0">

                        <button
                            class="btn btn-dark rounded-pill px-4 checkin-btn"
                            data-id="${item.id}">

                            <i class="fa-solid fa-arrow-right-to-bracket me-2"></i>

                            Check In

                        </button>

                    </div>

                </div>

            </div>
        `);

            });

        }

        function renderCheckedIn(items) {

            const container = document.getElementById("checkedin-list");
            container.innerHTML = ""
            if (!items.length) {

                container.innerHTML =
                    `<div class="alert alert-light rounded-3">No guests to check out today.</div>`;

                return;

            }

            container.innerHTML = "";

            items.forEach(item => {

                container.insertAdjacentHTML("beforeend", `
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-3"
                style="border:1px solid #eaeaea">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div class="d-flex gap-2 align-items-center">

                        <span class="fw-bold">

                            ${item.booking_reference}

                        </span>

                        <span class="badge rounded-1 px-2 py-1"
                            style="background:#e6f4ea;color:#1e8e3e">

                            CHECKED IN

                        </span>

                    </div>

                    <span class="text-warning fw-bold">
                        Checkout:
                        ${formatDate(item.check_out)}
                    </span>

                </div>

                <div class="row align-items-end">

                    <div class="col-md-9">

                        <h5 class="fw-bold mb-2">

                            ${item.guest}

                        </h5>

                        <div class="text-muted mb-3 d-flex gap-4 flex-wrap">

                            <span>

                                <i class="fa-regular fa-envelope me-1"></i>

                                ${item.email}

                            </span>

                            <span>

                                <i class="fa-regular fa-user me-1"></i>

                                ${item.number_of_guests} guest(s)

                            </span>

                        </div>

                        <div class="d-flex gap-4 flex-wrap fw-semibold">

                            <span>

                                <i class="fa-solid fa-bed me-1"></i>

                                ${item.room_name}

                                <span class="text-muted fw-normal">

                                    (${item.room_type})

                                </span>

                            </span>

                            <span>

                                Checked In:
                                ${item.checked_in_at}

                            </span>

                        </div>

                    </div>

                    <div class="col-md-3 text-md-end mt-4 mt-md-0">

                        <button
                            class="btn btn-dark rounded-pill px-4 checkout-btn"
                            data-id="${item.id}">

                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>

                            Check Out

                        </button>

                    </div>

                </div>

            </div>
        `);

            });

        }

        function loadingCard() {

            return `
        <div class="text-center py-5">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
            <p class="mt-3 mb-0">Loading...</p>
        </div>
    `;

        }

        function formatDate(date) {

            return new Date(date).toLocaleDateString("en-US", {
                month: "short",
                day: "numeric",
                year: "numeric"
            });

        }

        document.addEventListener("click", async function(e) {

            console.log(e)
            if (e.target.closest(".checkin-btn")) {

                const id = e.target.closest(".checkin-btn").dataset.id;

                console.log("Check In:", id);

                const formData = new FormData()
                formData.append("reservation_id", id)

                const response = await fetch(
                    "../../api/stays/checkIn.php", {
                        method: "POST",
                        body: formData
                    }
                );

                const result = await response.json();

                if (!result.success) {
                    return;
                }

                loadArrivals();
                loadCheckedIn();
                updateSummary()

            }

            if (e.target.closest(".checkout-btn")) {

                const id = e.target.closest(".checkout-btn").dataset.id;

                console.log("Check Out:", id);


                const formData = new FormData()
                formData.append("reservation_id", id)

                const response = await fetch(
                    "../../api/stays/checkOut.php", {
                        method: "POST",
                        body: formData
                    }
                );

                const result = await response.json();

                if (!result.success) {
                    return;
                }

                loadArrivals();
                loadCheckedIn();
                updateSummary()

            }

        });
    </script>
</body>

</html>