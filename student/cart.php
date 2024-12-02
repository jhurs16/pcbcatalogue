<!-- cart.php -->
<?php
include 'dbconn.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (count($_SESSION['cart']) < 3) {
        $BookId = $_POST['BookId'];
        if (!in_array($BookId, $_SESSION['cart'])) {
            $_SESSION['cart'][] = $BookId;
        }
    } else {
        echo "You can only borrow up to 3 books. Please return a book to borrow another.";
    }
}

if (isset($_POST['remove_from_cart'])) {
    $BookId = $_POST['BookId'];
    if (($key = array_search($BookId, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php foreach ($_SESSION['cart'] as $BookId): ?>
            <li>
                <?php echo getBookTitle($BookId); ?>
                <form method="POST">
                    <input type="hidden" name="BookId" value="<?php echo $BookId; ?>">
                    <button type="submit" name="remove_from_cart">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="POST" action="accept.php">
        <button type="submit">Confirm Borrowing</button>
    </form>
</body>
</html>