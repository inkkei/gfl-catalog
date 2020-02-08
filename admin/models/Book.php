<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 23.01.2020
 * Time: 10:59
 */
require_once ROOT . '/components/Database.php';
require_once ROOT . '/admin/models/Author.php';
require_once ROOT . '/admin/models/Genre.php';


class Book {
    private $connection;
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
    }

    // Return all the data from `books` & `authors` & `genre`
    public function getAll(){
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

    public function getLastBookId(){
        $query = $this->connection->prepare("SELECT book_id FROM books ORDER BY book_id DESC LIMIT 1");
        $query->execute();
        $id = $query->fetch(PDO::FETCH_ASSOC);

        return $id['book_id'];
    }

    // Add a new row to books table
    public function insert($title, $description, $price){
        $query = $this->connection->prepare("INSERT INTO books (book_title, description, price) 
                                                      VALUES (:title, :description, :price)");
        $query->execute([
            ':title' => $title,
            ':description' => $description,
            ':price' => $price
        ]);
    }

    public function add($data){
        if ($data){
            $this->insert($data['title'], $data['description'], $data['price']);

            $authorObj = new Author();
            $authorObj->handle($data['author'], $this->getLastBookId());

            $genreObj = new Genre();
            $genreObj->handle($data['genre'], $this->getLastBookId());
        }
    }

    public function update($data){
        if ($data) {
            $id = array_shift($data);
            $old_data = $this->getOne($id);

            $old_genre = array_map('trim', explode(",", array_pop($old_data)));
            $old_authors = array_map('trim', explode(",", array_pop($old_data)));

            $new_genre = array_pop($data);
            $new_authors = array_pop($data);

            foreach ($data as $field => $value) {
                if ($value !== $old_data[$field]) {
                    $query = $this->connection->prepare("UPDATE books SET " . $field . " = :value WHERE book_id = :id");
                    $query->bindParam(':value', $value, PDO::PARAM_STR);
                    $query->bindParam(':id', $id, PDO::PARAM_INT);
                    $query->execute();
                }
            }

            foreach ($new_genre as $genreItem) {
                if (!in_array($genreItem, $old_genre)) {
                    $obj = new Genre();
                    $obj->handle([$genreItem], $id);

                }
            }

            foreach ($old_genre as $genreItem) {
                if (!in_array($genreItem, $new_genre)) {
                    $obj = new Genre();
                    $genre_id = $obj->getId($genreItem);

                    $obj2 = new BooksGenres();
                    $obj2->delete($id, $genre_id);
                }
            }

            foreach ($new_authors as $authorItem) {
                if (!in_array($authorItem, $old_authors)) {
                    $obj = new Author();
                    $obj->handle([$authorItem], $id);
                }
            }

            foreach ($old_authors as $authorItem) {
                if (!in_array($authorItem, $new_authors)) {
                    $obj = new Author();
                    $author_id = $obj->getId($authorItem);

                    $obj2 = new BooksAuthors();
                    $obj2->delete($id, $author_id);
                }
            }
        }
    }

    public function delete($id){
        $query = $this->connection->prepare("DELETE FROM books WHERE book_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }
}
