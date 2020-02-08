<?php

function render($dir, $template, $data = 0){
    $path = ROOT . '/' . $dir . '/views/' . $template . '.php';
    include $path;
}


/*function render($dir, $template, $data = 0)
{
    $path = ROOT . '/' . $dir . '/views/' . $template . '.php';
    switch ($template) {
        case 'view':
            $genres = array_shift($data);
            $data = array_shift($data);
            include $path;
            break;
        default:
            include $path;
            break;
    }
}*/

?>
