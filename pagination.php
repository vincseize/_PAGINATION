<?php
    $pgn_paramRes  = 'n_result';
?>
<select id="select_ANYID" id="select_ANYNAME" class="<?php echo $n_result;?>" data-pgn="<?php echo $n_result;?>">
    <?php
        foreach($n_results_array as $result){
            $selected = '';
            if($result==$pgn_limit){$selected=' selected';}
            echo "<option value='$result' $selected>$result</option>";
        }
    ?>
</select>
<br>
<!-- ------------------------------- PAGINATION -->
<?php              
    // VARS
    $pgn_dfltLimit = 15;
    $pgn_rCount    = rows_count($pdo, $table);
    $pgn_paramPage = 'page';
    $pgn_paramRes  = $pgn_paramRes;
    $pgn_nBtns     = 4;
    $pgn_ics       = array("icon_before"=>"&#60;","icon_etc"=>"...","icon_next"=>"&#62;");
    // DONT TOUCH
    $pgn_page      = (isset($_GET[$pgn_paramPage])) ? $_GET[$pgn_paramPage] : 1;
    if (isset($_GET[$pgn_paramRes])) {$pgn_dfltLimit = $_GET[$pgn_paramRes];}
    // Let's go
    new Pagination($pgn_page,$pgn_dfltLimit,$pgn_rCount,$pgn_nBtns,$pgn_ics,$pgn_paramPage,$pgn_paramRes);        
?>
<script src="pgn.js"></script>
<!-- ------------------------------- PAGINATION -->