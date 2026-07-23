<?php
$bookingRef   = $_GET['ref']      ?? '';
$bookingDate  = $_GET['bdate']    ?? '';
$checkInTime  = $_GET['checkin']  ?? '';
$checkOutTime = $_GET['checkout'] ?? '';
$hotelName    = $_GET['hotel']    ?? '';


$checkInLabel  = 'Check-in date';
$checkOutLabel = 'Check-out date';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reservation Confirmed - Grand Horizon</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/contact.css">
</head>

<body>
  <header class="topbar">
    <div class="wrap">
      <div class="brand">Grand Horizon</div>
      <nav class="nav" aria-label="Primary">
        <a href="#">Home</a>
        <a href="#">Rooms</a>
        <a href="#">Contact</a>
        <button class="book-btn">Book Now</button>
      </nav>
    </div>
  </header>

  <main class="container" role="main">
    <div class="checkwrap" aria-hidden="true">✓</div>
    <h1>Reservation Confirmed!</h1>
    <p class="lead">Your booking has been successfully processed. A confirmation email will be sent shortly.</p>

    <section class="card" aria-labelledby="booking-details">
      <div class="card-body">
        <div class="row">
          <div class="label">Booking Reference</div>
          <div class="value">
            <span class="ref"><?php echo htmlspecialchars($bookingRef); ?></span>
            <span class="chip">CONFIRMED</span>
          </div>
        </div>

        <div class="row">
          <div class="label">Booking Date</div>
          <div class="value">
            <span><?php echo htmlspecialchars($bookingDate); ?></span>
          </div>
        </div>

        <div class="row">
          <div class="label">Check-in</div>
          <div class="value">
            <span><?php echo htmlspecialchars($checkInTime); ?> <span class="sep">•</span> <span class="muted"><?php echo htmlspecialchars($checkInLabel); ?></span></span>
          </div>
        </div>

        <div class="row">
          <div class="label">Check-out</div>
          <div class="value">
            <span><?php echo htmlspecialchars($checkOutTime); ?> <span class="sep">•</span> <span class="muted"><?php echo htmlspecialchars($checkOutLabel); ?></span></span>
          </div>
        </div>

        <div class="row">
          <div class="label">Hotel</div>
          <div class="value">
            <span><?php echo htmlspecialchars($hotelName); ?></span>
          </div>
        </div>
      </div>

      <div class="notes">
        <h3>Important notes</h3>
        <ul>
          <li>Free cancellation up to 48 hours before check-in.</li>
          <li>Check-in starts at 3:00 PM. Check-out by 12:00 PM.</li>
          <li>Please present a valid ID and credit card at check-in.</li>
        </ul>
        <div class="actions">
          <button class="btn" onclick="window.print()">
            🖨️ Print Confirmation
          </button>
          <a class="btn gold" href="#rooms">
            🛏️ Browse More Rooms
          </a>
        </div>
      </div>
    </section>
  </main>
</body>

</html>