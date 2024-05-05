<?php


require_once '../repo/DBUtils.php';
require_once 'entity/book.php';


class Model{
    private $db;

    public function __construct()
    {
        $this->db = new DBUtils();
    }

    public function getGenres()
    {
        $genresSet = $this->db->getGenres();
        $genres = array();
        foreach($genresSet as $g){
            array_push($genres, $g['genre']);
        }
        return $genres;
    }

    public function getFilteredBooksByGenre($genre){
        $resultSet = $this->db->getFilteredBooksByGenre($genre);
        $books = array();
        foreach($resultSet as $key=>$val){
            $book = new Book($val['id'], $val['title'], $val['author'], $val['pages'], $val['genre']);
            array_push($books, $book);
        }
        return $books;
    }

    public function selectAllBooks(){
        $resultSet = $this->db->selectAllBooks();
        $books = array();
        foreach($resultSet as $key=>$val){
            $book = new Book($val['id'], $val['title'], $val['author'], $val['pages'], $val['genre']);
            array_push($books, $book);
        }
        return $books;
    }

    public function addBook($id, $title, $author, $pages, $genre){
        return $this->db->addBook($id, $title, $author, $pages, $genre);
    }

    public function deleteBook($id){
        return $this->db->deleteBook($id);
    }

    public function updateBook($id, $title, $author, $pages, $genre){
        return $this->db->updateBook($id, $title, $author, $pages, $genre);
    }

}

?>