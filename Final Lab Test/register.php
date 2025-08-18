<?php
// DB Connection
$conn = new mysqli("localhost", "root", "", "registration_system");
if ($conn->connect_error) {
    die("Connection failed");
}

// Count remaining seats
function countRemaining($slot, $conn)
{
    $result = $conn->query("SELECT COUNT(*) AS total FROM students WHERE slot='$slot'");
    $count = $result->fetch_assoc()['total'];
    return 8 - $count;
}

// If form submitted (POST)
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sid = $_POST['sid'];
    $email = $_POST['email'];
    $slot = $_POST['slot'];

    // Check if already registered
    $check = $conn->query("SELECT * FROM students WHERE sid='$sid'");
    if ($check->num_rows > 0) {
        $message = "You are already registered! Do you want to update your slot?";
        echo "<script>
            if(confirm('$message')) {
            window.location.href='update.php?sid=$sid&slot=$slot';
         }
        </script>";
        exit();
    } else {
        if (countRemaining($slot, $conn) <= 0) {
            $message = "Sorry, this slot is full.";
        } else {
            $stmt = $conn->prepare("INSERT INTO students (firstname, lastname, sid, email, slot) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstname, $lastname, $sid, $email, $slot);
            $stmt->execute();
            $message = "Registration successful!";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>COMP207 - Register here for a practical slot</title>
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
    <script>
        function validateForm() {
            var nameRegex = /^[A-Za-z]+$/;
            var sidRegex = /^[0-9]{3}-[0-9]{2}-[0-9]{4}$/;
            var emailRegex = /^[a-zA-Z0-9._%+-]+@cse\.diu\.edu\.bd$/;

            var fn = document.forms["reg"]["firstname"].value;
            var ln = document.forms["reg"]["lastname"].value;
            var sid = document.forms["reg"]["sid"].value;
            var em = document.forms["reg"]["email"].value;

            if (!nameRegex.test(fn) || !nameRegex.test(ln)) {
                alert("Name should only contain letters.");
                return false;
            }
            if (!sidRegex.test(sid)) {
                alert("SID must follow xxx-xx-xxxx format.");
                return false;
            }
            if (!emailRegex.test(em)) {
                alert("Email must be DIU CSE domain.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>COMP207 - Register here for a practical slot</h1>

        <p class="warning">Register only if you know what you are doing.</p>

        <ul class="instructions">
            <li>Please enter all information and select your desired day. Please enter a correct 'SID' number!</li>
            <li>Please check the number of available seats before submitting.</li>
            <li>Register only to one slot.</li>
        </ul>

        <form name="reg" method="POST" onsubmit="return validateForm();">
            <table class="form-table">
                <tr>
                    <th>Name</th>
                    <th>Firstname</th>
                    <th>SID</th>
                    <th>Email Address</th>
                </tr>
                <tr>
                    <td><input type="text" name="lastname" required></td>
                    <td><input type="text" name="firstname" required></td>
                    <td><input type="text" name="sid" required placeholder="123-45-6789"></td>
                    <td><input type="email" name="email" required placeholder="yourname@cse.diu.edu.bd"></td>
                </tr>
            </table>

            <label class="slot-label">Select the practical slot:</label><br>
            <select name="slot" size="4" required>
                <?php
                $slots = ["slot1" => "Monday 15:00–17:00", "slot2" => "Tuesday 14:00–16:00", "slot3" => "Thursday 11:00–13:00", "slot4" => "Friday 10:00–12:00"];
                foreach ($slots as $value => $label) {
                    $rem = countRemaining($value, $conn);
                    $disabled = ($rem <= 0) ? "disabled" : "";
                    echo "<option value='$value' $disabled>$label — $rem seats remaining</option>";
                }
                ?>
            </select>

            <div class="buttons">
                <input type="submit" value="Register">
                <input type="reset" value="Clear">
            </div>
        </form>
        <p><?php echo $message; ?></p>
    </div>
</body>

</html>