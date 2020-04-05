<?php get_header(); ?>

<!-- ALL POSTS SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :
                        the_post();
                        $cities = get_the_terms($post->ID, 'city');
                    ?>
                        <div class="post post-row">
                            <a class="post-img" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('jobs-thumb'); ?>
                            </a>
                            <div class="post-body">
                                <div class="post-category">
                                    <? foreach ($cities as $city) : ?>
                                        <a href="<?php echo get_term_link((int) $city->term_id); ?>" rel="city">
                                            <?php echo $city->name; ?>
                                        </a>
                                    <? endforeach; ?>
                                </div>
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?> – <span class="jobs-company">
                                            <?php echo CFS()->get('company') ?>
                                        </span>
                                    </a>
                                </h3>
                                <ul class="post-meta">
                                    <li><?php echo CFS()->get('salary'); ?></li>
                                    <li><?php echo get_the_date(); ?></li>
                                </ul>
                                <p></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Записей нет</p>
                <?php endif; ?>
            </div>
            <?php get_sidebar('jobs-aside'); ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /ALL POSTS SECTION -->

<?php get_footer('jobs'); ?>