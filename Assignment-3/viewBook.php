<?php
include 'dbConnection.php'; // database connection file

// Secure delete logic
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // sanitize input
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: view_book.php");
    exit();
}

// Fetch all books
$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Books</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Book List</h2>
            <a href="add_book.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Book</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-100 text-gray-700 text-left">
                        <th class="border p-3">ID</th>
                        <th class="border p-3">Title</th>
                        <th class="border p-3">Author</th>
                        <th class="border p-3">Genre</th>
                        <th class="border p-3">Description</th>
                        <th class="border p-3">Best Selling</th>
                        <th class="border p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($book = $books->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="border p-3"><?= $book['id'] ?></td>
                            <td class="border p-3"><?= htmlspecialchars($book['title']) ?></td>
                            <td class="border p-3"><?= htmlspecialchars($book['author']) ?></td>
                            <td class="border p-3"><?= htmlspecialchars($book['genre']) ?></td>
                            <td class="border p-3"><?= htmlspecialchars($book['description']) ?></td>
                            <td class="border p-3 text-center"><?= $book['best_selling'] ? '✅' : '❌' ?></td>
                            <td class="border p-3 space-x-2">
                                <a href="updateBook.php?id=<?= $book['id'] ?>"
                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Update</a>
                                <a href="viewBook.php?delete=<?= $book['id'] ?>" class="delete-btn bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Alert2 confirmation before delete
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const href = this.href;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to undo this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>

</body>

</html>
