<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">Валюта</th>
        <th scope="col">Продажа</th>
        <th scope="col">Покупка</th>
        <th scope="col">Дата</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($history as $rate) { ?>
        <tr>
            <td><?=$rate->exchange_c?></td>
            <td><?=$rate->ask?></td>
            <td><?=$rate->bid?></td>
            <td><?=$rate->timestamp?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
