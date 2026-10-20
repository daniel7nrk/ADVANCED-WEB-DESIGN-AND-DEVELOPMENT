<?php
require "auth.php";
require "db.php";
$result = $conn->query("SELECT * FROM books ORDER BY book_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books - Bright Future Bookstore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <main class="container">
        <h2>Book records</h2>
        <?php if (isset($_GET["msg"])): ?><p class="msg success"><?= htmlspecialchars($_GET["msg"]) ?></p><?php endif; ?>
        <div class="table-wrap">
        <table>
            <tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Quantity</th><th>Actions</th></tr>
            <?php while ($b = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $b["book_id"] ?></td>
                <td><?= htmlspecialchars($b["title"]) ?></td>
                <td><?= htmlspecialchars($b["author"]) ?></td>
                <td><?= htmlspecialchars($b["category"]) ?></td>
                <td><?= number_format($b["price"], 2) ?></td>
                <td><?= $b["quantity"] ?></td>
                <td>
                    <a class="btn btn-sm" href="edit_book.php?id=<?= $b["book_id"] ?>">Edit</a>
                    <form action="delete_book.php" method="post" class="inline" onsubmit="return confirmDelete()">
                        <input type="hidden" name="id" value="<?= $b["book_id"] ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
