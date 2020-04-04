<?php

class Callie_Widget_Newsletter_Form extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'aside-widget',
            'description'                 => 'Форма для подписки от Callie',
            'customize_selective_refresh' => true,
        );
        parent::__construct('newsletter_form', 'Newsletter форма (Callie)', $widget_ops);
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Newsletter';
        $subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : 'Nec feugiat nisl pretium fusce id velit ut tortor pretium.';
        $shortcode = !empty($instance['shortcode']) ? $instance['shortcode'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $subtitle = apply_filters('widget_subtitle', $subtitle, $instance, $this->id_base);
        $shortcode = apply_filters('widget_shortcode', $shortcode, $instance, $this->id_base);

        echo $args['before_widget'];
?>
        <div class="section-title">
            <h2 class="title"><?php echo $args['before_title'] . $title . $args['after_title'] ?></h2>
        </div>
        <div class="newsletter-widget">
            <p><?php echo $subtitle ?></p>
            <?php echo do_shortcode($shortcode) ?>
        </div>
    <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance          = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
        $instance['shortcode'] = sanitize_text_field($new_instance['shortcode']);

        return $instance;
    }


    public function form($instance)
    {
        $instance = wp_parse_args(
            (array) $instance,
            ['title' => '', 'subtitle' => '', 'shortcode' => '']
        );
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            <label for="<?php echo $this->get_field_id('vk'); ?>">
                <?php _e('Subtitle:'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>" type="text" value="<?php echo esc_attr($instance['subtitle']); ?>" />
            <label for="<?php echo $this->get_field_id('shortcode'); ?>">
                <?php echo 'Шорткод на форму:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" type="text" value="<?php echo esc_attr($instance['shortcode']); ?>" />
        </p>
<?php
    }
}
