<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    // Assuming you have a MySQL database, modify the following variables accordingly
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form data
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST['price'];
    $photos = isset($_FILES["photo"]) ? $_FILES["photo"] : array();
    $names = isset($_POST["names"]) ? $_POST["names"] : array();
    $values = isset($_POST["values"]) ? $_POST["values"] : array();
    $featuresArray = array();

    for ($i = 0; $i < count($names); $i++) {
        $featuresArray[$names[$i]] = $values[$i];
    }

    // SQL sorgusunu oluşturun
    $sql1 = "INSERT INTO advert (user_id, title, description, price) VALUES ('{$_SESSION['user_id']}', '$title', '$description', '$price')";

    if ($conn->query($sql1) === TRUE) {
        echo "Data inserted successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT id FROM advert WHERE title='$title' and description='$description'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $advert_id = $row["id"];
        }
    } else {
        echo "Data not found.";
    }
    foreach ($featuresArray as $key => $value) {
        $sql2 = "INSERT INTO advert_field (advert_id, name, value) VALUES ('$advert_id','$key', '$value')";
        if ($conn->query($sql2) === TRUE) {
            echo "Data inserted successfully <br>";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }

    if (!empty($photos)) {
        foreach ($photos['tmp_name'] as $index => $photo) {
            if (!empty($photo) && is_uploaded_file($photo)) {
                // Read the contents of the file
                $pht = file_get_contents($photo);

                // Insert data into the database
                $sql3 = $conn->prepare("INSERT INTO advert_photo (advert_id, photo) VALUES ('$advert_id', ?)");
                $sql3->bind_param("s", $pht);

                if ($sql3->execute()) {
                    echo "Data for photo $index inserted successfully <br>";
                } else {
                    echo "Error inserting data for photo $index: " . $sql3->error . "<br>";
                }

                // Close the statement
                $sql3->close();
            } else {
                echo "Error for photo $index: File not uploaded or path is empty <br>";
            }
        }
    } else {
        echo "Error: Files array is empty <br>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Form submission error!";
}
