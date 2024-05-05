<?php

header("Access-Control-Allow-Origin: *");

require_once '../model/model.php';
require_once '../view/view.php';

class Controller
{
    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    public function service(){
        if (isset($_GET['action']) && !empty($_GET['action'])){
            if( $_GET['action'] == "selectAllBooks"){
                $this->{$_GET['action']}();
            }
            else if($_GET['action'] == 'addBook'){
                $this->{$_GET['action']}($_GET['id'], $_GET['title'], $_GET['author'], $_GET['pages'], $_GET['genre']);
            }
            else if($_GET['action'] == 'deleteBook'){
                $this->{$_GET['action']}($_GET['id']);
            }
            else if($_GET['action'] == 'updateBook'){
                $this->{$_GET['action']}($_GET['id'], $_GET['title'], $_GET['author'], $_GET['pages'], $_GET['genre']);
            }
            else if($_GET['action'] == "getGenres"){
                $this->{$_GET['action']}();
            }
            else if($_GET['action'] == "getFilteredBooksByGenre"){
                $this->{$_GET['action']}($_GET['genre']);
            }
        }
    }


    private function selectAllBooks(){
        $books = $this->model->selectAllBooks();
        return $this->view->output($books);
    }

    private function getFilteredBooksByGenre($genre){
        $books = $this->model->getFilteredBooksByGenre($genre);
        $this->view->output($books);
    }

    private function getGenres(){
        $genres = $this->model->getGenres();
        $this->view->output($genres);
    }

    private function addBook($id, $title, $author, $pages, $genre){
        $result = $this->model->addBook($id, $title, $author, $pages, $genre);
        if($result > 0){
            $r = "Success";
        }
        else{
            $r = "Failure";
        }
        $this->view->returnResult($r);
    }

    private function deleteBook($id){
        $result = $this->model->deleteBook($id);
        if($result > 0){
            $r = "Success";
        }
        else{
            $r = "Failure";
        }
        $this->view->returnResult($r);
    }

    private function updateBook($id, $title, $author, $pages, $genre){
        $result = $this->model->updateBook($id, $title, $author, $pages, $genre);
        if($result > 0){
            $r = "Success";
        }
        else{
            $r = "Failure";
        }
        $this->view->returnResult($r);
    }

}

$controller = new Controller();
$controller->service();

?>