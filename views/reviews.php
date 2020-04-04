<?php $reviews = callie_get_reviews(); ?>
<? foreach ($reviews as $review) : ?>
    <blockquote class="blockquote">
        <p><?php echo $review->post_content ?></p>
        <footer class="blockquote-footer"><?php echo $review->post_title ?></footer>
    </blockquote>
<? endforeach; ?>