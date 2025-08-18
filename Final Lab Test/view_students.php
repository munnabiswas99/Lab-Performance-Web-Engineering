<?php
$conn = new mysqli("localhost","root","","registration_system");
?>
<!DOCTYPE html>
<html>
<head>
<title>Lecturer View</title>
</head>
<body>
<h2>View Registered Students</h2>
<form method="GET">
    <select name="slot" required>
      <option value="slot1">Mon 15-17</option>
      <option value="slot2">Tue 14-16</option>
      <option value="slot3">Thu 11-13</option>
      <option value="slot4">Fri 10-12</option>
    </select>
    <input type="submit" value="View">
</form>
<?php
if(isset($_GET['slot'])){
    $slot = $_GET['slot'];
    $res = $conn->query("SELECT * FROM students WHERE slot='$slot'");
    echo "<h3>Students in $slot</h3><table border='1'>
            <tr><th>Firstname</th><th>Lastname</th><th>SID</th><th>Email</th></tr>";
    while($r = $res->fetch_assoc()){
        echo "<tr>
                <td>".$r['firstname']."</td>
                <td>".$r['lastname']."</td>
                <td>".$r['sid']."</td>
                <td>".$r['email']."</td>
              </tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
