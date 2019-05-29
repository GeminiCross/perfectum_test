<?php
require 'sort.php';
$task = new taskClass();
foreach ($task->array_sort() as $item) {
    echo $item[0] . ' - ' . ($item[1] + $item[2]) . '<br>';
}