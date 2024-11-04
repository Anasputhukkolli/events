<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "event"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $target_dir = "uploads/"; // Directory to save uploaded images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image = $_FILES["image"]["name"];

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO performers (name, instrument, image) VALUES (?, ?, ?)");
        
        if ($stmt) { // Check if preparation was successful
            $stmt->bind_param("sss", $name, $instrument, $image);

            // Set parameters and execute
            $name = $_POST['name'];
            $instrument = $_POST['instrument'];

            if ($stmt->execute()) {
                echo "New performer added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
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
    <title>Add Performer</title>
</head>
<body>
    <h1>Add New Performer</h1>
    <form action="insert_performer.php" method="POST" enctype="multipart/form-data">
        <label for="name">Performer Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="instrument">Instrument:</label>
        <input type="text" name="instrument" required><br><br>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" required><br><br>

        <input type="submit" value="Add Performer">
    </form>
</body>
</html>
