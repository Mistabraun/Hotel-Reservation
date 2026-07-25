<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Grand Horizon | Transaction History</title>

    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/transaction.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-3">
        <div class="container-fluid px-4 px-md-5">
            <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

            <div class="ms-auto d-flex align-items-center gap-4">
                <a href="index.php" class="nav-link font-sans small fw-medium text-black text-decoration-none opacity-75">Home</a>
                <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
                <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
                <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
                <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
                <a href="booking.php" class="btn-book-now font-sans text-decoration-none fw-medium text-white text-center">Book Now</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <div class="text-center mt-5 mb-5">

            <h1>Transaction History</h1>

            <p>
                View your previous hotel stays and your current reservation.
            </p>

        </div>

        <div class="row g-4">

            <!-- Stay History -->
            <div class="col-lg-8">

                <h3 class="section-title mb-4">
                    Stay History
                </h3>

                <div id="historyContainer">

                    <!-- <div class="card history-card">
                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-9">

                                    <h5>Family Suite</h5>

                                    <p>Booking ID: <strong>#BK10190</strong></p>

                                    <p>June 10 - June 13, 2026</p>

                                    <strong>₱8,400</strong>

                                </div>

                                <div class="col-md-3 text-md-end mt-3 mt-md-0">

                                    <span class="badge completed">
                                        Completed
                                    </span>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="card history-card">
                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-9">

                                    <h5>Standard Twin Room</h5>

                                    <p>Booking ID: <strong>#BK10121</strong></p>

                                    <p>April 5 - April 7, 2026</p>

                                    <strong>₱3,200</strong>

                                </div>

                                <div class="col-md-3 text-md-end mt-3 mt-md-0">

                                    <span class="badge completed">
                                        Completed
                                    </span>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="card history-card">
                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-9">

                                    <h5>Deluxe Queen Room</h5>

                                    <p>Booking ID: <strong>#BK10072</strong></p>

                                    <p>February 15 - February 16, 2026</p>

                                    <strong>₱2,800</strong>

                                </div>

                                <div class="col-md-3 text-md-end mt-3 mt-md-0">

                                    <span class="badge cancelled">
                                        Cancelled
                                    </span>

                                </div>

                            </div>

                        </div>
                    </div> -->

                </div>
            </div>

            <!-- Current Booking -->
            <div class="col-lg-4">

                <div class="sticky-booking">

                    <h3 class="section-title mb-4">
                        Current Booking
                    </h3>

                    <div id="currentBookingContainer">
                        <!-- <div class="card booking-card">

                            <div class="card-body">

                                <p><strong>Booking ID</strong><br>#BK10258</p>

                                <hr>

                                <p><strong>Room</strong><br>Deluxe King Room</p>

                                <p><strong>Guests</strong><br>2 Adults</p>

                                <p><strong>Check-in</strong><br>July 22, 2026</p>

                                <p><strong>Check-out</strong><br>July 24, 2026</p>

                                <p><strong>Total Paid</strong><br>₱5,600</p>

                                <span class="badge upcoming mb-4">
                                    Upcoming
                                </span>

                                <button class="btn btn-book w-100 mt-3">
                                    Cancel Reservation
                                </button>

                            </div>

                        </div> -->
                    </div>


                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/scripts/app.js"></script>
    <script>
        async function loadTransactions() {

            const response = await fetch("api/users/transactions/get.php", {
                headers: {
                    Accept: "application/json"
                }
            });

            const result = await response.json();

            if (!response.ok || !result.success) {
                return;
            }

            renderCurrentBooking(result.data.current_booking);
            renderHistory(result.data.history);
        }

        function renderCurrentBooking(booking) {


            const container =
                document.getElementById("currentBookingContainer");

            console.log(booking)

            if (!booking || booking.length == 0) {

                container.innerHTML = `
            <div class="card booking-card">
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-0">
                        No active booking.
                    </p>
                </div>
            </div>
        `;

                return;
            }
            container.innerHTML = ""
            container.innerHTML = `
        <div class="card booking-card">

            <div class="card-body">

                <p>
                    <strong>Booking ID</strong><br>
                    ${booking.booking_reference}
                </p>

                <hr>

                <p>
                    <strong>Room</strong><br>
                    ${booking.room_name}
                </p>

                <p>
                    <strong>Guests</strong><br>
                    ${booking.number_of_guests} Guest(s)
                </p>

                <p>
                    <strong>Check-in</strong><br>
                    ${formatDate(booking.check_in)}
                </p>

                <p>
                    <strong>Check-out</strong><br>
                    ${formatDate(booking.check_out)}
                </p>

                <p>
                    <strong>Total Paid</strong><br>
                    ${formatCurrency(booking.total_amount)}
                </p>

                <span class="badge upcoming mb-4">
                    ${booking.reservation_status}
                </span>

                <button
                    class="btn btn-book w-100 mt-3"
                    data-secret-key="${booking.secret_key}">
                    Cancel Reservation
                </button>

            </div>

        </div>
    `;
        }


        function renderHistory(history) {

            const container =
                document.getElementById("historyContainer");

            if (!history.length) {

                container.innerHTML = `
            <div class="card history-card">
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-0">
                        No booking history.
                    </p>
                </div>
            </div>
        `;

                return;
            }
            console.log(container)
            container.innerHTML = ""
            container.innerHTML = history.map(item => {

                let badgeClass = "checkout";

                if (item.reservation_status === "Cancelled") {
                    badgeClass = "cancelled";
                }

                if (
                    item.reservation_status === "Pending"
                ) {
                    badgeClass = "upcoming";
                }

                if (item.reservation_status === "Confirmed") {
                    badgeClass = "completed"
                }

                return `
            <div class="card history-card">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-9">

                            <h5>${item.room_name}</h5>

                            <p>
                                Booking ID:
                                <strong>
                                    ${item.booking_reference}
                                </strong>
                            </p>

                            <p>
                                ${formatDate(item.check_in)}
                                -
                                ${formatDate(item.check_out)}
                            </p>

                            <strong>
                                ${formatCurrency(item.total_amount)}
                            </strong>

                        </div>

                        <div class="col-md-3 text-md-end mt-3 mt-md-0">

                            <span class="badge ${badgeClass}">
                                ${item.reservation_status}
                            </span>

                        </div>

                    </div>

                </div>

            </div>
        `;

            }).join("");
        }


        loadTransactions()
    </script>
</body>

</html>