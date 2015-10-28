<?php

require_once 'sudoku.php';

$grid = array(
    array(0, 1, 9, 0, 6, 0, 0, 8, 5),
    array(0, 0, 0, 0, 3, 4, 0, 0, 0),
    array(0, 2, 0, 5, 0, 0, 1, 0, 0),
    array(0, 0, 8, 0, 5, 0, 0, 1, 3),
    array(5, 3, 7, 0, 9, 0, 4, 2, 6),
    array(2, 6, 0, 0, 4, 0, 9, 0, 0),
    array(0, 0, 4, 0, 0, 5, 0, 3, 0),
    array(0, 0, 0, 3, 7, 0, 0, 0, 0),
    array(8, 5, 0, 0, 1, 0, 2, 7, 0),
);

$action = filter_input(INPUT_GET, 'action' ,FILTER_SANITIZE_STRING);
if(isset($action)){
    $sudoku = new Sudoku($grid);
    switch ($action) {
        case 'display':
            echo json_encode($grid);
            break;
        case 'solve':
            echo json_encode($sudoku->solution());
            break;
        default:
            echo json_encode($grid);
    }  
}
