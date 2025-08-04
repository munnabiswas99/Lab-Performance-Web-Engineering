<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Submission Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
        #add connection.php to this file
        include "connection.php";
        if(isset($_POST["submit"])){
            $author = $_POST["author"];
            $title = $_POST["title"];
            $description = $_POST["description"];

            $sql = "INSERT INTO BOOKS (TITLE, AUTHOR, DESCRIPTION) VALUES ('$title', '$author', '$description')";
            $result = mysqli_query($connection, $sql);

            if(!$result){
                die ("Error 2");
            }
        }
    ?>

    <div class="form-container">
        <h2>Submit Book</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <button type="submit" class="submit-btn" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>