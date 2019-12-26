<?php

    require "pgn_pdo.class.php";
    require "pgn.class.php";

    // VARS TABLE
    $database        = 'booking_vuejs';
    $table           = 'clients';
    $n_results_array = ['5','10','15','25','50']; 
    $pgn_limit       = 15;          // !Important same as $pgn_dfltLimit value as in pagination.php
    $pgn_paramPage   = 'page';      // !Important same value as in pagination.php
    $pgn_paramRes    = 'n_result';  // !Important same value as in pagination.php

    function select_table($pdo, $table, $limit_start, $pgn_limit){
        $sth = $pdo->prepare("SELECT * FROM $table ORDER by id DESC LIMIT ".$limit_start.",".$pgn_limit);
        $sth->execute(); 
        return $sth;
    }

    function table_fields($pdo, $table){
        $sth = $pdo->prepare("DESCRIBE $table");
        $sth->execute();
        $table_fields = $sth->fetchAll(PDO::FETCH_COLUMN);
        return $table_fields;
    }

    function rows_count($pdo, $table){
        $sth = $pdo->prepare("SELECT COUNT(*) AS result FROM $table");
        $sth->execute(); 
        $rows = $sth->fetch();
        return $rows['result'];
    }

    // TABLE
    $pdo = new PDOConfig($database);

    $table_fields = table_fields($pdo, $table);

    if(isset($_GET[$pgn_paramRes])){$pgn_limit = $_GET[$pgn_paramRes]; }
    $pgn_page = (isset($_GET[$pgn_paramPage])) ? $_GET[$pgn_paramPage] : 1;
    $limit_start = ($pgn_page - 1) * $pgn_limit;
    $datas = select_table($pdo, $table, $limit_start, $pgn_limit);
    $pgn_rCount = rows_count($pdo, $table);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <mta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagination dengan PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
    <style>
        .align-middle {
            vertical-align: middle !important;
        }
        .navbar{
            border-radius: 0 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" style="color: white;"><b>Pagination</b></a>
            </div>
        </div>
    </nav>
    <div style="padding: 0 15px;">
        <div class="table-responsive">

            <!-- ------------------------------- PAGINATION -->
            <?php              
                require 'pagination.php';
            ?>
            <!-- ------------------------------- PAGINATION -->

            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th class="text-center"><?php echo $pgn_rCount;?></th>
                    <?php
                        foreach($table_fields as $field){
                            echo "<th>$field</th>";
                        }
                    ?>
                </tr>

                <?php
                $no = $limit_start + 1; 
                while ($data = $datas->fetch()) { 
                ?>
                    <tr>
                        <td class="align-middle text-center"><?php echo $no; ?></td>
                        <?php
                            foreach($table_fields as $field){
                                echo "<td class='align-middle'>$data[$field]</td>";
                            }
                        ?>
                    </tr>
                <?php
                $no++; 
                }
                ?>

            </table>

        </div>
        <!-- ------------------------------- PAGINATION -->
        <?php              
            require 'pagination.php';
        ?>
        <!-- ------------------------------- PAGINATION -->
    </div>
</body>
</html>