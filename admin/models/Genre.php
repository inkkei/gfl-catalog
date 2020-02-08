<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 20:51
 */

require_once ROOT. '/admin/models/BooksGenres.php';

class Genre {
    private $connection;
    public function __construct(){
        $database = new Database();
        $this->connection = $database->dbConnection();
}

    // Define relationship between book <-> author
    public function handle($genre, $lastBookId) {
        $booksGenres = new BooksGenres();

        foreach ($genre as $newGenre) {
            $genre_id = $this->getId($newGenre);
            $booksGenres->insert($lastBookId, $genre_id);
        }
    }

    // Return array of all the genres
    public function getAll(){
        $query = "SELECT * FROM genre ORDER BY genre_title";
        $query = $this->connection->query($query);
        $allGenres = array();
        while($genre = $query->fetch(PDO::FETCH_ASSOC)){
            $allGenres[$genre['genre_id']] = $genre['genre_title'];
        }
        return $allGenres;
    }

    // Return a genre by ID
    public function getOne($id){
        $query = $this->connection->prepare("SELECT * FROM genre WHERE genre_id = ?");
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($data){
        if($data){
            $id = $data['genre_id'];
            $genre_title = $data['genre_title'];

            $query = $this->connection->prepare("UPDATE genre SET genre_title = :value WHERE genre_id = :id");
            $query->bindParam(':value', $genre_title, PDO::PARAM_INT);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        }
    }

    public function delete($id){
        $query = $this->connection->prepare("DELETE FROM genre WHERE genre_id = :id");
        $query->bindValue(':id', $id);
        $query->execute();
    }

    public function getId($genre){
        $query = $this->connection->prepare("SELECT genre_id FROM genre WHERE genre_title = ?");
        $query->bindParam(1, $genre);
        $query->execute();
        $result = $query->fetch();
        return $result['genre_id'];
    }

    // Add a new row to genre table, return ID of this row
    public function insert($title){
        $title = trim($title);
        $query = $this->connection->prepare("INSERT INTO genre (genre_title) VALUES (?)");
        $query->bindParam(1, $title);
        $query->execute();

        $query = $this->connection->prepare("SELECT genre_id FROM genre ORDER BY genre_id DESC LIMIT 1");
        $query->execute();
        $id = $query->fetch(PDO::FETCH_ASSOC);

        return $id['genre_id'];
    }

}
