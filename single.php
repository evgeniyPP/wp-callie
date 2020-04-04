<?php get_header(); ?>
<?php the_post(); ?>

<!-- PAGE HEADER -->
<div id="post-header" class="page-header">
    <div class="page-header-bg" style="background-image: url(<?= get_the_post_thumbnail_url(null, 'full'); ?>); background-repeat: no-repeat; background-size: cover;" data-stellar-background-ratio="0.5"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="post-category">
                    <?php the_category(); ?>
                </div>
                <h1><?php the_title(); ?></h1>
                <ul class="post-meta">
                    <li><?php the_author(); ?></li>
                    <li><?php the_date(); ?></li>
                    <li><i class="fa fa-comments"></i><?= get_comments_number() ?></li>
                    <!-- <li><i class="fa fa-eye"></i> 807</li> -->
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
                                <p>Предыдущий пост</p>
                            </div>
                        <? endif; ?>

                        <? if (get_next_post()) : ?>
                            <div class="next-post">
                                <?php next_post_link('<strong>%link</strong>'); ?>
                                <p>Следующий пост</p>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <!-- /post nav  -->
            </div>
            <?php get_sidebar(); ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php get_footer(); ?>