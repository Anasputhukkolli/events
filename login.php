<?php
// Database connection
$host = 'localhost';
$db = 'event'; // Change this to your database name
$user = 'root'; // Change this to your database username
$pass = ''; // Change this to your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Handle login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if username and password are correct
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Start session and log the user in
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Store the username in session
            header("Location: index.php"); // Redirect to homepage after login
            exit();
        } else {
            $message = "Invalid username or password!";
        }
    } elseif (isset($_POST['register'])) {
        // Handle registration
        $email = $_POST['email'];
        $new_username = $_POST['new_username'];
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT); // Hash the password

        // Check if username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $new_username]);
        if ($stmt->fetch()) {
            $message = "Username already exists. Please choose a different one.";
        } else {
            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            if ($stmt->execute(['username' => $new_username, 'password' => $new_password, 'email' => $email])) {
                $message = "Registration successful! You can log in now.";
            } else {
                $message = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Event Management System</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-section active" id="login-section">
            <h2>Login</h2>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <form action="" method="post">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn">Login</button>
                <div class="toggle-link">
                    <p>Don't have an account? <a href="#" onclick="toggleForms()">Register here</a></p>
                </div>
            </form>
        </div>
        <div class="form-section" id="register-section" style="transform: translateX(100%);">
            <h2>Register</h2>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
            <form action="" method="post">
                
                <div class="input-group">
                    <input type="text" id="new_username" placeholder="Username" name="new_username" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Enter tha mail" required>
                </div>
                <div class="input-group">
                    <input type="password" id="new_password" placeholder="Password" name="new_password" required>
                </div>
                <button type="submit" name="register" class="btn">Register</button>
                <div class="toggle-link">
                    <p>Already have an account? <a href="#" onclick="toggleForms()">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        function toggleForms() {
            const loginSection = document.getElementById('login-section');
            const registerSection = document.getElementById('register-section');

            if (loginSection.classList.contains('active')) {
                loginSection.classList.remove('active');
                loginSection.style.transform = 'translateX(-100%)'; // Slide out
                registerSection.style.transform = 'translateX(0%)'; // Slide in
                setTimeout(() => {
                    registerSection.classList.add('active'); // Activate the register section
                }, 500);
            } else {
                registerSection.classList.remove('active');
                registerSection.style.transform = 'translateX(100%)'; // Slide out
                loginSection.style.transform = 'translateX(0%)'; // Slide in
                setTimeout(() => {
                    loginSection.classList.add('active'); // Activate the login section
                }, 500);
            }
        }
    </script>
</body>
</html>
