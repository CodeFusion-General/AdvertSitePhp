<?php
// Establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertphp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    // Insert data into the 'users' table
    $sql = "INSERT INTO user (email, name, surname, phone, address, birthdate)
            VALUES ('$email', '$name', '$surname', '$phone', '$address', '$birthdate')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql1 = "SELECT id FROM user WHERE (email = '$email' AND name = '$name' AND surname = '$surname' AND phone = '$phone' AND address = '$address' AND birthdate = '$birthdate')";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["id"];
        }
    } else {
        echo "Data not found.";
    }

    $sql2 = "INSERT INTO account (user_id, username, password) VALUES ('$user_id', '$username', '$hashedPassword')";

    if ($conn->query($sql2) === TRUE) {
        echo "Data inserted successfully <br>";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>