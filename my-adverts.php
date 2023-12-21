<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "My Adverts";
include 'head.php';
?>

<body>
    <?php include_once("navbar.php"); ?>
    <?php

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database using a LEFT JOIN to include the first photo for each advert
    $sql = "SELECT advert.*, MIN(advert_photo.photo) AS first_photo
        FROM advert
        LEFT JOIN advert_photo ON advert.id = advert_photo.advert_id
        WHERE user_id = " . $_SESSION['user_id'] . "
        GROUP BY advert.id";
    $result = $conn->query($sql);

    ?>
    <div class="container login-container save-advert row">
        <div class="col-12">
            <h1 style="text-align: center;">My Adverts</h1>
        </div>
        <div class="col-12">
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if ($result->num_rows === 0) {
                            echo "<tr><td colspan='5' style='text-align: center;'>No adverts found</td></tr>";
                        }
                        // Loop through the data and display it in the table
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="td-photo">
                                    <?php
                                    if (!empty($row['first_photo'])) {
                                        echo "<img src='data:image/jpeg;base64," . base64_encode($row['first_photo']) . "' class='table-img' alt='...'>";
                                    } else {
                                        echo "No photo available";
                                    }
                                    ?>
                                </td>
                                <td class="td-title"><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td class="td-photo"><?php echo $row['price']; ?></td>
                                <td class="td-button"><a class="btn" href="advert-detail.php?id=<?php echo $row['ID']; ?>&title=<?php echo $row['title']; ?>"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                            </tr>
                        <?php
                        }
                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>