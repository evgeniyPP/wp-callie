<?php

/**
 * Core class used to implement a Recent Posts widget.
 */
class Callie_Widget_Recent_Posts extends WP_Widget
{
    /**
     * Sets up a new Recent Posts widget instance.
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'widget_recent_entries',
            'description'                 => 'Свежие посты в верстке Callie',
            'customize_selective_refresh' => true,
        );
        parent::__construct('callie-recent-posts', 'Последние записи (Callie)', $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget($args, $instance)
    {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts');

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number) {
            $number = 5;
        }

        /**
         * Filters the arguments for the Recent Posts widget.
         *
         * @param array $args     An array of arguments used to retrieve the recent posts.
         * @param array $instance Array of settings for the current widget.
         */
        $r = new WP_Query(
            apply_filters(
                'widget_posts_args',
                array(
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ),
                $instance
            )
        );

        if (!$r->have_posts()) {
            return;
        }
?>
        <?php echo $args['before_widget']; ?>
        <div class="aside-widget">
            <div class="section-title">
                <?php
                if ($title) {
                    echo "<h2 class=\"title\">{$args['before_title']} {$title} {$args['after_title']}</h2>";
                }
                ?>
            </div>
            <?php foreach ($r->posts as $recent_post) : ?>
                <?php
                $post_title   = get_the_title($recent_post->ID);
                $title        = (!empty($post_title)) ? $post_title : __('(no title)');
                $aria_current = '';

                if (get_queried_object_id() === $recent_post->ID) {
                    $aria_current = ' aria-current="page"';
                }
                ?>
                <div class="post post-widget">
                    <a class="post-img" href="<?php the_permalink($recent_post->ID); ?>" <?php echo $aria_current; ?>>
                        <?php echo get_the_post_thumbnail($recent_post->ID) ?>
                    </a>
                    <div class="post-body">
                        <div class="post-category">
                            <a href="category.html"><?php echo get_the_category($recent_post->ID)[0]->name ?></a>
                        </div>
                        <h3 class="post-title">
                            <a href="blog-post.html"><?php echo $title; ?></a>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
            </ul>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field($new_instance['title']);
        $instance['number']    = (int) $new_instance['number'];
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        $title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number    = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

            <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
                <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
    <?php
    }
}
