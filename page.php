<?php get_header(); ?>
<?php the_post(); ?>

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <div class="section-row">
                    <div class="section-title">
                        <h2 class="title"><?php the_title(); ?></h2>
                    </div>
                    <div>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<?php get_footer(); ?>