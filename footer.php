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
    .site-footer {
        background-color: #f8f9fa;
        color: #333;
        padding: 40px 0;
        border-top: 1px solid #e7e7e7;
    }
    .site-footer ul {
        list-style: none;
        padding: 0;
    }
    .site-footer ul li a {
        color: #333;
        text-decoration: none;
    }
    .site-footer ul li a:hover {
        text-decoration: underline;
    }
    .footer-about, .footer-nav, .footer-contact {
        margin-bottom: 20px;
    }
    .footer-about h3, .footer-nav h3, .footer-contact h3 {
        margin-bottom: 10px;
    }
    .text-center {
        text-align: center;
    }
</style>