<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
?>

<?php
	global $cloud_clarity_options;
	$sidebar_position = ( $cloud_clarity_options['pages_sidebar'] == 'left' ) ? 'grid_8 pull_16 sidebar-box' : 'grid_8';
?>
	<div id="sidebar" class="<?php echo $sidebar_position; ?>">
	    <div id="sidebarSubnav">

<?php		    // Widgetized sidebar
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Pages Sidebar') ) : ?>

			<div class="custom-formatting">
			    <h3><?php esc_html_e('About This Sidebar', 'cloud_clarity'); ?></h3>
			    <ul>
				<?php _e("To edit this sidebar, go to admin backend's <strong><em>Appearances -> Widgets</em></strong> and place widgets into the <strong><em>Pages Sidebar</em></strong> Widget Area", 'cloud_clarity'); ?>
			    </ul>
			</div>

<?php		    endif; ?>
	    </div>
	    <!-- end sidebarSubnav -->
	</div>
	<!-- end sidebar -->


