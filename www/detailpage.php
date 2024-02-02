<?php


require 'database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM devices WHERE device_id = $id";
$result = mysqli_query($conn, $sql);
$device = mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Page</title>
</head>

<body>
    <h2><?php echo $device["name"] ?> Details</h2>
    <hr>
    <div>
        <p><strong>ID:</strong> <?php echo $device["device_id"] ?></p>
        <p><strong>Brand:</strong> <?php echo $device["brand"] ?></p>
        <p><strong>Model:</strong> <?php echo $device["model"] ?></p>
        <p><strong>Description:</strong> <?php echo $device["description"] ?></p>
        <p><strong>Price:</strong> <?php echo $device["price"] ?></p>
        <p><strong>Stock Quantity:</strong> <?php echo $device["stock_quantity"] ?></p>
        <!-- Add other information as needed -->

        <!-- Display the image -->
        <img src="<?php echo $device["image_url"] ?>" alt="Device Image">
    </div>
</body>

</html>