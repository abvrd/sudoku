<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sudoku solver</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Sudoku processor</h3>
            </div>
            <div class="jumbotron">
                <h1>Solving sudoku with PHP</h1>
                <p class="lead">A simple PHP class and script which process a grid of sudoku and solve it through recursion. Basic JQuery and Twitter Bootstrap front view for displaying what you're reading.</p>
                <p style="text-align: center;"><a target="_blank" class="btn btn-lg btn-warning" href="http://www.google.com/recaptcha/mailhide/d?k=01nNnLtHmI-4DHvrmqYYQnJQ==&c=IK-9Y86wp4pX8eP7ZoMKn-oHijSaRFFfELoL5mHLh0w=" role="button">Contact me</a></p>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <table id="sudoku" class="table table-bordered table-condensed table-responsive"></table>
                </div>
                <div class="col-lg-4" id="actions">
                    <button id="reset" type="button" class="btn btn-default">Reset</button>
                    <button id="soluce" type="button" class="btn btn-danger">Solution</button>
                    <button id="validate" type="button" class="btn btn-primary">Validate</button>
                    <div class="checkbox">
                        <label>
                            <input id="autoCheck" type="checkbox"> Auto check
                        </label>
                    </div>
                </div>
            </div>

            <div id="modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Warning</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                <p></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="scripts.js"></script>
    </body>
</html>
