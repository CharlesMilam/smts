<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */


// Create Text Domain For the Themes' Translations
if (function_exists('load_theme_textdomain')) {
    load_theme_textdomain('cloud_clarity', get_template_directory().'/locale');
}

// load styles
function my_init_styles() {
    if( !is_admin() ){
	// get the desired color scheme
	global $style;
	wp_enqueue_style('reset', get_bloginfo('template_url') . '/styles/common-css/reset.css', false, '1.0', 'screen');
	wp_enqueue_style('text', get_bloginfo('template_url') . "/styles/{$style}/css/text.css", false, '1.0', 'screen');
	wp_enqueue_style('grid-960', get_bloginfo('template_url') . '/styles/common-css/960.css', false, '1.0', 'screen');
	wp_enqueue_style('superfish_menu', get_bloginfo('template_url') . '/scripts/superfish-1.4.8/css/superfish.css', false, '1.0', 'screen');
	wp_enqueue_style('pagination', get_bloginfo('template_url') . '/scripts/pagination/pagenavi-css.css', false, '1.0', 'screen');
	wp_enqueue_style('style', get_bloginfo('template_url') . "/styles/{$style}/css/style.css", false, '1.0', 'screen');
	wp_enqueue_style('pretty_photo', get_bloginfo('template_url') . '/scripts/prettyPhoto/css/prettyPhoto.css', false, '1.0', 'screen');
    }
}
add_action('wp_print_styles', 'my_init_styles');

// load scripts
function my_init_scripts() {
    if( !is_admin() ){
	global $cloud_clarity_options, $current_slider;

	// Superfish Dropdown menu scripts
	wp_enqueue_script('hoverIntent', get_bloginfo('template_url')."/scripts/superfish-1.4.8/js/hoverIntent.js", array('jquery'), '1.0.0', false);
	wp_enqueue_script('superfish', get_bloginfo('template_url')."/scripts/superfish-1.4.8/js/superfish.js", array('jquery'), '1.4.8', false);
	wp_enqueue_script('supersubs', get_bloginfo('template_url')."/scripts/superfish-1.4.8/js/supersubs.js", array('jquery'), '0.2.0', false);

	// Miscellaneous JS scripts
	wp_enqueue_script('scripts', get_bloginfo('template_url')."/scripts/script.js", array('jquery'), '1.0', false);
    }
}
add_action('wp_print_scripts', 'my_init_scripts');


// Menu functions with support for WordPress 3.0 menus
if ( function_exists('wp_nav_menu') ) {
    add_theme_support( 'nav-menus' );
    register_nav_menus( array(
	'primary' => esc_html__( 'Primary Navigation', 'cloud_clarity' ),
    ) );
}

function cloud_clarity_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
	wp_nav_menu( array( 'menu_class' => 'sf-menu',
			    'link_before'=> '<span>',
			    'link_after' => '</span>',
			    'theme_location' => 'primary',
			    'fallback_cb' => 'cloud_clarity_nav_fallback' )
			);
    else
        cloud_clarity_nav_fallback();
}

function cloud_clarity_nav_fallback() {
    global $cloud_clarity_options;
    $menu_html = '<ul class="sf-menu">';
    $menu_html .= is_front_page() ? "<li class='current_page_item'>" : "<li>";
    $menu_html .= '<a href="'.get_bloginfo('wpurl').'"><span>'.esc_html__('Home', 'cloud_clarity').'</span></a></li>';
    $menu_html .= pages_without_title_attribute('depth=5&title_li=0&sort_column=menu_order&link_before=<span>&link_after=</span>&exclude='.$cloud_clarity_options['excluded_paged_from_menu']);
    $menu_html .= '</ul>';
    echo $menu_html;
}


if ( function_exists('add_theme_support') ) {
    add_theme_support( 'automatic-feed-links' );
}elseif ( function_exists('automatic_feed_links') ) {
    automatic_feed_links();
}


function pages_without_title_attribute($args) {
    if ($args) {
	$args .= '&echo=0';
    } else {
	$args = 'echo=0';
    }
    $pages = wp_list_pages($args);
    $pages = preg_replace('/title=\"(.*?)\"/', '', $pages);
    return $pages;
}
function subnav_pages_without_title_attribute($args) {
    $pages = wp_list_pages($args);
    $pages = preg_replace('/title=\"(.*?)\"/', '', $pages);
    return $pages;
}


/* Check for image */
function findImage() {
	$content = get_the_content();
	$count = substr_count($content, '<img');
	if ($count > 0) return true;
	else return false;
}

/* Get the first image from the post and return it */
function get_image_url() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
	$first_img = "/images/thumbnail-default.jpg";
    }
    return $first_img;
}


/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
function post_is_in_descendant_category( $cats, $_post = null )
{
    foreach ( (array) $cats as $cat ) {
	// get_term_children() accepts integer ID only
	$descendants = get_term_children( (int) $cat, 'category');
	if ( $descendants && in_category( $descendants, $_post ) )
	return true;
    }
    return false;
}

