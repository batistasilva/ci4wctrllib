<?php

if($featured_pages):

    foreach ($featured_pages as $page):
        ?>
        <div class="featured_page">
            <h2 class="page-header"><?php echo $page->title; ?></h2>
            <?php echo $page->body; ?>
        </div>




<?php
    endforeach;
endif; ?>
