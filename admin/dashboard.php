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
    <div class="flex-grow-1 d-flex flex-column overflow-hidden" style="min-width: 0;">
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

        <main class="bg-main flex-grow-1 p-4 m-1 overflow-y-auto" id="scroll-container">
            <header class="d-flex justify-content-between align-items-center">
                <h1 class="h4 m-0 p-0">Room Management</h1>
            </header>


            <div class="row g-4 my-1">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-solid fa-building text-warning fs-4 mb-4 card-icon hover-glow-building"></i>
                            <h3 class="fw-bold mb-1">120</h3>
                            <p class="text-muted-custom small m-0">Total Rooms</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-regular fa-circle-check text-success fs-4 mb-4 card-icon hover-pop-check"></i>
                            <h3 class="fw-bold mb-1">87</h3>
                            <p class="text-muted-custom small m-0">Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2" onclick="window.location.href='guests.php'">
                        <div class="card-body">
                            <i class="fa-solid fa-user text-danger fs-4 mb-4 card-icon hover-jump-user"></i>
                            <h3 class="fw-bold mb-1">30</h3>
                            <p class="text-muted-custom small m-0">Occupied</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-solid fa-wrench text-warning fs-4 mb-4 card-icon hover-twist-wrench"></i>
                            <h3 class="fw-bold mb-1">3</h3>
                            <p class="text-muted-custom small m-0">Maintenance</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-regular fa-calendar-check text-secondary fs-4 mb-4 card-icon hover-swing-calendar"></i>
                            <h3 class="fw-bold mb-1">8</h3>
                            <p class="text-muted-custom small m-0">Today's Reservations</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-solid fa-arrow-right-to-bracket text-info fs-4 mb-4 card-icon hover-slide-right"></i>
                            <h3 class="fw-bold mb-1">12</h3>
                            <p class="text-muted-custom small m-0">Expected Check-ins</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-solid fa-arrow-right-from-bracket text-danger fs-4 mb-4 card-icon hover-slide-left"></i>
                            <h3 class="fw-bold mb-1">9</h3>
                            <p class="text-muted-custom small m-0">Expected Check-outs</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card summary-card border-0 shadow-sm rounded-4 h-100 p-2">
                        <div class="card-body">
                            <i class="fa-solid fa-circle-dollar-to-slot text-success fs-4 mb-4 card-icon hover-flip-coin"></i>
                            <h3 class="fw-bold mb-1">$284.5k</h3>
                            <p class="text-muted-custom small m-0">Monthly Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4 fade-on-scroll">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-2 h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-4">Weekly Occupancy</h6>
                            <div style="position: relative; height: 250px; width: 100%;">
                                <canvas id="occupancyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-2 h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-4">Monthly Revenue</h6>
                            <div style="position: relative; height: 250px; width: 100%;">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 fade-on-scroll">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-4">Recent Activity</h6>

                            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                <li class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success-subtle text-success p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">Emma Richardson <span class="fw-normal text-muted">checked in — Deluxe Ocean Suite</span></p>
                                            <small class="text-muted" style="font-size: 0.8rem;">2 hours ago</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold">CHECK-IN</span>
                                </li>

                                <li class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-warning-subtle text-warning p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">The Park Family <span class="fw-normal text-muted">made a reservation — Family Garden Terrace</span></p>
                                            <small class="text-muted" style="font-size: 0.8rem;">4 hours ago</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2 fw-semibold">RESERVATION</span>
                                </li>

                                <li class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary-subtle text-primary p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-pen"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">James Whitmore <span class="fw-normal text-muted">updated stay — Presidential Suite</span></p>
                                            <small class="text-muted" style="font-size: 0.8rem;">6 hours ago</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-semibold">UPDATE</span>
                                </li>

                                <li class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-danger-subtle text-danger p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; color: #e76f51 !important; background-color: #ffebd6 !important;">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">Maria Santos <span class="fw-normal text-muted">checked out — Garden Terrace Room</span></p>
                                            <small class="text-muted" style="font-size: 0.8rem;">8 hours ago</small>
                                        </div>
                                    </div>
                                    <span class="badge rounded-pill px-3 py-2 fw-semibold" style="color: #e76f51; background-color: #ffebd6;">CHECK-OUT</span>
                                </li>

                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-danger-subtle text-danger p-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-semibold text-dark">David Kim <span class="fw-normal text-muted">canceled booking — Classic Garden Room</span></p>
                                            <small class="text-muted" style="font-size: 0.8rem;">12 hours ago</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 fw-semibold">CANCEL</span>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/app.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart Configuration
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            boxWidth: 20
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            color: '#f3f4f6'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: '#f3f4f6'
                        }
                    }
                }
            };
            const ctxOccupancy = document.getElementById('occupancyChart').getContext('2d');
            new Chart(ctxOccupancy, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Occupancy Rate (%)',
                        data: [60, 70, 82, 75, 85, 90, 80],
                        backgroundColor: '#8bc5fa',
                        borderWidth: 0,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        ...commonOptions.scales,
                        y: {
                            ...commonOptions.scales.y,
                            max: 90,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    }
                }
            });
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue ($k)',
                        data: [150, 190, 210, 250, 280, 320],
                        backgroundColor: '#8bc5fa',
                        borderWidth: 0,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        ...commonOptions.scales,
                        y: {
                            ...commonOptions.scales.y,
                            max: 350,
                            ticks: {
                                stepSize: 50
                            }
                        }
                    }
                }
            });

            // Scroll Fade Animation Logic
            const observerOptions = {
                root: document.getElementById('scroll-container'),
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>