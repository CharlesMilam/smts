<?php
/**
 * Widget Name: Recent Posts with Excerpts Widget
 * Description: A widget that allows to display a recent posts with excerpts and date and author info (optional).
 * Version: 0.1
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'latest_posts_load_widgets' );

/**
 * Register our widget.
 * 'Latest_Posts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function latest_posts_load_widgets() {
	register_widget( 'Latest_Posts_Widget' );
}

/**
 * Custom Category Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Latest_Posts_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Latest_Posts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_latest_posts', 'description' => esc_html__('The most recent posts with teaser text', 'qualifire') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 150, 'height' => 350, 'id_base' => 'latest-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'latest-posts-widget', esc_html__('QualiFire: Recent Posts', 'qualifire'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$category_id = $instance['category_id'];
		$num_posts = absint( $instance['num_posts'] );
		$post_offset =  absint( $instance['post_offset'] );
		$show_date_author = isset( $instance['show_date_author'] ) ? $instance['show_date_author'] : false;

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
		    echo $before_title . $title . $after_title;

		/* Display the Latest Posts accordinly... */
		echo '<div id="widget_latest_posts">';
		$cats_to_include = ( $category_id ) ? "cat={$category_id}&": '';
		$num_posts_query = new WP_Query( "{$cats_to_include}showposts={$num_posts}&offset={$post_offset}" );
		if( $num_posts_query->have_posts()) :
		    while( $num_posts_query->have_posts()) : $num_posts_query->the_post();
		    update_post_caches($posts); ?>
			<div class="latest_posts">
			    <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
<?php			    if ( $show_date_author )  : ?>
				<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>
<?php			    endif;
			    the_excerpt(); ?>
			</div><!-- end widget_recent_posts -->
<?php 		    endwhile;
		endif;
		echo '</div><!-- end widget_recent_posts -->';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_posts'] = strip_tags( $new_instance['num_posts'] );
		$instance['post_offset'] = strip_tags( $new_instance['post_offset'] );
		/* No need to strip tags for dropdowns and checkboxes. */
		$instance['category_id'] = $new_instance['category_id'];
		$instance['show_date_author'] = $new_instance['show_date_author'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('Latest Posts', 'qualifire'), 'category_id' => '', 'num_posts' => 3, 'post_offset' => 0, 'show_date_author' => false );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'qualifire'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<!-- Show Categories -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category_id' ); ?>"><?php esc_html_e('Pick a specific category:', 'qualifire'); ?></label>
			<?php wp_dropdown_categories('show_option_all=All&hierarchical=1&orderby=name&selected='.$instance['category_id'].'&name='.$this->get_field_name( 'category_id' ).'&class=widefat'); ?>

		</p>

		<!-- Number of Posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>"><?php esc_html_e('Number of posts to show:', 'qualifire'); ?></label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" type="text" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" size="3" maxlength="3" />
			<br />
			<small><?php esc_html_e('(at most 15)', 'qualifire'); ?></small>
		</p>

		<!-- Post Offset -->
		<p>
			<label for="<?php echo $this->get_field_id( 'post_offset' ); ?>"><?php esc_html_e('Number of posts to skip:', 'qualifire'); ?></label>
			<input id="<?php echo $this->get_field_id( 'post_offset' ); ?>" type="text" name="<?php echo $this->get_field_name( 'post_offset' ); ?>" value="<?php echo $instance['post_offset']; ?>" size="3" maxlength="3" />
			<br />
			<small><?php esc_html_e('(offset from latest)', 'qualifire'); ?></small>
		</p>

		<p>
			<!-- Show date & author info checkbox -->
			<label for="<?php echo $this->get_field_id( 'show_date_author' ); ?>">
			    <input class="checkbox" type="checkbox" <?php checked( $instance['show_date_author'], true ); ?> id="<?php echo $this->get_field_id( 'show_date_author' ); ?>" name="<?php echo $this->get_field_name( 'show_date_author' ); ?>" value="1" <?php checked('1', $instance['show_date_author']); ?> />
			    <?php esc_html_e('Show date & author info', 'qualifire'); ?>
			</label>
		</p>


<?php
	}
}


