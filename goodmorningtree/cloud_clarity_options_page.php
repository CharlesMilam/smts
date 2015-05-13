<?php

// Avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
		header('Status: 403 Forbidden');
		header('HTTP/1.1 403 Forbidden');
		exit();
}

define('cloud_clarity_PAGE_OPTIONS', 'cloud_clarity-page-options');
global $cloud_clarity_options;
$cloud_clarity_options  = get_option('cloud_clarity_options');


// Class for the theme options
class cloud_clarity_Theme_Options {

	//constructor of class, PHP4 compatible construction for backward compatibility
	function cloud_clarity_Theme_Options() {
		add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
		add_action('admin_menu', array(&$this, 'cloud_clarity_admin_menu'));
		add_action('admin_init', array(&$this, 'register_cloud_clarity_theme_settings'));
		add_action('admin_post_save_cloud_clarity_options', array(&$this, 'on_save_changes'));
	}
	
	function on_screen_layout_columns($columns, $screen) {
		if ($screen == $this->pagehook) {
			$columns[$this->pagehook] = 2;
		}
		return $columns;
	}

	function init_cloud_clarity_theme_options() {
	    global $cloud_clarity_options;
	    if( $cloud_clarity_options['reset_to_defaults'] == 'yes' ) delete_option( "cloud_clarity_options");
	    if (! get_option("cloud_clarity_options")) {
		add_option( "cloud_clarity_options",
		    array( // intitialize the 'cloud_clarity_options' array with the following key => value pairs:
			    "reset_to_defaults" => '',
			    "color_scheme" => "1",
			    "custom_logo_img" => "",
			    "logo_width" => 560,
			    "logo_height" => 90,
			    "slogan_distance_from_the_top" => 70,
			    "slogan_distance_from_the_left" => 100,
			    "top_page_phone_number" => "Call Us Free: 1-800-123-4567",
			    "excluded_paged_from_menu" => "",
			    "show_login_link_in_menu" => "yes",
			    "show_rss_link_in_menu" => "yes",
			    "show_breadcrumbs" => "yes",
			    "home_page_col_1_fixed" => "",
			    "pages_sidebar" => "left",
			    "excerpt_length_in_words" => 18,
			    "excerpt_more_phrase" => "(more&#133;)",
			    "current_slider" => '1',
			    "pm_image_width" => 940,
			    "pm_image_height" => 360,
			    "pm_segments" => 7,
			    "pm_tween_time" => 5,
			    "pm_tween_delay" => 0.1,
			    "pm_tween_type" => 'easeOutElastic',
			    "pm_z_distance" => 200,
			    "pm_expand" => 10,
			    "pm_shadow_darkness" => 100,
			    "pm_autoplay" => 5,
			    "pm_text_distance" => 25,
			    "pm_remove_3d_shadow" => "",
			    "pm_text_background" => "B7B7B7",
			    "pm_inner_color" => "111111",
			    "pm_slides_order_str" => "1",
			    "pm_slider_default_info_txt_1" => get_pm_slider_default_info_txt(),
			    "pm_slide_img_url_1" => "slide_1.jpg",
			    "pm_no_js_img" => esc_url_raw( get_bloginfo('template_url').'/sliders/piecemaker/images/slide_1.jpg' ),
			    "c1_image_width" => 940,
			    "c1_image_height" => 360,
			    "c1_slides_order_str" => "1",
			    "c1_slide_img_url_1" => esc_url_raw( get_bloginfo('template_url').'/sliders/cycle/cycle1/images/slide_1.jpg' ),
			    "c1_transition_type_1" => 'fade',
			    "c1_slide_link_target_1" => 'self',
			    "c1_speed" => 1000,
			    "c1_timeout" => 5000,
			    "c1_sync" => "yes",
			    "c2_slides_order_str" => "1",
			    "c2_slide_img_url_1" => esc_url_raw( get_bloginfo('template_url').'/sliders/cycle/cycle2/images/small_slide_1.jpg' ),
			    "c2_transition_type_1" => 'fade',
			    "c2_slide_link_target_1" => 'self',
			    "c2_slide_default_info_txt_1" => get_c2_slide_default_info_txt(),
			    "c2_slide_button_txt_1" => "READ MORE",
			    "c2_speed" => 1500,
			    "c2_timeout" => 5000,
			    "c2_sync" => "yes",
			    "c2_text_transition_on" => "yes",
			    "c2_text_color" => "FFFFFF",
			    "no_slider_text" => "Home",
			    "portfolio_categories" => "",
			    "portfolio_title_posistion" => "below",
			    "portfolio_sidebar" => "left",
			    "show_portfolio_post_date" => "yes",
			    "show_portfolio_postmetadata" => "yes",
			    "show_portfolio_comments" => "yes",
			    "blog_sidebar" => "right",
			    "blog_button_text" => "Read more",
			    "exclude_portfolio_from_blog" => "yes",
			    "show_contact_fields" => "yes",
			    "contact_field_name1" => "Address:",
			    "contact_field_value1" => "123 Street Name, Suite #",
			    "contact_field_value2" => "City, State 12345, Country",
			    "contact_field_name3" => "Phone:",
			    "contact_field_value3" => "(123) 123-4567",
			    "contact_field_name4" => "Fax:",
			    "contact_field_value4" => "(123) 123-4567",
			    "contact_field_name5" => "Toll Free:",
			    "contact_field_value5" => "(800) 123-4567",
			    "contact_sidebar" => "left",
			    "NA_phone_format" => "", // North American phone number check, disabled by default
			    "email_receipients" => get_option('admin_email'),
			    "recaptcha_enabled" => "no",
			    "recaptcha_publickey" => "",
			    "recaptcha_privatekey" => "",
			    "recaptcha_theme" => "white",
			    "recaptcha_lang" => "en",
			    "copyright_message" => '&copy; 2010 <strong>cloud_clarity</strong>',
			    "show_wp_link_in_footer" => "yes",
			    "show_entries_rss_in_footer" => "yes",
			    "show_comments_rss_in_footer" => "yes",
			    "google_analaytics" => "" )
		);
	    }
	    //Add more options here if needed
	    //if (! get_option("another_of_my_options")) {
	    //    add_option("another_of_my_options", "Hi there!!!");
	    //}
	}

	function register_cloud_clarity_theme_settings() {
	    register_setting( 'cloud_clarity_options_page', 'cloud_clarity_options', array(&$this, 'validate_options') );
	    // register_setting( 'cloud_clarity_options_page', array(&$this, 'another_of_my_options') );
	}
	//extend the admin menu
	function cloud_clarity_admin_menu() {
		$this->init_cloud_clarity_theme_options();
		//Add the cloud_clarity options page to the Themes' menu
		$this->pagehook = add_menu_page('Cloud Clarity Theme', esc_html__('Cloud Clarity Options', 'cloud_clarity'), 'manage_options', 'cloud_clarity_options_page', array(&$this, 'cloud_clarity_generate_options_page'));
		add_action('load-'.$this->pagehook, array(&$this, 'on_load_page'));
	}
	
