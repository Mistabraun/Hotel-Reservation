<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Reports - Grand Horizon</title>
</head>

<body class="vh-100 d-flex position-relative">
    <!-- Sidebar[cite: 1, 2, 3] -->
    <aside
        id="sidebar"        
        data-bs-scroll="true"
        tabindex="1"
        class="offcanvas-lg offcanvas-start bg-secondary text-white d-flex flex-column"
        style="width: 16rem">
        
        <div class="px-4 pt-4 pb-2 sidebar-brand">
            <h1>Grand Horizon</h1>
            <p class="text-white-50">ADMIN PANEL</p>
        </div>

        <div class="line"></div>
        <nav class="px-2.5 pt-4 pb-2 d-flex flex-column gap-4 overflow-y-auto">
            <div class="sidebar-category">
                <h2>Overview</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="Dashboard.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-cube"></i> Dashboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Management</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="rooms.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-bed"></i> Rooms
                        </a>
                    </li>
                    <li>
                        <a href="rooms-types.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-building"></i> Room Types
                        </a>
                    </li>
                    <li>
                        <a href="reservation.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-calendar-check"></i> Reservation
                        </a>
                    </li>
                    <li>
                        <a href="Guest.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-user"></i> Guests
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Operations</h2>
                <ul class="sidebar-list">
                    <li>
                        <!-- Removed active class from here[cite: 1, 3] -->
                        <a href="payments.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Check-in / Out
                        </a>
                    </li>
                    <li>
                        <a href="payments.php" class="sidebar-link link link-gray">
                            <i class="fa-regular fa-credit-card"></i> Payments
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Insights</h2>
                <ul class="sidebar-list">
                    <li>
                        <!-- Added active class to Reports[cite: 3] -->
                        <a href="Report.php" class="sidebar-link link link-gray active">
                            <i class="fa-solid fa-chart-simple"></i> Reports
                        </a>
                    </li>
                    <li>
                        <a href="settings.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-gear"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="mt-auto text-gray opacity-75">
            <div class="line"></div>
            <a href="/" class="extra-small d-flex p-4 pt-3 gap-3 align-items-center text-decoration-none text-reset">
                <i class="fa-solid fa-arrow-left ultra-small"></i>
                <p class="m-0 fw-semibold">Back to Website</p>
            </a>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column overflow-hidden bg-light">
        <!-- Unified Header matching Check-in & Dashboard[cite: 1, 2] -->
        <header class="border-bottom d-flex px-3 px-md-4 py-2 align-items-center bg-white" style="height: 3.5rem;">
            <button class="btn btn-outline-secondary d-lg-none border-0 px-2 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>
            <div class="d-flex flex-column justify-content-center">
                <h4 class="m-0 fw-bold fs-5">Reports</h4>
                <p class="m-0 small text-muted">Analytics and performance insights</p>
            </div>
            <div class="dropdown ms-auto d-flex align-items-center gap-3">
                <i class="fa-regular fa-bell fs-5 text-secondary bell-ring"></i>
                
                <button class="btn border-0 text-start p-0 text-secondary" type="button" id="profile-dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle fs-3"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end mt-2 me-3 profile-menu pt-2 pb-1 shadow-sm" aria-labelledby="profile-dropdown-btn">
                    <div class="profile-header p-1 px-3 mb-2">
                        <p class="profile-name fw-semibold">Justine Carl</p>
                        <p class="profile-email text-secondary-2">justine.carl@grandhorizon.com</p>
                        <span class="user-role admin rounded-1">Super Admin</span>
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
                            <button class="link link-danger fs-7 btn-default">
                                <i class="fa-solid fa-sign-out"></i>
                                <p>Logout</p>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>
        </header>

        <main class="flex-grow-1 p-3 p-md-4 overflow-y-auto" id="scroll-container">
            
            <!-- Page Header & Filters -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 fade-on-scroll">
                <div>
                    <h2 class="fw-bold mb-1">Performance Overview</h2>
                </div>
                <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                    <div class="d-flex gap-2">
                        <button class="btn btn-link text-muted text-decoration-none px-2">7 Days</button>
                        <button class="btn btn-light shadow-sm fw-bold px-3 rounded-2 text-dark">30 Days</button>
                        <button class="btn btn-link text-muted text-decoration-none px-2">90 Days</button>
                        <button class="btn btn-link text-muted text-decoration-none px-2">1 Year</button>
                    </div>
                </div>
            </div>

            <!-- Summary Cards using Bootstrap utilities -->
            <div class="row g-3 g-xl-4 mb-4 fade-on-scroll">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="text-muted fw-semibold text-uppercase mb-0" style="font-size: 0.75rem;">TOTAL REVENUE</h6>
                            <div class="bg-warning-subtle text-warning rounded-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fa-solid fa-dollar-sign"></i></div>
                        </div>
                        <h3 class="fw-bold mb-2">$1,904,500</h3>
                        <p class="text-info small fw-semibold mb-0"><i class="fa-solid fa-arrow-up"></i> 8.2% vs last period</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="text-muted fw-semibold text-uppercase mb-0" style="font-size: 0.75rem;">OCCUPANCY RATE</h6>
                            <div class="bg-danger-subtle text-danger rounded-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fa-solid fa-bed"></i></div>
                        </div>
                        <h3 class="fw-bold mb-2">78.4%</h3>
                        <p class="text-info small fw-semibold mb-0"><i class="fa-solid fa-arrow-up"></i> 3.6% vs last period</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="text-muted fw-semibold text-uppercase mb-0" style="font-size: 0.75rem;">AVG DAILY RATE</h6>
                            <div class="bg-secondary-subtle text-secondary rounded-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fa-solid fa-tag"></i></div>
                        </div>
                        <h3 class="fw-bold mb-2">$321</h3>
                        <p class="text-info small fw-semibold mb-0"><i class="fa-solid fa-arrow-up"></i> 4.1% vs last period</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="text-muted fw-semibold text-uppercase mb-0" style="font-size: 0.75rem;">REVPAR</h6>
                            <div class="bg-secondary-subtle text-secondary rounded-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;"><i class="fa-solid fa-chart-line"></i></div>
                        </div>
                        <h3 class="fw-bold mb-2">$252</h3>
                        <p class="text-info small fw-semibold mb-0"><i class="fa-solid fa-arrow-up"></i> 6.8% vs last period</p>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row g-3 g-xl-4 mb-4 fade-on-scroll">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <h6 class="fw-bold mb-1 fs-5">Monthly Revenue</h6>
                        <p class="text-muted small mb-4">Revenue and ADR trend</p>
                        <div style="position: relative; height: 260px; width: 100%;">
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <h6 class="fw-bold mb-1 fs-5">Occupancy Trend</h6>
                        <p class="text-muted small mb-4">Weekly occupancy rate with room count</p>
                        <div style="position: relative; height: 260px; width: 100%;">
                            <canvas id="occupancyTrendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row g-3 g-xl-4 mb-4 fade-on-scroll">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <h6 class="fw-bold mb-1 fs-5">Revenue by Room Type</h6>
                        <p class="text-muted small mb-4">Distribution across categories</p>
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-4" style="min-height: 200px;">
                            <div style="position: relative; height: 160px; width: 160px;">
                                <canvas id="roomTypePie"></canvas>
                            </div>
                            <div class="d-flex flex-column gap-2 small flex-grow-1" style="max-width: 250px;">
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Standard</span> <strong>$84.5k</strong></div>
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Deluxe</span> <strong>$128.0k</strong></div>
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Family Room</span> <strong>$96.0k</strong></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Suite</span> <strong>$72.0k</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-3 p-4 h-100">
                        <h6 class="fw-bold mb-1 fs-5">Booking Sources</h6>
                        <p class="text-muted small mb-4">Where guests come from</p>
                        <div class="d-flex flex-wrap align-items-center justify-content-center gap-4" style="min-height: 200px;">
                            <div style="position: relative; height: 160px; width: 160px;">
                                <canvas id="bookingSourcePie"></canvas>
                            </div>
                            <div class="d-flex flex-column gap-2 small flex-grow-1" style="max-width: 250px;">
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Direct Website</span> <strong>42%</strong></div>
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">OTA (Booking)</span> <strong>28%</strong></div>
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Phone</span> <strong>15%</strong></div>
                                <div class="d-flex justify-content-between border-bottom pb-1"><span class="text-muted">Travel Agents</span> <strong>10%</strong></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Walk-in</span> <strong>5%</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table: Room Type Performance -->
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4 fade-on-scroll">
                <h6 class="fw-bold mb-1 fs-5">Room Type Performance</h6>
                <p class="text-muted small mb-4">Breakdown by room category</p>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-top mb-0">
                        <thead class="text-muted text-uppercase">
                            <tr>
                                <th class="border-bottom py-3">ROOM TYPE</th>
                                <th class="text-center border-bottom py-3">TOTAL ROOMS</th>
                                <th class="text-center border-bottom py-3">OCCUPIED</th>
                                <th class="border-bottom py-3">OCC. RATE</th>
                                <th class="text-end border-bottom py-3">AVG PRICE</th>
                                <th class="text-end border-bottom py-3">REVENUE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-semibold">Standard</td>
                                <td class="text-center text-muted">48</td>
                                <td class="text-center text-muted">40</td>
                                <td style="min-width: 150px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1 rounded-pill bg-light" style="height: 6px;">
                                            <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: 83.3%;"></div>
                                        </div>
                                        <span class="text-muted small">83.3%</span>
                                    </div>
                                </td>
                                <td class="text-end text-muted">$204</td>
                                <td class="text-end fw-bold">$84,500</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Deluxe</td>
                                <td class="text-center text-muted">35</td>
                                <td class="text-center text-muted">30</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1 rounded-pill bg-light" style="height: 6px;">
                                            <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: 85.7%;"></div>
                                        </div>
                                        <span class="text-muted small">85.7%</span>
                                    </div>
                                </td>
                                <td class="text-end text-muted">$364</td>
                                <td class="text-end fw-bold">$128,000</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Family Room</td>
                                <td class="text-center text-muted">22</td>
                                <td class="text-center text-muted">16</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1 rounded-pill bg-light" style="height: 6px;">
                                            <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: 72.7%;"></div>
                                        </div>
                                        <span class="text-muted small">72.7%</span>
                                    </div>
                                </td>
                                <td class="text-end text-muted">$429</td>
                                <td class="text-end fw-bold">$96,000</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Suite</td>
                                <td class="text-center text-muted">15</td>
                                <td class="text-center text-muted">11</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1 rounded-pill bg-light" style="height: 6px;">
                                            <div class="progress-bar bg-warning rounded-pill" role="progressbar" style="width: 73.3%;"></div>
                                        </div>
                                        <span class="text-muted small">73.3%</span>
                                    </div>
                                </td>
                                <td class="text-end text-muted">$899</td>
                                <td class="text-end fw-bold">$72,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table: Top Guests by Spend -->
            <div class="card border-0 shadow-sm rounded-3 p-4 fade-on-scroll">
                <h6 class="fw-bold mb-1 fs-5">Top Guests by Spend</h6>
                <p class="text-muted small mb-4">VIP and high-value guest rankings</p>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-top mb-0">
                        <thead class="text-muted text-uppercase">
                            <tr>
                                <th class="border-bottom py-3">#</th>
                                <th class="border-bottom py-3">GUEST</th>
                                <th class="text-center border-bottom py-3">TOTAL STAYS</th>
                                <th class="text-end border-bottom py-3">TOTAL SPENT</th>
                                <th class="text-center border-bottom py-3">LAST STAY</th>
                                <th class="text-center border-bottom py-3">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.8rem;">1</div></td>
                                <td class="fw-semibold">James Whitmore</td>
                                <td class="text-center text-muted">7</td>
                                <td class="text-end fw-bold">$18,900</td>
                                <td class="text-center text-muted">2026-06-18</td>
                                <td class="text-center"><span class="badge bg-warning-subtle text-warning rounded-pill border border-warning-subtle px-3 py-1 fw-semibold">VIP</span></td>
                            </tr>
                            <tr>
                                <td><div class="rounded-circle bg-light text-secondary d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.8rem;">2</div></td>
                                <td class="fw-semibold">Emma Richardson</td>
                                <td class="text-center text-muted">3</td>
                                <td class="text-end fw-bold">$8,200</td>
                                <td class="text-center text-muted">2026-05-12</td>
                                <td class="text-center"><span class="badge bg-light text-secondary rounded-pill border px-3 py-1 fw-semibold">Regular</span></td>
                            </tr>
                            <tr>
                                <td><div class="rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.8rem;">3</div></td>
                                <td class="fw-semibold">David Mitchell</td>
                                <td class="text-center text-muted">4</td>
                                <td class="text-end fw-bold">$7,600</td>
                                <td class="text-center text-muted">2026-06-30</td>
                                <td class="text-center"><span class="badge bg-light text-secondary rounded-pill border px-3 py-1 fw-semibold">Regular</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
    
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // General Chart Options
            const commonGridOptions = {
                grid: { display: false, drawBorder: false },
                ticks: { display: true, color: '#8a8580', font: { size: 11 } }
            };

            // 1. Monthly Revenue Chart (Bar & Line combo style from UI)[cite: 3]
            const ctxRev = document.getElementById('monthlyRevenueChart').getContext('2d');
            new Chart(ctxRev, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [
                        {
                            type: 'scatter',
                            label: 'Target/Max',
                            data: [310, 315, 320, 315, 330, 340, 335],
                            backgroundColor: '#000',
                            pointRadius: 4,
                            yAxisID: 'y'
                        },
                        {
                            type: 'bar',
                            label: 'Revenue',
                            data: [245, 230, 260, 280, 310, 320, 285],
                            backgroundColor: '#000',
                            borderRadius: 4,
                            barPercentage: 0.7,
                            yAxisID: 'y'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { enabled: true } },
                    scales: {
                        x: commonGridOptions,
                        y: { 
                            display: true, position: 'left', min: 0, max: 320,
                            ticks: { stepSize: 80, color: '#8a8580', callback: function(value) { return '$' + value + 'k'; } },
                            grid: { display: false, drawBorder: false }
                        },
                        y1: {
                            display: true, position: 'right', min: 0, max: 340,
                            ticks: { stepSize: 85, color: '#8a8580', callback: function(value) { return '$' + value; } },
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // 2. Occupancy Trend Chart (Line area)[cite: 3]
            const ctxOcc = document.getElementById('occupancyTrendChart').getContext('2d');
            new Chart(ctxOcc, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            type: 'scatter',
                            label: 'Peak',
                            data: [90, 81, 93, 102, 110, 115, 104],
                            backgroundColor: '#000',
                            pointRadius: 4,
                        },
                        {
                            type: 'line',
                            label: 'Occupancy',
                            data: [70, 68, 72, 85, 92, 95, 88],
                            borderColor: 'transparent',
                            backgroundColor: 'rgba(230, 230, 230, 0.6)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: commonGridOptions,
                        y: { 
                            min: 50, max: 110,
                            ticks: { stepSize: 15, color: '#8a8580', callback: function(value) { return value + '%'; } },
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // 3. Revenue by Room Type (Doughnut)[cite: 3]
            const ctxRoom = document.getElementById('roomTypePie').getContext('2d');
            new Chart(ctxRoom, {
                type: 'doughnut',
                data: {
                    labels: ['Deluxe', 'Family Room', 'Standard', 'Suite'],
                    datasets: [{
                        data: [128.0, 96.0, 84.5, 72.0],
                        backgroundColor: ['#000000', '#333333', '#666666', '#999999'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: { legend: { display: false }, tooltip: { enabled: true } }
                }
            });

            // 4. Booking Sources (Doughnut)[cite: 3]
            const ctxSource = document.getElementById('bookingSourcePie').getContext('2d');
            new Chart(ctxSource, {
                type: 'doughnut',
                data: {
                    labels: ['Direct Website', 'OTA (Booking)', 'Phone', 'Travel Agents', 'Walk-in'],
                    datasets: [{
                        data: [42, 28, 15, 10, 5],
                        backgroundColor: ['#000000', '#2b2b2b', '#555555', '#808080', '#aaaaaa'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: { legend: { display: false }, tooltip: { enabled: true } }
                }
            });

            // Standardized Scroll Fade Animation matching Check-in & Dashboard[cite: 1, 2]
            const observerOptions = {
                root: document.getElementById('scroll-container'),
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Relies on the centralized '.is-visible' CSS class instead of inline styles
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