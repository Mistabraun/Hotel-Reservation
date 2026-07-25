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

<body class="vh-100 d-flex position-relative">
    <aside
        id="sidebar"        
        data-bs-scroll="true"
        tabindex="1"
        class="offcanvas-lg offcanvas-start bg-secondary text-white d-flex flex-column"
        style="width: 16rem">
        
        <!-- Added Grand Horizon Branding -->
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
                        <a href="payments.php" class="sidebar-link link link-gray active">
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
                        <a href="Report.php" class="sidebar-link link link-gray">
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
            <div class="d-flex flex-column justify-content-center">
                <h4 class="m-0 fw-bold fs-5">Check-in / Out</h4>
                <p class="m-0 small text-muted-custom" id="total-reservations-label" style="font-size: 0.75rem;">Loading reservations...</p>
            </div>
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
                        <li><a class="link link-subtle fs-7" href="settings.php"><i class="fa-regular fa-user"></i><p>Profile</p></a></li>
                        <li><a class="link link-subtle fs-7" href="settings.php"><i class="fa-solid fa-gear"></i><p>Settings</p></a></li>
                    </ul>
                    <div class="line"></div>
                    <ul class="profile-items mt-1">
                        <li><button class="link link-danger fs-7 btn-default" href="settings.php"><i class="fa-solid fa-sign-out"></i><p>Logout</p></button></li>
                    </ul>
                </ul>
            </div>
        </header>

        <!-- Responsive Main: Adjusted padding for mobile (p-2 p-md-4) -->
  <main class="bg-main flex-grow-1 p-4 p-md-5 overflow-y-auto" id="scroll-container">
    
    <!-- Page Header Section -->
    <div class="mb-4 fade-on-scroll">
        <h2 class="fw-bold mb-1" style="font-family: Georgia, serif; letter-spacing: -0.5px;">Check-in / Check-out</h2>
        <p class="text-muted small fw-semibold">2 rooms occupied · Check-in 3:00 PM · Check-out 12:00 PM</p>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 g-xl-4 mb-5 fade-on-scroll">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">0</h4>
                        <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Arriving Today</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-10 text-danger" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">1</h4>
                        <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Departing Today</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="fa-solid fa-bed"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">2</h4>
                        <span class="text-muted small fw-semibold" style="font-size: 0.75rem;">Currently Occupied</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-2">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0">4</h4>
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
        <div class="tab-pane fade show active" id="pills-checkins" role="tabpanel" aria-labelledby="pills-checkins-tab">
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
        <div class="tab-pane fade" id="pills-checkouts" role="tabpanel" aria-labelledby="pills-checkouts-tab">
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
    
    <script>
        // --- 1. INITIALIZATION & ANIMATION CONFIG ---
        document.addEventListener('DOMContentLoaded', () => {
            initScrollAnimations();
            initTabButtons();
            initDashboard();
        });

        function initScrollAnimations() {
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
        }

        // --- 2. BACKEND & TABLE LOGIC ---
        const API_BASE_URL = 'https://your-backend-api.com/api/v1/reservations'; 

        function initTabButtons() {
            const tabButtons = document.querySelectorAll('#pills-tab .nav-link');

            const setActiveTabButton = (activeButton) => {
                tabButtons.forEach((btn) => {
                    const isActive = btn === activeButton;
                    btn.classList.toggle('active', isActive);
                    btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    btn.style.backgroundColor = isActive ? '#111' : 'transparent';
                    btn.style.color = isActive ? '#fff' : '#111';
                });
            };

            tabButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    setActiveTabButton(button);
                });
            });

            const initialActiveButton = document.querySelector('#pills-tab .nav-link.active');
            if (initialActiveButton) {
                setActiveTabButton(initialActiveButton);
            }
        }

        function initDashboard() {
            const tableBody = document.getElementById('reservation-table-body');
            if (!tableBody) return;

            tableBody.addEventListener('click', (e) => {
                const row = e.target.closest('tr');
                if (!row) return;
                
                const bookingRef = row.dataset.id;
                if (e.target.closest('.btn-edit')) {
                    handleEditReservation(bookingRef);
                } else if (e.target.closest('.btn-cancel')) {
                    handleCancelReservation(bookingRef);
                }
            });

            refreshTableData();
        }

        async function refreshTableData() {
            const tableBody = document.getElementById('reservation-table-body');
            if (!tableBody) return;

            tableBody.innerHTML = '<tr><td colspan="9" class="text-center py-5"><i class="fa fa-spinner fa-spin me-2 fs-4 text-primary"></i><br>Loading records...</td></tr>';

            try {
                // Mock Data 
                const mockData = [
                    { id: "GH-2026-0738", guestName: "David & Sarah Mitchell", email: "mitchells@email.com", roomName: "Deluxe Ocean Suite", roomType: "Deluxe", checkIn: "Jun 28, 2026", checkOut: "Jun 30, 2026", guestCount: 2, total: 694.20, status: "CONFIRMED" },
                    { id: "GH-2026-0739", guestName: "Emma Richardson", email: "emma.rich@email.com", roomName: "Standard Room", roomType: "Standard", checkIn: "Jul 11, 2026", checkOut: "Jul 15, 2026", guestCount: 1, total: 350.00, status: "PENDING" },
                    { id: "GH-2026-0740", guestName: "Maria Santos", email: "msantos@email.com", roomName: "Garden Terrace", roomType: "Suite", checkIn: "Jul 05, 2026", checkOut: "Jul 10, 2026", guestCount: 3, total: 920.00, status: "CONFIRMED" }
                ];

                setTimeout(() => {
                    renderTable(mockData);
                    updateDashboardStats(mockData);
                }, 600);
            } catch (error) {
                tableBody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-danger">Failed to load data. Please try again.</td></tr>';
            }
        }

        function renderTable(data) {
            const tableBody = document.getElementById('reservation-table-body');
            tableBody.innerHTML = ''; 

            if (data.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="9" class="text-center py-4 text-muted">No reservations found.</td></tr>';
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');
                // Ensure rows slightly fade in dynamically based on index if needed
                tr.style.animation = `fadeIn 0.4s ease-in-out ${index * 0.1}s both`;
                tr.dataset.id = item.id; 
                
                let badgeClass = item.status === 'CONFIRMED' ? 'status-badge-confirmed' : 'status-badge-pending';

                tr.innerHTML = `
                    <td class="fw-bold">${item.id}</td>
                    <td>${item.guestName}<br><small class="text-muted">${item.email}</small></td>
                    <td>${item.roomName}<br><small class="text-muted">${item.roomType}</small></td>
                    <td>${item.checkIn}</td>
                    <td>${item.checkOut}</td>
                    <td>${item.guestCount}</td>
                    <td>$${item.total.toFixed(2)}</td>
                    <td><span class="status-badge ${badgeClass}">${item.status}</span></td>
                    <td>
                        <i class="fa fa-edit text-muted me-3 cursor-pointer btn-edit" title="Edit Booking"></i>
                        <i class="fa fa-times text-danger cursor-pointer btn-cancel" title="Cancel Booking"></i>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function updateDashboardStats(data) {
            const totalLabel = document.getElementById('total-reservations-label');
            if (totalLabel) {
                totalLabel.textContent = `${data.length} total reservations active`;
            }
            
            const confirmed = data.filter(r => r.status === 'CONFIRMED').length;
            const pending = data.filter(r => r.status === 'PENDING').length;
            
            const confirmedEl = document.getElementById('stat-confirmed');
            if (confirmedEl) confirmedEl.textContent = confirmed;

            const pendingEl = document.getElementById('stat-pending');
            if (pendingEl) pendingEl.textContent = pending;

            const checkoutEl = document.getElementById('stat-checkout');
            if (checkoutEl) checkoutEl.textContent = '12';

            const cancelledEl = document.getElementById('stat-cancelled');
            if (cancelledEl) cancelledEl.textContent = '2';
        }

        async function handleEditReservation(bookingId) {
            alert(`Edit interface triggered for ${bookingId}. \n\nBackend: Load edit modal details.`);
        }

        async function handleCancelReservation(bookingId) {
            if(confirm(`Are you sure you want to cancel booking ${bookingId}?`)) {
                alert(`Cancellation sent for ${bookingId}.`);
                refreshTableData();
            }
        }

        function fetchNotifications() {
            console.log("Fetching latest notifications...");
        }
    </script>
</body>
</html>