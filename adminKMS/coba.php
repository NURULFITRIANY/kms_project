<!DOCTYPE html>
    <head>
        <title>PHP Pagination</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
                <div class="col-md-10 col-md-offset-1">
                <h1>PHP Pagination</h1>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
								        <tr>
								                <td><?php echo $results->data[$i]['Name']; ?></td>
								                <td><?php echo $results->data[$i]['Country']; ?></td>
								                <td><?php echo $results->data[$i]['Continent']; ?></td>
								                <td><?php echo $results->data[$i]['Region']; ?></td>
								        </tr>
								<?php endfor; ?>
                        </tr>
                        </thead>
                        <tbody></tbody>
                </table>
                </div>
        </div>
        </body>
</html>