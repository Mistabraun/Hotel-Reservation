<?php
$message_sent = false;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($name && $email && $subject && $message) {

        $to = "info@grandhorizonhotel.com";
        $body = "From: $name \n Email: $email \n\n Message:\n $message";
        $headers = "From: $email" . "\r\n" . "Reply-To: $email";


        $message_sent = true;
    } else {
        $error_message = "Please fill out all fields correctly.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Grand Horizon Hotel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>

    <header class="navbar">
        <div class="logo">GRAND HORIZON</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Rooms & Suites</a></li>
                <li><a href="#">Dining</a></li>
                <li><a href="#">Spa</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </nav>
        <a href="#" class="btn-book">Book Your Stay</a>
    </header>

    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Connect With Us</h1>
            <p>Grand Horizon Hotel | Luxury Oceanfront Resort in Malibu, CA</p>
        </div>
    </section>

    <main class="contact-container">
        <div class="contact-grid">

            <div class="contact-info">
                <h2>Get In Touch</h2>
                <p class="lead-text">Experience the pinnacle of coastal luxury. Whether planning a stay, hosting an exclusive event, or seeking personalized concierge service, our team is at your disposal.</p>

                <div class="info-details">
                    <div class="info-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <h3>Our Location</h3>
                            <p>23400 Pacific Coast Highway,<br>Malibu, CA 90265</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <h3>Reservations & Inquiries</h3>
                            <p>+1 (310) 555-0199</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>concierge@grandhorizonhotel.com</p>
                        </div>
                    </div>
                </div>

                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <?php if ($message_sent): ?>
                    <div class="status-message success">
                        <h3>Thank You</h3>
                        <p>Your message has been received. A Grand Horizon concierge representative will contact you shortly.</p>
                    </div>
                <?php else: ?>
                    <h2>Send A Message</h2>
                    <?php if (!empty($error_message)): ?>
                        <div class="status-message error"><?= $error_message; ?></div>
                    <?php endif; ?>

                    <form action="contact.php" method="POST" class="contact-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required placeholder="Maria Clara">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="Mariaclara22@example.com">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required placeholder="Reservation Inquiry, Event, Feedback...">
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="6" required placeholder="How may we assist you with your Grand Horizon experience?"></textarea>
                        </div>

                        <button type="submit" class="btn-submit">Submit Inquiry</button>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </main>
    <footer>
        <p>&copy; <?= date('Y'); ?> Grand Horizon Hotel. Luxury Oceanfront Resort. All Rights Reserved.</p>
    </footer>

</body>

</html>
?>