<?php
require_once ROOT . '/admin/models/Book.php';
require_once ROOT . '/components/Render.php';

class BookController{
    public function actionIndex(){
        $book = new Book();
        $books = $book->getAll();

        render('admin', 'index', $books);
        return 1;
    }

    public function actionView($id){
        $book = new Book();
        $book_row = $book->getOne($id);
        $book_row['genre'] = array_map('trim', explode(",", $book_row['genre']));
        $book_row['authors'] = array_map('trim', explode(",", $book_row['authors']));

        $genre = new Genre();
        $genres = $genre->getAll();

        $author = new Author();
        $authors = $author->getAll();

        render('admin','view', ['info' => $book_row, 'genres' => $genres, 'authors' => $authors]);
        return 1;
    }

    public function actionCreateForm(){
        $genre = new Genre();
        $genres = $genre->getAll();

        $author = new Author();
        $authors = $author->getAll();

        render('admin','create', ['genres' => $genres, 'authors' => $authors]);
        return 1;
    }

    public function actionCreate(){
        $book = new Book();
        $book->add($_POST);

        $books = $book->getAll();
        render('admin', 'index', $books);
        return 1;
    }

    public function actionUpdate(){
        $book = new Book();
        $book->update($_POST);

        $books = $book->getAll();
        render('admin', 'index', $books);
        return 1;
    }

    public function actionDelete($id){
        $book = new Book();
        $book->delete($id);

        $books = $book->getAll();
        render('admin', 'index', $books);
        return 1;
    }

    public function actionError(){
        render('admin','error');
        return 1;
    }

}

?>