/**
 * Tests if any of a post's assigned categories are in the target categories or in any of the descendants
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 */
function post_is_in_category_or_descendants( $cats, $_post = null )
{
    if( in_category( $cats, $_post = null ) || post_is_in_descendant_category( $cats, $_post = null ) ) {
	return true;
    }
    return false;
}

/**
 * Check the validity of the given Phone Numbers (North American)
 * This regex will validate a 10-digit North American telephone number.
 * Separators are not required, but can include spaces, hyphens, or periods.
 * Parentheses around the area code are also optional.
 *
 * @param string $phone The phone number
 * @return bool true if the phone number is valid or false otherwise
 */
function isPhoneNumberValid( $phone ) {
    // validate a phone number
    $pattern = '/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/';
    return preg_match( $pattern, $phone );
}


// Custom Comment template
function mytheme_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment;
   $template_dir_url = get_bloginfo('template_url'); ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
	<div class="comment-meta vcard pngfix">
	    <div class="avatar-wrapper">
<?php		echo get_avatar( $comment, $size='52', $default="{$template_dir_url}/styles/common-images/mystery-man.jpg" ); ?>
	    </div>
	    <div class="commentmetadata">
		<div class="author"><?php comment_author_link() ?></div>
<?php		    printf(__('<span class="time">%1$s</span> on <a href="#comment-%2$s" title="">%3$s</a>', 'cloud_clarity'), get_comment_time(__('g:i a')), get_comment_ID(), get_comment_date(__('F j, Y')) );
		    edit_comment_link(esc_html__('edit', 'cloud_clarity'),'&nbsp;&nbsp;',''); ?>
	    </div>
	</div>

	<div class="commenttext">
	    <div class="round-corner-t-l pngfix"></div><div class="round-corner-t-r pngfix"></div><div class="round-corner-b-l pngfix"></div><div class="round-corner-b-r pngfix"></div>
<?php	    if ($comment->comment_approved == '0') : ?>
		<em><?php esc_html_e('Your comment is awaiting moderation.', 'cloud_clarity') ?></em>
		<br />
<?php	    endif; ?>
<?php	    comment_text() ?>
	    <div class="reply">
<?php		comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	    </div>
	</div>


     </div>
<?php
}


/***************** BEGIN EXCERPTS ******************/
// change the length of excerpts
function new_excerpt_length( $length ) {
    global $cloud_clarity_options;
    return $cloud_clarity_options['excerpt_length_in_words'];
}
add_filter('excerpt_length', 'new_excerpt_length');

// change the 'more' of excerpts
function moreLink( $content ){
    global $cloud_clarity_options;
    $more_phrase = $cloud_clarity_options['excerpt_more_phrase'];
    return str_replace( '[...]', '<small class="read_more"><a href="'.get_permalink().'"> '.$more_phrase.'</a></small>', $content );
}
add_filter('the_excerpt', 'moreLink');
/***************** END EXCERPTS ******************/


/***************** BEGIN SHORTCODES ******************/
// Allows shortcodes to be displayed in sidebar widgets
add_filter('widget_text', 'do_shortcode');

// Button Shortcode: use the following format:
// [button text="Read more..." style="white" title="Nice Button" url="http://www.example.com/" align="left"]
function button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'cloud_clarity'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
    ), $atts));

    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' dark-button': ' light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"><span class="pngfix">'.$text.'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('button', 'button_func');

// Small Button Shortcode: use the following format:
// [small_button text="Read more..." style="white" title="Nice Button" url="http://www.example.com/" align="left"]
function small_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'cloud_clarity'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
    ), $atts));

    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' small-dark-button': ' small-light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"><span class="pngfix">'.$text.'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('small_button', 'small_button_func');

// Sign Up Button Shortcode: use the following format:
// [signup url="http://www.example.com/" target="_target"]
function signup_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'url' => '#',
	    'target' => '_self',
    ), $atts));

    $html = '<p class="signup-button"><a href="'.$url.'" target="'.$target.'">Signup</a></p>';
    return $html;
}
add_shortcode('signup', 'signup_button_func');



