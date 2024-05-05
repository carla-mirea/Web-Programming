<?php

class DBUtils {

    private $host = "127.0.0.1"; //"127.0.0.1";
    private $user = "root";
    private $password = "";
    private $db = "book_library";
    private $charset = 'utf8';

    private $pdo;
    private $error;

    public function __construct()
    {
		$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
		$opt = array(PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false);
		try {
			$this->pdo = new PDO($dsn, $this->user, $this->password, $opt);		
		} // Catch any errors
		catch(PDOException $e){
			$this->error = $e->getMessage();
			echo "Error connecting to DB: " . $this->error;
		}        
    }

    public function getFilteredBooksByGenre($genre){
        $stmt = $this->pdo->query("SELECT * FROM books WHERE genre = '" . $genre ."' ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGenres(){
        $stmt = $this->pdo->query("SELECT DISTINCT genre FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectAllBooks(){
        $stmt = $this->pdo->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBook($id, $title, $author, $pages, $genre){    
        $affected_rows = $this->pdo->exec("INSERT INTO books(id, title, author, pages, genre) values(" . $id . ", '" . $title . "', '" . $author . "', " . $pages .", '". $genre . "')");

        return $affected_rows;
    }

    public function deleteBook($id){
        $affected_rows = $this->pdo->exec("DELETE FROM books WHERE id = ". $id ."");
        
        return $affected_rows;
    }

    public function updateBook($id, $title, $author, $pages, $genre){
        $affected_rows = $this->pdo->exec("UPDATE books SET title = '" . $title . "', author = '" . $author . "', pages = " . $pages . ", genre = '" . $genre . "' WHERE id = " . $id . "");
   
        return $affected_rows;
    }


}

?>