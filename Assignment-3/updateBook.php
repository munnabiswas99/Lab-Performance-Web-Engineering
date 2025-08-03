<?php
include 'dbConnection.php';

// Fetch existing book
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $book = $conn->query("SELECT * FROM books WHERE id=$id")->fetch_assoc();
    if (!$book) {
        die("Book not found.");
    }
}

// Handle update submission
if (isset($_POST['update'])) {
    $id           = intval($_POST['id']);
    $title        = mysqli_real_escape_string($conn, $_POST['title']);
    $author       = mysqli_real_escape_string($conn, $_POST['author']);
    $genre        = mysqli_real_escape_string($conn, $_POST['genre']);
    $description  = mysqli_real_escape_string($conn, $_POST['description']);
    $best_selling = isset($_POST['best_selling']) ? 1 : 0;

    $sql = "UPDATE books SET 
                title='$title',
                author='$author',
                genre='$genre',
                description='$description',
                best_selling=$best_selling
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: viewBook.php");
        exit();
    } else {
        echo "<p class='text-red-600 font-bold text-center mt-4'>Update Failed: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fade 0.6s ease-in;
        }
        @keyframes fade {
            from {opacity: 0; transform: translateY(20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-2xl p-10 rounded-xl w-full max-w-xl border border-gray-200 fade-in">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-green-700">Update Book</h2>

        <form method="POST" class="space-y-5">
            <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']) ?>">

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Author</label>
                <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Genre</label>
                <select name="genre" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 bg-white" required>
                    <option value="">-- Select Genre --</option>
                    <?php
                    $genres = ["Fiction", "Non-fiction", "Science", "Biography", "Fantasy", "Mystery"];
                    foreach ($genres as $g) {
                        $selected = ($book['genre'] === $g) ? 'selected' : '';
                        echo "<option value='$g' $selected>$g</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500"><?= htmlspecialchars($book['description']) ?></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="best_selling" value="1" <?= $book['best_selling'] ? 'checked' : '' ?>
                    class="w-5 h-5 text-green-600 border-gray-300 rounded">
                <label class="text-sm text-gray-700">Best Selling</label>
            </div>

            <div class="flex justify-between pt-6">
                <a href="view_book.php"
                    class="text-gray-600 underline hover:text-gray-900 transition">← Back to Book List</a>

                <button type="submit" name="update"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                    Update Book
                </button>
            </div>
        </form>
    </div>

</body>

</html>