// Mesage Box Shortcode: use the following format:
// [message type="info"]Your info message goes here...[/message]
// there are 4 pre-set message types: "info", "success", "warning", "erroneous"
// and a "custom" style: [message type="custom" width="94%" bgcolor="#EEEEEE" border="#BBBBBB" color="#333333"]Your info message goes here...[/message]
// width could be in pixels as well, e.g. width="250px"
function info_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => 'custom',
	    'bgcolor' => '#EEE',
	    'border' => '#BBB',
	    'width' => 'auto',
	    'color' => '#333',
    ), $atts));
    if ($type == 'custom') {
	$html = '<div class="'.$type.'" style="background:-moz-linear-gradient(center top , #FFFFFF, '.$bgcolor.') repeat scroll 0 0 transparent;
					       background: -webkit-gradient(linear, center top, center bottom, from(#FFF), to('.$bgcolor.'));
					       border:1px solid '.$border.';
					       background-color: '.$bgcolor.';
					       width:'.$width.';
					       color:'.$color.';">'.$content.'</div>';
    } else {
	$html = '<div class="'.$type.'"><div class="msg-box-icon pngfix">'.$content.'</div></div>';
    }
    return $html;
}
add_shortcode('message', 'info_func');

// Dropcap Shortcode
// [dropcap]A[/dropcap]
function dropcap_func( $atts, $content = null ) {
    extract(shortcode_atts(array(), $atts));
    $html = '<span class="dropcap">'.$content.'</span>';
    return $html;
}
add_shortcode('dropcap', 'dropcap_func');

/***************** END SHORTCODES ******************/



/**
 * Checks whether a dynamic sidebar exists
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if sidebar exists. False otherwise.
 */
function sidebar_exist( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) )
	    return true;
    }
    return false;
}

/**
 * Checks whether a dynamic sidebar exists and if is active (has any widgets)
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if exists and active (using widgets). False otherwise.
 */
function sidebar_exist_and_active( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) ) {
	    return is_active_sidebar( $sidebar['id'] );
	}
    }
    return false;
}

/* Widget Settings */

function recent_comment_author_link( $return ) {
	return str_replace( $return, "<span></span>$return", $return );
}
add_filter('get_comment_author_link', 'recent_comment_author_link');

function filter_widget( $params ) {
    switch( _get_widget_id_base($params[0]['widget_id']) ) {
	case 'recent-posts':
	case 'categories':
	case 'archives':
	case 'pages':
	case 'links':
	case 'meta':
	case 'custom-category-widget': // cloud_clarity: Custom Category
	case 'loginform-widget': // cloud_clarity: Login Form
	case 'subpages-widget': // cloud_clarity: Subpages
	case 'nav_menu': // WP 3 widget menu support
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	case 'rss':
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-rss-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	default:
	      //var_dump( _get_widget_id_base($params[0]['widget_id']) );
	      //var_dump( $params );
	      return $params;
    }
}
add_filter('dynamic_sidebar_params','filter_widget');

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Pages Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for regular pages.', 'cloud_clarity'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PortfolioSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Portfolio section.', 'cloud_clarity'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'BlogSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Blog/News section.', 'cloud_clarity'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'ContactSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Contact page.', 'cloud_clarity'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	// Front Page Before Content Widget Area
	register_sidebar(array(
		'name' => 'Home Page Before Content',
		'description' => esc_html__('A widget area positioned just above the Home Page Main Content area.', 'cloud_clarity'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_1_title">',
		'after_title' => '</h3>',
	));

	// Front Page Content Widget Areas
	register_sidebar(array(
		'name' => 'Home Page Column 1',
		'description' => esc_html__('A widget area, used as the 1st column in the Main Content area.', 'cloud_clarity'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_1_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Home Page Column 2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Main Content area.', 'cloud_clarity'),
		'before_widget' => '<div class="cont_col_2 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_2_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Home Page Column 3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Main Content area.', 'cloud_clarity'),
		'before_widget' => '<div class="cont_col_3 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_3_title">',
		'after_title' => '</h3>',
	));

	// Bottom Widget Areas
	register_sidebar(array(
		'name' => 'Bottom 1',
		'description' => esc_html__('A widget area, used as the 1st column in the Bottom area (just above the footer).', 'cloud_clarity'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => 'Bottom 2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Bottom area (just above the footer).', 'cloud_clarity'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => 'Bottom 3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Bottom area (just above the footer).', 'cloud_clarity'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

    register_sidebar(array(
		'name' => 'Bottom 4',
		'description' => esc_html__('A widget area, used as the 4th column in the Bottom area (just above the footer).', 'cloud_clarity'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
    ));
}


/* Custom widgets... */
include ('widgets/loginForm-widget.php');
include ('widgets/customCategory-widget.php');
include ('widgets/googleMap-widget.php');
include ('widgets/latestPost-widget.php');
include ('widgets/subpages-widget.php');

// Return a string of html and php code used for displaying widget areas with dynamic width
function get_column( $id = '', $class = '', $widget_area = '' ) {
    return "<div id='{$id}' class='{$class}'><div class='column-content-wrapper'><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('{$widget_area}') ) : endif; ?></div></div><!-- end {$id} -->";
}


/* Load the cloud_clarity Options Page */
include( 'cloud_clarity_options_page.php' );

// Remove meta name="generator" content="WordPress" from the <head>
remove_action('wp_head', 'wp_generator');


/* Load breadcrumbs script */
if ($cloud_clarity_options['show_breadcrumbs'] == 'yes')
    include( 'scripts/breadcrumbs.php' );




