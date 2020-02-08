<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 23.01.2020
 * Time: 10:59
 */
require_once ROOT . '/components/Database.php';

class Book {
    private $connection;
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
    }

    // Return all the data from `books` & `authors` & `genre`
    public function getAllData(){
        $query = "SELECT b.book_id, b.book_title, description, b.price,
            GROUP_CONCAT(DISTINCT author_name SEPARATOR ', ') AS authors,
            GROUP_CONCAT(DISTINCT genre_title SEPARATOR ', ') AS genre
            FROM books b
            INNER JOIN authors a
            INNER JOIN books_authors ba
            INNER JOIN genre g
            INNER JOIN books_genre bg
            ON (b.book_id = ba.book_id
            AND a.author_id = ba.author_id
            AND b.book_id = bg.book_id
            AND g.genre_id = bg.genre_id)
            GROUP BY book_title";
        
        $query = $this->connection->query($query);
        $results = array(); 
        while($book = $query->fetch(PDO::FETCH_ASSOC)){
            array_push($results, $book);
        }
        return $results;
    }

    // Return book by ID
    public function getOne($id){
        $query = "SELECT b.book_id, b.book_title, description, b.price,
                GROUP_CONCAT(DISTINCT author_name SEPARATOR ', ') AS authors,
                GROUP_CONCAT(DISTINCT genre_title SEPARATOR ', ') AS genre
                FROM books b
                INNER JOIN authors a
                INNER JOIN books_authors ba
                INNER JOIN genre g
                INNER JOIN books_genre bg
                ON (b.book_id = ba.book_id
                AND a.author_id = ba.author_id
                AND b.book_id = bg.book_id
                AND g.genre_id = bg.genre_id
                AND b.book_id = ?)
                GROUP BY book_title";
        $query = $this->connection->prepare($query);
        $query->execute([$id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function sendMail($data){

        $to = "admin@gfl-catalog.s-host.net";    
        $from = "admin@gfl-catalog.s-host.net"; 
        $name = $data['name'];
        $address = $data['address'];
        $qty = $data['qty'];
        $subject = "New order";

        $mail_to_myemail = "New order! 
        Name: $name
        Address: $address
        Quantity: $qty";

        $headers = "From: $from \r\n";
        mail($to, $subject, $mail_to_myemail, $headers . 'Content-type: text/plain; charset=utf-8');
         

    }
}
