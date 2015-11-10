# Sudoku
A PHP sudoku resolver

PHP, Bootstrap

Installation
-----------

Works under a simple web server processing PHP like Apache or Nginx.
index.php is the main resource.
```ruby
git clone https://github.com/abvrd/sudoku.git
```

Usage
-----

You can change the grid by setting different defaults values in process.php.
```ruby
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
```


