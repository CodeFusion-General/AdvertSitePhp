<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $advert_id = $_POST["advert_id"]; 
    $comment = $_POST["comment"];
    $star = $_POST["star"];
    $title = $_POST["title"]; 

    $stmt = $conn->prepare("INSERT INTO advert_comment (advert_id, title, comment, star) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $advert_id, $title, $comment, $star);
   

    if ($stmt->execute()) {
        echo "Yorum ve puan başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
