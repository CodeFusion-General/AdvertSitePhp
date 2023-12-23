<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    $isErrorField = false;
    $isErrorPhoto = false;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST['price'];
    $photos = isset($_FILES["photo"]) ? $_FILES["photo"] : array();
    $names = isset($_POST["names"]) ? $_POST["names"] : array();
    $values = isset($_POST["values"]) ? $_POST["values"] : array();
    $featuresArray = array();

    for ($i = 0; $i < count($names); $i++) {
        $featuresArray[$names[$i]] = $values[$i];
    }

    $sql1 = "INSERT INTO advert (user_id, title, description, price) VALUES ('{$_SESSION['user_id']}', '$title', '$description', '$price')";

    if ($conn->query($sql1) === TRUE) {
    } else {
        cancelFunction();
    }

    $sql = "SELECT id FROM advert WHERE title='$title' and description='$description'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $advert_id = $row["id"];
        }
    } else {
        echo "Data not found.";
    }

    foreach ($featuresArray as $key => $value) {
        $sql2 = "INSERT INTO advert_field (advert_id, name, value) VALUES ('$advert_id','$key', '$value')";
        if ($conn->query($sql2) === TRUE) {
        } else {
            $isErrorField = true;
            cancelFunction();
        }
    }

    if (!empty($photos)) {
        foreach ($photos['tmp_name'] as $index => $photo) {
            if (!empty($photo) && is_uploaded_file($photo)) {
                $pht = file_get_contents($photo);

                $sql3 = $conn->prepare("INSERT INTO advert_photo (advert_id, photo) VALUES ('$advert_id', ?)");
                $sql3->bind_param("s", $pht);

                if ($sql3->execute()) {
                } else {
                    $isErrorPhoto = true;
                    cancelFunction();
                }

                $sql3->close();
            } else {
                $isErrorPhoto = true;
                cancelFunction();
            }
        }
    }

    echo "<script>
            alert('Advert successfully added');
            window.location.href='http://localhost/AdvertSitePhp/new-advert.php';
        </script>";

    $conn->close();
}

function cancelFunction()
{
    global $advert_id, $isErrorField, $isErrorPhoto, $conn;
    $sql = "DELETE FROM advert WHERE id='$advert_id'";
    $conn->query($sql);

    if ($isErrorField == true) {
        $sql1 = "DELETE FROM advert_field WHERE advert_id='$advert_id'";
        $conn->query($sql1);
        echo "<script>
                alert('Error on saving field');
                window.location.href='http://localhost/AdvertSitePhp/new-advert.php';
            </script>";
        die();
    } else if ($isErrorPhoto == true) {
        $sql1 = "DELETE FROM advert_field WHERE advert_id='$advert_id'";
        $conn->query($sql1);
        $sql2 = "DELETE FROM advert_photo WHERE advert_id='$advert_id'";
        $conn->query($sql2);
        echo "<script>
                alert('Error on saving photo');
                window.location.href='http://localhost/AdvertSitePhp/new-advert.php';
            </script>";
        die();
    } else {
        echo "<script>
                alert('Error on saving advert');
                window.location.href='http://localhost/AdvertSitePhp/new-advert.php';
            </script>";
        die();
    }
}
?>
