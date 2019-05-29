<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <div class="col-8 center-block">
        <?php foreach($currencies as $currency) { ?>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?=$currency->exchange_c?></h5>
                    <small class="text-muted"><?=$currency->timestamp?></small>
                </div>
                <p class="mb-1">Покупка: <span class="font-weight-bold"><?=$currency->bid?></span></p>
                <p class="mb-1">Продажа: <span class="font-weight-bold"><?=$currency->ask?></span></p>
            </a>
        <?php } ?>
    </div>
</div>
