<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = "Adverts";
include 'head.php';
?>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container login-container save-advert row">
        <div class="col-12">
            <h1 style="text-align: center;">Adverts</h1>
        </div>
        <div class="col-12">
            <div>
            <table  class="table">
                <thead>
                    <tr>
                        <th scope="col">Photos</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <td class="td-photo"><img src="ac.jpg" class="table-img" alt="..."></td>
                        <td>Mark</td>
                        <td class="td-photo">Otto</td>
                        <td class="td-button"><a class="btn" href="advert-detail.php"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>
                    <tr>
                        <td class="td-photo"><img src="aq.jpg" class="table-img" alt="..."></td>
                        <td>Jacob</td>
                        <td class="td-photo">Thornton</td>
                        <td class="td-button"><a class="btn" href="advert-detail.php"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>
                    <tr>
                        <td class="td-photo"><img src="aw.jpg" class="table-img" alt="..."></td>
                        <td>Larry the Bird</td>
                        <td class="td-photo">@twitter</td>
                        <td class="td-button"><a class="btn" href="advert-detail.php"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                    </tr>
                    
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>

</html>