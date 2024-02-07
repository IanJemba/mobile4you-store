<?php
require 'database.php';

//de sql query
$sql = "SELECT * FROM devices";

//hier wordt de query uitgevoerd met de database
$result = mysqli_query($conn, $sql);


$devices = mysqli_fetch_all($result, MYSQLI_ASSOC);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices Overview</title>
    <style>
        .device-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: whitesmoke;
            font-family: 'Times New Roman', Times, serif;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .device-image {
            max-width: 100px;
            max-height: 100px;
        }

        li {
            text-decoration: none;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="devices.php">Home</a></li>
            <li><a href="loginpage.php"> Log In</a>
        </ul>
    </nav>
    <h3>Devices Overview</h3>
    <hr>
    <?php foreach ($devices as $device) : ?>
        <div class="device-container">
            <a href="detailpage.php?id=<?php echo  $device['device_id'] ?>">
                <h4><?php echo $device["name"] ?></h4>
                <p><strong>ID:</strong> <?php echo $device["device_id"] ?></p>
                <p><strong>Brand:</strong> <?php echo $device["brand"] ?></p>
                <p><strong>Model:</strong> <?php echo $device["model"] ?></p>
                <p><strong>Description:</strong> <?php echo $device["description"] ?></p>
                <p><strong>Price:</strong> <?php echo $device["price"] ?></p>
                <p><strong>Stock Quantity:</strong> <?php echo $device["stock_quantity"] ?></p>
                <img class="device-image" src="<?php echo $device["image_url"] ?>" alt="Device Image">
            </a>
        </div>
    <?php endforeach; ?>
</body>

</html>