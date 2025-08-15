<?php
include 'db.php';

$id = $_GET['id'];
$student = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    if ($conn->query($sql)) {
        header("Location: idx.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
    <h2>Edit Student</h2>
    <form method="post">
        Name: <input type="text" name="name" value="<?= $student['name'] ?>" required><br><br>
        Email: <input type="email" name="email" value="<?= $student['email'] ?>" required><br><br>
        Phone: <input type="text" name="phone" value="<?= $student['phone'] ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
