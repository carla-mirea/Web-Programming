<?php

class Book{
    public $id;
    public $title;
    public $author;
    public $pages;
    public $genre;


    function __construct($id, $title, $author, $pages, $genre)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->pages = $pages;
        $this->genre = $genre;      
    }

    function get_id(){
        return $this->id;
    }

    function set_id($newId){
        $this->id = $newId;
    }

    function get_title(){
        return $this->title;
    }

    function set_title($newTitle){
        $this->title = $newTitle;
    }

    function get_author(){
        return $this->author;
    }

    function set_author($newAuthor){
        $this->author = $newAuthor;
    }

    function get_pages(){
        return $this->pages;
    }

    function set_pages($newPages){
        $this->pages = $newPages;
    }

    function get_genre(){
        return $this->genre;
    }

    function set_genre($newGenre){
        $this->genre = $newGenre;
    }
}