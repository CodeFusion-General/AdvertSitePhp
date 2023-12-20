<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Start the session (if not already started)
session_start();

// Check if the user is not logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === false) {
    // Redirect to the login page or any other page
    header("Location: login.php");
    exit(); // Stop further execution of the script
}

?>


<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "Save Advert";
include 'head.php';
?>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container">
        <form class="row login-container save-advert" action="./backend/advert.php" method="post" enctype="multipart/form-data">
            <h1 class="col-12" style="text-align: center;">Save Advert</h1>
            <div class="col-4">
                <div id="photoSlider"></div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photos</label>
                    <input type="file" name="photo[]" class="form-control" id="photo" multiple>
                </div>
            </div>
            <div class="col-4 my-auto">
                <div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" id="price" oninput="validatePrice(this)">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row" id="features">
                    <h1 class="col-12" style="text-align: center;">Features</h1>
                </div>
            </div>
            <div style="text-align: center;" class="col-12">
                <button type="button" class="btn" onclick="addTextBoxes()">Add Feature</button>
                <button type="submit" class="btn">Save Advert</button>
            </div>
        </form>
    </div>

    <script>
        let features = 0;
        let featuresData = []; // Dizi, eklenen textbox'ların verilerini saklamak için

        // Yeni eklenen butonun işlevini gerçekleştiren JavaScript fonksiyonu
        function addTextBoxes() {
            var featuresdiv = $("#features");

            // Yeni metin kutularını ekleyin
            var TextBox = $('<div class="mb-3 col-6"><label for="name" class="form-label">Name</label><input type="text" name="names[]" class="form-control" id="name"></div><div class="mb-3 col-6"><label for="value" class="form-label">Value</label><input type="text" name="values[]" class="form-control" id="value"></div>');

            // Yeni metin kutularını formun içine ekleyin
            featuresdiv.append(TextBox);
        }

        function validatePrice(input) {
            // Alınan değeri kontrol etmek için bir düzenli ifade kullanın
            var regex = /^[0-9]+$/;

            if (input.value.trim() !== "" && !regex.test(input.value)) {
                // Eğer giriş matematiksel karakterler içermiyorsa
                alert("Please enter a valid numeric value for the price.");
                // İsterseniz aşağıdaki satırı kullanarak hatalı girişi temizleyebilirsiniz
                input.value = input.value.replace(/[^\d]/g, '');
            }
        }
        // Diğer fonksiyonlar buraya eklenir...

        $(document).ready(function() {
            // Dosya seçildiğinde
            $('#photo').on('change', function() {
                var photoSlider = $('#photoSlider');
                photoSlider.html(''); // Slider'ı temizle

                // Seçilen dosyaları oku
                var files = $(this)[0].files;

                // En fazla 3 dosya göster
                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = $('<img>').attr('src', e.target.result);
                        var slide = $('<div>').append(img);
                        photoSlider.slick('slickAdd', img);
                    };

                    reader.readAsDataURL(files[i]);
                }

                // Slick Carousel'ı başlat
                photoSlider.slick({
                    dots: true,
                    infinite: true,
                    slidesToShow: 1,
                    adaptiveHeight: true
                });
            });
        });
    </script>

</body>

</html>