	function on_load_page() {
	    
		wp_enqueue_style('style', get_template_directory_uri().'/scripts/admin/style.css', false, '1.0', 'screen');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_register_script('admin-scripts', get_template_directory_uri().'/scripts/admin/scripts.js', array('jquery','media-upload','thickbox'), '1.0', false);
		wp_enqueue_script('admin-scripts');
		// load tablednd scripts
		wp_register_script('tablednd', get_template_directory_uri().'/scripts/admin/jquery.tablednd.js', array('jquery'), '0.5', false);
		wp_enqueue_script('tablednd');
		// load uloadify scripts
		wp_enqueue_style('uploadify-style', get_template_directory_uri().'/scripts/admin/uploadify/uploadify.css', false, '1.0', 'screen');
		wp_register_script('swfobject', get_template_directory_uri().'/scripts/admin/uploadify/swfobject.js', array('jquery'), '2.2', false );
		wp_enqueue_script('swfobject');
		wp_register_script('jquery.uploadify', get_template_directory_uri().'/scripts/admin/uploadify/jquery.uploadify.min.js', array('jquery'), '2.1.0', false );
		wp_enqueue_script('jquery.uploadify');
		//load color picker scripts
		wp_enqueue_style('qf-colorpicker-style', get_template_directory_uri().'/scripts/admin/colorpicker/css/colorpicker.css', false, '1.0', 'screen');
		wp_register_script('qf-colorpicker', get_template_directory_uri().'/scripts/admin/colorpicker/js/colorpicker.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('qf-colorpicker');

		// load javascripts to allow drag/drop, expand/collapse and hide/show of boxes
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');

		add_meta_box('cloud_clarity-theme-layout-options-sidebox', esc_html__('Theme Layout', 'cloud_clarity'), array(&$this, 'theme_layout_options_sidebox'), $this->pagehook, 'side', 'core');
		add_meta_box('cloud_clarity-help-options-sidebox', esc_html__('Help', 'cloud_clarity'), array(&$this, 'help_options_sidebox'), $this->pagehook, 'side', 'core');
		add_meta_box('cloud_clarity-general-options-metabox', esc_html__('General Options', 'cloud_clarity'), array(&$this, 'general_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-front-page-options-metabox', esc_html__('Front Page Sliders', 'cloud_clarity'), array(&$this, 'front_page_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-portfolio-section-options-metabox', esc_html__('Portfolio Section', 'cloud_clarity'), array(&$this, 'portfolio_section_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-blog-section-options-metabox', esc_html__('Blog Section', 'cloud_clarity'), array(&$this, 'blog_section_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-contact_page-options-metabox', esc_html__('Contact Page', 'cloud_clarity'), array(&$this, 'contact_page_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-footer-options-metabox', esc_html__('Footer Options', 'cloud_clarity'), array(&$this, 'footer_options_contentbox'), $this->pagehook, 'normal', 'core');
		add_meta_box('cloud_clarity-statistics-options-metabox', esc_html__('Statistics', 'cloud_clarity'), array(&$this, 'statistics_options_contentbox'), $this->pagehook, 'normal', 'core');
	}

	function cloud_clarity_generate_options_page() {

		// global screen column value to be able to have a sidebar in WordPress 2.8+
		global $screen_layout_columns;

		/* Messages to display saved and reset */
		if ( $_REQUEST['updated'] ) echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings saved.', 'cloud_clarity').'</strong></p></div>';
		//if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.esc_html__('Settings reset.', 'cloud_clarity').'</strong></p></div>'; ?>
		<div id="cloud_clarity-metaboxes-general" class="wrap">
<?php		    if ( function_exists('screen_icon') ) screen_icon(); ?>
		    <h2>Cloud Clarity Options</h2>
		    <form method="post" action="options.php">
<?php			settings_fields( 'cloud_clarity_options_page' ); // Checks that the user can update options and also redirect the user back to the correct admin page (this form).
			$options = get_option('cloud_clarity_options');
			// Allows the 'closed' state of metaboxes to be remembered
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
			// Allows the order of metaboxes to be remembered
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false ); ?>

			<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
				<div id="side-info-column" class="inner-sidebar">
<?php				    do_meta_boxes($this->pagehook, 'side', $options); ?>
				</div>
				<div id="post-body" class="has-sidebar">
					<div id="post-body-content" class="has-sidebar-content">
<?php					    do_meta_boxes($this->pagehook, 'normal', $options); ?>
<?php					    do_meta_boxes($this->pagehook, 'additional', $options); ?>
					    <fieldset style="margin:2px 0 0;"><legend class="screen-reader-text"><span><?php esc_attr_e('Reset to defaults', 'cloud_clarity') ?></span></legend>
						<label for="reset_to_defaults">
						    <input name="cloud_clarity_options[reset_to_defaults]" type="checkbox" id="reset_to_defaults" value="yes" <?php checked('yes', $reset_to_defaults); ?> />
						    <?php esc_attr_e('Reset to defaults', 'cloud_clarity') ?>
						</label>
					    </fieldset>
					    <p class="submit">
						<input type="hidden" id="cloud_clarity_submit" value="1" name="cloud_clarity_submit"/>
						<input class="button-primary" type="submit" name="submit" value="<?php esc_attr_e('Save Changes', 'cloud_clarity') ?>" />
					    </p>
					</div>
				</div>
				<br class="clear"/>
			</div>
		    </form>
<?php		    /* The reset button */; ?>
<!--		    <form method="post">
			<p class="submit">
			    <input name="reset" type="submit" value="Reset" />
			    <input type="hidden" name="action" value="reset" />
			</p>
		    </form> -->
		</div>
		<script type="text/javascript">
		    //<![CDATA[
		    jQuery(document).ready( function($) {
			    // close postboxes that should be closed
			    $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			    // postboxes setup
			    postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
		    });
		    //]]>
		</script>
<?php	}

	/**
	 * Validate user input
	 *
	 * @param array $input, an array of user input
	 * @return array Return an input array of sanitized input
	 */
	function validate_options( $input ) {
		global $cloud_clarity_options;

		//Color Scheme
		$input['color_scheme'] = (  $input['color_scheme'] ) ? $input['color_scheme'] : $cloud_clarity_options['color_scheme'];

		//General
		$input['custom_logo_img'] = esc_url_raw($input['custom_logo_img']);
		$input['logo_width'] = is_numeric( $input['logo_width'] ) ? absint($input['logo_width']) : $cloud_clarity_options['logo_width'];
		$input['logo_height'] = is_numeric( $input['logo_height'] ) ? absint($input['logo_height']) : $cloud_clarity_options['logo_height'];
		$input['slogan_distance_from_the_top'] =  ( preg_match('/^0*([0-9]{1}|[0-9]{1}[0-9]{1}|100)$/', $input['slogan_distance_from_the_top']) )  ? ($input['slogan_distance_from_the_top']) : $cloud_clarity_options['slogan_distance_from_the_top'];
		$input['slogan_distance_from_the_left'] =  ( preg_match('/^0*([0-9]{1}|[0-9]{1,2}|[0-3]{1}[0-9]{1,2}|400)$/', $input['slogan_distance_from_the_left']) )  ? ($input['slogan_distance_from_the_left']) : $cloud_clarity_options['slogan_distance_from_the_left'];
		$input['top_page_phone_number'] = trim(stripslashes($input['top_page_phone_number']));
		$pages_array = get_pages('hierarchical=0');
		foreach ($pages_array as $page_obj) {
		    $cur_page_ID = $page_obj->ID;
		    if ( $input['exclude_page_from_menu_'.$cur_page_ID] == 'yes' ) {
			$input['excluded_paged_from_menu'] .= $cur_page_ID.',';
		    }
		}
		$input['excluded_paged_from_menu'] = substr_replace( $input['excluded_paged_from_menu'],"",-1 );
		$input['pages_sidebar'] = ($input['pages_sidebar']) ? $input['pages_sidebar'] : $cloud_clarity_options['pages_sidebar'];
		$input['excerpt_length_in_words'] = is_numeric( $input['excerpt_length_in_words'] ) ? absint($input['excerpt_length_in_words']) : $cloud_clarity_options['excerpt_length_in_words'];
		$input['excerpt_more_phrase'] = esc_html(strip_tags(stripslashes($input['excerpt_more_phrase'])));

		//Front Page Sliders
		$input['current_slider'] = ( $input['current_slider'] ) ? $input['current_slider'] : $cloud_clarity_options['current_slider'];
		// piecemaker
		$input['pm_image_width'] = is_numeric( $input['pm_image_width'] ) ? absint($input['pm_image_width']) : $cloud_clarity_options['pm_image_width'];
		$input['pm_image_height'] = is_numeric( $input['pm_image_height'] ) ? absint($input['pm_image_height']) : $cloud_clarity_options['pm_image_height'];
		$input['pm_segments'] = ( is_numeric( $input['pm_segments'] ) && $input['pm_segments'] > 0 ) ? absint($input['pm_segments']) : $cloud_clarity_options['pm_segments'];
		$input['pm_tween_time'] = is_numeric( $input['pm_tween_time'] ) ? abs($input['pm_tween_time']) : $cloud_clarity_options['pm_tween_time'];
		$input['pm_tween_delay'] = is_numeric(  $input['pm_tween_delay'] ) ? abs($input['pm_tween_delay']) : $cloud_clarity_options['pm_tween_delay'];
		$input['pm_tween_type'] = (  $input['pm_tween_type'] ) ? $input['pm_tween_type'] : $cloud_clarity_options['pm_tween_type'];
		$input['pm_z_distance'] = is_numeric( $input['pm_z_distance'] ) ? $input['pm_z_distance'] : $cloud_clarity_options['pm_z_distance'];
		$input['pm_expand'] = is_numeric( $input['pm_expand'] ) ? absint($input['pm_expand']) : $cloud_clarity_options['pm_expand'];
		$input['pm_shadow_darkness'] =  ( preg_match('/^0*([0-9]{1,2}|100)$/', $input['pm_shadow_darkness']) )  ? ($input['pm_shadow_darkness']) : $cloud_clarity_options['pm_shadow_darkness'];
		$input['pm_autoplay'] = ( is_numeric( $input['pm_autoplay'] ) && $input['pm_autoplay'] > 0 ) ? absint($input['pm_autoplay']) : $cloud_clarity_options['pm_autoplay'];
		$input['pm_text_distance'] = is_numeric( $input['pm_text_distance'] ) ? absint($input['pm_text_distance']) : $cloud_clarity_options['pm_text_distance'];
		$input['pm_text_background'] = ( ctype_alnum($input['pm_text_background']) ) ? strtoupper(stripslashes($input['pm_text_background'])) : $cloud_clarity_options['pm_text_background'];
		$input['pm_inner_color'] = ( ctype_alnum($input['pm_inner_color']) ) ? strtoupper(stripslashes($input['pm_inner_color'])) : $cloud_clarity_options['pm_inner_color'];
		$input['pm_slides_order_str'] = ($input['pm_slides_order_str']) ? $input['pm_slides_order_str'] : $cloud_clarity_options['pm_slides_order_str'];
		$pm_slides_array = explode( ',', $input['pm_slides_order_str'] );
		foreach( $pm_slides_array as $slide_row_number ) {
		    $input['pm_slider_default_info_txt_'.$slide_row_number] = ($input['pm_slider_default_info_txt_'.$slide_row_number]) ? stripslashes($input['pm_slider_default_info_txt_'.$slide_row_number]) : $cloud_clarity_options['pm_slider_default_info_txt_'.$slide_row_number];
		    $input['pm_slide_img_url_'.$slide_row_number] = ($input['pm_slide_img_url_'.$slide_row_number]) ? $input['pm_slide_img_url_'.$slide_row_number] : $cloud_clarity_options['pm_slide_img_url_'.$slide_row_number];
		}
		$input['pm_no_js_img'] = ($input['pm_no_js_img']) ? esc_url_raw($input['pm_no_js_img']) : $cloud_clarity_options['pm_no_js_img'];
		// cycle 1
		$input['c1_image_width'] = is_numeric( $input['c1_image_width'] ) ? absint($input['c1_image_width']) : $cloud_clarity_options['c1_image_width'];
		$input['c1_image_height'] = is_numeric( $input['c1_image_height'] ) ? absint($input['c1_image_height']) : $cloud_clarity_options['c1_image_height'];
		$input['c1_slides_order_str'] = ($input['c1_slides_order_str']) ? $input['c1_slides_order_str'] : $cloud_clarity_options['c1_slides_order_str'];
		$c1_slides_array = explode( ',', $input['c1_slides_order_str'] );
		foreach( $c1_slides_array as $slide_row_number ) {
		    $input['c1_slide_img_url_'.$slide_row_number] = ($input['c1_slide_img_url_'.$slide_row_number]) ? esc_url_raw($input['c1_slide_img_url_'.$slide_row_number]) : $cloud_clarity_options['c1_slide_img_url_'.$slide_row_number];
		    $input['c1_transition_type_'.$slide_row_number] = (  $input['c1_transition_type_'.$slide_row_number] ) ? $input['c1_transition_type_'.$slide_row_number] : $cloud_clarity_options['c1_transition_type_'.$slide_row_number];
		    $input['c1_slide_link_url_'.$slide_row_number] = ($input['c1_slide_link_url_'.$slide_row_number]) ? esc_url_raw($input['c1_slide_link_url_'.$slide_row_number]) : $cloud_clarity_options['c1_slide_link_url_'.$slide_row_number];
		    $input['c1_slide_link_target_'.$slide_row_number] = (  $input['c1_slide_link_target_'.$slide_row_number] ) ? $input['c1_slide_link_target_'.$slide_row_number] : $cloud_clarity_options['c1_slide_link_target_'.$slide_row_number];
		}
		$input['c1_speed'] = is_numeric( $input['c1_speed'] ) ? absint($input['c1_speed']) : $cloud_clarity_options['c1_speed'];
		$input['c1_timeout'] = is_numeric( $input['c1_timeout'] ) ? absint($input['c1_timeout']) : $cloud_clarity_options['c1_timeout'];
		// cycle 2
		$input['c2_slides_order_str'] = ($input['c2_slides_order_str']) ? $input['c2_slides_order_str'] : $cloud_clarity_options['c2_slides_order_str'];
		$c2_slides_array = explode( ',', $input['c2_slides_order_str'] );
		foreach( $c2_slides_array as $slide_row_number ) {
		    $input['c2_slide_img_url_'.$slide_row_number] = ($input['c2_slide_img_url_'.$slide_row_number]) ? esc_url_raw($input['c2_slide_img_url_'.$slide_row_number]) : $cloud_clarity_options['c2_slide_img_url_'.$slide_row_number];
		    $input['c2_transition_type_'.$slide_row_number] = (  $input['c2_transition_type_'.$slide_row_number] ) ? $input['c2_transition_type_'.$slide_row_number] : $cloud_clarity_options['c2_transition_type_'.$slide_row_number];
		    $input['c2_slide_link_url_'.$slide_row_number] = ($input['c2_slide_link_url_'.$slide_row_number]) ? esc_url_raw($input['c2_slide_link_url_'.$slide_row_number]) : $cloud_clarity_options['c2_slide_link_url_'.$slide_row_number];
		    $input['c2_slide_link_target_'.$slide_row_number] = (  $input['c2_slide_link_target_'.$slide_row_number] ) ? $input['c2_slide_link_target_'.$slide_row_number] : $cloud_clarity_options['c2_slide_link_target_'.$slide_row_number];
		    $input['c2_slide_default_info_txt_'.$slide_row_number] = ($input['c2_slide_default_info_txt_'.$slide_row_number]) ? stripslashes($input['c2_slide_default_info_txt_'.$slide_row_number]) : $cloud_clarity_options['c2_slide_default_info_txt_'.$slide_row_number];
		    $input['c2_slide_button_txt_'.$slide_row_number] = ($input['c2_slide_button_txt_'.$slide_row_number]) ? stripslashes($input['c2_slide_button_txt_'.$slide_row_number]) : $cloud_clarity_options['c2_slide_button_txt_'.$slide_row_number];
		}
		$input['c2_speed'] = is_numeric( $input['c2_speed'] ) ? absint($input['c2_speed']) : $cloud_clarity_options['c2_speed'];
		$input['c2_timeout'] = is_numeric( $input['c2_timeout'] ) ? absint($input['c2_timeout']) : $cloud_clarity_options['c2_timeout'];
		$input['c2_text_color'] = ( ctype_alnum($input['c2_text_color']) ) ? strtoupper(stripslashes($input['c2_text_color'])) : $cloud_clarity_options['c2_text_color'];
		// no slider
		$input['no_slider_text'] = stripslashes($input['no_slider_text']);

		//Portfolio Section
		$portfolio_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio.php&hierarchical=0');
		foreach ( $portfolio_pages_array as $portfolio_page_obj ) {
		    $port_page_ID = $portfolio_page_obj->ID;
		    $input['portfolio_categories'] .= $input['portfolio_cat_for_page_'.$port_page_ID].',';
		    $input['portfolio_items_per_page_for_page_'.$port_page_ID] = ( is_numeric( $input['portfolio_items_per_page_for_page_'.$port_page_ID] ) && $input['portfolio_items_per_page_for_page_'.$port_page_ID] > 0 ) ? absint($input['portfolio_items_per_page_for_page_'.$port_page_ID]) : $cloud_clarity_options['portfolio_items_per_page_for_page_'.$port_page_ID];
		};
		$input['portfolio_categories'] = substr_replace( $input['portfolio_categories'],"",-1 );
		$input['portfolio_title_posistion'] = ($input['portfolio_title_posistion']) ? $input['portfolio_title_posistion'] : $cloud_clarity_options['portfolio_title_posistion'];
		$input['portfolio_sidebar'] = ($input['portfolio_sidebar']) ? $input['portfolio_sidebar'] : $cloud_clarity_options['portfolio_sidebar'];

		//Blog/News Section
		$input['blog_sidebar'] = ($input['blog_sidebar']) ? $input['blog_sidebar'] : $cloud_clarity_options['blog_sidebar'];
		$input['blog_button_text'] = trim(stripslashes($input['blog_button_text']));

		//Contact Information Fields
		$input['contact_field_name1'] = stripslashes($input['contact_field_name1']);
		$input['contact_field_value1'] = stripslashes($input['contact_field_value1']);
		$input['contact_field_name2'] = stripslashes($input['contact_field_name2']);
		$input['contact_field_value2'] = stripslashes($input['contact_field_value2']);
		$input['contact_field_name3'] = stripslashes($input['contact_field_name3']);
		$input['contact_field_value3'] = stripslashes($input['contact_field_value3']);
		$input['contact_field_name4'] = stripslashes($input['contact_field_name4']);
		$input['contact_field_value4'] = stripslashes($input['contact_field_value4']);
		$input['contact_field_name5'] = stripslashes($input['contact_field_name5']);
		$input['contact_field_value5'] = stripslashes($input['contact_field_value5']);
		$input['contact_field_name6'] = stripslashes($input['contact_field_name6']);
		$input['contact_field_value6'] = stripslashes($input['contact_field_value6']);
		$input['contact_field_name7'] = stripslashes($input['contact_field_name7']);
		$input['contact_field_value7'] = stripslashes($input['contact_field_value7']);
		$input['contact_sidebar'] = ($input['contact_sidebar']) ? $input['contact_sidebar'] : $cloud_clarity_options['contact_sidebar'];
		$email_receipients = $this->email_receipients_are_valid($input['email_receipients']); // validate email(s)
		$input['email_receipients'] = ( $email_receipients ) ?  $email_receipients: $cloud_clarity_options['email_receipients'];
		$input['recaptcha_publickey'] = trim(stripslashes($input['recaptcha_publickey']));
		$input['recaptcha_privatekey'] = trim(stripslashes($input['recaptcha_privatekey']));
		$input['recaptcha_enabled'] = ($input['recaptcha_publickey'] && $input['recaptcha_privatekey']) ? $input['recaptcha_enabled'] : 'no'; // disable ReCAPTCHA if publickey and privatekey are empty
		$input['recaptcha_theme'] = (  $input['recaptcha_theme'] ) ? $input['recaptcha_theme'] : $cloud_clarity_options['recaptcha_theme'];
		$input['recaptcha_lang'] = (  $input['recaptcha_lang'] ) ? $input['recaptcha_lang'] : $cloud_clarity_options['recaptcha_lang'];

		//Footer
		$input['copyright_message'] = stripslashes($input['copyright_message']);

		//Statistics
		$input['google_analaytics'] = stripslashes($input['google_analaytics']);

		return $input;
	}

	function on_save_changes() {
		// user permission check
		if ( !current_user_can('manage_options') )
			wp_die( esc_html__("Cheatin' uh?") );
		// cross check the given referer
		check_admin_referer( 'cloud_clarity_options_page-options' );
		//lets redirect the post request into get request (you may add additional params at the url, if you need to show save results
		wp_redirect($_POST['_wp_http_referer']);
	}

	/**
	 * Validate email receipient(s) email addresses
	 *
	 * @param string $receipients, a string of CSV email addresses
	 * @return bool|mixed False on failure or a string of properly formatted CSV email addresses otherwise
	 */
	function email_receipients_are_valid ( $receipients ) {
	    	$emails_array = explode( ",", $receipients );
		foreach ( $emails_array as $email ) {
		    if ( !is_email( trim($email) ) )
			return false;
		}
		return implode( ', ', array_map( 'trim', $emails_array) ); // trim white spaced from beginning and end of email addresses
	}



	/**************************************************************************************/
	/**** Below you will find the callback method for each of the registered metaboxes ****/
	/**************************************************************************************/

	function theme_layout_options_sidebox( $options ) {
		$color_scheme = $options['color_scheme']; ?>
		<p style="font-size:12px; margin-left:5px;"><?php esc_html_e('Choose a color scheme:', 'cloud_clarity'); ?></p>
		<label for="color_scheme" class="link-target" style="padding:5px 20px 15px; display:block;">
			<select name="cloud_clarity_options[color_scheme]" id="color_scheme">
			    <option value="1"<?php echo ($options['color_scheme'] == '1') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 1 (Black)', 'cloud_clarity'); ?> </option>
			    <option value="2"<?php echo ($options['color_scheme'] == '2') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 2 (Red)', 'cloud_clarity'); ?> </option>
			    <option value="3"<?php echo ($options['color_scheme'] == '3') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 3 (Olive)', 'cloud_clarity'); ?> </option>
			    <option value="4"<?php echo ($options['color_scheme'] == '4') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 4 (Blue)', 'cloud_clarity'); ?> </option>
			    <option value="5"<?php echo ($options['color_scheme'] == '5') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 5 (Grey)', 'cloud_clarity'); ?> </option>
			    <option value="6"<?php echo ($options['color_scheme'] == '6') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 6 (Orange)', 'cloud_clarity'); ?> </option>
			    <option value="7"<?php echo ($options['color_scheme'] == '7') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 7 (Lavender)', 'cloud_clarity'); ?> </option>
			    <option value="8"<?php echo ($options['color_scheme'] == '8') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 8 (Tan)', 'cloud_clarity'); ?> </option>
			    <option value="9"<?php echo ($options['color_scheme'] == '9') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('Style 9 (Midnight Blue)', 'cloud_clarity'); ?> </option>
			</select>
		</label>
<?php	}

	function help_options_sidebox( $options ) { ?>
		<p style="font-size:12px; margin-left:5px;"><?php esc_html_e('cloud_clarity theme help resources:', 'cloud_clarity'); ?></p>
		<ul style="list-style-type:none; margin:5px 5px 10px 20px;">
		    <li><?php echo '<div><a href="'.get_bloginfo('template_url').'/scripts/documentation/index.html?KeepThis=true&amp;TB_iframe=true&amp;height=450&amp;width=680" class="thickbox" title="Documentation">'.esc_html__('Documentation', 'cloud_clarity').'</a></div>'; ?></li>
		    <li><?php echo '<div><a href="'.get_bloginfo('template_url').'/scripts/documentation/index.html" title="Open Documentation in a new window..."  target="_blank">'.esc_html__('Documentation (new window)', 'cloud_clarity').'</a></div>'; ?></li>
		    <li><?php echo '<div><a href="http://www.youtube.com/user/internq7" target="_blank">'.esc_html__('Video Tutorials', 'cloud_clarity').'</a></div>'; ?></li>
		    <li><?php echo '<div><a href="http://www.universallyacclaimed.com/wp-themes/cloud_clarity/" target="_blank">'.esc_html__('cloud_clarity Demo Site', 'cloud_clarity').'</a></div>'; ?></li>
		    <li><?php echo '<div><a href="http://www.universallyacclaimed.com/wp-themes/cloud_clarity/?page_id=133" target="_blank">'.esc_html__('cloud_clarity Typography', 'cloud_clarity').'</a></div>'; ?></li>
		    <li><?php echo '<div><a href="http://themeforest.net/user/internq7/" target="_blank">'.esc_html__('Contact Us', 'cloud_clarity').'</a></div>'; ?></li>
		</ul>
<?php	}

	function general_options_contentbox( $options ) {
		$custom_logo_img = $options['custom_logo_img'];
		$home_page_col_1_fixed =  $options['home_page_col_1_fixed'];
		$pages_sidebar = $options['pages_sidebar'];
		$excerpt_length_in_words = $options['excerpt_length_in_words'];
		$excerpt_more_phrase = $options['excerpt_more_phrase']; ?>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Custom Logo', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Enter a URL or upload an image for your logo:', 'cloud_clarity'); ?><br />
				<textarea style="width: 98%; font-size: 12px;" id="custom_logo_img" rows="2" cols="60" name="cloud_clarity_options[custom_logo_img]"><?php if( $custom_logo_img ){ echo esc_url($custom_logo_img); } ?></textarea><br />
				<div><input id="upload_logo_button" type="button" value="<?php esc_attr_e('Upload Logo', 'cloud_clarity'); ?>" style="cursor:pointer; margin:5px 0 0;" /></div>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Logo Dimensions', 'cloud_clarity'); ?></th>
			    <td>
				<input name="cloud_clarity_options[logo_width]" type="text" id="logo_width" value="<?php echo esc_attr($options['logo_width']); ?>" size="5" maxlength="4" />
				<span> X </span>
				<input name="cloud_clarity_options[logo_height]" type="text" id="logo_height" value="<?php echo esc_attr($options['logo_height']); ?>" size="5" maxlength="4" />
				px <span class="description"><?php esc_html_e('(Width X Height) in pixels.', 'cloud_clarity'); ?><br />
				<?php esc_html_e('Note: the maximum designated space for the logo is 560px by 90px.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><label for="slogan_distance_from_the_top"><?php esc_html_e('Slogan Position from the Top', 'cloud_clarity'); ?></label></th>
			    <td>
				<input name="cloud_clarity_options[slogan_distance_from_the_top]" type="text" id="slogan_distance_from_the_top" value="<?php echo esc_attr($options['slogan_distance_from_the_top']); ?>" size="5" maxlength="3" />
				<span> px <?php esc_html_e('from the top. Enter a number between 0 and 100.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><label for="slogan_distance_from_the_left"><?php esc_html_e('Slogan Position from the Left', 'cloud_clarity'); ?></label></th>
			    <td>
				<input name="cloud_clarity_options[slogan_distance_from_the_left]" type="text" id="slogan_distance_from_the_left" value="<?php echo esc_attr($options['slogan_distance_from_the_left']); ?>" size="5" maxlength="3" />
				<span> px <?php esc_html_e('from the left. Enter a number between 0 and 400.', 'cloud_clarity'); ?></span><br />
				<span class="description"><?php  printf( __('Please note that the actual Slogan text can be changed or deleted at %1$sSettings -> General%2$s <strong>Tagline</strong> option.', 'cloud_clarity'), '<a href="options-general.php">', '</a>' ); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Phone Number Information', 'cloud_clarity'); ?></th>
			    <td>
				<input name="cloud_clarity_options[top_page_phone_number]" type="text" id="top_page_phone_number" value="<?php if ($options['top_page_phone_number']) { echo esc_attr($options['top_page_phone_number'], 'cloud_clarity'); } ?>" size="30" maxlength="70" />
				<?php esc_html_e('Use this field to provide a phone number or any other short piece of information (30 character limit for display).  It is displayed just under the search box located at the top right corner of the theme.', 'cloud_clarity'); ?>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Exclude Pages From Menu', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Please select the page(s) you would like to be excluded from the top navigation menu. This option will NOT affect the settings in the new WP 3.0 "Appearances -> Menus" option.', 'cloud_clarity'); ?><br />
<?php				$pages_array = get_pages('hierarchical=0'); ?>
				<div style="height:100px; padding:5px 10px; overflow:auto; border:1px solid #ccc;">
<?php				    foreach ($pages_array as $page_obj) :
					$cur_page_ID = $page_obj->ID; ?>
					<input name="cloud_clarity_options[exclude_page_from_menu_<?php echo $cur_page_ID; ?>]" type="checkbox" id="exclude_page_from_menu_<?php echo $cur_page_ID; ?>" value="yes" <?php checked('yes', $options['exclude_page_from_menu_'.$cur_page_ID]); ?> />
					<strong><?php echo $page_obj->post_title; ?></strong> (<?php esc_html_e('page ID:', 'cloud_clarity'); ?> <strong><?php echo $cur_page_ID; ?></strong>)<br />
<?php				    endforeach; ?>
				</div>
				<span class="description"><?php esc_html_e('Keep in mind that if you exclude a page that has descendants (children pages), they will automatically be excluded from the menu as well!', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Login Link in the Menu', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Login Link in the Menu', 'cloud_clarity'); ?></span></legend>
				<label for="show_login_link_in_menu">
				    <input name="cloud_clarity_options[show_login_link_in_menu]" type="checkbox" id="show_login_link_in_menu" value="yes" <?php checked('yes', $options['show_login_link_in_menu']); ?> />
				    <?php esc_html_e('Show Login/Logout link in the Navigation menu?', 'cloud_clarity'); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('RSS icon in the Menu', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('RSS icon in the Menu', 'cloud_clarity'); ?></span></legend>
				<label for="show_rss_link_in_menu">
				    <input name="cloud_clarity_options[show_rss_link_in_menu]" type="checkbox" id="show_rss_link_in_menu" value="yes" <?php checked('yes', $options['show_rss_link_in_menu']); ?> />
				    <?php esc_html_e('Show RSS icon in the Navigation menu?', 'cloud_clarity'); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Breadcrumbs', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Show Breadcrumbs', 'cloud_clarity'); ?></span></legend>
				<label for="show_breadcrumbs">
				    <input name="cloud_clarity_options[show_breadcrumbs]" type="checkbox" id="show_breadcrumbs" value="yes" <?php checked('yes', $options['show_breadcrumbs']); ?> />
				    <?php esc_html_e('Show Breadcrumbs', 'cloud_clarity'); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Home Page Column 1', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Please choose whether you would like to have the Widget Area "Home Page Column 1" fixed width:', 'cloud_clarity'); ?><br />
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Home Page Column 1', 'cloud_clarity'); ?></span></legend>
				    <label for="home_page_col_1_fixed">
					<input name="cloud_clarity_options[home_page_col_1_fixed]" type="checkbox" id="home_page_col_1_fixed" value="yes" <?php checked('yes', $home_page_col_1_fixed); ?> />
					<?php esc_html_e('Fixed width', 'cloud_clarity'); ?><br />
				    </label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Default Pages Sidebar Position', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Choose position:', 'cloud_clarity'); ?><br />
				<label><input type="radio" name="cloud_clarity_options[pages_sidebar]" id="pages_sidebar_left" value="left" <?php checked('left', $pages_sidebar); ?> /> <?php esc_html_e('Left', 'cloud_clarity'); ?></label>&nbsp;&nbsp;
				<label><input type="radio" name="cloud_clarity_options[pages_sidebar]" id="pages_sidebar_right" value="right" <?php checked('right', $pages_sidebar); ?> /> <?php esc_html_e('Right', 'cloud_clarity'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="description"><?php esc_html_e('This is the sidebar shown on all pages', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><label for="excerpt_length_in_words"><?php esc_html_e('Excerpt Length', 'cloud_clarity'); ?></label></th>
			    <td>
				<?php esc_html_e('Change the excerpt length:', 'cloud_clarity'); ?> <input name="cloud_clarity_options[excerpt_length_in_words]" type="text" id="excerpt_length_in_words" value="<?php echo esc_attr($excerpt_length_in_words); ?>" size="5" maxlength="5" /> <br />
				<span class="description"><?php esc_html_e('Shorten or lengthen the excerpt to suite your personal needs. The number refers to the first number of words from a post.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Excerpt More Phrase', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Change the phrase', 'cloud_clarity'); ?>: <input name="cloud_clarity_options[excerpt_more_phrase]" type="text" id="excerpt_more_phrase" value="<?php if ($excerpt_more_phrase){ echo esc_attr($excerpt_more_phrase); }?>" size="30" maxlength="60" />
				<br />
				<span class="description"><?php esc_html_e("This is the excerpt's 'Read more..' link. Change it to anything you'd like...", 'cloud_clarity'); ?></span>
			    </td>
			</tr>
		    </tbody>
		</table>
<?php	}

	function front_page_options_contentbox( $options ) {
		$current_slider = $options['current_slider']; ?>

		<table class="form-table" style="background-color:#F9F9F9; border:1px solid #DDDDDD;">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Current Slider', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Choose a slider:', 'cloud_clarity'); ?><br />
				<label><input type="radio" name="cloud_clarity_options[current_slider]" id="current_slider_1" value="1" <?php checked('1', $current_slider); ?> /> <?php esc_html_e('Piecemaker', 'cloud_clarity'); ?></label><br />
				<label><input type="radio" name="cloud_clarity_options[current_slider]" id="current_slider_2" value="2" <?php checked('2', $current_slider); ?> /> <?php esc_html_e('Cycle 1 (full width image)', 'cloud_clarity'); ?></label><br />
				<label><input type="radio" name="cloud_clarity_options[current_slider]" id="current_slider_3" value="3" <?php checked('3', $current_slider); ?> /> <?php esc_html_e('Cycle 2 (image with text)', 'cloud_clarity'); ?></label><br />
				<label><input type="radio" name="cloud_clarity_options[current_slider]" id="current_slider_4" value="4" <?php checked('4', $current_slider); ?> /> <?php esc_html_e('No Slider', 'cloud_clarity'); ?> <span class="description"><?php esc_html_e('(Remove slider from home page completely)', 'cloud_clarity'); ?></span></label><br />
				<div class="submit" style="padding:10px 0 0 80px; float:left; clear:both;">
				    <input type="hidden" id="cloud_clarity_submit" value="1" name="cloud_clarity_submit"/>
				    <input class="button-primary" type="submit" name="submit" value="<?php esc_attr_e('Save & Activate', 'cloud_clarity'); ?>" />
				</div>
<?php				if ( $current_slider != '4' ) : ?>
				    <div style="padding-top:10px; clear:both;"><?php esc_html_e('Continue with the section below to customize the slider...', 'cloud_clarity'); ?></div>
<?php				endif; ?>
			    </td>
			</tr>
		    </tbody>
		</table>

<?php		if ( $current_slider == '1' ) :
		    $pm_image_width = $options['pm_image_width'];
		    $pm_image_height = $options['pm_image_height'];
		    $pm_segments = $options['pm_segments'];
		    $pm_tween_time = $options['pm_tween_time'];
		    $pm_tween_delay = $options['pm_tween_delay'];
		    $pm_tween_type = $options['pm_tween_type'];
		    $pm_z_distance = $options['pm_z_distance'];
		    $pm_expand = $options['pm_expand'];
		    $pm_shadow_darkness = $options['pm_shadow_darkness'];
		    $pm_autoplay = $options['pm_autoplay'];
		    $pm_text_distance = $options['pm_text_distance'];
		    $pm_remove_3d_shadow = $options['pm_remove_3d_shadow'];
		    $pm_text_background = $options['pm_text_background'];
		    $pm_inner_color = $options['pm_inner_color'];
		    $pm_slides_order_str = $options['pm_slides_order_str'];
		    $pm_slides_array = explode( ',', $options['pm_slides_order_str'] );
		    $pm_no_js_img = $options['pm_no_js_img'];
		    // Include the Piecemaker Slider XML generator page
		    require_once('sliders/piecemaker/piecemakerXML.php'); ?>
		    <!-- Add invisible fields from the other sliders' forms to preserve their state. (this is only necessary for checkboxes and some text fields)  -->
		    <input style="display:none;" name="cloud_clarity_options[c1_sync]" type="checkbox" id="c1_sync" value="yes" <?php checked('yes', $options['c1_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c2_sync]" type="checkbox" id="c2_sync" value="yes" <?php checked('yes', $options['c2_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c2_text_transition_on]" type="checkbox" id="c2_text_transition_on" value="yes" <?php checked('yes', $options['c2_text_transition_on']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c1_remove_3d_shadow]" type="checkbox" id="c1_remove_3d_shadow" value="yes" <?php checked('yes', $options['c1_remove_3d_shadow']); ?> />
		    <input name="cloud_clarity_options[no_slider_text]" type="hidden" id="no_slider_text" value="<?php if ($options['no_slider_text']) { echo esc_attr($options['no_slider_text']); } ?>" />


		    <h2 style="color:#2680AA; margin-top: 2px; padding:20px 10px 0;"><?php esc_html_e('Piecemaker Slider Settings:', 'cloud_clarity'); ?></h2>
		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><label for="pm_image_width"><?php esc_html_e('Image Width', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_image_width]" type="text" id="pm_image_width" value="<?php echo esc_attr($pm_image_width); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('The width of the images to be loaded.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_image_height"><?php esc_html_e('Image Height', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_image_height]" type="text" id="pm_image_height" value="<?php echo esc_attr($pm_image_height); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('The height of the images to be loaded.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_segments"><?php esc_html_e('Number of segments', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_segments]" type="text" id="pm_segments" value="<?php echo esc_attr($pm_segments); ?>" size="5" maxlength="2" />
				    <span><?php esc_html_e('Number of segments, in which the images will be sliced.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_tween_time"><?php esc_html_e('Tween Time', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_tween_time]" type="text" id="pm_tween_time" value="<?php echo esc_attr($pm_tween_time); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('Number of seconds for each element to be turned.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_tween_delay"><?php esc_html_e('Tween Delay', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_tween_delay]" type="text" id="pm_tween_delay" value="<?php echo esc_attr($pm_tween_delay); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('Number of seconds from one element starting to turn to the next element starting.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_tween_type"><?php esc_html_e('Tween Type', 'cloud_clarity'); ?></label></th>
				<td>
				    <select name="cloud_clarity_options[pm_tween_type]" id="pm_tween_type">
					<option value="easeInOutBack"<?php echo ($pm_tween_type == 'easeInOutBack') ? ' selected="selected"' : ''; ?>>easeInOutBack</option>
					<option value="easeOutInBack"<?php echo ($pm_tween_type == 'easeOutInBack') ? ' selected="selected"' : ''; ?>>easeOutInBack</option>
					<option value="easeOutBack"<?php echo ($pm_tween_type == 'easeOutBack') ? ' selected="selected"' : ''; ?>>easeOutBack</option>
					<option value="easeInBack"<?php echo ($pm_tween_type == 'easeInBack') ? ' selected="selected"' : ''; ?>>easeInBack</option>
					<option value="easeInBounce"<?php echo ($pm_tween_type == 'easeInBounce') ? ' selected="selected"' : ''; ?>>easeInBounce</option>
					<option value="easeOutBounce"<?php echo ($pm_tween_type == 'easeOutBounce') ? ' selected="selected"' : ''; ?>>easeOutBounce</option>
					<option value="easeInOutBounce"<?php echo ($pm_tween_type == 'easeInOutBounce') ? ' selected="selected"' : ''; ?>>easeInOutBounce</option>
					<option value="easeOutInBounce"<?php echo ($pm_tween_type == 'easeOutInBounce') ? ' selected="selected"' : ''; ?>>easeOutInBounce</option>
					<option value="easeInCirc"<?php echo ($pm_tween_type == 'easeInCirc') ? ' selected="selected"' : ''; ?>>easeInCirc</option>
					<option value="easeOutCirc"<?php echo ($pm_tween_type == 'easeOutCirc') ? ' selected="selected"' : ''; ?>>easeOutCirc</option>
					<option value="easeInOutCirc"<?php echo ($pm_tween_type == 'easeInOutCirc') ? ' selected="selected"' : ''; ?>>easeInOutCirc</option>
					<option value="easeOutInCirc"<?php echo ($pm_tween_type == 'easeOutInCirc') ? ' selected="selected"' : ''; ?>>easeOutInCirc</option>
					<option value="easeInElastic"<?php echo ($pm_tween_type == 'easeInElastic') ? ' selected="selected"' : ''; ?>>easeInElastic</option>
					<option value="easeOutElastic"<?php echo ($pm_tween_type == 'easeOutElastic') ? ' selected="selected"' : ''; ?>>easeOutElastic</option>
					<option value="easeInOutElastic"<?php echo ($pm_tween_type == 'easeInOutElastic') ? ' selected="selected"' : ''; ?>>easeInOutElastic</option>
					<option value="easeOutInElastic"<?php echo ($pm_tween_type == 'easeOutInElastic') ? ' selected="selected"' : ''; ?>>easeOutInElastic</option>
					<option value="easeInQuint"<?php echo ($pm_tween_type == 'easeInQuint') ? ' selected="selected"' : ''; ?>>easeInQuint</option>
					<option value="easeOutQuint"<?php echo ($pm_tween_type == 'easeOutQuint') ? ' selected="selected"' : ''; ?>>easeOutQuint</option>
					<option value="easeInOutQuint"<?php echo ($pm_tween_type == 'easeInOutQuint') ? ' selected="selected"' : ''; ?>>easeInOutQuint</option>
					<option value="easeOutInQuint"<?php echo ($pm_tween_type == 'easeOutInQuint') ? ' selected="selected"' : ''; ?>>easeOutInQuint</option>
					<option value="easeInExpo"<?php echo ($pm_tween_type == 'easeInExpo') ? ' selected="selected"' : ''; ?>>easeInExpo</option>
					<option value="easeOutExpo"<?php echo ($pm_tween_type == 'easeOutExpo') ? ' selected="selected"' : ''; ?>>easeOutExpo</option>
					<option value="easeInOutExpo"<?php echo ($pm_tween_type == 'easeInOutExpo') ? ' selected="selected"' : ''; ?>>easeInOutExpo</option>
					<option value="easeOutInExpo"<?php echo ($pm_tween_type == 'easeOutInExpo') ? ' selected="selected"' : ''; ?>>easeOutInExpo</option>
					<option value="easeInCubic"<?php echo ($pm_tween_type == 'easeInCubic') ? ' selected="selected"' : ''; ?>>easeInCubic</option>
					<option value="easeOutCubic"<?php echo ($pm_tween_type == 'easeOutCubic') ? ' selected="selected"' : ''; ?>>easeOutCubic</option>
					<option value="easeInOutCubic"<?php echo ($pm_tween_type == 'easeInOutCubic') ? ' selected="selected"' : ''; ?>>easeInOutCubic</option>
					<option value="easeOutInCubic"<?php echo ($pm_tween_type == 'easeOutInCubic') ? ' selected="selected"' : ''; ?>>easeOutInCubic</option>
					<option value="easeInQuart"<?php echo ($pm_tween_type == 'easeInQuart') ? ' selected="selected"' : ''; ?>>easeInQuart</option>
					<option value="easeOutQuart"<?php echo ($pm_tween_type == 'easeOutQuart') ? ' selected="selected"' : ''; ?>>easeOutQuart</option>
					<option value="easeInOutQuart"<?php echo ($pm_tween_type == 'easeInOutQuart') ? ' selected="selected"' : ''; ?>>easeInOutQuart</option>
					<option value="easeOutInQuart"<?php echo ($pm_tween_type == 'easeOutInQuart') ? ' selected="selected"' : ''; ?>>easeOutInQuart</option>
					<option value="easeInSine"<?php echo ($pm_tween_type == 'easeInSine') ? ' selected="selected"' : ''; ?>>easeInSine</option>
					<option value="easeOutSine"<?php echo ($pm_tween_type == 'easeOutSine') ? ' selected="selected"' : ''; ?>>easeOutSine</option>
					<option value="easeInOutSine"<?php echo ($pm_tween_type == 'easeInOutSine') ? ' selected="selected"' : ''; ?>>easeInOutSine</option>
					<option value="easeOutInSine"<?php echo ($pm_tween_type == 'easeOutInSine') ? ' selected="selected"' : ''; ?>>easeOutInSine</option>
					<option value="easeInQuad"<?php echo ($pm_tween_type == 'easeInQuad') ? ' selected="selected"' : ''; ?>>easeInQuad</option>
					<option value="easeOutQuad"<?php echo ($pm_tween_type == 'easeOutQuad') ? ' selected="selected"' : ''; ?>>easeOutQuad</option>
					<option value="easeInOutQuad"<?php echo ($pm_tween_type == 'easeInOutQuad') ? ' selected="selected"' : ''; ?>>easeInOutQuad</option>
					<option value="easeOutInQuad"<?php echo ($pm_tween_type == 'easeOutInQuad') ? ' selected="selected"' : ''; ?>>easeOutInQuad</option>
					<option value="linear"<?php echo ($pm_tween_type == 'linear') ? ' selected="selected"' : ''; ?>>linear</option>
				    </select>
				    <span><?php printf( esc_html__('Type of transition from Caurina&#39;s Tweener class. Find all possible transition types and more information about Tweener in the official %1$sdocumentation%2$s.', 'cloud_clarity'), '<a href="http://hosted.zeh.com.br/tweener/docs/en-us/misc/transitions.html" target="_blank">', '</a>' ); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_z_distance"><?php esc_html_e('Z Distance', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_z_distance]" type="text" id="pm_z_distance" value="<?php echo esc_attr($pm_z_distance); ?>" size="5" maxlength="5" />
				    <span><?php esc_html_e('To which extend are the cubes moved on z axis when being tweened. Negative values bring the cube closer to the camera, positive values take it further away. A good range is roughly between -200 and 700.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_expand"><?php esc_html_e('Expand', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_expand]" type="text" id="pm_expand" value="<?php echo esc_attr($pm_expand); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('To which extend are the cubes moved away from each other when tweening.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_shadow_darkness"><?php esc_html_e('Shadow Darkness', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_shadow_darkness]" type="text" id="pm_shadow_darkness" value="<?php echo esc_attr($pm_shadow_darkness); ?>" size="5" maxlength="3" />
				    <span><?php esc_html_e('To which extend are the sides shadowed, when the elements are tweening and the sided move towards the background. 100 is black, 0 is no darkening.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_autoplay"><?php esc_html_e('Autoplay', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_autoplay]" type="text" id="pm_autoplay" value="<?php echo esc_attr($pm_autoplay); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('Number of seconds to the next image.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="pm_text_distance"><?php esc_html_e('Text Distance', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[pm_text_distance]" type="text" id="pm_text_distance" value="<?php echo esc_attr($pm_text_distance); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('Distance of the info text to the borders of its background.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('3D Shadow', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('3D Shadow', 'cloud_clarity'); ?></span></legend>
				    <label for="pm_remove_3d_shadow">
					<input name="cloud_clarity_options[pm_remove_3d_shadow]" type="checkbox" id="pm_remove_3d_shadow" value="yes" <?php checked('yes', $pm_remove_3d_shadow); ?> />
					<?php esc_html_e('Remove the 3D shadow under the slider</span>', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			</tbody>
		    </table>

		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Text Background', 'cloud_clarity'); ?></th>
				<td style="width:37px; padding:4px 4px">
				    <div id="colorSelector1">
					<div style="background-color: #<?php echo ($pm_text_background) ? esc_attr($pm_text_background) : '0000FF'; ?>;"></div>
				    </div>
				</td>
				<td>
				    <input name="cloud_clarity_options[pm_text_background]" id="pm_text_background" type="text" maxlength="6" size="6" style="margin:7px 10px 0 0" value="<?php echo ($pm_text_background) ? esc_attr($pm_text_background) : '0000FF'; ?>" />
				    <?php esc_html_e('Description text background', 'cloud_clarity'); ?>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Inner Color', 'cloud_clarity'); ?></th>
				<td style="width:37px; padding:4px 4px">
				    <div id="colorSelector2">
					<div style="background-color: #<?php echo ($pm_inner_color) ? esc_attr($pm_inner_color) : '0000FF'; ?>;"></div>
				    </div>
				</td>
				<td>
				    <input name="cloud_clarity_options[pm_inner_color]" id="pm_inner_color" type="text" maxlength="6" size="6" style="margin:7px 10px 0 0" value="<?php echo ($pm_inner_color) ? esc_attr($pm_inner_color) : '0000FF'; ?>" />
				    <?php esc_html_e('Sides color of the sliced elements', 'cloud_clarity'); ?>
				</td>
			    </tr>
			</tbody>
		    </table>

		    <input name="cloud_clarity_options[pm_slides_order_str]" type="hidden" id="pm_slides_order_str" value="<?php if ($pm_slides_order_str){ echo esc_attr($pm_slides_order_str); }?>" />
		    <div class="add-row" style></div>
		    <table id="pm-table-slides" class="pm-table-slides">
			<tbody>
<?php			    foreach( $pm_slides_array as $position=>$slide_row_number ) : ?>
				<tr id="<?php echo $slide_row_number; ?>" class="row-style">
				    <td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				    <td class="deleteSlide" style="margin:10px 10px; padding:5px 15px;">&nbsp;</td>
				    <td class="position" style="padding:15px 5px; width:10%; font-weight:bold; font-size:20px; text-align:center;"><?php echo $position+1; ?></td>
				    <td class="slide-info-text" style="padding:0; width:70%">
					<p style="font-weight:bold;"><?php esc_html_e('Edit the info text, erase all for none:', 'cloud_clarity'); ?></p>
					<textarea name="cloud_clarity_options[pm_slider_default_info_txt_<?php echo $slide_row_number; ?>]" class="code"
						    style="width:97%; font-size:12px; margin: 5px 0;" id="pm_slider_default_info_txt_<?php echo $slide_row_number; ?>"
						    rows="6" cols="60" wrap="off"><?php echo ( $options['pm_slider_default_info_txt_'.$slide_row_number] ) ? esc_attr($options['pm_slider_default_info_txt_'.$slide_row_number]) : ''; ?></textarea>
					<p><span class="description" style="margin:20px 0;"><?php esc_html_e("Study the above text for slider's specific syntax", 'cloud_clarity'); ?></span></p>
				    </td>
				    <td style="padding:0 5px; width:20%" valign="top">
					<p style="font-weight:bold;"><?php esc_html_e('Upload Slide:', 'cloud_clarity'); ?></p>
					<input id="pm_slide_img_url_<?php echo $slide_row_number; ?>" name="cloud_clarity_options[pm_slide_img_url_<?php echo $slide_row_number; ?>]" style=" margin: 5px 0;" type="text" size="20"
						value="<?php if ($options['pm_slide_img_url_'.$slide_row_number]){ echo esc_attr($options['pm_slide_img_url_'.$slide_row_number]); }?>" />
					<div class="uploadify" style="padding-top:7px;">
					    <input type="file" name="uploadify-<?php echo $slide_row_number; ?>" id="uploadify-<?php echo $slide_row_number; ?>" />
					</div>
					<div id="file-uploaded-<?php echo $slide_row_number; ?>" class="file-uploaded" style="float:right; clear:right; padding-right:5px; line-height:24px; color:green"></div>
				    </td>
				</tr>
<?php			    endforeach; ?>
			</tbody>
		    </table>
		    <table id="pm-clone-table" style="display:none;">
			<tbody>
			    <tr id="999" class="row-style">
				<td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				<td class="deleteSlide" style="margin:10px 10px; padding:5px 15px;">&nbsp;</td>
				<td class="position" style="padding:15px 5px; width:10%; font-weight:bold; font-size:20px; text-align:center;">999</td>
				<td class="slide-info-text" style="padding:0; width:70%">
				    <p style="font-weight:bold;"><?php esc_html_e('Edit the info text, erase all for none:', 'cloud_clarity'); ?></p>
				    <textarea name="cloud_clarity_options[pm_slider_default_info_txt_999]" class="code"
						style="width:97%; font-size:12px; margin: 5px 0;" id="pm_slider_default_info_txt_999"
						rows="6" cols="60" wrap="off"><?php echo get_pm_slider_default_info_txt(); ?></textarea>
				    <p><span class="description" style="margin:20px 0;"><?php esc_html_e("Study the above text for slider's specific syntax", 'cloud_clarity'); ?></span></p>
				</td>
				<td style="padding:0 5px; width:20%" valign="top">
				    <p style="font-weight:bold;"><?php esc_html_e('Upload Slide:', 'cloud_clarity'); ?></p>
				    <input id="pm_slide_img_url_999" name="cloud_clarity_options[pm_slide_img_url_999]" style=" margin: 5px 0;" type="text" size="20" value="" />
				    <div class="uploadify" style="padding-top:7px;">
					<input type="file" name="uploadify-999" id="uploadify-999" />
				    </div>
				    <div id="file-uploaded-999" class="file-uploaded" style="float:right; clear:right; padding-right:5px; line-height:24px; color:green"></div>
				</td>
			    </tr>
			</tbody>
		    </table>

		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('No JavaScript image', 'cloud_clarity'); ?></th>
				<td>
				    <?php esc_html_e('Paste the full path to your image:', 'cloud_clarity'); ?><br />
				    <textarea style="width: 98%; font-size: 12px;" id="pm_no_js_img" rows="2" cols="60" name="cloud_clarity_options[pm_no_js_img]"><?php if( $pm_no_js_img ){ echo esc_url($pm_no_js_img); } ?></textarea><br />
				    <span class="description"><?php esc_html_e('In the case when JavaScript is disabled the 1st slider image is displayed by default in place of the Piecemaker slider, you may change that in here', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			</tbody>
		    </table>

<?php		elseif ( $current_slider == '2' ) :
		    $c1_image_width = $options['c1_image_width'];
		    $c1_image_height = $options['c1_image_height'];
		    $c1_slides_order_str = $options['c1_slides_order_str'];
		    $c1_slides_array = explode( ',', $options['c1_slides_order_str'] );
		    $c1_speed = $options['c1_speed'];
		    $c1_timeout = $options['c1_timeout'];
		    $c1_sync = $options['c1_sync']; // see the other slides' forms to add an invisible instance of this checkbox to preserver the state
		    $c1_remove_3d_shadow = $options['c1_remove_3d_shadow'];  ?>
		    <!-- Add invisible fields from the other sliders' forms to preserve their state. (this is only necessary for checkboxes and some text fields)  -->
		    <input style="display:none;" name="cloud_clarity_options[c2_sync]" type="checkbox" id="c2_sync" value="yes" <?php checked('yes', $options['c2_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c2_text_transition_on]" type="checkbox" id="c2_text_transition_on" value="yes" <?php checked('yes', $options['c2_text_transition_on']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[pm_remove_3d_shadow]" type="checkbox" id="pm_remove_3d_shadow" value="yes" <?php checked('yes', $options['pm_remove_3d_shadow']); ?> />
		    <input name="cloud_clarity_options[no_slider_text]" type="hidden" id="no_slider_text" value="<?php if ($options['no_slider_text']) { echo esc_attr($options['no_slider_text']); } ?>" />


		    <h2 style="color:#2680AA; margin-top: 2px; padding:20px 10px 0;"><?php esc_html_e('Cycle 1 Slider Settings:', 'cloud_clarity'); ?></h2>
		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><label for="c1_image_width"><?php esc_html_e('Image Width', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c1_image_width]" type="text" id="c1_image_width" value="<?php echo esc_attr($c1_image_width); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('The width of the images to be loaded.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="c1_image_height"><?php esc_html_e('Image Height', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c1_image_height]" type="text" id="c1_image_height" value="<?php echo esc_attr($c1_image_height); ?>" size="5" maxlength="4" />
				    <span><?php esc_html_e('The height of the images to be loaded.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="c1_speed"><?php esc_html_e('Transition Speed', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c1_speed]" type="text" id="c1_speed" value="<?php echo esc_attr($c1_speed); ?>" size="5" maxlength="6" />
				    <span><?php esc_html_e('Speed of the transition.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="c1_timeout"><?php esc_html_e('Timeout', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c1_timeout]" type="text" id="c1_timeout" value="<?php echo esc_attr($c1_timeout); ?>" size="5" maxlength="6" />
				    <span><?php esc_html_e('Milliseconds between slide transitions (0 to disable auto advance).', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Sync', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Sync', 'cloud_clarity'); ?></span></legend>
				    <label for="c1_sync">
					<input name="cloud_clarity_options[c1_sync]" type="checkbox" id="c1_sync" value="yes" <?php checked('yes', $c1_sync); ?> />
					<?php esc_html_e('Toggle this option to see how some effects behave differently (such as blind, curtain, and zoom).', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('3D Shadow', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('3D Shadow', 'cloud_clarity'); ?></span></legend>
				    <label for="c1_remove_3d_shadow">
					<input name="cloud_clarity_options[c1_remove_3d_shadow]" type="checkbox" id="c1_remove_3d_shadow" value="yes" <?php checked('yes', $c1_remove_3d_shadow); ?> />
					<?php esc_html_e('Remove the 3D shadow under the slider', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			</tbody>
		    </table>


		    <input name="cloud_clarity_options[c1_slides_order_str]" type="hidden" id="c1_slides_order_str" value="<?php if ($c1_slides_order_str){ echo esc_attr($c1_slides_order_str); }?>" />
		    <div class="add-row" style></div>
		    <table id="c1-table-slides" class="c1-table-slides">
			<tbody>
    <?php		    foreach( $c1_slides_array as $position=>$slide_row_number ) : ?>
				<tr id="<?php echo $slide_row_number; ?>" class="row-style">
				    <td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				    <td class="deleteSlide" style="margin:10px 10px; width:30px; padding:5px 15px;">&nbsp;</td>
				    <td class="position" style="padding:15px 20px; width:40px; font-weight:bold; font-size:20px; text-align:center; height:110px"><?php echo $position+1; ?></td>
				    <td style="padding:0 10px 10px 20px; width:100%" valign="top">
					<p style="font-weight:bold;"><?php esc_html_e('Slide Image:', 'cloud_clarity'); ?></p>
					<textarea style="width: 98%; font-size: 12px;" id="c1_slide_img_url_<?php echo $slide_row_number; ?>" rows="2" cols="60" name="cloud_clarity_options[c1_slide_img_url_<?php echo $slide_row_number; ?>]"><?php if ($options['c1_slide_img_url_'.$slide_row_number]){ echo esc_url($options['c1_slide_img_url_'.$slide_row_number]); }?></textarea><br />
					<div class="uploadify" style="padding-top:7px; width: 120px; float:left;">
					    <input type="file" name="uploadify-<?php echo $slide_row_number; ?>" id="uploadify-<?php echo $slide_row_number; ?>" />
					</div>
					<div class="transition-type" style="padding:7px 5px 0 30px; float:left;">
					    <select name="cloud_clarity_options[c1_transition_type_<?php echo $slide_row_number; ?>]" id="c1_transition_type_<?php echo $slide_row_number; ?>">
						<option value="fade"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'fade') ? ' selected="selected"' : ''; ?>>fade</option>
						<option value="curtainX"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'curtainX') ? ' selected="selected"' : ''; ?>>curtainX</option>
						<option value="curtainY"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'curtainY') ? ' selected="selected"' : ''; ?>>curtainY</option>
						<option value="turnUp"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'turnUp') ? ' selected="selected"' : ''; ?>>turnUp</option>
						<option value="turnDown"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'turnDown') ? ' selected="selected"' : ''; ?>>turnDown</option>
						<option value="wipe"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'wipe') ? ' selected="selected"' : ''; ?>>wipe</option>
						<option value="scrollHorz"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollHorz') ? ' selected="selected"' : ''; ?>>scrollHorz</option>
						<option value="scrollVert"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollVert') ? ' selected="selected"' : ''; ?>>scrollVert</option>
						<option value="growX"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'growX') ? ' selected="selected"' : ''; ?>>growX</option>
						<option value="growY"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'growY') ? ' selected="selected"' : ''; ?>>growY</option>
						<option value="scrollUp"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollUp') ? ' selected="selected"' : ''; ?>>scrollUp</option>
						<option value="scrollDown"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollDown') ? ' selected="selected"' : ''; ?>>scrollDown</option>
						<option value="shuffle"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'shuffle') ? ' selected="selected"' : ''; ?>>shuffle</option>
						<option value="blindX"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'blindX') ? ' selected="selected"' : ''; ?>>blindX</option>
						<option value="blindY"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'blindY') ? ' selected="selected"' : ''; ?>>blindY</option>
						<option value="blindZ"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'blindZ') ? ' selected="selected"' : ''; ?>>blindZ</option>
						<option value="cover"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'cover') ? ' selected="selected"' : ''; ?>>cover</option>
						<option value="fadeZoom"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'fadeZoom') ? ' selected="selected"' : ''; ?>>fadeZoom</option>
						<option value="scrollLeft"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollLeft') ? ' selected="selected"' : ''; ?>>scrollLeft</option>
						<option value="scrollRight"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'scrollRight') ? ' selected="selected"' : ''; ?>>scrollRight</option>
						<option value="slideX"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'slideX') ? ' selected="selected"' : ''; ?>>slideX</option>
						<option value="slideY"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'slideY') ? ' selected="selected"' : ''; ?>>slideY</option>
						<option value="toss"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'toss') ? ' selected="selected"' : ''; ?>>toss</option>
						<option value="turnLeft"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'turnLeft') ? ' selected="selected"' : ''; ?>>turnLeft</option>
						<option value="turnRight"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'turnRight') ? ' selected="selected"' : ''; ?>>turnRight</option>
						<option value="uncover"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'uncover') ? ' selected="selected"' : ''; ?>>uncover</option>
						<option value="zoom"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'zoom') ? ' selected="selected"' : ''; ?>>zoom</option>
						<option value="none"<?php echo ($options['c1_transition_type_'.$slide_row_number] == 'none') ? ' selected="selected"' : ''; ?>>none</option>
					    </select>
					    <span><?php esc_html_e('Transition effect.', 'cloud_clarity'); ?></span>
					</div>
					<div id="file-uploaded-<?php echo $slide_row_number; ?>" class="file-uploaded" style="float:right; clear:both; padding-right:5px; line-height:24px; color:green"></div>
					<div id="c1_slide_link_url_<?php echo $slide_row_number; ?>" class="slide-link" style="padding:20px 5px 0; clear:both;">
					    <label for="c1_slide_link_url_<?php echo $slide_row_number; ?>"><?php esc_html_e('Link:', 'cloud_clarity'); ?> </label>
					    <input name="cloud_clarity_options[c1_slide_link_url_<?php echo $slide_row_number; ?>]" type="text" id="c1_slide_link_url_<?php echo $slide_row_number; ?>" value="<?php if ($options['c1_slide_link_url_'.$slide_row_number]){ echo esc_url($options['c1_slide_link_url_'.$slide_row_number]); }?>" size="30" />
					    <label for="c1_slide_link_target_<?php echo $slide_row_number; ?>">
						<?php esc_html_e('Target: ', 'cloud_clarity'); ?>
						<select name="cloud_clarity_options[c1_slide_link_target_<?php echo $slide_row_number; ?>]" id="c1_slide_link_target_<?php echo $slide_row_number; ?>">
						    <option value="self"<?php echo ($options['c1_slide_link_target_'.$slide_row_number] == 'self') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('self', 'cloud_clarity'); ?></option>
						    <option value="blank"<?php echo ($options['c1_slide_link_target_'.$slide_row_number] == 'blank') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('blank', 'cloud_clarity'); ?></option>
						</select>
					    </label>
					</div>
				    </td>
				</tr>
    <?php		    endforeach; ?>
			</tbody>
		    </table>
		    <table id="c1-clone-table" style="display:none;">
			<tbody>
			    <tr id="999" class="row-style">
				<td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				<td class="deleteSlide" style="margin:10px 10px; width:30px; padding:5px 15px;">&nbsp;</td>
				<td class="position" style="padding:15px 20px; width:40px; font-weight:bold; font-size:20px; text-align:center; height:110px">999</td>
				<td style="padding:0 10px 10px 20px; width:100%" valign="top">
				    <p style="font-weight:bold;"><?php esc_html_e('Slide Image:', 'cloud_clarity'); ?></p>
				    <textarea style="width: 98%; font-size: 12px;" id="c1_slide_img_url_999" rows="2" cols="60" name="cloud_clarity_options[c1_slide_img_url_999]"></textarea><br />
				    <div class="uploadify" style="padding-top:7px; float:left;">
					<input type="file" name="uploadify-999" id="uploadify-999" />
				    </div>
				    <div class="transition-type" style="padding:7px 5px 0 30px; float:left;">
					<select name="cloud_clarity_options[c1_transition_type_999]" id="c1_transition_type_999">
					    <option value="fade" selected="selected">fade</option>
					    <option value="curtainX">curtainX</option>
					    <option value="curtainY">curtainY</option>
					    <option value="turnUp">turnUp</option>
					    <option value="turnDown">turnDown</option>
					    <option value="wipe">wipe</option>
					    <option value="scrollHorz">scrollHorz</option>
					    <option value="scrollVert">scrollVert</option>
					    <option value="growX">growX</option>
					    <option value="growY">growY</option>
					    <option value="scrollUp">scrollUp</option>
					    <option value="scrollDown">scrollDown</option>
					    <option value="shuffle">shuffle</option>
					    <option value="blindX">blindX</option>
					    <option value="blindY">blindY</option>
					    <option value="blindZ">blindZ</option>
					    <option value="cover">cover</option>
					    <option value="fadeZoom">fadeZoom</option>
					    <option value="scrollLeft">scrollLeft</option>
					    <option value="scrollRight">scrollRight</option>
					    <option value="slideX">slideX</option>
					    <option value="slideY">slideY</option>
					    <option value="toss">toss</option>
					    <option value="turnLeft">turnLeft</option>
					    <option value="turnRight">turnRight</option>
					    <option value="uncover">uncover</option>
					    <option value="zoom">zoom</option>
					    <option value="none">none</option>
					</select>
					<span><?php esc_html_e('Transition effect.', 'cloud_clarity'); ?></span>
				    </div>
				    <div id="file-uploaded-999" class="file-uploaded" style="float:right; clear:both; padding-right:5px; line-height:24px; color:green"></div>
				    <div id="c1_slide_link_url_999" class="slide-link" style="padding:20px 5px 0; clear:both;">
					<label for="c1_slide_link_url_999" class="link-url"><?php esc_html_e('Link:', 'cloud_clarity'); ?> </label>
					<input name="cloud_clarity_options[c1_slide_link_url_999]" type="text" id="c1_slide_link_url_999" value="" size="30" />
					<label for="c1_slide_link_target_999" class="link-target">
						<?php esc_html_e('Target: ', 'cloud_clarity'); ?>
						<select name="cloud_clarity_options[c1_slide_link_target_999]" id="c1_slide_link_target_999">
						    <option value="self" selected="selected"><?php esc_attr_e('self', 'cloud_clarity'); ?></option>
						    <option value="blank"><?php esc_attr_e('blank', 'cloud_clarity'); ?></option>
						</select>
					</label>
				    </div>
				</td>
			    </tr>
			</tbody>
		    </table>

<?php		elseif ( $current_slider == '3' ) :
		    $c2_slides_order_str = $options['c2_slides_order_str'];
		    $c2_slides_array = explode( ',', $options['c2_slides_order_str'] );
		    $c2_speed = $options['c2_speed'];
		    $c2_timeout = $options['c2_timeout'];
		    $c2_sync = $options['c2_sync']; // see the other slides' forms to add an invisible instance of this checkbox to preserver the state
		    $c2_text_color = $options['c2_text_color'];  ?>
		    <!-- Add invisible fields from the other sliders' forms to preserve their state. (this is only necessary for checkboxes and some text fields)  -->
		    <input style="display:none;" name="cloud_clarity_options[c1_sync]" type="checkbox" id="c1_sync" value="yes" <?php checked('yes', $options['c1_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[pm_remove_3d_shadow]" type="checkbox" id="pm_remove_3d_shadow" value="yes" <?php checked('yes', $options['pm_remove_3d_shadow']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c1_remove_3d_shadow]" type="checkbox" id="c1_remove_3d_shadow" value="yes" <?php checked('yes', $options['c1_remove_3d_shadow']); ?> />
		    <input name="cloud_clarity_options[no_slider_text]" type="hidden" id="no_slider_text" value="<?php if ($options['no_slider_text']) { echo esc_attr($options['no_slider_text']); } ?>" />


		    <h2 style="color:#2680AA; margin-top: 2px; padding:20px 10px 0;"><?php esc_html_e('Cycle 2 Slider Settings:', 'cloud_clarity'); ?></h2>
		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><label for="c2_speed"><?php esc_html_e('Transition Speed', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c2_speed]" type="text" id="c2_speed" value="<?php echo esc_attr($c2_speed); ?>" size="5" maxlength="6" />
				    <span><?php esc_html_e('Speed of the transition.', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><label for="c2_timeout"><?php esc_html_e('Timeout', 'cloud_clarity'); ?></label></th>
				<td>
				    <input name="cloud_clarity_options[c2_timeout]" type="text" id="c2_timeout" value="<?php echo esc_attr($c2_timeout); ?>" size="5" maxlength="6" />
				    <span><?php esc_html_e('Milliseconds between slide transitions (0 to disable auto advance).', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Sync', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Sync', 'cloud_clarity'); ?></span></legend>
				    <label for="c2_sync">
					<input name="cloud_clarity_options[c2_sync]" type="checkbox" id="c2_sync" value="yes" <?php checked('yes', $c2_sync); ?> />
					<?php esc_html_e('Toggle this option to see how some effects behave differently (such as blind, curtain, and zoom).', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Enable Transition on Text', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Enable Transition on Text', 'cloud_clarity'); ?></span></legend>
				    <label for="c2_text_transition_on">
					<input name="cloud_clarity_options[c2_text_transition_on]" type="checkbox" id="c2_text_transition_on" value="yes" <?php checked('yes', $options['c2_text_transition_on']); ?> />
					<?php esc_html_e('Toggle this option to enable/disable the transition effect on the info text. If disabled (unchecked) then the text will disapear for the duration of the transition.', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			</tbody>
		    </table>
		    
		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Text Color', 'cloud_clarity'); ?></th>
				<td style="width:37px; padding:4px 4px">
				    <div id="c2-colorSelector1">
					<div style="background-color: #<?php echo ($c2_text_color) ? esc_attr($c2_text_color) : 'FFFFFF'; ?>;"></div>
				    </div>
				</td>
				<td>
				    <input name="cloud_clarity_options[c2_text_color]" id="c2_text_color" type="text" maxlength="6" size="6" style="margin:7px 10px 0 0" value="<?php echo ($c2_text_color) ? esc_attr($c2_text_color) : 'FFFFFF'; ?>" />
				    <?php esc_html_e('Description text color', 'cloud_clarity'); ?>
				</td>
			    </tr>
			</tbody>
		    </table>


		    <input name="cloud_clarity_options[c2_slides_order_str]" type="hidden" id="c2_slides_order_str" value="<?php if ($c2_slides_order_str){ echo esc_attr($c2_slides_order_str); }?>" />
		    <div class="add-row" style></div>
		    <table id="c2-table-slides" class="c2-table-slides">
			<tbody>
    <?php		    foreach( $c2_slides_array as $position=>$slide_row_number ) : ?>
				<tr id="<?php echo $slide_row_number; ?>" class="row-style">
				    <td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				    <td class="deleteSlide" style="margin:10px 10px; width:30px; padding:5px 15px;">&nbsp;</td>
				    <td class="position" style="padding:15px 20px; width:40px; font-weight:bold; font-size:20px; text-align:center; height:110px"><?php echo $position+1; ?></td>
				    <td style="padding:10px 10px 10px 20px; width:100%" valign="top">
					<div class="c2_slide_img_url" style="padding:7px 5px 0 0; float:left; display:inline;">
					    <label for="c2_slide_img_url_<?php echo $slide_row_number; ?>" style="font-weight:bold;"><?php esc_html_e('Image:', 'cloud_clarity'); ?></label>
					    <input name="cloud_clarity_options[c2_slide_img_url_<?php echo $slide_row_number; ?>]" type="text" id="c2_slide_img_url_<?php echo $slide_row_number; ?>" name="cloud_clarity_options[c2_slide_img_url_<?php echo $slide_row_number; ?>]" value="<?php if ($options['c2_slide_img_url_'.$slide_row_number]){ echo esc_url($options['c2_slide_img_url_'.$slide_row_number]); }?>" size="40" />
					</div>
					<div class="uploadify" style="padding-top:7px; width: 120px; float:left; display:inline;">
					    <input type="file" name="uploadify-<?php echo $slide_row_number; ?>" id="uploadify-<?php echo $slide_row_number; ?>" />
					</div>
					<div id="file-uploaded-<?php echo $slide_row_number; ?>" class="file-uploaded" style="clear:both; padding-right:5px; line-height:24px; color:green"></div>
					<div class="transition-type" style="padding:10px 5px 0 0; clear:both;">
					    <strong><?php esc_html_e('Transition:', 'cloud_clarity'); ?></strong>
					    <select name="cloud_clarity_options[c2_transition_type_<?php echo $slide_row_number; ?>]" id="c2_transition_type_<?php echo $slide_row_number; ?>">
						<option value="fade"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'fade') ? ' selected="selected"' : ''; ?>>fade</option>
						<option value="curtainX"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'curtainX') ? ' selected="selected"' : ''; ?>>curtainX</option>
						<option value="curtainY"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'curtainY') ? ' selected="selected"' : ''; ?>>curtainY</option>
						<option value="turnUp"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'turnUp') ? ' selected="selected"' : ''; ?>>turnUp</option>
						<option value="turnDown"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'turnDown') ? ' selected="selected"' : ''; ?>>turnDown</option>
						<option value="wipe"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'wipe') ? ' selected="selected"' : ''; ?>>wipe</option>
						<option value="scrollHorz"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollHorz') ? ' selected="selected"' : ''; ?>>scrollHorz</option>
						<option value="scrollVert"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollVert') ? ' selected="selected"' : ''; ?>>scrollVert</option>
						<option value="growX"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'growX') ? ' selected="selected"' : ''; ?>>growX</option>
						<option value="growY"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'growY') ? ' selected="selected"' : ''; ?>>growY</option>
						<option value="scrollUp"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollUp') ? ' selected="selected"' : ''; ?>>scrollUp</option>
						<option value="scrollDown"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollDown') ? ' selected="selected"' : ''; ?>>scrollDown</option>
						<option value="shuffle"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'shuffle') ? ' selected="selected"' : ''; ?>>shuffle</option>
						<option value="blindX"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'blindX') ? ' selected="selected"' : ''; ?>>blindX</option>
						<option value="blindY"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'blindY') ? ' selected="selected"' : ''; ?>>blindY</option>
						<option value="blindZ"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'blindZ') ? ' selected="selected"' : ''; ?>>blindZ</option>
						<option value="cover"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'cover') ? ' selected="selected"' : ''; ?>>cover</option>
						<option value="fadeZoom"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'fadeZoom') ? ' selected="selected"' : ''; ?>>fadeZoom</option>
						<option value="scrollLeft"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollLeft') ? ' selected="selected"' : ''; ?>>scrollLeft</option>
						<option value="scrollRight"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'scrollRight') ? ' selected="selected"' : ''; ?>>scrollRight</option>
						<option value="slideX"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'slideX') ? ' selected="selected"' : ''; ?>>slideX</option>
						<option value="slideY"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'slideY') ? ' selected="selected"' : ''; ?>>slideY</option>
						<option value="toss"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'toss') ? ' selected="selected"' : ''; ?>>toss</option>
						<option value="turnLeft"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'turnLeft') ? ' selected="selected"' : ''; ?>>turnLeft</option>
						<option value="turnRight"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'turnRight') ? ' selected="selected"' : ''; ?>>turnRight</option>
						<option value="uncover"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'uncover') ? ' selected="selected"' : ''; ?>>uncover</option>
						<option value="zoom"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'zoom') ? ' selected="selected"' : ''; ?>>zoom</option>
						<option value="none"<?php echo ($options['c2_transition_type_'.$slide_row_number] == 'none') ? ' selected="selected"' : ''; ?>>none</option>
					    </select>
					</div>
					<div id="c2_slide_link_url_<?php echo $slide_row_number; ?>" class="slide-link" style="padding:10px 5px 0 0; clear:both;">
					    <label for="c2_slide_link_url_<?php echo $slide_row_number; ?>" style="font-weight:bold;"><?php esc_html_e('Link:', 'cloud_clarity'); ?> </label>
					    <input name="cloud_clarity_options[c2_slide_link_url_<?php echo $slide_row_number; ?>]" type="text" id="c2_slide_link_url_<?php echo $slide_row_number; ?>" value="<?php if ($options['c2_slide_link_url_'.$slide_row_number]){ echo esc_url($options['c2_slide_link_url_'.$slide_row_number]); }?>" size="30" />
					    <label for="c2_slide_link_target_<?php echo $slide_row_number; ?>">
						<?php esc_html_e('Target: ', 'cloud_clarity'); ?>
						<select name="cloud_clarity_options[c2_slide_link_target_<?php echo $slide_row_number; ?>]" id="c2_slide_link_target_<?php echo $slide_row_number; ?>">
						    <option value="self"<?php echo ($options['c2_slide_link_target_'.$slide_row_number] == 'self') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('self', 'cloud_clarity'); ?></option>
						    <option value="blank"<?php echo ($options['c2_slide_link_target_'.$slide_row_number] == 'blank') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('blank', 'cloud_clarity'); ?></option>
						</select>
					    </label>
					</div>
					<div class="slide-info-text" style="padding:10px 5px 0 0; width:60%; float:left; display:inline;">
					    <strong><?php esc_html_e('Slide text', 'cloud_clarity'); ?></strong> <span class="description" style="margin:20px 0;"><?php esc_html_e('(You could use text and/or html)', 'cloud_clarity'); ?></span>:<br />
					    <textarea name="cloud_clarity_options[c2_slide_default_info_txt_<?php echo $slide_row_number; ?>]" class="code"
							style="width:97%; font-size:12px; margin: 5px 0;" id="c2_slide_default_info_txt_<?php echo $slide_row_number; ?>"
							rows="4" cols="60"><?php echo ( $options['c2_slide_default_info_txt_'.$slide_row_number] ) ? esc_attr($options['c2_slide_default_info_txt_'.$slide_row_number]) : ''; ?></textarea>
					</div>
					<div class="slide-button" style="padding-top:10px; float:left; display:inline; width:35%">
					    <label for="c2_slide_button_txt_<?php echo $slide_row_number; ?>" style="font-weight:bold;"><?php esc_html_e('Button Text:', 'cloud_clarity'); ?> </label><br />
					    <input name="cloud_clarity_options[c2_slide_button_txt_<?php echo $slide_row_number; ?>]" type="text" id="c2_slide_button_txt_<?php echo $slide_row_number; ?>" value="<?php echo esc_attr($options['c2_slide_button_txt_'.$slide_row_number]); ?>" size="20" /><br />
					    <span class="description" style="padding:5px; display:block; line-height:17px;"><?php _e('The button is activated only if a <strong>Link</strong> is provided.', 'cloud_clarity'); ?></span>
					</div>
				    </td>
				</tr>
    <?php		    endforeach; ?>
			</tbody>
		    </table>
		    <table id="c2-clone-table" style="display:none;">
			<tbody>
			    <tr id="999" class="row-style">
				<td class="dragHandle showDragHandle" style="width:30px; padding:15px 20px;">&nbsp;</td>
				<td class="deleteSlide" style="margin:10px 10px; width:30px; padding:5px 15px;">&nbsp;</td>
				<td class="position" style="padding:15px 20px; width:40px; font-weight:bold; font-size:20px; text-align:center; height:110px">999</td>
				<td style="padding:10px 10px 10px 20px; width:100%" valign="top">
				    <div class="c2_slide_img_url" style="padding:7px 5px 0 0; float:left; display:inline;">
					<label for="c2_slide_img_url_999" style="font-weight:bold;"><?php esc_html_e('Image:', 'cloud_clarity'); ?></label>
					<input name="cloud_clarity_options[c2_slide_img_url_999]" type="text" id="c2_slide_img_url_999" name="cloud_clarity_options[c2_slide_img_url_999]" value="" size="40" />
				    </div>
				    <div class="uploadify" style="padding-top:7px; float:left; display:inline;">
					<input type="file" name="uploadify-999" id="uploadify-999" />
				    </div>
				    <div id="file-uploaded-999" class="file-uploaded" style="clear:both; padding-left:5px; line-height:24px; color:green"></div>
				    <div class="transition-type" style="padding:10px 5px 0 0; clear:both;">
					<strong><?php esc_html_e('Transition:', 'cloud_clarity'); ?></strong>
					<select name="cloud_clarity_options[c2_transition_type_999]" id="c2_transition_type_999">
					    <option value="fade" selected="selected">fade</option>
					    <option value="curtainX">curtainX</option>
					    <option value="curtainY">curtainY</option>
					    <option value="turnUp">turnUp</option>
					    <option value="turnDown">turnDown</option>
					    <option value="wipe">wipe</option>
					    <option value="scrollHorz">scrollHorz</option>
					    <option value="scrollVert">scrollVert</option>
					    <option value="growX">growX</option>
					    <option value="growY">growY</option>
					    <option value="scrollUp">scrollUp</option>
					    <option value="scrollDown">scrollDown</option>
					    <option value="shuffle">shuffle</option>
					    <option value="blindX">blindX</option>
					    <option value="blindY">blindY</option>
					    <option value="blindZ">blindZ</option>
					    <option value="cover">cover</option>
					    <option value="fadeZoom">fadeZoom</option>
					    <option value="scrollLeft">scrollLeft</option>
					    <option value="scrollRight">scrollRight</option>
					    <option value="slideX">slideX</option>
					    <option value="slideY">slideY</option>
					    <option value="toss">toss</option>
					    <option value="turnLeft">turnLeft</option>
					    <option value="turnRight">turnRight</option>
					    <option value="uncover">uncover</option>
					    <option value="zoom">zoom</option>
					    <option value="none">none</option>
					</select>
				    </div>
				    <div id="c2_slide_link_url_999" class="slide-link" style="padding:10px 5px 0 0; clear:both;">
					<label for="c2_slide_link_url_999" class="link-url" style="font-weight:bold;"><?php esc_html_e('Link:', 'cloud_clarity'); ?> </label>
					<input name="cloud_clarity_options[c2_slide_link_url_999]" type="text" id="c2_slide_link_url_999" value="" size="30" />
					<label for="c2_slide_link_target_999" class="link-target">
						<?php esc_html_e('Target: ', 'cloud_clarity'); ?>
						<select name="cloud_clarity_options[c2_slide_link_target_999]" id="c2_slide_link_target_999">
						    <option value="self" selected="selected"><?php esc_attr_e('self', 'cloud_clarity'); ?></option>
						    <option value="blank"><?php esc_attr_e('blank', 'cloud_clarity'); ?></option>
						</select>
					</label>
				    </div>
				    <div class="slide-info-text" style="padding:10px 5px 0 0; width:60%; float:left; display:inline;">
					<strong><?php esc_html_e('Slide text', 'cloud_clarity'); ?></strong> <span class="description" style="margin:20px 0;"><?php esc_html_e('(You could use text and/or html)', 'cloud_clarity'); ?></span>:<br />
					<textarea name="cloud_clarity_options[c2_slide_default_info_txt_999]" class="code"
						    style="width:97%; font-size:12px; margin: 5px 0;" id="c2_slide_default_info_txt_999"
						    rows="4" cols="60"><?php echo get_c2_slide_default_info_txt(); ?></textarea>
				    </div>
				    <div class="slide-button" style="padding-top:10px; float:left; display:inline; width:35%">
					<label for="c2_slide_button_txt_999" style="font-weight:bold;"><?php esc_html_e('Button Text:', 'cloud_clarity'); ?> </label><br />
					<input name="cloud_clarity_options[c2_slide_button_txt_999]" type="text" id="c2_slide_button_txt_999" value="<?php echo esc_attr($options['c2_slide_button_txt_1']); ?>" size="20" /><br />
					<span class="description" style="padding:5px; display:block; line-height:17px;"><?php _e('The button is activated only if a <strong>Link</strong> is provided.', 'cloud_clarity'); ?></span>
				    </div>
				</td>
			    </tr>
			</tbody>
		    </table>

