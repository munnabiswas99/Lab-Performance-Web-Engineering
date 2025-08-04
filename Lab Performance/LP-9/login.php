<!-- login.php -->
<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['name'];
            header("Location: coffee.php");
            exit();
        }
    }
    echo "<script>alert('Invalid email or password');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="center-box">
<h2>Login</h2>
<form method="post">
    <input type="email" name="email" placeholder="Email (e.g. yourname.cse@diu.edu.bd)" required pattern="^[a-zA-Z0-9._%+-]+\.cse@diu\.edu\.bd$"><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<a href="register.php">Don't have an account? Register here</a>
</div>
</body>
</html>