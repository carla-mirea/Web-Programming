<?php
use FTP\Connection;

include ('database/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lend'])) {
        lendBook();
    } elseif (isset($_POST['return'])) {
        returnBook();
    }
}

function lendBook() {
    $con = OpenConnection();

    $book_id = $_POST['book_id'];
    $lend_date = date('Y-m-d'); // Current date

    $stmt = $con->prepare("INSERT INTO book_loans (book_id, lend_date, is_returned) VALUES (?, ?, 0)");
    $stmt->bind_param("is", $book_id, $lend_date);
    $stmt->execute();

    CloseConnection($con);

    // Redirect back to the browse page or any other desired page
    header("Location: browse.php");
    exit();
}

function returnBook() {
    $con = OpenConnection();
    $loan_id = $_POST['loan_id'];
    $return_date = date('Y-m-d'); // Current date

    $stmt = $con->prepare("UPDATE book_loans SET return_date = ?, is_returned = 1 WHERE loan_id = ?");
    $stmt->bind_param("si", $return_date, $loan_id);
    $stmt->execute();

    // Delete the entry from the book_loan table
    $deleteStmt = $con->prepare("DELETE FROM book_loans WHERE loan_id = ?");
    $deleteStmt->bind_param("i", $loan_id);
    $deleteStmt->execute();

    CloseConnection($con);

    // Redirect back to the browse page or any other desired page
    header("Location: browse.php");
    exit();
}
?>
