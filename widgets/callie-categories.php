<?php

class Callie_Widget_Categories extends WP_Widget
{

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct()
	{
		$widget_ops = array(
			'classname'                   => 'widget_categories',
			'description'                 => 'Список категорий в верстке Callie',
			'customize_selective_refresh' => true,
		);
		parent::__construct('callie_categories', 'Категории (Callie)', $widget_ops);
	}

	public function widget($args, $instance)
	{
		static $first_dropdown = true;

		$title = !empty($instance['title']) ? $instance['title'] : __('Categories');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$categories = get_categories([
			'taxonomy'     => 'category',
			'type'         => 'post',
			'child_of'     => 0,
			'parent'       => '',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'exclude'      => '',
			'include'      => '',
			'number'       => 0,
			'pad_counts'   => false
		]);

		echo $args['before_widget'];
?>
		<ul>
			<div class="aside-widget">
				<div class="section-title">
					<h2 class="title"><?php echo $args['before_title'] . $title . $args['after_title'] ?></h2>
				</div>
				<div class="category-widget">
					<ul>
						<? foreach ($categories as $category) : ?>
							<li>
								<a href="<?php echo get_category_link($category->term_id); ?>">
									<?php echo $category->name; ?>
									<span><?php echo $category->count; ?></span>
								</a>
							</li>
						<? endforeach; ?>
					</ul>
				</div>
			</div>
		</ul>
	<?php

		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field($new_instance['title']);

		return $instance;
	}

	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form($instance)
	{
		// Defaults.
		$instance     = wp_parse_args((array) $instance, array('title' => ''));
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>
<?php
	}
}
