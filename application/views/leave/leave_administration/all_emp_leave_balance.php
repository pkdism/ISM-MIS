<?php

/* 
 * Author :- Nishant Raj
 */
$ui = new UI();

    $table = $ui->table()->hover()->bordered()->sortable()->searchable()->paginated()->open();
    
    $table->close();

