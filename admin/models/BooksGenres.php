<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 21:08
 */

class BooksGenres {
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
    }

    // Define relationship (book <-> genre)
    public function insert($book_id, $genre_id){
        $query = $this->connection->prepare("INSERT INTO books_genre (book_id, genre_id) VALUES (:book_id, :genre_id)");
        $query->bindParam(":book_id", $book_id);
        $query->bindParam(":genre_id", $genre_id);
        $query->execute();
    }

    // Delete relationship (book <-> genre)
    public function delete($book_id, $genre_id){
        $query = $this->connection->prepare("DELETE FROM books_genre WHERE book_id = :book_id AND genre_id = :genre_id");
        $query->bindParam(':book_id', $book_id);
        $query->bindParam(':genre_id', $genre_id);
        $query->execute();
    }

}