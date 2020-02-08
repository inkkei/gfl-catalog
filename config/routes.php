<?php
/**
 * Created by PhpStorm.
 * User: Demid
 * Date: 26.01.2020
 * Time: 22:11
 */

return [
    'author/create-form' => 'author/createForm',
    'author/create' => 'author/create',
    'author/delete/([0-9]+)' => 'author/delete/$1',
    'author/update' => 'author/update',
    'author/([0-9]+)' => 'author/view/$1',
    'authors' => 'author/index',
    'genre/create-form' => 'genre/createForm',
    'genre/create' => 'genre/create',
    'genre/delete/([0-9]+)' => 'genre/delete/$1',
    'genre/update' => 'genre/update',
    'genre/([0-9]+)' => 'genre/view/$1',
    'genres' => 'genre/index',
    'create-form' => 'book/createForm',
    'update' => 'book/update',
    'delete/([0-9]+)' => 'book/delete/$1',
    'create' => 'book/create',
    'edit/([0-9]+)' => 'book/view/$1',
    'admin' => 'book/index',
    'order' => 'site/order',
    'view/([0-9]+)' => 'site/view/$1',
    ''=>'site/index',

];

