<!DOCTYPE html>
<html lang="en">

<?php
$pageTitle = $_GET['title'] . " - Advert Details";
include 'head.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advertphp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$targetAdvertId = isset($_GET['id']) ? $_GET['id'] : null;

if ($targetAdvertId === null) {
    die("Advert ID not provided");
}

$sql = "SELECT * FROM advert WHERE id = $targetAdvertId";

$resultAdvert = $conn->query($sql);

if ($resultAdvert->num_rows > 0) {
    $advertData = $resultAdvert->fetch_assoc();  

    $sql1 = "SELECT * FROM advert_photo WHERE advert_id = $targetAdvertId";
    $resultPhotos = $conn->query($sql1);

    $photosData = [];
    while ($photo = $resultPhotos->fetch_assoc()) {
        $photosData[] = $photo;
    }

    $sql2 = "SELECT * FROM advert_field WHERE advert_id = $targetAdvertId";
    $resultFields = $conn->query($sql2);

    $fieldsData = [];
    while ($field = $resultFields->fetch_assoc()) {
        $fieldsData[] = $field;
    }
} else {
    echo "No data found";
}
?>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container login-container save-advert row">
        <div class="col-8">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <?php
                    foreach ($photosData as $key => $photo) {
                        $activeClass = ($key == 0) ? 'active' : '';
                        echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='$key' class='$activeClass' aria-label='Slide " . ($key + 1) . "'></button>";
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    foreach ($photosData as $key => $photo) {
                        $activeClass = ($key == 0) ? 'active' : '';
                        echo "<div class='carousel-item $activeClass'>";
                        echo "<img src='data:image/jpeg;base64," . base64_encode($photo['photo']) . "' class='d-block w-100' alt='...'>";
                        echo "</div>";
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-4">
            <!-- Display fetched advert data -->
            <h1><?php echo $advertData['title']; ?></h1>
            <div style="margin-top: 25px;">
                <h4>Price: <?php echo $advertData['price']; ?> $</h4>
                <h4 style="text-align:center;">Features</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <?php
                            foreach ($fieldsData as $field) {
                                echo "<tr>";
                                echo "<td>" . $field['name'] . "</td>";
                                echo "<td>" . $field['value'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <h4 style="text-align:center;">Description</h4>
                <p><?php echo $advertData['description']; ?></p>
            </div>
        </div>
    </div>
</body>

</html>
