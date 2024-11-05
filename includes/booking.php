<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
$is_logged_in = isset($_SESSION['username']);

$servername = "localhost";
$username = "root";       // replace with your database username
$password = "";           // replace with your database password
$dbname = "event";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_success = false;
$booked_events = [];

// Handle form submission and insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
    if (!$is_logged_in) {
        // Show login prompt
        $show_login_prompt = true;
    } else {
        // Proceed with booking
        $username = $_SESSION['username'];
        $event = $conn->real_escape_string($_POST['event']);
        $booking_date = date('Y-m-d H:i:s');

        // SQL to insert data
        $sql = "INSERT INTO bookings (username, event, booking_date) VALUES ('$username', '$event', '$booking_date')";

        if ($conn->query($sql) === TRUE) {
            $booking_success = true; // Booking was successful
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
}

// Fetch booked events for the logged-in user
if ($is_logged_in) {
    $username = $_SESSION['username'];
    $sql = "SELECT event, booking_date FROM bookings WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $booked_events[] = $row;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Custom popup styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .popup-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            width: 300px;
        }
        .popup-header {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .popup-close {
            cursor: pointer;
            float: right;
            font-size: 1.2em;
        }
        .booked-events-table {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<section class=" bg-black" id="booking">
<div class="container   ">
    <section id="booking" class="bg-light p-4 rounded shadow-sm">
        <?php if ($is_logged_in): ?>
            <div class="card">
                <div class="card-header bg-black ">
                    <h3 class="card-title text-black">Book Your Event</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Name:</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="event" class="form-label">Select Event:</label>
                            <select id="event" name="event" class="form-select" required>
                                <option value="">--Choose an event--</option>
                                <option value="tech_event">Technical Event</option>
                                <option value="arts_event">Arts Event</option>
                                <option value="sports_event">Sports Event</option>
                            </select>
                        </div>
                        <div class="mt-50">
                            <button type="submit" class="btn boxed-btn3">Book Event</button>
                            <button type="button" class="btn boxed-btn3 " onclick="toggleBookedEvents()">Booked Events</button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Booked Events Table -->
            <div class="booked-events-table">
                <h4>Your Booked Events</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Booking Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($booked_events) > 0): ?>
                            <?php foreach ($booked_events as $booked_event): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($booked_event['event']); ?></td>
                                    <td><?php echo htmlspecialchars($booked_event['booking_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No events booked yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Please log in to book an event.</div>
            <button class=" boxed-btn3 btn " onclick="showLoginPopup()">Login</button>
        <?php endif; ?>
    </section>
</div>
</section>

<!-- Custom Popup for Booking Success -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-content">
        <div class="popup-header">
            <span>Booking Successful</span>
            <span class="popup-close" onclick="hidePopup()">&times;</span>
        </div>
        <div class="popup-body">
            Thank you, <?php echo htmlspecialchars($_SESSION['username']); ?>, for booking an event.
        </div>
    </div>
</div>

<!-- Custom Popup for Login Prompt -->
<div class="popup-overlay" id="loginPopup" style="display: none;">
    <div class="popup-content">
        <div class="popup-header">
            <span>Login Required</span>
            <span class="popup-close" onclick="hideLoginPopup()">&times;</span>
        </div>
        <div class="popup-body">
            <p>Please log in to book an event.</p>
            <button class=" boxed-btn3 btn btn-primary" onclick="redirectToLogin()">Go to Login</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    function showPopup() {
        document.getElementById('popupOverlay').style.display = 'block';
    }

    function hidePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
    }

    function toggleBookedEvents() {
        const bookedEventsTable = document.querySelector('.booked-events-table');
        bookedEventsTable.style.display = bookedEventsTable.style.display === 'none' || bookedEventsTable.style.display === '' ? 'block' : 'none';
    }

    function showLoginPopup() {
        document.getElementById('loginPopup').style.display = 'block';
    }

    function hideLoginPopup() {
        document.getElementById('loginPopup').style.display = 'none';
    }

    function redirectToLogin() {
        // Redirect to the login page
        window.location.href = 'login.php'; // Change to your login page
    }

    // Show the popup if booking is successful
    <?php if ($booking_success): ?>
        showPopup();
    <?php endif; ?>
</script>

</body>
</html>
