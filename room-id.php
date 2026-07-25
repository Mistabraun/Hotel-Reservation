<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Grand Horizon | Room Details</title>
  <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="css/room-id.css" />
</head>

<body class="d-flex flex-column" style="height: 100vh;">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm py-3 bg-white bg-opacity-95">
    <div class="container">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand font-serif fw-bold h4 mb-0 text-dark text-decoration-none" href="index.php">Grand Horizon</a>

      <div class="ms-auto d-flex align-items-center gap-4">
        <a href="index.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Home</a>
        <a href="index.php#about" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">About</a>
        <a href="rooms.php" class="nav-link font-sans small fw-medium text-dark text-decoration-none opacity-75">Rooms</a>
        <!-- Naka-highlight na kulay gold ang Amenities gaya ng nasa screen -->
        <a href="amenities.php" class="nav-link font-sans small fw-bold text-gold text-decoration-none">Amenities</a>
        <a href="booking.php" class="btn-book-now font-sans text-decoration-none fw-medium text-white text-center">Book Now</a>
      </div>
    </div>
    </div>
  </nav>

  <main id="pageContent" class="pt-5 flex-grow-1"></main>

  <footer class="footer-section py-5 bg-dark text-white">
    <div class="container">
      <div class="row gy-4">
        <div class="col-md-4">
          <h5 class="footer-title">Grand Horizon</h5>
          <p class="footer-text">
            Where elegance meets the shore. Enjoy a luxurious Malibu stay with premium amenities and personalized service.
          </p>
        </div>
        <div class="col-md-2">
          <h6 class="footer-title">Explore</h6>
          <ul class="footer-list">
            <li><a href="room.html#rooms">Rooms</a></li>
            <li><a href="room.html#about">About</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="footer-title">Information</h6>
          <ul class="footer-list">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="footer-title">Policies</h6>
          <ul class="footer-list">
            <li><a href="#">Cancellation</a></li>
            <li><a href="#">Privacy</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/app.js"></script>
  <script>
    const navbar = document.querySelector(".navbar");
    const setNavbarState = () => {
      if (navbar) {
        navbar.classList.toggle("scrolled", window.scrollY > 20);
      }
    };

    window.addEventListener("scroll", setNavbarState, {
      passive: true
    });
    setNavbarState();

    const params = new URLSearchParams(window.location.search);
    const roomId = params.get("roomId");

    const pageContent = document.getElementById("pageContent");

    const highlights = ["Free cancellation up to 48 hours", "Best rate guarantee", "Complimentary Wi-Fi"]

    async function loadRooms() {
      const response = await fetch("api/users/rooms/get.php", {
        headers: {
          Accept: "application/json"
        }
      });

      const result = await response.json();

      if (!response.ok || !result.success) {
        return
      }
      return result.data
    }

    async function loadRoom() {

      const response = await fetch(
        `api/users/rooms/getById.php?id=${roomId}`
      );

      const result = await response.json();

      if (!result.success) {
        renderNotFound();
        return;
      }

      renderRoom(result.data);

    }

    loadRoom();

    function renderNotFound() {

      pageContent.innerHTML = `
        <section class="py-5">
            <div class="container text-center py-5">

                <h1 class="display-6 fw-bold">
                    Room not found
                </h1>

                <p class="text-muted">
                    Please choose one of our available rooms.
                </p>

                <a
                    class="btn btn-room rounded-pill mt-3"
                    href="room.html">

                    Back to rooms

                </a>

            </div>
        </section>
    `;

    }

    async function renderRoom(room) {
      const rooms = await loadRooms();
      pageContent.innerHTML = `
          <section class="room-hero py-5">
                    <div class="container">
                        <nav aria-label="breadcrumb" class="mb-4">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="room.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="room.html#rooms">Rooms</a></li>
                                <li class="breadcrumb-item active" aria-current="page">${room.room_name}</li>
                            </ol>
                        </nav>

                        <div class="row g-4 align-items-start">
                            <div class="col-lg-7">
                                <div class="image-card shadow-sm overflow-hidden rounded-4">
                                    <img src="assets/images/rooms/${room.images[0].cover_image}" alt="${room.room_name}" />
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="detail-card shadow-sm rounded-4 p-4 p-lg-5">
                                    <span class="room-tag">${room.room_type}</span>
                                    <h1 class="detail-title">${room.room_name}</h1>
                                    <p class="detail-intro">${room.description}</p>
                                    <div class="price-row d-flex align-items-center justify-content-between mb-4">
                                        <div>
                                            <p class="detail-price mb-0"> ${formatCurrency(room.price_per_night)}</p>
                                            <span class="detail-price-label">per night</span>
                                        </div>
                                        <span class="detail-badge">${room.status}</span>
                                    </div>

                                    <div class="row g-3 mb-4">
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Guests</span>
                                                <strong>${room.capacity}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Size</span>
                                                <strong>${parseInt(room.size)}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Bed</span>
                                                <strong>${room.bed_type}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="detail-stat">
                                                <span>Rating</span>
                                                <strong>4.9/5</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/booking.php?roomId=${room.id}" class="btn btn-room w-100 rounded-pill mb-3">Book Now</a>
                                    <div class="detail-perks">
                                        ${highlights.map((item) => `<div><i class="fa-solid fa-check me-2"></i>${item}</div>`).join("")}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 mt-3">
                            <div class="col-lg-8">
                                <div class="detail-card rounded-4 p-4 p-lg-5 shadow-sm">
                                    <h2 class="detail-section-title">Amenities</h2>
                                    <div class="d-flex flex-wrap gap-2 mt-3">
                                        ${room.amenities.map((item) => `<span class="detail-chip">${item.name}</span>`).join("")}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="detail-card rounded-4 p-4 shadow-sm">
                                    <h2 class="detail-section-title">Why guests love it</h2>
                                    <ul class="detail-list mt-3">
                                        <li>Private and quiet environment</li>
                                        <li>Thoughtful luxury touches</li>
                                        <li>Perfect balance of comfort and style</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h2 class="section-title text-center mb-4">Explore more rooms</h2>
                            <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                                ${rooms
                                  .filter((item) => item.id !== room.id)
                                  .map(
                                    (item) =>  `
                                    <article class="col">
                                        <div class="card room-card h-100 overflow-hidden">
                                            <img src="assets/images/rooms/${item.thumbnail}" class="card-img-top" alt="${item.room_name}">
                                            <div class="card-body">
                                                <span class="room-tag">${item.room_type}</span>
                                                <h3 class="room-title">${item.room_name}</h3>
                                                <p class="room-price">${formatCurrency(item.price_per_night)} <span>/ night</span></p>
                                                <a href="room-id.php?roomId=${item.id}" class="btn btn-room rounded-pill">View details</a>
                                            </div>
                                        </div>
                                    </article>
                                `,
                                  )
                                  .join("")}
                            </div>
                        </div>
                    </div>
                </section>
                `

    }
  </script>
</body>

</html>