<?php

use FTP\Connection;
session_start();
include ('database/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['add'])){
        $title = $con->real_escape_string($_POST['title']);
        $author = $con->real_escape_string($_POST['author']);
        $pages = $con->real_escape_string($_POST['pages']);
        $genre = $con->real_escape_string($_POST['genre']);

        // Validate input
        if (empty($title) || empty($author) || empty($genre)) {
            echo "title, author, and genre are required fields.";
            exit;
        }

        if (!is_numeric($pages) || $pages <= 0) {
            echo "Pages must be a positive number.";
            exit;
        }

        $stmt = $con->prepare("INSERT INTO books(title, author, pages, genre) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("ssis", $title, $author, $pages, $genre);
        $stmt->execute();

    }

    /*if ($con->query($query) === TRUE) {
        echo "Book added successfully.";
    } else {
        echo "Error adding book: " . $con->error;
    }*/

    CloseConnection($con);
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

<section class="add_form">
    <form action="add.php" method="post">
        <input id="title" type="text" name="title" placeholder="title">
        <input id="author" type="text" name="author" placeholder="author">
        <input id="pages" type="text" name="pages" placeholder="pages">
        <input id="genre" type="text" name="genre" placeholder="genre">
        <input id="add" type="submit" name="add" value="Add new document">
        
    </form>
</section>

<section class="display_add">
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
                echo   "</tr>";
            }
            CloseConnection($con);
            ?>

        </tbody>
    </table>
</section>

</body>

</html>