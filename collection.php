<?php

/**
 * A collection representing values/cell to process for the sudoku
 *
 * @author abvrd
 */
class Collection {

    private $items = array();
    private $iterator = 0;

    public function addItem($number, $row, $column) {
        $obj = array(
            "possibleValues" => $number,
            "row" => $row,
            "column" => $column
        );
        $this->items[] = $obj;
    }

    public function getItem($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            return NULL;
        }
    }

    public function nextItem() {
        ++$this->iterator;
        if (isset($this->items[$this->iterator])) {
            return $this->items[$this->iterator];
        } else {
            return NULL;
        }
    }
    
    public function previousItem() {
        --$this->iterator;
        if (isset($this->items[$this->iterator])) {
            return $this->items[$this->iterator];
        } else {
            return NULL;
        }
    }
    
    public function cmp($a, $b) {
        return ($a["possibleValues"] < $b["possibleValues"]) ? -1 : 1;
    }

    public function sortCollection() {
        usort($this->items, array($this, "cmp"));
    }

    public function getItems() {
        return $this->items;
    }

}
