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

                </div>
            </div>
            <div class="col-4">
                <div class="row" id="features">
                    <h1 class="col-12" style="text-align: center;">Features</h1>
                </div>
            </div>
            <div style="text-align: center;" class="col-12">
                <button type="button" class="btn" onclick="addTextBoxes()">Add Textboxes</button>
                <button type="submit" class="btn">Save Advert</button>
            </div>
        </form>
    </div>
    <!-- <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Formdan gelen verileri al
                $title = $_POST["title"];
                $description = $_POST["description"];
                $photos = isset($_FILES["photo"]) ? $_FILES["photo"] : array();
                // Eklenen text box'ları al
                $names = isset($_POST["names"]) ? $_POST["names"] : array();
                $values = isset($_POST["values"]) ? $_POST["values"] : array();
                // Yeni text box'ları key-value çiftleri olarak birleştir
                $featuresArray = array();
                for ($i = 0; $i < count($names); $i++) {
                    $featuresArray[$names[$i]] = $values[$i];
                }
                if (isset($_FILES["photo"]) && is_array($_FILES["photo"]) && !empty($_FILES["photo"])) {
                    for ($i = 0; $i < count($photos["name"]); $i++) {
                        $photo = $photos["name"][$i];
                        $photoTmpName = $photos["tmp_name"][$i];
                        $photoError = $photos["error"][$i];
                        $photoSize = $photos["size"][$i];
                        $photoType = $photos["type"][$i];
                        $photoExtension = pathinfo($photo, PATHINFO_EXTENSION);
                        $photoName = uniqid() . "." . $photoExtension;
                        $photoDestination = "uploads/" . $photoName;
                        echo '<img src="' . $photoDestination . '" alt="Uploaded Photo"><br>';
                        move_uploaded_file($photoTmpName, $photoDestination);
                    }
                }

                // Şimdi, $title, $description ve $newTextBoxKeyValueArray içindeki verileri kullanabilirsiniz.

                // Örnek olarak, ekrana yazdıralım:
                echo "Title: " . $title . "<br>";
                echo "Description: " . $description . "<br>";

                // Yeni text box'ları ekrana yazdır
                foreach ($featuresArray as $key => $value) {
                    echo "Features Key: " . $key . ", Value: " . $value . "<br>";
                }
                foreach ($photos["name"] as $photo) {
                    echo "Photo: " . $photo . "<br>";
                }
            } else {
                // Eğer form POST yöntemiyle gelmediyse, uygun bir işlem yapabilirsiniz.
                echo "Form submission error!";
            }
            ?> -->


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