<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <!-- Burada head.php içeriğini dahil edebilirsiniz -->
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include_once("navbar.php"); ?>
    
    <?php

    // Giriş durumunu kontrol et
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Kullanıcı giriş yapmışsa, hoş geldiniz mesajını göster
        echo '<p>Hoş geldiniz, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
    } else {
        // Kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
        // header('Location: login.php');
        // exit();
        echo "<p>Giriş yapmadınız.</p>";
    }
    ?>

    <p>Hello, World!</p>
</body>
</html>
