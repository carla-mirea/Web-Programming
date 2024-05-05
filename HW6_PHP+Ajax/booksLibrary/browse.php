<?php
use FTP\Connection;

include ('database/connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books Browser</title>
    <script type="text/javascript" src="browse.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<button class="home" type="button" onclick="location.href='./index.html'">HOME </button>
<button onclick="location.href='./book_action.php'">Lend/Return Books</button>

<div id="previous-filter">

</div>

<center>
    <div id="main">

        <h1> Books </h1>
        <div" style="float: left";>

            <select id="select-genre" name="Select Filter" onchange="get_filtered_by_genre()">
                <?php
                    $con = OpenConnection();
                    $sql = "SELECT DISTINCT genre FROM books";
                    $result_set = $con->query($sql);

                    if(mysqli_num_rows($result_set) > 0){
                        while($row = mysqli_fetch_array($result_set)){
                            $genre = ''. $row['genre'] .'';
                            echo '<option>' . $genre . '</option>';
                        }
                    }
                    CloseConnection($con);
                ?>

            </select>

        </div>

        <br />
        <br />


        <table id="browse-table" class="browse-table">
            <thead id>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Pages</th>
                <th>Genre</th>
            </thead>
            <tbody id="browse-tbody">
                <?php
                    $con = OpenConnection();
                    $result_set = mysqli_query($con, "SELECT * FROM books");
                    
                    while($row = mysqli_fetch_array($result_set)){
                        echo " <tr>";
                        echo  "<td>" . $row['id'] . "</td>";
                        echo  "<td>" . $row['title'] . "</td>";
                        echo  "<td>" . $row['author'] . "</td>";
                        echo  "<td>" . $row['pages'] . "</td>";
                        echo  "<td>" . $row['genre'] . "</td>";
                        echo   "</tr>";
                    }
                    CloseConnection($con)
                ?>
            </tbody>
        </table>

        <label>
        </label>

    </div>
</center>
</body>
</html>
