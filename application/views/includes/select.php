<?php

if(@$unique!='unique')
    echo '<option value="0">SELECCIONE...</option>';

foreach($arr as $row)
    echo '<option value="'.$row->$tag['id'].'">'.$row->$tag['name'].'</option>';

?>
