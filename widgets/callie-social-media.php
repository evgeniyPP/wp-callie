<?php

class Callie_Widget_Social_Media extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'social-widget',
            'description'                 => 'Ссылки на социальные сети',
            'customize_selective_refresh' => true,
        );
        parent::__construct('social_media', 'Ссылки на соцсети (Callie)', $widget_ops);
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : 'Social Media';
        $vk = !empty($instance['vk']) ? $instance['vk'] : '#';
        $twitter = !empty($instance['twitter']) ? $instance['twitter'] : '#';
        $facebook = !empty($instance['facebook']) ? $instance['facebook'] : '#';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $vk = apply_filters('widget_vk_link', $vk, $instance, $this->id_base);
        $twitter = apply_filters('widget_twitter_link', $twitter, $instance, $this->id_base);
        $facebook = apply_filters('widget_facebook_link', $facebook, $instance, $this->id_base);

        echo $args['before_widget'];
?>
        <div class="aside-widget">
            <div class="section-title">
                <h2 class="title"><?php echo $args['before_title'] . $title . $args['after_title'] ?></h2>
            </div>
            <div class="social-widget">
                <ul>
                    <li>
                        <a href="<?php echo $vk ?>" class="social-vk">
                            <i class="fa fa-vk"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $twitter ?>" class="social-twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $facebook ?>" class="social-facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance)
    {
        $instance          = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['vk'] = sanitize_text_field($new_instance['vk']);
        $instance['twitter'] = sanitize_text_field($new_instance['twitter']);
        $instance['facebook'] = sanitize_text_field($new_instance['facebook']);

        return $instance;
    }


    public function form($instance)
    {
        $instance = wp_parse_args(
            (array) $instance,
            ['title' => '', 'vk' => '', 'twitter' => '', 'facebook' => '']
        );
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            <label for="<?php echo $this->get_field_id('vk'); ?>">
                <?php echo 'Ссылка на VK:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('vk'); ?>" name="<?php echo $this->get_field_name('vk'); ?>" type="text" value="<?php echo esc_attr($instance['vk']); ?>" />
            <label for="<?php echo $this->get_field_id('twitter'); ?>">
                <?php echo 'Ссылка на Twitter:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($instance['twitter']); ?>" />
            <label for="<?php echo $this->get_field_id('facebook'); ?>">
                <?php echo 'Ссылка на Facebook:' ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
        </p>
<?php
    }
}
