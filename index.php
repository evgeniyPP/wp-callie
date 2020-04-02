<?php get_header(); ?>

<!-- ALL POSTS SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="post post-row">
                            <a class="post-img" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                            <div class="post-body">
                                <div class="post-category">
                                    <?php the_category(); ?>
                                </div>
                                <h3 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <ul class="post-meta">
                                    <li><a href="author.html"><?php the_author(); ?></a></li>
                                    <li><?php the_date(); ?></li>
                                </ul>
                                <p><?php echo CFS()->get('intro') ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Записей нет</p>
                <?php endif; ?>

                <!-- <div class="section-row loadmore text-center">
                    <a href="#" class="primary-button">Load More</a>
                </div> -->
            </div>
            <?php get_sidebar(); ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /ALL POSTS SECTION -->

<?php get_footer(); ?>