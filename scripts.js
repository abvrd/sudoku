$(document).ready(function () {
    $("#autoCheck").prop('checked', '');
    
    //load and set the grid
    $.ajax({
        url: 'process.php?action=display',
        dataType: 'json',
        success: function (data) {
            var result = '';
            for (var i = 0; i < data.length; i++) {
                var row = '<tr>';
                if (i % 3 === 2)
                    row = '<tr class="cell-border-bottom">';
                for (var j = 0; j < data[i].length; j++) {
                    var cell = '<td>';
                    if (j % 3 === 2)
                        cell = '<td class="cell-border-right">';
                    var value = data[i][j];
                    if (value === 0) {
                        value = '<input type="text">';
                    } else {
                        value = '<span class="cells">' + value + '</span>';
                    }
                    row += cell + value + '</td>';
                }
                row += '</tr>';
                result += row;
            }
            $('#sudoku').html(result);
            $('#sudoku input:text').on('focus', function () {
                $(this).css({color: 'black'});
            });
        }
    });

    /**
     * Get the solution and fill it into the grid
     */
    $('#soluce').on('click', function () {
        $.ajax({
            url: 'process.php?action=solve',
            dataType: 'json',
            success: function (data) {
                var i = 0;
                $("#sudoku input[type=text]").each(function () {
                    $(this).val(data[i]).css({color: 'blue'});
                    i++;
                });
            }
        });
    });

    /**
     * Submit the inputs and compare with solution
     */
    $('#validate').on('click', function () {
        $.ajax({
            url: 'process.php?action=solve',
            dataType: 'json',
            success: function (data) {
                var i = 0;
                $("#sudoku input[type=text]").each(function () {
                    var current = $(this).val();
                    if (current == '') {
                        $(this).val(data[i]).css({color: 'red'});
                    } else if (current != data[i]) {
                        $(this).css({color: 'red'});
                    } else {
                        $(this).val(data[i]).css({color: 'green'});
                    }
                    i++;
                });
            }
        });
    });

    /**
     * Clear the inputs.
     */
    $('#reset').on('click', function () {
        $("#sudoku input[type=text]").each(function () {
            $(this).val('');
        });
    });

    $("#autoCheck").on('click', function () {
        var checked = $(this).prop('checked');
        if (checked) {
            //adding control on user input if auto check is checked
            $('#sudoku input[type=text]').on('blur', function () {
                var value = $(this).val();
                var row = $(this).closest('tr').index();
                var column = $(this).closest('td').index();

                var error = '';
                if (!checkRow(value, row, column)) {
                    error = 'Number already present in the row.<br>';
                }
                if (!checkColumn(value, column, row)) {
                    error += 'Number already present in the column.<br>';
                }
                if (!checkArea(value, row, column)) {
                    error += 'Number already present in the block.<br>';
                }
                if(error !== '') {
                    $("#modal .modal-body p").html(error);
                    $('#modal').modal();
                }
            });
        } else {
            //remove even handler 
            $('#sudoku input[type=text]').off('blur');
        }
    });
});

/**
 * Check if a number is already in its row
 * @returns {Boolean}
 */
function checkRow(value, row, column) {
    var row = $("#sudoku tr").eq(row);
    var check = [];
    row.find('td').each(function () {
        var td = $(this);
        if (td.index() != column) {
            var input = td.find('input:text').val();
            if (input !== undefined && input !== '') {
                check.push(parseInt(input));
            } else if (td.find('span').text() !== '') {
                check.push(parseInt(td.find('span').text()));
            }
        }
    });
    row.find('td span').each(function () {
        if ($(this).text() !== '') {
            check.push(parseInt($(this).text()));
        }
    });

    if ($.inArray(parseInt(value), check) !== -1) {
        return false;
    } else {
        return true;
    }
}

/**
 * Check if a number is already in its column
 * @returns {Boolean}
 */
function checkColumn(value, column, row) {
    var check = [];
    $("#sudoku tr").each(function () {
        if ($(this).index() != row) {
            var td = $(this).find('td').eq(column);
            var input = td.find('input:text').val();
            if (input !== undefined && input !== '') {
                check.push(parseInt(input));
            } else if (td.find('span').text() !== '') {
                check.push(parseInt($(this).find('td span').eq(column).text()));
            }
        }
    });
    if ($.inArray(parseInt(value), check) !== -1) {
        return false;
    } else {
        return true;
    }
}

/**
 * Check if a number is already in its area
 * @returns {Boolean}
 */
function checkArea(value, row, column) {
    var check = [];
    var start_row = row - row % 3;
    var start_column = column - column % 3;
    var limit_row = start_row + 3;
    var limit_column = start_column + 3;

    for (var i = start_row; i < limit_row; i++) {
        for (var j = start_column; j < limit_column; j++) {
            if (i != row && j != column) {
                var td = $("#sudoku tr").eq(i).find('td').eq(j);
                var input = td.find('input:text').val();
                //check if it's an input or default number
                if (input !== undefined && input !== '') {
                    check.push(parseInt(input));
                } else if (td.find('span').text() !== '') {
                    check.push(parseInt(td.find('span').text()));
                }
            }
        }
    }
    if ($.inArray(parseInt(value), check) !== -1) {
        return false;
    } else {
        return true;
    }
}