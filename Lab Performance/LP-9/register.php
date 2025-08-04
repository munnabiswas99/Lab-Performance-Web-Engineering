<!-- register.php -->
<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $birth = $_POST['birth'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO user_table (email, name, birth, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $username, $birth, $password);

    if ($stmt->execute()) {
        $user_id = $conn->insert_id;
        $birth_year = substr($birth, 6, 4);
        $serial_no = $birth_year . '-' . $user_id;

        $update_sql = "UPDATE user_table SET serial_no = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $serial_no, $email);
        $update_stmt->execute();

        echo "<script>alert('Registration successful. Please log in.'); window.location='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
function validateForm() {
    const email = document.forms["regForm"]["email"].value;
    const pattern = /^[a-zA-Z0-9._%+-]+\.cse@diu\.edu\.bd$/;
    if (!pattern.test(email)) {
        alert("Invalid email format. Use .cse@diu.edu.bd");
        return false;
    }
    return true;
}
</script>
</head>
<body>
<div class="center-box">
<h2>Register</h2>
<form name="regForm" method="post" onsubmit="return validateForm()">
    <input type="email" name="email" placeholder="Email (e.g. yourname.cse@diu.edu.bd)" required pattern="^[a-zA-Z0-9._%+-]+\.cse@diu\.edu\.bd$"><br>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="text" name="birth" placeholder="Birthdate (dd-mm-yyyy)" required pattern="\d{2}-\d{2}-\d{4}"><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>
<a href="login.php">Already registered? Login here</a>
</div>
</body>
</html>