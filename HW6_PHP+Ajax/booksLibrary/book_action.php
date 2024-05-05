<?php

use FTP\Connection;
session_start();
include ('database/connection.php');

// Add book loan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lend'])) {
    $con = OpenConnection();

    $book_id = $con->real_escape_string($_POST['book_id']);
    $lend_date = date("Y-m-d"); // Set the current date as the lend date

    // Validate input
    if (empty($book_id)) {
        echo "Book ID is required.";
        exit;
    }

    // Validate if the Book ID is an integer
    if (!isset($book_id) || !ctype_digit($book_id)) {
        echo "Invalid book ID.";
        exit;
    }

    // Check if the book exists
    $stmt = $con->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Book with ID $book_id does not exist.";
        exit;
    }

    // Check if the book is already lent
    $stmt = $con->prepare("SELECT * FROM book_loans WHERE book_id = ? AND is_returned = 0");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "This book is already lent.";
        exit;
    }

    // Insert the new book loan into the book_loans table
    $stmt = $con->prepare("INSERT INTO book_loans(book_id, lend_date) VALUES(?, ?)");
    $stmt->bind_param("is", $book_id, $lend_date);
    $stmt->execute();

    CloseConnection($con);
}

// Return book loan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['return'])) {
    $con = OpenConnection();

    $loan_id = $con->real_escape_string($_POST['loan_id']);

    // Validate input
    if (empty($loan_id)) {
        echo "Loan ID is required.";
        exit;
    }

    // Update the book_loans table to mark the book as returned
    $stmt = $con->prepare("UPDATE book_loans SET is_returned = 1 WHERE loan_id = ?");
    $stmt->bind_param("i", $loan_id);
    $stmt->execute();

    CloseConnection($con);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lend/Return Books</title>
</head>
<body>
    <button class="home" type="button" onclick="location.href='./index.html'">HOME </button>
    <br>
    
    <h1>Lend/Return Books</h1>

    <h2>Lend a Book</h2>
    <form action="book_loans.php" method="post">
        <input type="hidden" name="lend">
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" required>
        <button type="submit">Lend</button>
    </form>

    <h2>Return a Book</h2>
    <form action="book_loans.php" method="post">
        <input type="hidden" name="return">
        <label for="loan_id">Loan ID:</label>
        <input type="text" id="loan_id" name="loan_id" required>
        <button type="submit">Return</button>
    </form>

    <h2>Currently Lent Books</h2>
    <table>
        <thead>
            <tr>
                <th>Loan ID</th>
                <th>Book ID</th>
                <th>Lend Date</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $con = OpenConnection();
            $sql = "SELECT * FROM book_loans WHERE is_returned = 0";
            $result_set = $con->query($sql);

            if ($result_set->num_rows > 0) {
                while ($row = $result_set->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['loan_id'] . "</td>";
                    echo "<td>" . $row['book_id'] . "</td>";
                    echo "<td>" . $row['lend_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No books currently lent</td></tr>";
            }

            CloseConnection($con);

            
            ?>
        </tbody>
    </table>
</body>
</html>
