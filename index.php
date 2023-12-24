<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <?php include 'head.php'; ?>
</head>
<style>
.carousel-item img {
  max-height: 500px; /* Maksimum yükseklik değerini sayfanın yapısına göre ayarlayın */
  width: auto; /* Genişliği otomatik ayarla, aspect ratio korunur */
  margin: auto; /* Yatayda merkezleme yapar */
}

#featuredCarousel {
  max-height: 500px; 
  overflow: hidden; 
}
        </style>

<body>
    <?php include_once("navbar.php"); ?>
    
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    // Giriş durumunu kontrol et
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
        <header class="main-header">
            <div class="container">
                <h1>Hoş Geldiniz!</h1>
                <p>Bizimle birlikte keşfedin, ilan verin ve bulun.</p>
                <a href="register.php" class="btn btn-primary">Kayıt Ol</a>
                <a href="login.php" class="btn btn-secondary">Giriş Yap</a>
            </div>
        </header>
    <?php endif; ?>

<?php
// Veritabanı bağlantı detayları
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertphp";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Öne çıkan ilanlar için SQL sorgusu
$sql = "SELECT advert.id, advert.title, advert.description, advert.price, 
               (SELECT photo FROM advert_photo WHERE advert_photo.advert_id = advert.id LIMIT 1) AS photo
        FROM advert
        ORDER BY advert.id DESC
        LIMIT 10"; // Örnek olarak son 10 ilanı alabiliriz.

$result = $conn->query($sql);

// SQL sorgusu sonuçlarını bir diziye aktaralım
$featuredAdverts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $featuredAdverts[] = $row;
    }
}


?>

    <section class="featured-adverts">
        <div class="container">
            <h2>Öne Çıkan İlanlar</h2>
            <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php foreach ($featuredAdverts as $key => $advert): ?>
            <div class="carousel-item <?php echo ($key == 0) ? 'active' : ''; ?>">
                <a href="/AdvertSitePhp/advert-detail.php?id=<?php echo $advert['id']; ?>&title=<?php echo urlencode($advert['title']); ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($advert['photo']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($advert['title']); ?>">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo htmlspecialchars($advert['title']); ?></h5>
                </div>
            </div>
        <?php endforeach; ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <h2>Nasıl Çalışır?</h2>
            <p>Sitemizde ilan vermek veya ilanlara göz atmak oldukça kolay. İşte adımlar:</p>
            <!-- Adımları açıklayan içerik -->
        </div>
    </section>

    <footer>
        <div class="container">
            <?php include 'footer.php'; ?>
        </div>
    </footer>

    <!-- Opsiyonel JavaScript -->
    <!-- jQuery, Popper.js, Bootstrap JS gibi -->
    <script src="path_to_jquery"></script>
    <script src="path_to_popper"></script>
    <script src="path_to_bootstrap_js"></script>
</body>
</html>