<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>

    <link rel="stylesheet" href="css/room.css">
</head>

<body>

    <div class="container">

        <header class="header">
            <div class="title-area">
                <h1>Room Management</h1>
                <p>6 rooms total</p>
            </div>
            <button class="btn-add-room">
                <i class="fa-solid fa-plus"></i> Add Room
            </button>
        </header>

        <div class="controls">
            <div class="search-container">
                <input type="text" placeholder="Search rooms...">
            </div>
            <div class="filter-group">
                <button class="filter-btn active">All</button>
                <button class="filter-btn">Available</button>
                <button class="filter-btn">Occupied</button>
                <button class="filter-btn">Maintenance</button>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 35%;">Room</th>
                        <th style="width: 15%;">Type</th>
                        <th style="width: 15%;">Price</th>
                        <th style="width: 15%;">Capacity</th>
                        <th style="width: 12%;">Status</th>
                        <th style="width: 8%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-status="available">
                        <td>
                            <div class="room-title">Classic Garden Room</div>
                            <div class="room-sub">1 Queen Bed · 320 sq ft</div>
                        </td>
                        <td><span class="badge-type">Standard</span></td>
                        <td><span class="price-text">$189</span></td>
                        <td style="color: #555;">2 guests</td>
                        <td><span class="status available">Available</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr data-status="occupied">
                        <td>
                            <div class="room-title">Deluxe Ocean Suite</div>
                            <div class="room-sub">1 King Bed · 480 sq ft</div>
                        </td>
                        <td><span class="badge-type">Deluxe</span></td>
                        <td><span class="price-text">$349</span></td>
                        <td style="color: #555;">2 guests</td>
                        <td><span class="status occupied">Occupied</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr data-status="available">
                        <td>
                            <div class="room-title">Family Garden Terrace</div>
                            <div class="room-sub">1 King Bed + 2 Twin Beds · 650 sq ft</div>
                        </td>
                        <td><span class="badge-type">Family Room</span></td>
                        <td><span class="price-text">$429</span></td>
                        <td style="color: #555;">4 guests</td>
                        <td><span class="status available">Available</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr data-status="available">
                        <td>
                            <div class="room-title">Presedential Suite</div>
                            <div class="room-sub">1 California King Bed · 950 sq ft</div>
                        </td>
                        <td><span class="badge-type">Suite</span></td>
                        <td><span class="price-text">$899</span></td>
                        <td style="color: #555;">2 guests</td>
                        <td><span class="status available">Available</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr data-status="available">
                        <td>
                            <div class="room-title">Garden Terrace</div>
                            <div class="room-sub">1 King Bed or 2 Twin Beds · 350 sq ft</div>
                        </td>
                        <td><span class="badge-type">Standard</span></td>
                        <td><span class="price-text">$219</span></td>
                        <td style="color: #555;">2 guests</td>
                        <td><span class="status available">Available</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr data-status="occupied">
                        <td>
                            <div class="room-title">Deluxe Poolside Room</div>
                            <div class="room-sub">1 King Bed + 1 day Bed · 500 sq ft</div>
                        </td>
                        <td><span class="badge-type">Deluxe</span></td>
                        <td><span class="price-text">$379</span></td>
                        <td style="color: #555;">3 guests</td>
                        <td><span class="status occupied">OCCUPIED</span></td>
                        <td>
                            <button class="action-btn" title="Edit"><i class="fa-solid fa-pen"></i></button>
                            <button class="action-btn delete-btn" title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="overlay" id="overlay"></div>

    <div class="modal" id="addModal">
        <div class="modal-box">

            <h2>Add New Room</h2>

            <label>Room Name *</label>
            <input type="text" placeholder="e.g. Deluxe Ocean Suite">

            <div class="row">
                <div>
                    <label>Type</label>
                    <select>
                        <option>Standard</option>
                        <option>Deluxe</option>
                        <option>Suite</option>
                        <option>Family Room</option>
                    </select>
                </div>

                <div>
                    <label>Status</label>
                    <select>
                        <option>Available</option>
                        <option>Occupied</option>
                        <option>Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="row3">
                <div>
                    <label>Price/Night *</label>
                    <input type="number" value="0">
                </div>

                <div>
                    <label>Capacity</label>
                    <input type="number" value="2">
                </div>

                <div>
                    <label>Size</label>
                    <input type="text" placeholder="e.g. 480 sq ft">
                </div>
            </div>

            <label>Bed Type</label>
            <input type="text" placeholder="e.g. 1 King Bed">

            <label>Amenities</label>
            <div class="amenities-container">
                <span class="amenity-badge">Free Wi-Fi</span>
                <span class="amenity-badge">Flat-screen TV</span>
                <span class="amenity-badge">Mini Bar</span>
                <span class="amenity-badge">Room Service</span>
                <span class="amenity-badge">Air Conditioning</span>
                <span class="amenity-badge">Coffee Maker</span>
                <span class="amenity-badge">Safe Box</span>
                <span class="amenity-badge">Premium Toiletries</span>
                <span class="amenity-badge">Ocean View</span>
                <span class="amenity-badge">Sitting Area</span>
                <span class="amenity-badge">Bathtub</span>
                <span class="amenity-badge">Bathrobe & Slippers</span>
                <span class="amenity-badge">Private Terrace</span>
                <span class="amenity-badge">Kids Amenity Kit</span>
                <span class="amenity-badge">Crib Available</span>
                <span class="amenity-badge">Connecting Rooms</span>
                <span class="amenity-badge">Garden Access</span>
                <span class="amenity-badge">Private Patio</span>
                <span class="amenity-badge">Pool Access</span>
                <span class="amenity-badge">Day Bed</span>
                <span class="amenity-badge">Butler Service</span>
                <span class="amenity-badge">Private Study</span>
                <span class="amenity-badge">Dining Area</span>
                <span class="amenity-badge">Walk-in Closet</span>
                <span class="amenity-badge">Jacuzzi</span>
                <span class="amenity-badge">Panoramic View</span>
            </div>

            <div class="modal-buttons">
                <button class="cancel" onclick="closeModal()">Cancel</button>
                <button class="save">Add Room</button>
            </div>

        </div>
    </div>

    <div class="modal" id="editModal">
        <div class="modal-box">

            <h2>Edit Room</h2>

            <label>Room Name *</label>
            <input type="text" value="Classic Garden Room">

            <div class="row">
                <div>
                    <label>Type</label>
                    <select>
                        <option>Standard</option>
                        <option>Deluxe</option>
                        <option>Suite</option>
                    </select>
                </div>

                <div>
                    <label>Status</label>
                    <select>
                        <option>Available</option>
                        <option>Occupied</option>
                        <option>Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="row3">
                <div>
                    <label>Price/Night *</label>
                    <input type="number" value="189">
                </div>

                <div>
                    <label>Capacity</label>
                    <input type="number" value="2">
                </div>

                <div>
                    <label>Size</label>
                    <input type="text" value="320 sq ft">
                </div>
            </div>

            <label>Bed Type</label>
            <input type="text" value="1 Queen Bed">

            <label>Amenities</label>
            <div class="amenities-container">
                <span class="amenity-badge">Free Wi-Fi</span>
                <span class="amenity-badge">Flat-screen TV</span>
                <span class="amenity-badge">Mini Bar</span>
                <span class="amenity-badge">Room Service</span>
                <span class="amenity-badge">Air Conditioning</span>
                <span class="amenity-badge">Coffee Maker</span>
                <span class="amenity-badge">Safe Box</span>
                <span class="amenity-badge">Premium Toiletries</span>
                <span class="amenity-badge">Ocean View</span>
                <span class="amenity-badge">Sitting Area</span>
                <span class="amenity-badge">Bathtub</span>
                <span class="amenity-badge">Bathrobe & Slippers</span>
                <span class="amenity-badge">Private Terrace</span>
                <span class="amenity-badge">Kids Amenity Kit</span>
                <span class="amenity-badge">Crib Available</span>
                <span class="amenity-badge">Connecting Rooms</span>
                <span class="amenity-badge">Garden Access</span>
                <span class="amenity-badge">Private Patio</span>
                <span class="amenity-badge">Pool Access</span>
                <span class="amenity-badge">Day Bed</span>
                <span class="amenity-badge">Butler Service</span>
                <span class="amenity-badge">Private Study</span>
                <span class="amenity-badge">Dining Area</span>
                <span class="amenity-badge">Walk-in Closet</span>
                <span class="amenity-badge">Jacuzzi</span>
                <span class="amenity-badge">Panoramic View</span>
            </div>

            <div class="modal-buttons">
                <button class="cancel" onclick="closeModal()">Cancel</button>
                <button class="save">Save Changes</button>
            </div>

        </div>
    </div>

    <div class="modal small" id="deleteModal">

        <div class="modal-box">

            <div class="delete-icon">
                <i class="fa-solid fa-trash"></i>
            </div>

            <h2>Delete Room?</h2>

            <p style="margin:20px 0;color:#777;">
                This action cannot be undone.<br>
                All associated data will be removed.
            </p>

            <div class="modal-buttons">
                <button class="cancel" onclick="closeModal()">Cancel</button>
                <button class="delete">Delete</button>
            </div>

        </div>

    </div>

    <script src="js/room.js"></script>
</body>

</html>