<footer id="footer">
    <!-- container -->
    <div class="container">
        <?php get_sidebar($sidebar_bottom ?? 'bottom'); ?>

        <!-- row -->
        <div class="footer-bottom row">
            <div class="col-md-6 col-md-push-6">
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'bottom',
                        'container'  => null,
                        'item_wrap'  => '<ul>%3$s</ul>',
                        'menu_class' => 'footer-nav',
                        'menu_id'    => '',
                    ]
                ); ?>
            </div>
            <div class="col-md-6 col-md-pull-6">
                <div class="footer-copyright">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</footer>
<?php wp_footer(); ?>
</body>

</html>