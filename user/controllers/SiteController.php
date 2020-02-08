<?php
require_once ROOT . '/user/models/Book.php';
require_once ROOT . '/components/Render.php';

class SiteController{
    public function actionIndex(){
        $book = new Book();
        $catalogData = $book->getAllData();

        render('user','index', $catalogData);
        return 1;
    }

    public function actionView($id){
        $book = new Book();
        $current_data = $book->getOne($id);

        render('user','view', $current_data);
        return 1;
    }

    public function actionError(){
        render('user', 'error');
        return 1;
    }

    public function actionOrder(){
        $data = json_decode($_POST['data'], true);
        $book = new Book();
        $book->sendMail($data);

        return 1;
    }

}

?>