<?php		elseif ( $current_slider == '4' ) : // No slider ?>
		    <!-- Add invisible fields from the other sliders' forms to preserve their state. (this is only necessary for checkboxes and some text fields)  -->
		    <input style="display:none;" name="cloud_clarity_options[c1_sync]" type="checkbox" id="c1_sync" value="yes" <?php checked('yes', $options['c1_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c2_sync]" type="checkbox" id="c2_sync" value="yes" <?php checked('yes', $options['c2_sync']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c2_text_transition_on]" type="checkbox" id="c2_text_transition_on" value="yes" <?php checked('yes', $options['c2_text_transition_on']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[pm_remove_3d_shadow]" type="checkbox" id="pm_remove_3d_shadow" value="yes" <?php checked('yes', $options['pm_remove_3d_shadow']); ?> />
		    <input style="display:none;" name="cloud_clarity_options[c1_remove_3d_shadow]" type="checkbox" id="c1_remove_3d_shadow" value="yes" <?php checked('yes', $options['c1_remove_3d_shadow']); ?> />

		    <table class="form-table">
			<tbody>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('No Slider Text', 'cloud_clarity'); ?></th>
				<td>
				    <?php esc_html_e('Change the phrase:', 'cloud_clarity'); ?> <input name="cloud_clarity_options[no_slider_text]" type="text" id="no_slider_text" value="<?php if ($options['no_slider_text']) { echo esc_attr($options['no_slider_text']); } ?>" size="35" maxlength="120" />
				    <br />
				    <span class="description"><?php esc_html_e('This is the title text displayed in the place of the slider on the home page', 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			</tbody>
		    </table>
<?php		endif;
	}

	function portfolio_section_options_contentbox( $options ) {
		$portfolio_title_posistion = $options['portfolio_title_posistion'];
		$portfolio_sidebar = $options['portfolio_sidebar']; ?>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Portfolio Pages', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Use this area to assign Portfolio Categories to their respective Portfolio pages.', 'cloud_clarity'); ?><br />
				<?php esc_html_e('Firstly though, you have to create the Portfolio page(s) and assign the "Portfolio page" template to it.', 'cloud_clarity'); ?><br />
				<?php esc_html_e("If you don't see any categories in the dropdown(s) below it's because you haven't created any yet, in that case go go 'Posts -> Categories' and create a 'Portfolio' category there. Also don't forget to save all your Portfolio related Posts and sub categories under that category.", 'cloud_clarity'); ?><br />
<?php				$portfolio_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio.php&hierarchical=0');
				foreach ($portfolio_pages_array as $portfolio_page_obj) :
				    $port_page_ID = $portfolio_page_obj->ID; ?>
				    <div style="margin-bottom:10px;background-color:#F9F9F9; padding:7px; border:1px solid #ddd;">
					<?php esc_html_e('To Portfolio page', 'cloud_clarity'); ?> <strong><?php echo $portfolio_page_obj->post_title; ?></strong> (page ID: <strong><?php echo $port_page_ID; ?></strong>) <br />
					<?php esc_html_e('assign the Category:', 'cloud_clarity'); ?> <?php wp_dropdown_categories("show_option_all=Select Category&hierarchical=1&orderby=name&selected={$options['portfolio_cat_for_page_'.$port_page_ID]}&name=cloud_clarity_options[portfolio_cat_for_page_{$port_page_ID}]&class=postform"); ?><br />
					<?php esc_html_e('with', 'cloud_clarity'); ?> <input name="cloud_clarity_options[portfolio_items_per_page_for_page_<?php echo $port_page_ID ?>]" type="text" id="portfolio_items_per_page_for_page_<?php echo $port_page_ID ?>" value="<?php echo ($options['portfolio_items_per_page_for_page_'.$port_page_ID]) ? esc_attr($options['portfolio_items_per_page_for_page_'.$port_page_ID]) : '6'; ?>" size="5" maxlength="5" /> <?php esc_html_e('items per page.', 'cloud_clarity'); ?>
				    </div>
<?php				endforeach; ?>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Portfolio Title Position', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e('Choose position:', 'cloud_clarity'); ?><br />
				<label><input type="radio" name="cloud_clarity_options[portfolio_title_posistion]" id="portfolio_title_posistion_below" value="below" <?php checked('below', $portfolio_title_posistion); ?> /> <?php esc_html_e('Below', 'cloud_clarity'); ?></label>&nbsp;&nbsp;
				<label><input type="radio" name="cloud_clarity_options[portfolio_title_posistion]" id="portfolio_title_posistion_above" value="above" <?php checked('above', $portfolio_title_posistion); ?> /> <?php esc_html_e('Above', 'cloud_clarity'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="description"><?php esc_html_e('This is the post title shown with every thumbnail. Choose whether you would like to have it displayed above the Thumbnail or just below it.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
		    </tbody>
		</table>

		<div class="form-table" style="background-color:#F9F9F9; border:1px solid #DDDDDD; margin-bottom:5px;">
		    <p style="padding:20px 5px 10px;"><?php esc_html_e('The following settings refer to the individual portfolio item post which is usually accessed by slicking on a portfoilo item title or "read more..." link (if present).', 'cloud_clarity'); ?></p>
		    <table>
			<tbody>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Sidebar Position', 'cloud_clarity'); ?></th>
				<td>
				    <?php esc_html_e('Choose position:', 'cloud_clarity'); ?><br />
				    <label><input type="radio" name="cloud_clarity_options[portfolio_sidebar]" id="portfolio_sidebar_left" value="left" <?php checked('left', $portfolio_sidebar); ?> /> <?php esc_html_e('Left', 'cloud_clarity'); ?></label>&nbsp;&nbsp;
				    <label><input type="radio" name="cloud_clarity_options[portfolio_sidebar]" id="portfolio_sidebar_right" value="right" <?php checked('right', $portfolio_sidebar); ?> /> <?php esc_html_e('Right', 'cloud_clarity'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				    <span class="description"><?php esc_html_e("This is the sidebar shown on individual portflio items' posts", 'cloud_clarity'); ?></span>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Portfolio Post Date', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Portfolio Post Date', 'cloud_clarity'); ?></span></legend>
				    <label for="show_portfolio_post_date">
					<input name="cloud_clarity_options[show_portfolio_post_date]" type="checkbox" id="show_portfolio_post_date" value="yes" <?php checked('yes', $options['show_portfolio_post_date']); ?> />
					<?php esc_html_e('Show the date located at the top right corner next to the Post title (Single View).', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Portfolio Post Metadata', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Portfolio Post Metadata', 'cloud_clarity'); ?></span></legend>
				    <label for="show_portfolio_postmetadata">
					<input name="cloud_clarity_options[show_portfolio_postmetadata]" type="checkbox" id="show_portfolio_postmetadata" value="yes" <?php checked('yes', $options['show_portfolio_postmetadata']); ?> />
					<?php esc_html_e('Show Portfolio Post Metadata box (Single View).', 'cloud_clarity'); ?><br />
					<span class="description"><?php esc_html_e('This is the info box situated right under the post and just above the comments area.', 'cloud_clarity'); ?></span>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			    <tr valign="top">
				<th scope="row"><?php esc_html_e('Show Comment Area', 'cloud_clarity'); ?></th>
				<td>
				    <fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Show Comment Area', 'cloud_clarity'); ?></span></legend>
				    <label for="show_portfolio_comments">
					<input name="cloud_clarity_options[show_portfolio_comments]" type="checkbox" id="show_portfolio_comments" value="yes" <?php checked('yes', $options['show_portfolio_comments']); ?> />
					<?php esc_html_e('Show comment area in Portfolio posts (Single View)', 'cloud_clarity'); ?>
				    </label>
				    </fieldset>
				</td>
			    </tr>
			</tbody>
		    </table>
		</div>
<?php	}

	function blog_section_options_contentbox( $options ) {
		$blog_sidebar = $options['blog_sidebar']; ?>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Sidebar Position', 'cloud_clarity'); ?></th>
			    <td><?php  ?>
				<?php esc_html_e('Choose position:', 'cloud_clarity'); ?> <br />
				<label><input type="radio" name="cloud_clarity_options[blog_sidebar]" id="blog_sidebar_left" value="left" <?php checked('left', $blog_sidebar); ?> /> <?php esc_html_e('Left', 'cloud_clarity'); ?></label>&nbsp;&nbsp;
				<label><input type="radio" name="cloud_clarity_options[blog_sidebar]" id="blog_sidebar_right" value="right" <?php checked('right', $blog_sidebar); ?> /> <?php esc_html_e('Right', 'cloud_clarity'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="description"><?php esc_html_e('This is the sidebar shown on blog pages', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('"Read more" Button', 'cloud_clarity'); ?></th>
			    <td>
				<input name="cloud_clarity_options[blog_button_text]" type="text" id="blog_button_text" value="<?php if ($options['blog_button_text']) { echo esc_attr($options['blog_button_text']); } ?>" size="30" maxlength="100" />
				<?php esc_html_e("Enter the text for the post's 'Read more' button.  Leave blank to hide the button.", 'cloud_clarity'); ?>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Exclude Portfolio(s) from Blog', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Exclude Portfolio(s) from Blog', 'cloud_clarity'); ?></span></legend>
				<label for="exclude_portfolio_from_blog">
				    <input name="cloud_clarity_options[exclude_portfolio_from_blog]" type="checkbox" id="exclude_portfolio_from_blog" value="yes" <?php checked('yes', $options['exclude_portfolio_from_blog']); ?> />
				    <?php esc_html_e('Exclude Portfolio section(s) related posts from showing in the the general Blog section ("Blog page" template loop).', 'cloud_clarity'); ?><br />
				    <span class="description"><?php esc_html_e('Note: Portfolio posts are those that have been assigned to a portfolio related category. A portfolio related category is one which either directly or indireclty (parent or descendant) has been assigned to a "Portfolio page" template (see the "Portfolio section above for these assignments)', 'cloud_clarity'); ?></span>
				</label>
				</fieldset>
			    </td>
			</tr>
		    </tbody>
		</table>
<?php	}

	function contact_page_options_contentbox( $options ) {
		$show_contact_fields = $options['show_contact_fields'];
		$contact_field_name1 = $options['contact_field_name1'];
		$contact_field_value1 = $options['contact_field_value1'];
		$contact_field_name2 = $options['contact_field_name2'];
		$contact_field_value2 = $options['contact_field_value2'];
		$contact_field_name3 = $options['contact_field_name3'];
		$contact_field_value3 = $options['contact_field_value3'];
		$contact_field_name4 = $options['contact_field_name4'];
		$contact_field_value4 = $options['contact_field_value4'];
		$contact_field_name5 = $options['contact_field_name5'];
		$contact_field_value5 = $options['contact_field_value5'];
		$contact_field_name6 = $options['contact_field_name6'];
		$contact_field_value6 = $options['contact_field_value6'];
		$contact_field_name7 = $options['contact_field_name7'];
		$contact_field_value7 = $options['contact_field_value7'];
		$contact_sidebar = $options['contact_sidebar'];
		$NA_phone_format = $options['NA_phone_format'];
		$email_receipients = $options['email_receipients']; ?>
		<h4><?php esc_html_e('Enable Business Contact', 'cloud_clarity'); ?></h4>
		<fieldset style="margin: 10px 20px 20px"><legend class="screen-reader-text"><span><?php esc_html_e('Enable Contact Info Fields', 'cloud_clarity'); ?></span></legend>
		    <label for="show_contact_fields">
			<input name="cloud_clarity_options[show_contact_fields]" type="checkbox" id="show_contact_fields" value="yes" <?php checked('yes', $show_contact_fields); ?> />
			<?php esc_html_e('Enable the Business Contact fields (see below for description)', 'cloud_clarity'); ?>
		    </label>
		</fieldset>
		<h4><?php esc_html_e('Business Contact Fields', 'cloud_clarity'); ?></h4>
		<p style="margin:5px 20px">
		    <?php _e('The Business Contact Fields provide a way to better display additional contact information such as Company Name, Address, Phone, etc. An example of a Field pair could be <strong>Telephone: (123) 123-4567</strong>, where you would enter the "<strong>Telephone:</strong>" part in the first field and "<strong>(123) 123-4567</strong>" in the second (under the same "Line #") respectively.', 'cloud_clarity'); ?><br /><br />
		    <?php esc_html_e('Line 1:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name1]" type="text" id="contact_field_name1" value="<?php if ($contact_field_name1){echo esc_attr($contact_field_name1);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value1]" type="text" id="contact_field_value1" value="<?php if ($contact_field_value1){echo esc_attr($contact_field_value1);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 2:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name2]" type="text" id="contact_field_name2" value="<?php if ($contact_field_name2){echo esc_attr($contact_field_name2);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value2]" type="text" id="contact_field_value2" value="<?php if ($contact_field_value2){echo esc_attr($contact_field_value2);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 3:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name3]" type="text" id="contact_field_name3" value="<?php if ($contact_field_name3){echo esc_attr($contact_field_name3);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value3]" type="text" id="contact_field_value3" value="<?php if ($contact_field_value3){echo esc_attr($contact_field_value3);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 4:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name4]" type="text" id="contact_field_name4" value="<?php if ($contact_field_name4){echo esc_attr($contact_field_name4);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value4]" type="text" id="contact_field_value4" value="<?php if ($contact_field_value4){echo esc_attr($contact_field_value4);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 5:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name5]" type="text" id="contact_field_name5" value="<?php if ($contact_field_name5){echo esc_attr($contact_field_name5);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value5]" type="text" id="contact_field_value5" value="<?php if ($contact_field_value5){echo esc_attr($contact_field_value5);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 6:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name6]" type="text" id="contact_field_name6" value="<?php if ($contact_field_name6){echo esc_attr($contact_field_name6);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value6]" type="text" id="contact_field_value6" value="<?php if ($contact_field_value6){echo esc_attr($contact_field_value6);}?>" size="50" maxlength="70" /><br/>
		    <?php esc_html_e('Line 7:', 'cloud_clarity'); ?> <br />
		    <input name="cloud_clarity_options[contact_field_name7]" type="text" id="contact_field_name7" value="<?php if ($contact_field_name7){echo esc_attr($contact_field_name7);}?>" size="30" maxlength="50" />
			     <input name="cloud_clarity_options[contact_field_value7]" type="text" id="contact_field_value7" value="<?php if ($contact_field_value7){echo esc_attr($contact_field_value7);}?>" size="50" maxlength="70" /><br/><br/>
		    <span class="description"><?php esc_html_e('Some html tags and inline styling could be used for formatting here, e.g.', 'cloud_clarity'); ?> &lt;em&gt;Address:&lt;/em&gt; or &lt;span style=&quot;color:red;&quot;&gt;Address:&lt;/span&gt;</span>
		</p>
		<h4><?php esc_html_e('Sidebar Position', 'cloud_clarity'); ?></h4>
		<p><?php esc_html_e('Choose position:', 'cloud_clarity'); ?><br />
		    <label style="margin:20px"><input type="radio" name="cloud_clarity_options[contact_sidebar]" id="contact_sidebar_left" value="left" <?php checked('left', $contact_sidebar); ?> /> <?php esc_html_e('Left', 'cloud_clarity'); ?></label>&nbsp;
		    <label><input type="radio" name="cloud_clarity_options[contact_sidebar]" id="contact_sidebar_right" value="right" <?php checked('right', $contact_sidebar); ?> /> <?php esc_html_e('Right', 'cloud_clarity'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
		    <span class="description"><?php esc_html_e('This is the sidebar shown on the Contact page', 'cloud_clarity'); ?></span>
		</p>
		<h4><?php esc_html_e('Phone Number validation', 'cloud_clarity'); ?></h4>
		<p><?php esc_html_e('This is the field displayed in the E-mail form on the Contact page template. If checked, the validation for North American phone numbers will be enabled.', 'cloud_clarity'); ?></p>
		<fieldset style="margin: 10px 20px 20px"><legend class="screen-reader-text"><span><?php esc_html_e('Enable North American phone number validation') ?></span></legend>
		    <label for="NA_phone_format">
			<input name="cloud_clarity_options[NA_phone_format]" type="checkbox" id="NA_phone_format" value="yes" <?php checked('yes', $NA_phone_format); ?> />
			<?php esc_html_e('Enable North American phone number validation in the contact email form', 'cloud_clarity'); ?><br />
		    </label>
		</fieldset>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('E-mail Recipient(s)', 'cloud_clarity'); ?></th>
			    <td>
				<?php esc_html_e("Please enter recipient's email address, comma-separate multiple recipients:", 'cloud_clarity'); ?><br />
				<textarea style="width: 98%; font-size: 12px;" id="email_receipients" rows="2" cols="60" name="cloud_clarity_options[email_receipients]"><?php if( $email_receipients ){ echo esc_attr($email_receipients); } ?></textarea><br />
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Enable ReCAPTCHA', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Enable ReCAPTCHA', 'cloud_clarity'); ?></span></legend>
				<label for="recaptcha_enabled">
				    <input name="cloud_clarity_options[recaptcha_enabled]" type="checkbox" id="recaptcha_enabled" value="yes" <?php checked( 'yes', $options['recaptcha_enabled']); ?> />
				    <?php printf( esc_html__('Add ReCAPTCHA to the email form for extra security (for more information visit %s)', 'cloud_clarity'), '<a href="http://recaptcha.net/" target="_blank">www.recaptcha.net</a>' ); ?>
				</label><br />
				<span class="description"><?php esc_html_e('Please note: ReCAPTCHA will be automatically disabled if the two fields below are empty!', 'cloud_clarity'); ?></span>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('ReCAPTCHA Public Key', 'cloud_clarity'); ?></th>
			    <td>
				<input name="cloud_clarity_options[recaptcha_publickey]" type="text" id="recaptcha_publickey" value="<?php if ($options['recaptcha_publickey']) { echo esc_attr($options['recaptcha_publickey']); } ?>" size="55" maxlength="100" />
				<br /><?php esc_html_e('To use reCAPTCHA you must get an API public key from', 'cloud_clarity'); ?> <a href="http://recaptcha.net/api/getkey/" target="_blank">http://recaptcha.net/api/getkey</a>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('ReCAPTCHA Private Key', 'cloud_clarity'); ?></th>
			    <td>
				<input name="cloud_clarity_options[recaptcha_privatekey]" type="text" id="recaptcha_privatekey" value="<?php if ($options['recaptcha_privatekey']) { echo esc_attr($options['recaptcha_privatekey']); } ?>" size="55" maxlength="100" />
				<br /><?php esc_html_e('To use ReCAPTCHA you must get an API private key from', 'cloud_clarity'); ?> <a href="http://recaptcha.net/api/getkey/" target="_blank">http://recaptcha.net/api/getkey</a><br />
				<span class="description"><?php esc_html_e('This key is used when communicating between your server and the ReCAPTCHA server. Be sure to keep it a secret.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('ReCAPTCHA Theme', 'cloud_clarity'); ?></th>
			    <td>
				<label for="recaptcha_theme" class="link-target">
					<?php esc_html_e('Choose Theme: ', 'cloud_clarity'); ?>
					<select name="cloud_clarity_options[recaptcha_theme]" id="recaptcha_theme">
					    <option value="white"<?php echo ($options['recaptcha_theme'] == 'white') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('white', 'cloud_clarity'); ?></option>
					    <option value="red"<?php echo ($options['recaptcha_theme'] == 'red') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('red', 'cloud_clarity'); ?></option>
					    <option value="blackglass"<?php echo ($options['recaptcha_theme'] == 'blackglass') ? ' selected="selected"' : ''; ?>><?php esc_attr_e('blackglass', 'cloud_clarity'); ?></option>
					</select>
				</label>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('ReCAPTCHA Language', 'cloud_clarity'); ?></th>
			    <td>
				<label for="recaptcha_lang" class="link-target">
					<?php esc_html_e('Language: ', 'cloud_clarity'); ?>
					<select name="cloud_clarity_options[recaptcha_lang]" id="recaptcha_lang">
					    <option value="en"<?php echo ($options['recaptcha_lang'] == 'en') ? ' selected="selected"' : ''; ?>>English</option>
					    <option value="nl"<?php echo ($options['recaptcha_lang'] == 'nl') ? ' selected="selected"' : ''; ?>>Dutch</option>
					    <option value="fr"<?php echo ($options['recaptcha_lang'] == 'fr') ? ' selected="selected"' : ''; ?>>French</option>
					    <option value="de"<?php echo ($options['recaptcha_lang'] == 'de') ? ' selected="selected"' : ''; ?>>German</option>
					    <option value="pt"<?php echo ($options['recaptcha_lang'] == 'pt') ? ' selected="selected"' : ''; ?>>Portuguese</option>
					    <option value="ru"<?php echo ($options['recaptcha_lang'] == 'ru') ? ' selected="selected"' : ''; ?>>Russian</option>
					    <option value="es"<?php echo ($options['recaptcha_lang'] == 'es') ? ' selected="selected"' : ''; ?>>Spanish</option>
					    <option value="tr"<?php echo ($options['recaptcha_lang'] == 'tr') ? ' selected="selected"' : ''; ?>>Turkish</option>
					</select>
				</label>
			    </td>
			</tr>
		    </tbody>
		</table>
<?php	}

	function footer_options_contentbox( $options ) {
		$copyright_message = $options['copyright_message'];
		$show_wp_link_in_footer = $options['show_wp_link_in_footer'];
		$show_entries_rss_in_footer = $options['show_entries_rss_in_footer'];
		$show_comments_rss_in_footer = $options['show_comments_rss_in_footer']; ?>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Copyright Message', 'cloud_clarity'); ?></th>
			    <td>
				<textarea style="width: 98%; font-size: 12px;" id="copyright_message" rows="2" cols="60" name="cloud_clarity_options[copyright_message]"><?php if( $copyright_message ){ echo esc_attr($copyright_message); } ?></textarea>
				<br />
				<span class="description"><?php esc_html_e('Copyright message displayed in the footer.', 'cloud_clarity'); ?></span>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('WordPress credits link', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('WordPress credits link', 'cloud_clarity'); ?></span></legend>
				<label for="show_wp_link_in_footer">
				    <input name="cloud_clarity_options[show_wp_link_in_footer]" type="checkbox" id="show_wp_link_in_footer" value="yes" <?php checked('yes', $show_wp_link_in_footer); ?> />
				    <?php printf( esc_html__('Show "is proudly powered by %s" in footer?', 'cloud_clarity'), '<strong>WordPress</strong>' ); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Entries (RSS) link', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Entries (RSS) link', 'cloud_clarity'); ?></span></legend>
				<label for="show_entries_rss_in_footer">
				    <input name="cloud_clarity_options[show_entries_rss_in_footer]" type="checkbox" id="show_entries_rss_in_footer" value="yes" <?php checked('yes', $show_entries_rss_in_footer); ?> />
				    <?php esc_html_e('Show "Entries (RSS)" link in footer?', 'cloud_clarity'); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
			<tr valign="top">
			    <th scope="row"><?php esc_html_e('Comments (RSS) link', 'cloud_clarity'); ?></th>
			    <td>
				<fieldset><legend class="screen-reader-text"><span><?php esc_html_e('Comments (RSS) link', 'cloud_clarity'); ?></span></legend>
				<label for="show_comments_rss_in_footer">
				    <input name="cloud_clarity_options[show_comments_rss_in_footer]" type="checkbox" id="show_comments_rss_in_footer" value="yes" <?php checked('yes', $show_comments_rss_in_footer); ?> />
				    <?php esc_html_e('Show "Comments (RSS)" link in footer?', 'cloud_clarity'); ?>
				</label>
				</fieldset>
			    </td>
			</tr>
		    </tbody>
		</table>
<?php	}

	function statistics_options_contentbox( $options ) {
		$google_analaytics = $options['google_analaytics']; ?>
		<table class="form-table">
		    <tbody>
			<tr valign="top">
			<th scope="row"><label for="google_analaytics"><?php esc_html_e('Google Analytics', 'cloud_clarity'); ?></label></th>
			<td>
			    <textarea class="code" style="width: 98%; font-size: 12px;" id="google_analaytics" rows="10" cols="60" name="cloud_clarity_options[google_analaytics]"><?php if( $google_analaytics ){ echo esc_attr($google_analaytics); } ?></textarea>
			    <br />
			    <span class="description"><?php esc_html_e('Paste your Google Analytics or other tracking code here. It will be inserted just before the closing body tag for every page', 'cloud_clarity'); ?></span>
			</td>
			</tr>
		    </tbody>
		</table>
<?php	}



} // end of cloud_clarity_Theme_Options Class

function get_pm_slider_default_info_txt() {
    $secial_break_char = "special_break";
    $this_site_url = get_bloginfo('url');
    return <<<XML
<headline>Description Text</headline>
<break>{$secial_break_char}</break>
<paragraph>Here you can add a description text for this slide.</paragraph>
<break>{$secial_break_char}</break>
<inline>This text will be loaded from an XML file and formatted with an external CSS file. You can also easily add {$secial_break_char}</inline>
<a href="{$this_site_url}" target="_blank">hyperlinks</a>
<paragraph>. This one leads you to the home page, by the way.</paragraph>
XML;
}

function get_c2_slide_default_info_txt() {
    return <<<XML
<h2>Title Goes Here...</h2>

<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>

<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
XML;
}

// let's begin...
$my_cloud_clarity_Theme_Options = new cloud_clarity_Theme_Options();




