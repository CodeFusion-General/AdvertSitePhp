<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="footer-about col-md-4">
                <h3>Hakkımızda</h3>
                <p>Biz, müşterilerimize en iyi hizmeti sunmayı hedefleyen bir ilan platformuyuz.</p>
            </div>
            <div class="footer-nav col-md-4">
                <h3>Navigasyon</h3>
                <ul>
                    <li><a href="index.php">Ana Sayfa</a></li>
                    <li><a href="adverts.php">İlanlar</a></li>
                    <li><a href="contact.php">İletişim</a></li>
                    <!-- Diğer navigasyon linkleri -->
                </ul>
            </div>
            <div class="footer-contact col-md-4">
                <h3>İletişim</h3>
                <ul>
                <li><a href="mailto:info@example.com">muhammedsogut@stu.aydin.edu.tr</a></li>
                    <li><a href="mailto:info@example.com">kadir.ugurlu@stu.aydin.edu.tr</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p>&copy; <?= date("Y"); ?> IAU Computer Engineering Tüm hakları saklıdır.</p>
            </div>
        </div>
    </div>
</footer>
<style>
.container {
  width: 100%; /* Container'ı tam sayfa genişliğine ayarlar */
  max-width: 1200px; /* Maksimum genişlik */
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.row {
  display: flex; /* Flexbox ile çocuk div'leri yan yana diz */
  flex-wrap: wrap; /* İçerik fazla olduğunda yeni satıra geçer */
}
</style>