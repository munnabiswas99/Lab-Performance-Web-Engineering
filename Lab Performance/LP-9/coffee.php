<!-- coffee.php -->
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order'])) {
    $order = $_POST['order'];
    $email = $_SESSION['email'];
    $time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO order_table (email, order_item, time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $order, $time);
    $stmt->execute();
    echo "<script>alert('Order placed successfully!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav>
  <span>Welcome, <?php echo $_SESSION['username']; ?></span>
  <a href="logout.php" class="logout-btn">Logout</a>
</nav>
<div class="card-container">
    <?php
    $coffees = [
        ["name" => "Espresso", "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrjyHlkViXf1t9FlpAnmlozT9DZSvPbFi-Lg&s"],
        ["name" => "Latte", "img" => "https://www.allrecipes.com/thmb/SUs7po94w7k2OwqYDjC3H_ZW3JQ=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/96629-cafe-latte-ddmfs-hero-4x3-0288359d9c37485fa69afe5369dbcf2e.jpg"],
        ["name" => "Cappuccino", "img" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTE55ZIrMBNiVuDG386CsA3QPIZUDKYD63b3Q&s"]
    ];
    foreach ($coffees as $coffee) {
        echo "<div class='card'>";
        echo "<img src='{$coffee['img']}' alt='{$coffee['name']}' class='coffee-img'>";
        echo "<h3>{$coffee['name']}</h3>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='order' value='{$coffee['name']}'>";
        echo "<button type='submit'>Order</button>";
        echo "</form>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>