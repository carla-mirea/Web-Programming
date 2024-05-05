<?php

use FTP\Connection;

include ('database/connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $con = OpenConnection();
    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $pages = $_POST['pages'];
        $genre = $_POST['genre'];
        $query = "INSERT INTO books VALUES('$id', '$title', '$author', '$pages', '$genre')";
        $con->query($query);
    }
    else if(isset($_POST['update'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $pages = $_POST['pages'];
        $genre = $_POST['genre'];
        $query = "UPDATE books SET title='$title', author='$author', pages='$pages', genre='$genre' WHERE id='$id'";
        $con->query($query);
    }

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
    <form action="crud_books.php" method="post">
        <input id="id" type="text" name="id" placeholder="id">
        <input id="title" type="text" name="title" placeholder="title">
        <input id="author" type="text" name="author" placeholder="author">
        <input id="pages" type="text" name="pages" placeholder="pages">
        <input id="genre" type="text" name="genre" placeholder="genre">
        <input id="add" type="submit" name="add" value="Add new document">
        <!-- <input id="update" genre$genre="submit" name="update" value="Update document"> -->
    </form>
</section>

<section class="update_form">
    <form action="crud_books.php" method="post">
        <input id="id" type="text" name="id" placeholder="id">
        <input id="title" type="text" name="title" placeholder="title">
        <input id="author" type="text" name="author" placeholder="author">
        <input id="pages" type="text" name="pages" placeholder="pages">
        <input id="genre" type="text" name="genre" placeholder="genre">
        <input id="update" type="submit" name="update" value="Update book">
    </form>
</section>

<section class="display">
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
                            <button class='btnUpdate' type='button'>Update</button>
                            <button class='btnDelete' type='button'>Delete</button>
                      </td>
                      </tr>";
            }
            CloseConnection($con);
            ?>

        </tbody>
    </table>
</section>


<!-- <button class='btnUpdate' id='edit' name='edit' genre$genre='button' value= ". $row['id'] . " onclick=\"location.href='./update.php'\">Update</button> -->
</body>

</html>