<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="footer-about col-md-4">
                <h3>About Us</h3>
                <p>We are an advertisement platform aiming to provide the best service to our customers.</p>
            </div>
            <div class="footer-nav col-md-4">
                <h3>Navigation</h3>
                <ul>
                    <li><a href="index.php">Home Page</a></li>
                    <li><a href="adverts.php">Adverts</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <!-- Other navigation links -->
                </ul>
            </div>
            <div class="footer-contact col-md-4">
                <h3>Contact</h3>
                <ul>
                    <li><a href="mailto:info@example.com">muhammedsogut@stu.aydin.edu.tr</a></li>
                    <li><a href="mailto:info@example.com">kadir.ugurlu@stu.aydin.edu.tr</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p>&copy; <?= date("Y"); ?> IAU Computer Engineering All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<style>
body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

footer {
  margin-top: auto;
  width: 100%;
  background-color: #f8f9fa;
  text-align: center;
}

.container {
  width: 100%; 
  max-width: 1200px; 
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}

.row {
  display: flex; 
  flex-wrap: wrap; 
}
</style>
