<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head.php'; ?>
    <meta charset="UTF-8">
    <title>İletişim</title>
    <style>


        </style>
    <!-- Stil dosyalarınız ve diğer head etiketleri -->
</head>
<body>
<?php include_once("navbar.php"); ?>
    <!-- Sitenizin diğer bölümleri -->

    <div class="container contact-container">
        <h1>İletişim</h1>
        <p>Bizimle iletişime geçmekten çekinmeyin. Aşağıdaki formu doldurarak bizimle iletişime geçebilirsiniz.</p>
        
        <form action="backend\contact-form-handler.php" method="post">
            <div class="form-group">
                <label for="name">Adınız</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">E-posta Adresiniz</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Mesajınız</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Gönder</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
