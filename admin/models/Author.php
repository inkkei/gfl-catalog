<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 20:51
 */

require_once ROOT. '/admin/models/BooksAuthors.php';

class Author {
    private $connection;
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
}

    // Define relationship between book <-> author
    public function handle($author, $lastBookId) {
        $booksAuthors = new BooksAuthors();

        foreach ($author as $newAuthor) {
            $author_id = $this->getId($newAuthor);
            $booksAuthors->insert($lastBookId, $author_id);
        }
    }

    // Return array of all the authors
    public function getAll(){
        $query = "SELECT * FROM authors ORDER BY author_name";
        $query = $this->connection->query($query);
        $allAuthorsArray = array();
        while($author = $query->fetch(PDO::FETCH_ASSOC)){
            $allAuthorsArray[$author['author_id']] = $author['author_name'];
        }
        return $allAuthorsArray;
    }

    // Return an author by ID
    public function getOne($id){
        $query = $this->connection->prepare("SELECT * FROM authors WHERE author_id = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($data){
        if($data){
            $id = $data['author_id'];
            $author_name = $data['author_name'];

            $query = $this->connection->prepare("UPDATE authors SET author_name = :value WHERE author_id = :id");
            $query->bindParam(':value', $author_name, PDO::PARAM_INT);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        }
    }

    public function delete($id){
        $query = $this->connection->prepare("DELETE FROM authors WHERE author_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }

    // Add a new row to authors table, return ID of this row
    public function insert($name)
    {
        $query = $this->connection->prepare("INSERT INTO authors (author_name) VALUES (?)");
        $query->execute([$name]);

        $query = $this->connection->prepare("SELECT author_id FROM authors ORDER BY author_id DESC LIMIT 1");
        $query->execute();
        $id = $query->fetch(PDO::FETCH_ASSOC);

        return $id['author_id'];
    }

    // Return author's ID by author's name
    public function getId($author){
        $query = $this->connection->prepare("SELECT author_id FROM authors WHERE author_name = ?");
        $query->bindParam(1, $author);
        $query->execute();
        $result = $query->fetch();
        return $result['author_id'];
    }
}
