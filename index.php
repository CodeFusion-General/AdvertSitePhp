<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "Home";
include 'head.php';
?>

<body>
    <?php include_once("navbar.php"); ?>
    <?php
    // Oturumu başlat
    session_start();

    // Giriş durumunu kontrol et
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Kullanıcı giriş yapmışsa, hoş geldiniz mesajını göster
        echo 'Hoş geldiniz, ' . $_SESSION['username'] . '!';
    } else {
        // Kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
        // header('Location: login.php');
        // exit();
        echo "Giriş yapmadınız.";
    }
    ?>
    <?php
    echo "Hello, World!";
    ?>
</body>

</html>