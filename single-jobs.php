<?php
get_header();
the_post();
$cities = get_the_terms($post->ID, 'city');
?>

<!-- PAGE HEADER -->
<div class="jobs-single-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="post-category">
                    <? foreach ($cities as $city) : ?>
                        <a href="<?php echo get_term_link((int) $city->term_id); ?>" rel="city">
                            <?php echo $city->name; ?>
                        </a>
                    <? endforeach; ?>
                </div>
                <h1>
                    <?php the_title(); ?> – <span class="jobs-company">
                        <?php echo CFS()->get('company') ?>
                    </span>
                </h1>
                <ul class="post-meta">
                    <li><?php echo CFS()->get('salary'); ?></li>
                    <li><?php echo get_the_date(); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /PAGE HEADER -->
</header>
<!-- /HEADER -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <!-- post content -->
                <div class="section-row">
                    <?php the_post_thumbnail('jobs-thumb'); ?><br />
                    <?php the_content(); ?>
                </div>
                <!-- /post content -->

                <!-- post tags -->
                <div class="section-row">
                    <div class="post-tags">
                        <?php the_tags(); ?>
                    </div>
                </div>
                <!-- /post tags -->

                <!-- post nav -->
                <div class="section-row">
                    <div class="post-nav">
                        <? if (get_previous_post()) : ?>
                            <div class="prev-post">
                                <?php previous_post_link('<strong>%link</strong>'); ?>
                                <p>Предыдущая вакансия</p>
                            </div>
                        <? endif; ?>

                        <? if (get_next_post()) : ?>
                            <div class="next-post">
                                <?php next_post_link('<strong>%link</strong>'); ?>
                                <p>Следующая вакансия</p>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <!-- /post nav  -->
            </div>
            <?php get_sidebar('jobs-aside'); ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php get_footer('jobs'); ?>