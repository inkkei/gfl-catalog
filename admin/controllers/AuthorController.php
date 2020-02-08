<?php
require_once ROOT . '/admin/models/Book.php';
require_once ROOT . '/components/Render.php';

class AuthorController{
    public function actionIndex(){
        $author = new Author();
        $authorData = $author->getAll();

        render('admin', 'author/index', $authorData);
        return 1;
    }

    public function actionView($id){
        $author = new Author();
        $row = $author->getOne($id);

        render('admin','author/view', $row);
        return 1;
    }

    public function actionCreateForm(){
        render('admin','author/create');
        return 1;
    }

    public function actionCreate(){
        $author = new Author();
        $id = $author->insert($_POST['author_name']);

        $row = $author->getOne($id);
        render('admin','author/view', $row);
        return 1;
    }

    public function actionUpdate(){
        $author = new Author();
        $author->update($_POST);

        $authorsData = $author->getAll();
        render('admin', 'author/index', $authorsData);
        return 1;
    }

    public function actionDelete($id){
        $author = new Author();
        $author->delete($id);

        $authors = $author->getAll();
        render('admin', 'author/index', $authors);
        return 1;
    }

    public function actionError(){
        render('admin','error');
        return 1;
    }

}

?>

