<?php
require_once ROOT . '/admin/models/Book.php';
require_once ROOT . '/components/Render.php';

class GenreController{
    public function actionIndex(){
        $genre = new Genre();
        $genreData = $genre->getAll();

        render('admin', 'genre/index', $genreData);
        return 1;
    }

    public function actionView($id){
        $genre = new Genre();
        $row = $genre->getOne($id);

        render('admin','genre/view', $row);
        return 1;
    }

    public function actionCreateForm(){
        render('admin','genre/create');
        return 1;
    }

    public function actionCreate(){
        $genre = new Genre();
        $id = $genre->insert($_POST['genre_title']);

        $row = $genre->getOne($id);

        render('admin','genre/view', $row);
        return 1;
    }

    public function actionUpdate(){
        $genre = new Genre();
        $genre->update($_POST);

        $genreData = $genre->getAll();
        render('admin', 'genre/index', $genreData);
        return 1;
    }

    public function actionDelete($id){
        $genre = new Genre();
        $genre->delete($id);

        $genreData = $genre->getAll();
        render('admin', 'genre/index', $genreData);
        return 1;
    }

    public function actionError(){
        render('admin','error');
        return 1;
    }

}

?>

