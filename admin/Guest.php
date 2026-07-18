<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Guests Management - Grand Horizon</title>
</head>

<body class="vh-100 d-flex position-relative">
    
    <!-- COMPLETE SIDEBAR NAVIGATION -->
    <aside id="sidebar" data-bs-scroll="true" tabindex="1" class="offcanvas-lg offcanvas-start bg-secondary text-white d-flex flex-column" style="width: 16rem">
        <header class="px-3 pt-4 pb-2">
            <h1 class="h5">Grand Horizon</h1>
            <p class="f-spacing-wide fw-semibold text-uppercase ultra-small text-gray">Admin Panel</p>
        </header>
        <div class="line"></div>
        <nav class="px-2.5 pt-4 pb-2 d-flex flex-column gap-4 overflow-y-auto">
            <div class="sidebar-category">
                <h2>Overview</h2>
                <ul class="sidebar-list">
                    <li>
                        <a href="DashBoard.php" class="sidebar-link link link-gray">
                            <i class="fa-solid fa-cube"></i> Dashboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Management</h2>
                <ul class="sidebar-list">
                    <li><a href="rooms.php" class="sidebar-link link link-gray"><i class="fa-solid fa-bed"></i> Rooms</a></li>
                    <li><a href="rooms-types.php" class="sidebar-link link link-gray"><i class="fa-regular fa-building"></i> Room Types</a></li>
                    <li><a href="reservation.php" class="sidebar-link link link-gray"><i class="fa-regular fa-calendar-check"></i> Reservation</a></li>
                    <li>
                        <!-- Active Item -->
                        <a href="guests.php" class="sidebar-link link link-gray active">
                            <i class="fa-regular fa-user"></i> Guests
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Operations</h2>
                <ul class="sidebar-list">
                    <li><a href="payments.php" class="sidebar-link link link-gray"><i class="fa-solid fa-arrow-right-to-bracket"></i> Check-in / Out</a></li>
                    <li><a href="payments.php" class="sidebar-link link link-gray"><i class="fa-regular fa-credit-card"></i> Payments</a></li>
                </ul>
            </div>
            <div class="sidebar-category">
                <h2>Insights</h2>
                <ul class="sidebar-list">
                    <li><a href="reports.php" class="sidebar-link link link-gray"><i class="fa-solid fa-chart-simple"></i> Reports</a></li>
                    <li><a href="settings.php" class="sidebar-link link link-gray"><i class="fa-solid fa-gear"></i> Settings</a></li>
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

    <!-- MAIN BODY SECTION -->
    <div class="flex-grow-1 d-flex flex-column">
        
        <!-- COMPLETE HEADER WITH PROFILE MENU -->
        <header class="border-bottom d-flex p-2 mx-2 me-4 ms-0 align-items-center bg-white" style="height: 3.5rem;">
            <button class="btn btn-outline d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="ms-3 d-flex flex-column justify-content-center">
                <h4 class="m-0 fw-bold fs-5">Guests Management</h4>
                <p class="m-0 small text-muted-custom" style="font-size: 0.75rem;">Manage, verify, and monitor hotel guest records</p>
            </div>
            
            <!-- Profile and Notifications Dropdown -->
            <div class="dropdown ms-auto d-flex align-items-center gap-3">
                <i class="fa-regular fa-bell fs-5 text-secondary bell-ring"></i>
                <button class="btn border-0 text-start p-0 text-secondary" type="button" id="profile-dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user-circle fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2 me-3 profile-menu pt-2 pb-1" aria-labelledby="profile-dropdown-btn">
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
                            <button class="link link-danger fs-7 btn-default" href="logout.php">
                                <i class="fa-solid fa-sign-out"></i>
                                <p>Logout</p>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>
        </header>

        <!-- MAIN SUB-CONTENT -->
        <main class="bg-main flex-grow-1 p-4 overflow-y-auto">
            <!-- Action Bar (Search, Filter, Add button) -->
            <div class="d-flex flex-column flex-md-row gap-3 justify-content-between align-items-md-center mb-4">
                <div class="d-flex flex-grow-1 max-width-md gap-2" style="max-width: 500px;">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search by name, email, or room...">
                    </div>
                    <select id="statusFilter" class="form-select style-select" style="width: 160px;">
                        <option value="All">All Statuses</option>
                        <option value="Checked In">Checked In</option>
                        <option value="Checked Out">Checked Out</option>
                        <option value="Reserved">Reserved</option>
                    </select>
                </div>
                <button class="btn btn-primary d-flex align-items-center gap-2 px-4" data-bs-toggle="modal" data-bs-target="#addGuestModal">
                    <i class="fa-solid fa-plus"></i> Add New Guest
                </button>
            </div>

            <!-- Guest Data Table Card -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary-2 uppercase fs-7 fw-semibold">
                            <tr>
                                <th class="ps-4">Guest Info</th>
                                <th>Contact Details</th>
                                <th>Room Assignment</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="guestTableBody">
                            <!-- Populated dynamically via JS code below -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL 1: ADD GUEST -->
    <div class="modal fade" id="addGuestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Add New Guest Profile</h5>
                    <button type="button" class="btn-close" data-bs-shadow="none" data-bs-dismiss="modal"></button>
                </div>
                <form id="addGuestForm">
                    <div class="modal-body px-4 pb-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Full Name</label>
                            <input type="text" id="addName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Email Address</label>
                            <input type="email" id="addEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Phone Number</label>
                            <input type="text" id="addPhone" class="form-control" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-semibold text-secondary">Room Number</label>
                                <input type="text" id="addRoom" class="form-control" placeholder="e.g. 302" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold text-secondary">Status Assignment</label>
                                <select id="addStatus" class="form-select">
                                    <option value="Checked In">Checked In</option>
                                    <option value="Reserved">Reserved</option>
                                    <option value="Checked Out">Checked Out</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light px-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Create Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: EDIT GUEST -->
    <div class="modal fade" id="editGuestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Modify Guest Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editGuestForm">
                    <input type="hidden" id="editIndex">
                    <div class="modal-body px-4 pb-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Full Name</label>
                            <input type="text" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Email Address</label>
                            <input type="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-secondary">Phone Number</label>
                            <input type="text" id="editPhone" class="form-control" required>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label small fw-semibold text-secondary">Room Number</label>
                                <input type="text" id="editRoom" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold text-secondary">Status Status</label>
                                <select id="editStatus" class="form-select">
                                    <option value="Checked In">Checked In</option>
                                    <option value="Reserved">Reserved</option>
                                    <option value="Checked Out">Checked Out</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn btn-light px-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary px-4">Save Updates</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 3: VIEW DETAILS (Updated with Photo) -->
    <div class="modal fade" id="viewGuestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Guest Summary Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="text-center mb-4">
                        <!-- Replaced icon with default photo image tag -->
                        <img id="viewCardPhoto" src="" alt="Guest Photo" class="rounded-circle object-fit-cover mb-3 border shadow-sm" style="width: 80px; height: 80px;">
                        <h4 id="viewCardName" class="fw-bold mb-1"></h4>
                        <span id="viewCardStatus" class="badge"></span>
                    </div>
                    <div class="bg-light p-3 rounded-3 fs-7">
                        <div class="row mb-2"><div class="col-4 text-muted">Email:</div><div id="viewCardEmail" class="col-8 fw-semibold text-dark"></div></div>
                        <div class="row mb-2"><div class="col-4 text-muted">Phone No:</div><div id="viewCardPhone" class="col-8 fw-semibold text-dark"></div></div>
                        <div class="row"><div class="col-4 text-muted">Room Space:</div><div id="viewCardRoom" class="col-8 fw-semibold text-dark"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT FRAMEWORKS & LOGIC -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Default Mock Database State (Photo property is optional, generator is used if blank)
        let guestData = [
            { name: "John Doe", email: "john@example.com", phone: "+1 234-567-8901", room: "Room 101", status: "Checked In", photo: "" },
            { name: "Sarah Jenkins", email: "sarah.j@example.com", phone: "+1 987-654-3210", room: "Room 205", status: "Reserved", photo: "" },
            { name: "Michael Chang", email: "m.chang@example.com", phone: "+1 456-789-0123", room: "Room 312", status: "Checked Out", photo: "" }
        ];

        // Element Access Points
        const guestTableBody = document.getElementById('guestTableBody');
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');

        // Dynamic Table Render Function
        function renderTable() {
            const searchQuery = searchInput.value.toLowerCase();
            const filterValue = statusFilter.value;
            guestTableBody.innerHTML = '';

            guestData.forEach((guest, index) => {
                // Search and Filter validations
                const matchesSearch = guest.name.toLowerCase().includes(searchQuery) || 
                                      guest.email.toLowerCase().includes(searchQuery) || 
                                      guest.room.toLowerCase().includes(searchQuery);
                const matchesFilter = filterValue === 'All' || guest.status === filterValue;

                if (matchesSearch && matchesFilter) {
                    // Match visual status class assignments
                    let badgeClass = 'bg-success-subtle text-success';
                    if (guest.status === 'Reserved') badgeClass = 'bg-warning-subtle text-warning';
                    if (guest.status === 'Checked Out') badgeClass = 'bg-secondary-subtle text-secondary';

                    // Generate a default photo if guest.photo is empty using their initials
                    const photoUrl = guest.photo || `https://ui-avatars.com/api/?name=${encodeURIComponent(guest.name)}&background=random&color=fff&size=100`;

                    const row = `
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="${photoUrl}" alt="${guest.name}" class="rounded-circle object-fit-cover shadow-sm" style="width: 40px; height: 40px;">
                                    <div class="fw-bold text-dark">${guest.name}</div>
                                </div>
                            </td>
                            <td>
                                <div class="small">${guest.email}</div>
                                <div class="extra-small text-muted">${guest.phone}</div>
                            </td>
                            <td><span class="fw-semibold text-dark">${guest.room}</span></td>
                            <td><span class="badge ${badgeClass} rounded-2">${guest.status}</span></td>
                            <td class="text-end pe-4">
                                <div class="btn-group gap-1">
                                    <button class="btn btn-sm btn-light border" onclick="viewGuest(${index})" title="View Profile"><i class="fa-regular fa-eye"></i></button>
                                    <button class="btn btn-sm btn-light border text-primary" onclick="openEditModal(${index})" title="Modify File"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn btn-sm btn-light border text-danger" onclick="deleteGuest(${index})" title="Remove"><i class="fa-regular fa-trash-can"></i></button>
                                </div>
                            </td>
                        </tr>
                    `;
                    guestTableBody.insertAdjacentHTML('beforeend', row);
                }
            });
        }

        // Action: Create Record
        document.getElementById('addGuestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            guestData.push({
                name: document.getElementById('addName').value,
                email: document.getElementById('addEmail').value,
                phone: document.getElementById('addPhone').value,
                room: 'Room ' + document.getElementById('addRoom').value.replace('Room ', ''),
                status: document.getElementById('addStatus').value,
                photo: "" // Leave blank so the generator creates a default avatar based on their new name
            });
            this.reset();
            bootstrap.Modal.getInstance(document.getElementById('addGuestModal')).hide();
            renderTable();
        });

        // Action: View Card Trigger
        function viewGuest(index) {
            const guest = guestData[index];
            
            // Set the dynamic default photo
            const photoUrl = guest.photo || `https://ui-avatars.com/api/?name=${encodeURIComponent(guest.name)}&background=random&color=fff&size=200`;
            document.getElementById('viewCardPhoto').src = photoUrl;
            
            document.getElementById('viewCardName').innerText = guest.name;
            document.getElementById('viewCardEmail').innerText = guest.email;
            document.getElementById('viewCardPhone').innerText = guest.phone;
            document.getElementById('viewCardRoom').innerText = guest.room;
            
            const badge = document.getElementById('viewCardStatus');
            badge.innerText = guest.status;
            badge.className = 'badge ' + (guest.status === 'Checked In' ? 'bg-success' : guest.status === 'Reserved' ? 'bg-warning text-dark' : 'bg-secondary');
            
            new bootstrap.Modal(document.getElementById('viewGuestModal')).show();
        }

        // Action: Prepare Edit form inputs
        function openEditModal(index) {
            const guest = guestData[index];
            document.getElementById('editIndex').value = index;
            document.getElementById('editName').value = guest.name;
            document.getElementById('editEmail').value = guest.email;
            document.getElementById('editPhone').value = guest.phone;
            document.getElementById('editRoom').value = guest.room.replace('Room ', '');
            document.getElementById('editStatus').value = guest.status;
            new bootstrap.Modal(document.getElementById('editGuestModal')).show();
        }

        // Action: Submit Modifications
        document.getElementById('editGuestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const index = document.getElementById('editIndex').value;
            // Preserve their existing photo if they had one, otherwise keep blank
            const existingPhoto = guestData[index].photo;
            
            guestData[index] = {
                name: document.getElementById('editName').value,
                email: document.getElementById('editEmail').value,
                phone: document.getElementById('editPhone').value,
                room: 'Room ' + document.getElementById('editRoom').value.replace('Room ', ''),
                status: document.getElementById('editStatus').value,
                photo: existingPhoto
            };
            bootstrap.Modal.getInstance(document.getElementById('editGuestModal')).hide();
            renderTable();
        });

        // Action: Remove Target Index Record
        function deleteGuest(index) {
            if (confirm(`Are you absolutely sure you want to completely remove ${guestData[index].name} from the registry?`)) {
                guestData.splice(index, 1);
                renderTable();
            }
        }

        // Event Triggers for Sorting/Searching Input Changes
        searchInput.addEventListener('input', renderTable);
        statusFilter.addEventListener('change', renderTable);

        // Initial Data Boot Execution
        document.addEventListener("DOMContentLoaded", renderTable);
    </script>
</body>
</html>