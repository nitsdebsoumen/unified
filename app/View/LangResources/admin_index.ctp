<?php
$customHelper = $this->Helpers->load('Lang');
$from = '"';
$to = '"';
?>

<div class="lang_resources form">
    <form action="<?php echo $this->webroot; ?>admin/lang_resources/index" method='post'>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>En</th>
                    <!-- <th>Es</th> -->
                </tr>
            </thead>
            <tbody>

                    <?php
                    //$page=SITE_URL."administrator/includes/lang/sp.php";

                    $enpath = WWW_ROOT . "lang/en.php";                    
                    $enlines = file($enpath); //file in to an array
                    $frpath = WWW_ROOT . "lang/sp.php";
                    $frlines = file($frpath); //file in to an array

                    //pr($enlines);
                    //pr($frlines);
                    
                    $noofitem = count($enlines);

                    for ($no = 1; $no <= $noofitem; $no++) {
                        if (strpos($enlines[$no], '//') !== false) {
                            echo '<tr><td><label>' . $no . '<label></td><td colspan="3">CommentLine</td></tr>';
                        } elseif (strpos($enlines[$no], '?>') !== false) {
                            break;
                        } else {
                            echo '<tr>';
                            echo '<td><label>' . $no . '<label></td>';
                            echo '<td><input type="text" name="en_' . $no . '" value="' . $customHelper->getStringBetween($enlines[$no], $from, $to) . '" size="50"></td>';
                            //echo '<td><input type="text" name="fr_' . $no . '" value="' . $customHelper->getStringBetween($frlines[$no], $from, $to) . '" size="50"></td>';

                            //echo '</tr>';
                        }
                    }
                    ?>

                <tr>
                    <td colspan="3">
                        <input type="submit" class="btn btn-primary" value="Save" name="submit">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php //echo($this->element('admin_sidebar'));?>
