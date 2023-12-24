<!DOCTYPE html>
<html lang="en">
    <?php
    session_start(); 

    if (!isset($_SESSION['user_id'])) {

        header("Location: login.php");
        exit();
    }

    $pageTitle = "My Adverts";
    include 'head.php';

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advertphp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $order = 'ASC';
    $sort_type = 'price'; 
    if (isset($_GET['sort'])) {
        $sort_type = $_GET['sort'];
        $order = ($_GET['order'] === 'desc') ? 'DESC' : 'ASC';
    }

    $price_sort_order = ($sort_type === 'price' && $order === 'ASC') ? 'desc' : 'asc';
    $stars_sort_order = ($sort_type === 'average_stars' && $order === 'ASC') ? 'desc' : 'asc';
    $price_sort_link = $_SERVER['PHP_SELF'] . "?sort=price&order=$price_sort_order";
    $stars_sort_link = $_SERVER['PHP_SELF'] . "?sort=average_stars&order=$stars_sort_order";

    $sort_column = $sort_type === 'average_stars' ? 'average_star' : 'advert.price';
    $sql = "SELECT advert.*, MIN(advert_photo.photo) AS first_photo,
                COALESCE(AVG(advert_comment.star), 0) AS average_star
            FROM advert
            LEFT JOIN advert_photo ON advert.id = advert_photo.advert_id
            LEFT JOIN advert_comment ON advert.id = advert_comment.advert_id
            WHERE user_id = " . $_SESSION['user_id'] . "
            GROUP BY advert.id
            ORDER BY $sort_column $order";
    $result = $conn->query($sql);


    function display_stars($rating) {
        $rating = round($rating);
        $output = '';
        for ($i = 0; $i < 5; $i++) {
            if ($i < $rating) {
                $output .= '&#9733;'; 
            } else {
                $output .= '&#9734;';
            }
        }
        return $output;
    }

?>
<?php include_once("navbar.php"); ?>
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
                            <th scope="col">
                                <a href="<?php echo $price_sort_link; ?>">Price</a>
                            </th>
                            <th scope="col">
                                <a href="<?php echo $stars_sort_link; ?>">Average Stars</a>
                            </th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if ($result->num_rows === 0) {
                            echo "<tr><td colspan='5' style='text-align: center;'>No adverts found</td></tr>";
                        }
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
                                <td><?php echo display_stars($row['average_star']); ?></td> 
                                <td class="td-button">
                                    <a class="btn" href="advert-detail.php?id=<?php echo $row['ID']; ?>&title=<?php echo $row['title']; ?>"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    <a class="btn" style="margin-left: 3px;" href="update-advert.php?id=<?php echo $row['ID']; ?>&title=<?php echo $row['title']; ?>"><i class="fa-solid fa-pen"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>