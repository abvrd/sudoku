<?php

require_once 'collection.php';

/**
 * Description of Sudoku
 *
 * @author abvrd
 */
class Sudoku {

    private $grid = array();
    private $grid_init = array();
    private $priorities;
    private $size = 9;

    public function __construct($grid, $size = 9) {
        $this->priorities = new Collection();
        $this->grid = $this->grid_init = $grid;
        $this->size = $size;
    }

    /**
     * Check if a value is already present on the given column
     * @param int $value
     * @param int $column
     * @return boolean
     */
    public function checkColumn($value, $column) {
        if (($column - 1) >= $this->size) {
            return false;
        }
        for ($i = 0; $i < count($this->grid); $i++) {
            if ($this->grid[$i][$column] === $value) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if a value is already present on the given row
     * @param int $value
     * @param int $row
     * @return boolean
     */
    public function checkRow($value, $row) {
        for ($i = 0; $i < count($this->grid[$row]); $i++) {
            if ($this->grid[$row][$i] === $value) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if a value is already present on the given area/block
     * @param int $value
     * @param int $row
     * @param int $column
     * @return boolean
     */
    public function checkArea($value, $row, $column) {
        //delimit the area to loop through
        $limit = sqrt($this->size);
        //start from
        $_i = $row - $row % $limit;
        $_j = $column - $column % $limit;
        //limit
        $_iLimit = $_i + $limit;
        $_jLimit = $_j + $limit;

        for ($i = $_i; $i < $_iLimit; $i++) {
            for ($j = $_j; $j < $_jLimit; $j++) {
                if ($this->grid[$i][$j] === $value) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Check the number of possible values for the cell
     * @param int $row
     * @param int $column
     * @return int
     */
    public function checkPossibleValues($row, $column) {
        $result = 0;
        for ($k = 0; $k < $this->size; $k++) {
            if ($this->checkRow($k, $row) && $this->checkColumn($k, $column) && $this->checkArea($k, $row, $column)) {
                $result++;
            }
        }
        return $result;
    }

    /**
     * Set a collection sort by asc of cells to process on the sudoku (empty ones)
     */
    public function checkPriorities() {
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                if ($this->grid[$i][$j] === 0) {
                    $this->priorities->addItem($this->checkPossibleValues($i, $j), $i, $j);
                }
            }
        }
        $this->priorities->sortCollection();
    }

    /**
     * Bactracking process to fill the sudoku
     * @param array $item
     * @return boolean
     */
    public function resolve($item) {
        // limit of the grid, nothing else to process
        if ($item === NULL) {
            return true;
        }
        $row = $item["row"];
        $column = $item["column"];

        for ($k = 1; $k <= $this->size; $k++) {
            //global check for the value
            if ($this->checkRow($k, $row) && $this->checkColumn($k, $column) && $this->checkArea($k, $row, $column)) {
                $this->grid[$row][$column] = $k;
                if ($this->resolve($this->priorities->nextItem())) {
                    return true;
                } else {
                    //reset the iterator to the current position to process
                    $this->priorities->previousItem();
                }
            }
        }
        //the cell is still to be processed, reset value
        $this->grid[$row][$column] = 0;
        return false;
    }

    /**
     * Launch sudoku process
     */
    public function process() {
        $this->checkPriorities();
        $this->resolve($this->priorities->getItem(0));
    }
    
    /**
     * Get a collection of results linearly
     * @return array
     */
    public function solution() {
        $this->checkPriorities();
        $this->resolve($this->priorities->getItem(0));
        $results = array();
        
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                if ($this->grid_init[$i][$j] === 0) {
                    $results[] = $this->grid[$i][$j];
                }
            }
        }
        return $results;
    }
    
    /**
     * Display the sudoku grid
     */
    public function display() {
        for ($i = 0; $i < count($this->grid); $i++) {
            for ($j = 0; $j < count($this->grid[$i]); $j++) {
                $position = $j + 1;
                $res = $this->grid[$i][$j];
                if ($res === 0)
                    $res = '.';
                if ($position % 9 === 0) {
                    echo $res . '<br>';
                } else if ($position % 3 === 0) {
                    echo $res . ' | ';
                } else {
                    echo $res . ' ';
                }
            }
            if (($i + 1) % 3 === 0) {
                echo "- - - - - - - - -<br>";
            }
        }
    }

}
