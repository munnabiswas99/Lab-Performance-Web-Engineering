<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $title        = $_POST['title'];
    $author       = $_POST['author'];
    $genre        = $_POST['genre'];
    $description  = $_POST['description'];
    $best_selling = isset($_POST['best_selling']) ? 1 : 0;

    $sql = "INSERT INTO books (title, author, genre, description, best_selling)
            VALUES ('$title', '$author', '$genre', '$description', $best_selling)";

    if ($conn->query($sql)) {
        echo "<div class='fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-lg z-50'>
                 Book added successfully!
              </div>";
    } else {
        echo "<div class='fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-lg z-50'>
                 Error: " . $conn->error . "
              </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Add Book | Library Vault</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="bg-gradient-to-br from-purple-100 to-indigo-100 min-h-screen flex items-center justify-center px-4 py-10">

    <div class="bg-white rounded-xl shadow-2xl border-t-8 border-indigo-500 w-full max-w-2xl p-10 space-y-6 relative">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-indigo-700 mb-2"><i class="fa-solid fa-book-open-reader mr-2"></i>Add a Book</h1>
            <p class="text-gray-500">Fill out the form below to add a new title to your library</p>
        </div>

        <form method="POST" action="add_book.php" class="grid gap-6">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Book Title</label>
                <input type="text" name="title" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Author Name</label>
                <input type="text" name="author" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Genre</label>
                <select name="genre" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Choose Genre --</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-fiction">Non-fiction</option>
                    <option value="Science">Science</option>
                    <option value="Biography">Biography</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Mystery">Mystery</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg resize-none shadow-inner focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Brief summary or description..."></textarea>
            </div>

            <div class="flex items-center space-x-3">
                <input type="checkbox" name="best_selling" value="1"
                    class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label class="text-gray-700 text-sm font-medium">Mark as Best Selling</label>
            </div>

            <div class="text-center pt-4">
                <button type="submit" name="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 font-semibold rounded-full shadow-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fa-solid fa-plus mr-2"></i>Submit Book
                </button>
            </div>
        </form>
    </div>

</body>
</html>
