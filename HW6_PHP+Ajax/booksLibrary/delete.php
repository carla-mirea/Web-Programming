<?php

use FTP\Connection;

include ('database/connection.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if ID is provided
    if (!isset($_POST['id'])) {
        http_response_code(400); // Bad Request
        exit("Book ID is required.");
    }

    // Validate ID format
    $id = $_POST['id'];
    if (!is_numeric($id) || $id <= 0) {
        http_response_code(400); // Bad Request
        exit("Invalid book ID format.");
    }

    $connection = OpenConnection();
    $id = $connection->real_escape_string($_POST['id']);
    $stmt = $connection->prepare("DELETE FROM books WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    CloseConnection($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books Processing </title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>

<body>
<button class="home" type="button" onclick="location.href='./index.html'">HOME </button>
<br>

<section class="display_delete">
    <br>
    <table class="display-table">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Pages</th>
            <th>Genre</th>
        </thead>
        <tbody>

            <?php
            $con = OpenConnection();
            $result_set = mysqli_query($con, "SELECT * FROM books");
            
            while($row = mysqli_fetch_array($result_set)){
                echo "<tr>";
                echo  "<td>" . $row['id'] . "</td>";
                echo  "<td>" . $row['title'] . "</td>";
                echo  "<td>" . $row['author'] . "</td>";
                echo  "<td>" . $row['pages'] . "</td>";
                echo  "<td>" . $row['genre'] . "</td>";
                echo  "<td> 
                            <button class='btnDelete' type='button'>Delete</button>
                      </td>
                      </tr>";
            }
            CloseConnection($con);
            ?>

        </tbody>
    </table>
</section>

</body>

</html>