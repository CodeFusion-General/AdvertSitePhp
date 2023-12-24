<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Veritabanı bağlantı bilgileri
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    // Veritabanı bağlantısını kur
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Bağlantı kontrolü
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Yorum ve puan verilerini POST'tan al
    $advert_id = $_POST["advert_id"]; // İlan ID'si
    $comment = $_POST["comment"]; // Kullanıcının yaptığı yorum
    $star = $_POST["star"]; // Kullanıcının verdiği puan
    $title = $_POST["title"]; 

    // Verileri advert_comment tablosuna kaydet
    $stmt = $conn->prepare("INSERT INTO advert_comment (advert_id, title, comment, star) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $advert_id, $title, $comment, $star);
   

    // SQL sorgusunu çalıştır ve sonucu kontrol et
    if ($stmt->execute()) {
        echo "Yorum ve puan başarıyla kaydedildi.";
    } else {
        echo "Hata: " . $stmt->error;
    }

    // Bağlantıyı kapat
    $stmt->close();
    $conn->close();
}
?>
