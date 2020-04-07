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
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : 'Enter your email';
        $button = !empty($instance['button']) ? $instance['button'] : 'Subscribe';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $subtitle = apply_filters('widget_subtitle', $subtitle, $instance, $this->id_base);
        $placeholder = apply_filters('widget_placeholder', $placeholder, $instance, $this->id_base);
        $button = apply_filters('widget_button', $button, $instance, $this->id_base);

        echo $args['before_widget'];
?>
        <div class="section-title">
            <h2 class="title"><?php echo $args['before_title'] . $title . $args['after_title'] ?></h2>
        </div>
        <div class="newsletter-widget">
            <form id="newsletter-form">
                <p><?php echo $subtitle ?></p>
                <input class="input" name="newsletter" placeholder="<?php echo $placeholder ?>">
                <button id="newsletter-btn" class="primary-button"><?php echo $button ?></button>
                <p id="newsletter-message"></p>
            </form>
        </div>
    <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance          = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['subtitle'] = sanitize_text_field($new_instance['subtitle']);
        $instance['placeholder'] = sanitize_text_field($new_instance['placeholder']);
        $instance['button'] = sanitize_text_field($new_instance['button']);

        return $instance;
    }


    public function form($instance)
    {
        $instance = wp_parse_args(
            (array) $instance,
            ['title' => '', 'subtitle' => '', 'placeholder' => '', 'button' => '']
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
                <?php echo 'Текст формы ввода:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo esc_attr($instance['placeholder']); ?>" />
            <label for="<?php echo $this->get_field_id('button'); ?>">
                <?php echo 'Текст кнопки:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo esc_attr($instance['button']); ?>" />
        </p>
<?php
    }
}
