<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 21:08
 */

class BooksAuthors {
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
    }

    // Define relationship (book <-> author)
    public function insert($book_id, $author_id){
        $query = $this->connection->prepare("INSERT INTO books_authors (book_id, author_id) VALUES (:book_id, :author_id)");
        $query->bindParam(":book_id", $book_id);
        $query->bindParam(":author_id", $author_id);
        $query->execute();
    }

    // Delete relationship (book <-> author)
    public function delete($book_id, $author_id){
        $query = $this->connection->prepare("DELETE FROM books_authors WHERE book_id = :book_id AND author_id = :author_id");
        $query->bindParam(':book_id', $book_id);
        $query->bindParam(':author_id', $author_id);
        $query->execute();
    }

}